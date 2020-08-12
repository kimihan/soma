<?php

require_once(APPPATH."libraries/MY_Model.php");
class Pagseguro_model {

    private $CI;
    private $email;
    private $token;
    private $sessionId;
    private $preApprovalCode;
    private $plain;
    private $idServico;
    private $dataSender;
    private $dataPaymentMethod;
    private $dataPayment;

    function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->load->model(["formas_pagamento_model"]);

        $this->init();
    }

    private function init() {
        $formasPagamento = (array) $this->CI->formas_pagamento_model->retornaDados(null, ["operadora" => "PagSeguro"]);
        $formasPagamento = array_shift($formasPagamento);

        $this->setEmail($formasPagamento->email)->setToken($formasPagamento->token);

        return $formasPagamento;
    }

    public function createSessionId() {
        $retorno = $this->sendCurl("v2/sessions?email={$this->getEmail()}&token={$this->getToken()}", 
                                    "email={$this->getEmail()}&token={$this->getToken()}");

        $parseXml = simplexml_load_string($retorno);
        $sessionId = $parseXml->id[0]->__toString();

        $this->setSessionId($sessionId);

        return $sessionId;
    }

    public function createPreApprovals() {
        $fields = "{\r\n\t\"plan\": \"{$this->getPlain()}\", \r\n\t\"reference\": \"{$this->getIdServico()}\",{$this->createSender()},{$this->createPaymentMethod()}";

        $headers = [
            "Accept: application/vnd.pagseguro.com.br.v1+json;charset=ISO-8859-1",
            "Content-Type: application/json"
        ];

        $retorno = $this->sendCurl("pre-approvals?email={$this->getEmail()}&token={$this->getToken()}", $fields, $headers);

        return $retorno;
    }

    public function createPayment() {
        $dataPayment = $this->getDataPayment();

        $headers = [
            "Content-Type: application/xml",
            "Accept: application/vnd.pagseguro.com.br.v3+json;charset=ISO-8859-1"
        ];

        $price = number_format($dataPayment['vrPreco'], 2);

        $fields = "<payment>\r\n\t<items>\r\n\t\t<item>\r\n\t\t\t<id>{$dataPayment['idServico']}</id>\r\n\t\t\t<description>{$dataPayment['descNome']}</description>\r\n\t\t\t<amount>{$price}</amount>\r\n\t\t\t<quantity>1</quantity>\r\n\t\t</item>\r\n\t</items>\r\n\t<reference>{$dataPayment['idServico']}</reference>\r\n\t<hash>{$dataPayment['hashReady']}</hash>\r\n\t<preApprovalCode>{$dataPayment['codePreApproval']}</preApprovalCode>\r\n</payment>";

        $retorno = $this->sendCurl("pre-approvals/payment?email={$this->getEmail()}&token={$this->getToken()}", $fields, $headers);

        return $retorno;
       
    }

    private function createSender() {
        $dataSender = $this->getDatasender();

        $phone = ["areaCode" => substr($dataSender["numTelefone"], 0, 2), 
                    "number" => substr($dataSender["numTelefone"], 2, strlen($dataSender["numTelefone"]) -1 )];
        $address = ["street" => $dataSender["descLogradouro"], "number" => $dataSender["numLocal"], "complement" => $dataSender["descComplemento"], 
                    "district" => $dataSender["descBairro"], "city" => $dataSender["descCidade"], "state" => $dataSender["siglaUf"], 
                    "country" => "BRA", "postalCode" => $dataSender["numCep"]];
        $documents = ["type" => "CPF", "value" => $dataSender["numCpf"]];
        
        $sender = "\r\n\t\"sender\": {\r\n\t\t\"name\": \"{$dataSender['descNome']}\",\r\n\t\t\"email\": \"{$dataSender['descEmail']}\",
            \r\n\t\t\"hash\": \"{$dataSender['hashReady']}\",
            \r\n\t\t\"phone\": {\r\n\t\t\t\"areaCode\": \"{$phone['areaCode']}\",\r\n\t\t\t\"number\": \"{$phone['number']}\"\r\n\t\t},
            \r\n\t\t\"address\": {\r\n\t\t\t\"street\": \"{$address['street']}\",\r\n\t\t\t\"number\": \"{$address['number']}\",\r\n\t\t\t\"complement\": \"\",
            \r\n\t\t\t\"district\": \"{$address['district']}\",\r\n\t\t\t\"city\": \"{$address['city']}\",\r\n\t\t\t\"state\": \"{$address['state']}\",\r\n\t\t\t\"country\": \"BRA\",
            \r\n\t\t\t\"postalCode\": \"{$address['postalCode']}\"\r\n\t\t},\r\n\t\t\"documents\": [{\r\n\t\t\t\"type\": \"CPF\",\r\n\t\t\t\"value\": \"{$documents['value']}\"\r\n\t\t}]\r\n\t}";

        return $sender;
    }

    private function createPaymentMethod() {
        $dataSender = $this->getDatasender();
        $dataPaymentMethod = $this->getDataPaymentMethod();

        $phone = ["areaCode" => substr($dataSender["numTelefone"], 0, 2), 
                    "number" => substr($dataSender["numTelefone"], 2, strlen($dataSender["numTelefone"]) -1 )];
        $documents = ["type" => "CPF", "value" => $dataSender["numCpf"]];
        $holder = ["name" => $dataPaymentMethod["nomeCartao"], "birthDate" => $dataPaymentMethod["dataNascimento"], 
                    "documents" => $documents, "phone" => $phone];
        $billingAddress = ["street" => $dataSender["descLogradouro"], "number" => $dataSender["numLocal"], "complement" => $dataSender["descComplemento"], 
        "district" => $dataSender["descBairro"], "city" => $dataSender["descCidade"], "state" => $dataSender["siglaUf"], 
        "country" => "BRA", "postalCode" => $dataSender["numCep"]];

        $paymentMethod = "\r\n\t\"paymentMethod\": {\r\n\t\t\"type\": \"CREDITCARD\",\r\n\t\t\"creditCard\": {\r\n\t\t\t\"token\": \"{$dataPaymentMethod['token']}\",
            \r\n\t\t\t\"holder\": {\r\n\t\t\t\t\"name\": \"{$holder['name']}\",\r\n\t\t\t\t\"birthDate\": \"{$holder['birthDate']}\",
            \r\n\t\t\t\t\"documents\": [{\r\n\t\t\t\t\t\"type\": \"CPF\",\r\n\t\t\t\t\t\"value\": \"{$documents['value']}\"\r\n\t\t\t\t}],
            \r\n\t\t\t\t\"phone\": {\r\n\t\t\t\t\t\"areaCode\": \"{$phone['areaCode']}\",\r\n\t\t\t\t\t\"number\": \"{$phone['number']}\"\r\n\t\t\t\t},
            \r\n\t\t\t\t\"billingAddress\": {\r\n\t\t\t\t\t\"street\": \"{$billingAddress['street']}\",\r\n\t\t\t\t\t\"number\": \"{$billingAddress['number']}\",
            \r\n\t\t\t\t\t\"complement\": \"\",\r\n\t\t\t\t\t\"district\": \"{$billingAddress['district']}\",\r\n\t\t\t\t\t\"city\": \"{$billingAddress['city']}\",\r\n\t\t\t\t\t\"state\": \"{$billingAddress['state']}\",
            \r\n\t\t\t\t\t\"country\": \"BRA\",\r\n\t\t\t\t\t\"postalCode\": \"{$billingAddress['postalCode']}\"\r\n\t\t\t\t}\r\n\t\t\t}\r\n\t\t}\r\n\t}\r\n}";

        //var_dump($paymentMethod);
        
        return $paymentMethod;
    }

    public function sendCurl($path, $fields, $headers = NULL) {
        $ch = curl_init();
        $url = (AMBIENTE_DEV != "1") ? "https://ws.pagseguro.uol.com.br/" : "https://ws.sandbox.pagseguro.uol.com.br/";

        curl_setopt($ch, CURLOPT_URL, $url . $path);
        
        //definindo a url de busca 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        //definino que o método de envio, será POST
        curl_setopt($ch, CURLOPT_POST, TRUE);
        
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

        if(!empty($headers)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }
        
        //definindo uma variável para receber o conteúdo da página...
        $retorno = curl_exec($ch);
        
        //fechando-o para liberação do sistema.
        curl_close($ch); //fechamos o recurso e liberamos o sistema...
        
        //mostrando o conteúdo...
        return $retorno;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getToken() {
        return $this->token;
    }

    public function getSessionId() {
        return $this->sessionId;
    }

    public function getPreApprovalCode() {
        return $this->preApprovalCode;
    }

    public function getPlain() {
        return $this->plain;
    }

    public function getIdServico() {
        return $this->idServico;
    }

    public function getDatasender() {
        return $this->dataSender;
    }

    public function getDataPaymentMethod() {
        return $this->dataPaymentMethod;
    }
    
    public function getDataPayment() {
        return $this->dataPayment;
    }

    public function setEmail($email) {
        $this->email = $email;

        return $this;
    }

    public function setToken($token) {
        $this->token = $token;

        return $this;
    }

    public function setSessionId($sessionId) {
        $this->sessionId = $sessionId;

        return $this;
    }

    public function setPreApprovalCode($preApprovalCode) {
        $this->preApprovalCode = $preApprovalCode;

        return $this;
    }

    public function setPlain($plain) {
        $this->plain = $plain;

        return $this;
    }

    public function setIdServico($idServico) {
        $this->idServico = $idServico;

        return $this;
    }

    public function setDatasender($dataSender) {
        $this->dataSender = $dataSender;

        return $this;
    }

    public function setDataPaymentMethod($dataPaymentMethod) {
        $this->dataPaymentMethod = $dataPaymentMethod;

        return $this;
    }
    
    public function setDataPayment($dataPayment) {
        $this->dataPayment = $dataPayment;

        return $this;
    }
    
}
               
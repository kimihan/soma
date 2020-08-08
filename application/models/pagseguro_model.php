<?php

require_once(APPPATH."libraries/MY_Model.php");
class Pagseguro_model {

    private $CI;
    private $email;
    private $token;
    private $sessionId;

    function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->load->model(["formas_pagamento_model"]);
    }

    private function init() {
        $formasPagamento = (array) $this->CI->formas_pagamento_model->retornaDados(null, ["operadora" => "PagSeguro"]);
        $formasPagamento = array_shift($formasPagamento);

        $this->setEmail($formasPagamento->email)->setToken($formasPagamento->token);

        return $formasPagamento;
    }

    public function createSessionId() {
        $this->init();
        $retorno = $this->sendCurl();

        $parseXml = simplexml_load_string($retorno);
        $sessionId = $parseXml->id[0]->__toString();

        $this->setSessionId($sessionId);

        return $sessionId;
    }

    public function sendCurl() {
        $cr = curl_init();
        $url = (AMBIENTE_DEV != "1") ? "https://ws.pagseguro.uol.com.br/" : "https://ws.sandbox.pagseguro.uol.com.br/";

        curl_setopt($cr, CURLOPT_URL, $url . "v2/sessions?email={$this->getEmail()}&token={$this->getToken()}");
        
        //definindo a url de busca 
        curl_setopt($cr, CURLOPT_RETURNTRANSFER, true);
        
        //definino que o método de envio, será POST
        curl_setopt($cr, CURLOPT_POST, TRUE);
        
        //definindo os dados que serão enviados
        curl_setopt($cr, CURLOPT_POSTFIELDS, "email={$this->getEmail()}&token={$this->getToken()}");
        
        //definindo uma variável para receber o conteúdo da página...
        $retorno = curl_exec($cr);
        
        //fechando-o para liberação do sistema.
        curl_close($cr); //fechamos o recurso e liberamos o sistema...
        
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
}
               
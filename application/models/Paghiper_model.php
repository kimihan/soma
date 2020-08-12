<?php

require_once(APPPATH."libraries/MY_Model.php");
class Paghiper_model {

    private $CI;
    private $token;
    private $apiKey;

    function __construct()
    {
        $this->CI = &get_instance();

        $this->token = PAGHIPER_TOKEN;
        $this->apiKey = PAGHIPER_APIKEY;
    }

    function geraBoletosMensais($idCliente, $vrPreco)
    {
        $this->CI->load->model("app_gerencial/manupula_cliente_model");
        $this->CI->load->library("Paghiper_pagamento_library");

        $dadosClientes = $this->CI->manupula_cliente_model->retornaDadosCliente($idCliente);

        $vencimentos = $this->calcularParcelas(13);
        $params = array();

        $arrayBoletos = array();
        for($x = 1;$x <= 12; $x++) {
            $params["apiKey"] = $this->apiKey;
            $params["order_id"] = $idCliente."-".$x;
            $params["payer_email"] = $dadosClientes->descEmail;
            $params["payer_name"] = $dadosClientes->descNome;
            $params["payer_cpf_cnpj"] = $dadosClientes->numCpf;
            $params["type_bank_slip"] = "boletoCarne";
            $params["days_due_date"] = $vencimentos[$x];
            $params["items"]  = array(
                array ("description" => "Pagamento mensalidade seguro-".$x,
                    "quantity" => "1",
                    "item_id" => $x,
                    "price_cents" => str_replace(".","",$vrPreco)));

            $arrayBoletos[] = $this->CI->paghiper_pagamento_library->emiteBoleto($params);
        }

        foreach($arrayBoletos as $key => $boleto) {
            $boleto = json_decode($boleto);
            $arrayIds[] = $boleto->create_request->transaction_id;
        }

        $dadosCarne["token"] = $this->token;
        $dadosCarne["apiKey"] = $this->apiKey;
        $dadosCarne["type_bank_slip"] = "boletoA4";
        $dadosCarne["transactions"] = $arrayIds;
        $carneBoletos = $this->CI->paghiper_pagamento_library->multiple_bank($dadosCarne);

        return $carneBoletos;
    }

    function calcularParcelas($nParcelas, $dataPrimeiraParcela = null){
        if($dataPrimeiraParcela != null){
            $dataPrimeiraParcela = explode( "/",$dataPrimeiraParcela);
            $dia = $dataPrimeiraParcela[0];
            $mes = $dataPrimeiraParcela[1];
            $ano = $dataPrimeiraParcela[2];
        } else {
            $dia = date("d");
            $mes = date("m");
            $ano = date("Y");
        }

        for($x = 0; $x < $nParcelas; $x++){
            $vencimento = date("Y-m-d",strtotime("+".$x." month",mktime(0, 0, 0,$mes,$dia,$ano)));
            $d1 = strtotime(date("Y-m-d"));
            $d2 = strtotime($vencimento);

            $dataFinal = ($d2 - $d1) /86400;
            $arrayVencimentos[] = number_format($dataFinal, 0);
        }

        return $arrayVencimentos;
    }
}
               
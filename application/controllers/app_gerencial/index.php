<?php

require_once(APPPATH.'libraries/MY_Controller.php');
class Index extends MY_Controller {

    /**
     * Método construtor da classe
     *
     * @access public
     */
    function __construct() 
    {
        parent::__construct();
    }

    /**
     * Método principal da classe
     *
     * @access public
     */
    function index()
    {	
        $this->load->model("app_gerencial/manupula_cliente_model");
        $this->load->model("app_gerencial/manipula_cobranca_model");
        
        $dadosBusca = $_GET;

        $dataInicial = NULL;
        if(!empty($dadosBusca["data_inicial"])) {
            $dataInicial = $dadosBusca["data_inicial"];
        }

        $dataFinal = NULL;
        if(!empty($dadosBusca["data_final"])) {
            $dataFinal = $dadosBusca["data_final"];
        }

        //clientes
        $param["clientesAdimplementes"] = $this->manupula_cliente_model->retornaClientesAdimplentes($dataInicial, $dataFinal);
        $param["clientesInadimplentes"] = $this->manupula_cliente_model->retornaClientesInadimplentes($dataInicial, $dataFinal);
        $param["totalClientes"] = $this->manupula_cliente_model->retornaTotalClientes($dataInicial, $dataFinal);

        //cobrancas
        $param["cobrancasPagas"] = $this->manipula_cobranca_model->retornaCobrancasPagas($dataInicial, $dataFinal);
        $param["cobrancasAVencer"] = $this->manipula_cobranca_model->retornaCobrancasAVencer($dataInicial, $dataFinal);
        $param["cobrancasVencidas"] = $this->manipula_cobranca_model->retornaCobrancasVencidas($dataInicial, $dataFinal);

        //valores
        $param["valorRecebido"] = $this->manipula_cobranca_model->retornaValorRecebido($dataInicial, $dataFinal);
        $param["valorAReceber"] = $this->manipula_cobranca_model->retornaValorAReceber($dataInicial, $dataFinal);
        $param["valorVencido"] = $this->manipula_cobranca_model->retornaValorVencido($dataInicial, $dataFinal);
        $param["valorTotal"] = $this->manipula_cobranca_model->retornaValorTotal($dataInicial, $dataFinal);

        $param["view"] = $this->load->view("app_gerencial/dashboard", $param, TRUE);
        $this->load->view("app_gerencial/index", $param);
	}

    function listagem()
    {
        $param["view"] = "app_gerencial/listagem";
        $this->load->view("app_gerencial/index", $param);
    }
}

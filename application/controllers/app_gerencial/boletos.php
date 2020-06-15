<?php

require_once(APPPATH.'libraries/MY_Controller.php');
class Boletos extends MY_Controller {

    /**
     * Método construtor da classe
     *
     * @access public
     */
    function __construct()
    {
        parent::__construct();

        $this->load->model("app_gerencial/manipula_boleto_model");
    }

    /**
     * Método principal da classe
     *
     * @access public
     */
    function index($flgInserido = NULL)
    {
        $dadosBusca = $_GET;
        $param["deleteMethod"] = "";
        $param["searchMethod"] = "boletos/index";
        $param["referenceModel"] = "boletos";
        $param["listName"] = "Boletos";
        $param["fields"] = array(
            array("name" => "ID", "field" => "idBoleto"),
            array("name" => "Data gerado", "field" => "dataGerado"),
            array("name" => "Data vencimento", "field" => "dataVencimento"),
            array("name" => "Valor", "field" => "vrPreco", "removeFilter" => TRUE),
            array("name" => "Cancelado?", "field" => "flgCancelado")
        );

        foreach($param["fields"] as $key => $value) {
            if(!empty($dadosBusca[$value["field"]])) {
                $param["fields"][$key]["search"] = $dadosBusca[$value["field"]];
            }
        }

        $dados = $this->manipula_boleto_model->retornaDados(NULL, $dadosBusca);

        $param["values"] = $this->objectToArray($dados);
        $param["registroInserido"] = $flgInserido;

        $param["view"] = $this->load->view("app_gerencial/listagem", $param, TRUE);
        $this->load->view("app_gerencial/index", $param);
    }

    function ver($idProduto)
    {
        $dados = $this->manipula_produto_model->retornaDados($idProduto);

        $param["view"] = $this->load->view("app_gerencial/produto/ver_produto", array("dadosProduto" => $dados), TRUE);
        $this->load->view("app_gerencial/index", $param);
    }
}

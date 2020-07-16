<?php

require_once(APPPATH.'libraries/MY_Controller.php');
class Comissoes extends MY_Controller {

    /**
     * Método construtor da classe
     *
     * @access public
     */
    function __construct() 
    {
        parent::__construct();

        $this->load->model("app_gerencial/manipula_comissao_model");
    }

    /**
     * Método principal da classe
     *
     * @access public
     */
    function index($flgInserido = NULL)
    {
        $dadosBusca = $_GET;
        $param["searchMethod"] = "comissoes/index";
        $param["referenceModel"] = "comissoes";
        $param["listName"] = "Comissoes à pagar";
        $param["fields"] = array(
            array("name" => "ID", "field" => "idVendedor"),
            array("name" => "Nome do vendedor", "field" => "descNome"),
            array("name" => "CPF", "field" => "numCpf", "removeFilter" => TRUE),
            array("name" => "Telefone", "field" => "numTelefone", "removeFilter" => TRUE),
            array("name" => "Valor a pagar", "field" => "vrComissaoPagar", "removeFilter" => TRUE),
            array("name" => "1ª Comissão?", "field" => "flgPrimeiraComissao")
        );

        foreach($param["fields"] as $key => $value) {
            if(!empty($dadosBusca[$value["field"]])) {
                $param["fields"][$key]["search"] = $dadosBusca[$value["field"]];
            }
        }

        $dados = $this->manipula_comissao_model->retornaDadosComissao(NULL, $dadosBusca);
    
        $param["values"] = $this->objectToArray($dados);
        $param["removeEdit"] = TRUE;
        $param["registroInserido"] = $flgInserido;

        $param["view"] = $this->load->view("app_gerencial/listagem", $param, TRUE);
        $this->load->view("app_gerencial/index", $param);
    } 

    function ver($idVendedor)
    {
        $dados = $this->manipula_comissao_model->retornaDadosComissaoVendedor($idVendedor);

        $param["view"] = $this->load->view("app_gerencial/comissao/ver_comissao", array("dadosComissao" => $dados), TRUE);
        $this->load->view("app_gerencial/index", $param);
    }

}

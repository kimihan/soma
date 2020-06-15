<?php

require_once(APPPATH.'libraries/MY_Controller.php');
class Vendedores extends MY_Controller {

    /**
     * Método construtor da classe
     *
     * @access public
     */
    function __construct()
    {
        parent::__construct();

        $this->load->model("app_gerencial/manupula_vendedor_model");
    }

    /**
     * Método principal da classe
     *
     * @access public
     */
    function index($flgInserido = NULL)
    {
        $dadosBusca = $_GET;
        $param["deleteMethod"] = "vendedores/ajax_excluir";
        $param["searchMethod"] = "vendedores/index";
        $param["listName"] = "Vendedores";
        $param["referenceModel"] = "vendedores";
        $param["fields"] = array(
            array("name" => "ID", "field" => "idVendedor"),
            array("name" => "Nome", "field" => "descNome"),
            array("name" => "Email", "field" => "descEmail"),
            array("name" => "Telefone", "field" => "numTelefone")
        );

        foreach($param["fields"] as $key => $value) {
            if(!empty($dadosBusca[$value["field"]])) {
                $param["fields"][$key]["search"] = $dadosBusca[$value["field"]];
            }
        }

        $dadosVendedores = $this->manupula_vendedor_model->retornaDadosVendedor(NULL, $dadosBusca);

        $param["values"] = $this->objectToArray($dadosVendedores);
        $param["registroInserido"] = $flgInserido;

        $param["view"] = $this->load->view("app_gerencial/listagem", $param, TRUE);
        $this->load->view("app_gerencial/index", $param);
    }

    function ver($idVendedor)
    {
        $dadosVendedor = $this->manupula_vendedor_model->retornaDadosVendedor($idVendedor);

        $param["view"] = $this->load->view("app_gerencial/vendedor/ver_vendedor", array("dadosVendedor" => $dadosVendedor), TRUE);
        $this->load->view("app_gerencial/index", $param);
    }

    function editar($idVendedor = NULL)
    {
        $dadosVendedor = NULL;
        if(!empty($idVendedor)) {
            $dadosVendedor = $this->manupula_vendedor_model->retornaDadosCliente($idVendedor);
        }

        $param["view"] = $this->load->view("app_gerencial/vendedor/inserir_vendedor", array("dadosVendedor" => $dadosVendedor), TRUE);
        $this->load->view("app_gerencial/index", $param);
    }

    function ajax_salvar()
    {
        $dadosPost = $this->post_all();

        $insert = $this->manupula_vendedor_model->insereEditaVendedor($dadosPost);

        echo "success";
    }

    function ajax_excluir()
    {
        $dadosPost = $this->post_all();

        $idVendedor = $dadosPost["idRegistro"];

        $this->manupula_vendedor_model->excluiVendedor($idVendedor);
    }

}

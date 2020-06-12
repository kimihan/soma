<?php

require_once(APPPATH.'libraries/MY_Controller.php');
class Clientes extends MY_Controller {

    /**
     * Método construtor da classe
     *
     * @access public
     */
    function __construct() 
    {
        parent::__construct();

        $this->load->model("app_gerencial/manupula_cliente_model");
    }

    /**
     * Método principal da classe
     *
     * @access public
     */
    function index($flgInserido = NULL)
    {
        $dadosBusca = $_GET;
        $param["deleteMethod"] = "clientes/ajax_excluir";
        $param["searchMethod"] = "clientes/index";
        $param["listName"] = "Clientes";
        $param["fields"] = array(
            array("name" => "ID", "field" => "idCliente"),
            array("name" => "Nome", "field" => "descNome"),
            array("name" => "Email", "field" => "descEmail"),
            array("name" => "Telefone", "field" => "numTelefone")
        );

        foreach($param["fields"] as $key => $value) {
            if(!empty($dadosBusca[$value["field"]])) {
                $param["fields"][$key]["search"] = $dadosBusca[$value["field"]];
            }
        }

        $dadosClientes = $this->manupula_cliente_model->retornaDadosCliente(NULL, $dadosBusca);

        $param["values"] = $this->objectToArray($dadosClientes);
        $param["registroInserido"] = $flgInserido;

        $param["view"] = $this->load->view("app_gerencial/listagem", $param, TRUE);
        $this->load->view("app_gerencial/index", $param);
	}

    function ver($idCliente)
    {
        $dadosCliente = $this->manupula_cliente_model->retornaDadosCliente($idCliente);

        $param["view"] = $this->load->view("app_gerencial/cliente/ver_cliente", array("dadosCliente" => $dadosCliente), TRUE);
        $this->load->view("app_gerencial/index", $param);
    }

    function editar($idCliente = NULL)
    {
        $dadosCliente = NULL;
        if(!empty($idCliente)) {
            $dadosCliente = $this->manupula_cliente_model->retornaDadosCliente($idCliente);
        }

        $param["view"] = $this->load->view("app_gerencial/cliente/inserir_cliente", array("dadosCliente" => $dadosCliente), TRUE);
        $this->load->view("app_gerencial/index", $param);
    }

    function ajax_salvar()
    {
        $dadosPost = $this->post_all();

        $insert = $this->manupula_cliente_model->insereEditaCliente($dadosPost);

        echo "success";
    }

    function ajax_excluir()
    {
        $dadosPost = $this->post_all();

        $idCliente = $dadosPost["idRegistro"];

        $this->manupula_cliente_model->excluiCliente($idCliente);
    }

}

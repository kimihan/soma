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
    }

    /**
     * Método principal da classe
     *
     * @access public
     */
    function index()
    {
        $param["fields"] = array(
            array("name" => "ID", "field" => "id"),
            array("name" => "Nome", "field" => "desc_nome"),
            array("name" => "Email", "field" => "desc_email"),
            array("name" => "Telefone", "field" => "desc_telefone")
        );

        $param["values"] = array(
            array("id" => "1", "desc_nome" => "Cliente 1", "desc_email" => "cliente1@gmail.com",  "desc_telefone" => "(99) 99999-9999"),
            array("id" => "2", "desc_nome" => "Cliente 2", "desc_email" => "cliente2@gmail.com",  "desc_telefone" => "(99) 99999-9999"),
            array("id" => "3", "desc_nome" => "Cliente 3", "desc_email" => "cliente3@gmail.com",  "desc_telefone" => "(99) 99999-9999")
        );

        $param["view"] = $this->load->view("app_gerencial/listagem", $param, TRUE);
        $this->load->view("app_gerencial/index", $param);
	}

    function ver()
    {
        $param["view"] = $this->load->view("app_gerencial/cliente/ver_cliente", array(), TRUE);
        $this->load->view("app_gerencial/index", $param);
    }

    function editar($idCliente)
    {
        $param["view"] = $this->load->view("app_gerencial/cliente/inserir_cliente", array(), TRUE);
        $this->load->view("app_gerencial/index", $param);
    }

    function ajax_salvar()
    {
        $this->load->model("app_gerencial/manupula_cliente_model");


        $dadosPost = $this->post_all();

        $this->manupula_cliente_model->insereEditaCliente($dadosPost);
        die();
    }
}

<?php

require_once(APPPATH.'libraries/MY_Controller.php');
class Cliente extends MY_Controller {

    /**
     * Método construtor da classe
     *
     * @access public
     */
    function __construct() 
    {
        parent::__construct();

        if(parent::verificarLoginCliente()) {
            $this->load->helper('url');
            redirect('app_cliente/login', 'refresh');
        }

        $this->load->model("app_gerencial/manupula_cliente_model");
    }

    /**
     * Método principal da classe
     *
     * @access public
     */
    function index()
    {
		return $this->template->load("app_cliente/template", "app_cliente/index");
    } 
    
    function cadastro()
    {
        return $this->template->load("app_cliente/template", "app_cliente/cadastro/cadastro_cliente");        
    }

    function cadastro_endereco()
    {
        return $this->template->load("app_cliente/template", "app_cliente/cadastro/cadastro_endereco_cliente");        
    }

    function cadastro_pagamento()
    {
        return $this->template->load("app_cliente/template", "app_cliente/cadastro/cadastro_pagamento_cliente");        
    }

    function salvar()
    {

    }

    function buscar_cliente() 
    {
        $dados = $this->input->post();

        if(!empty($dados["id"])) {
            $dadosCliente = $this->manupula_cliente_model->retornaDadosCliente($dados["id"]);

            echo (!empty($dadosCliente) && count($dadosCliente) > 0) ? json_encode($dadosCliente) : json_encode(["erro" => "Cliente não encontrado"]);

            return $dadosCliente;
        } else {
            echo json_encode(["erro" => "Cliente não encontrado"]);
            return false;
        }
    }
}

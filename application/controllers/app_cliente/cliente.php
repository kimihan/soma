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
}

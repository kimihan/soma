<?php

require_once(APPPATH.'libraries/MY_Controller.php');
class Login extends MY_Controller {

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
        if(!parent::verificarLoginCliente()) {
            $this->load->helper('url');
            redirect('app_cliente/venda', 'refresh');
        }

		return $this->template->load("app_cliente/template", "app_cliente/index");
    }
}

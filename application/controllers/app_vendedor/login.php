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

        if(!parent::verificarLoginVendedor()) {
            $this->load->helper('url');
            redirect('app_vendedor/venda', 'refresh');
        }

        $this->load->model("login_model");
    }

    /**
     * Método principal da classe
     *
     * @access public
     */
    function index()
    {
		return $this->template->load("app_vendedor/template", "app_vendedor/index");
    }

    function login() {
        return $this->template->load("app_vendedor/template", "app_vendedor/login");
    }
    
    function logar()
    {
        $dadosLogin = [];
        parse_str($this->input->post()["dadosLogin"], $dadosLogin);

        $login = $this->login_model->logarVendendor($dadosLogin);

        echo ($login) ? "sucesso" : "error";
    }
}

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
        $this->load->model("login_model");
        $this->load->library('session');
    }

    /**
     * Método principal da classe
     *
     * @access public
     */
    function index()
    {
        if(!parent::verificarLoginVendedor()) {
            $this->load->helper('url');
            redirect('app_vendedor/venda', 'refresh');
        }

		return $this->template->load("app_vendedor/template", "app_vendedor/index");
    }

    function login() 
    {
        if(!parent::verificarLoginVendedor()) {
            $this->load->helper('url');
            redirect('app_vendedor/venda', 'refresh');
        }

        return $this->template->load("app_vendedor/template", "app_vendedor/login");
    }
    
    function logar()
    {
        if(!parent::verificarLoginVendedor()) {
            $this->load->helper('url');
            redirect('app_vendedor/venda', 'refresh');
        }

        $dadosLogin = [];
        parse_str($this->input->post()["dadosLogin"], $dadosLogin);

        $login = $this->login_model->logarVendendor($dadosLogin);

        echo ($login) ? "sucesso" : "error";
    }

    function logout()
    {
        $logout = $this->login_model->logoutVendendor();
        $this->load->helper('url');
        redirect('app_vendedor/login/login', 'refresh');

        return false;
    }
}

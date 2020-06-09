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
		return $this->template->load("app_vendedor/template", "app_vendedor/index");
    }
    
    function logar()
    {
        return $this->template->load("app_vendedor/template", "app_vendedor/login");
    }
}

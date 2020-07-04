<?php

require_once(APPPATH.'libraries/MY_Controller.php');
class Venda extends MY_Controller {

    /**
     * Método construtor da classe
     *
     * @access public
     */
    function __construct() 
    {
        parent::__construct();
        
        if(parent::verificarLoginVendedor()) {
            $this->load->helper('url');
            redirect('app_vendedor/login', 'refresh');
        }
    }

    /**
     * Método principal da classe
     *
     * @access public
     */
    function index()
    {
        return $this->template->load("app_vendedor/template", "app_vendedor/venda/cadastrar_venda");
    }
}

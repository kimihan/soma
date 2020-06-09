<?php

require_once(APPPATH.'libraries/MY_Controller.php');
class Index extends MY_Controller {

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
		$this->load->view("app_gerencial/index");
	}

    function listagem()
    {
        $param["view"] = "app_gerencial/listagem";
        $this->load->view("app_gerencial/index", $param);
    }
}

<?php

require_once(APPPATH.'libraries/MY_Controller.php');
class Financeiro extends MY_Controller {

    /**
     * Método construtor da classe
     *
     * @access public
     */
    function __construct() 
    {
        parent::__construct(TRUE);
    }

    /**
     * Método principal da classe
     *
     * @access public
     */
    function index()
    {
        $param["view"] = "app_gerencial/listagem";
        $this->load->view("app_gerencial/index", $param);
	} 
}

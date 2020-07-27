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
		$this->load->view("app_gerencial/login/login");
	}

    function ajax_logar()
    {
        $dadosPost = $this->post_all();

        if($dadosPost["login"] == "soma" && $dadosPost["senha"] == "acesso01") {
            $_SESSION["usuarioLogado"] = TRUE;
            echo json_encode(array("sucesso" => TRUE));
        }
    }

    function deslogar()
    {
        unset($_SESSION["usuarioLogado"]);
        header("Location: ".base_url()."app_gerencial/login");
    }
}

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

        $this->load->helper('url');
        $this->load->model(["cliente_model", "login_model"]);
        $this->load->library('session');
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

    function logar()
    {
      $dados = $this->input->post();
      $dadosCliente = (array) $this->cliente_model->buscar_cliente($dados);

      if(!isset($dadosCliente["erro"])) {
        $login = $this->login_model->logarCliente($dadosCliente);
        if(empty($dadosCliente["Endereco_idEndereco"])) {
          redirect('app_cliente/cliente/cadastro', 'refresh');
        } else {
          redirect('app_cliente/cliente/cadastro_pagamento', 'refresh');
        }
      } else {
        redirect('app_cliente/login', 'refresh');
      }
    }

    function logout()
    {
        $logout = $this->login_model->logoutCliente();
        $this->load->helper('url');
        redirect('app_cliente/login', 'refresh');

        return false;
    }
}

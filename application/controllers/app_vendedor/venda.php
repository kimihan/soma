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
        $this->load->model("app_gerencial/manupula_vendedor_model");
        $this->load->library('session');

        $dadosVendedor = $this->session->userdata('sVendedor');
        $dadosProdutos = $this->manupula_vendedor_model->retornaProdutoVendedor($dadosVendedor["idVendedor"], ["flgAplicativo" => FLG_APLICATIVO]);

        return $this->template->load("app_vendedor/template", "app_vendedor/venda/cadastrar_venda", ["dadosProdutos" => $dadosProdutos]);
    }

    function cadastrar_venda_endereco()
    {
        return $this->template->load("app_vendedor/template", "app_vendedor/venda/cadastrar_endereco_venda");
    }
}

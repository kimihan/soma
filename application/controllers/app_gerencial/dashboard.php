<?php

require_once(APPPATH.'libraries/MY_Controller.php');
class Dashboard extends MY_Controller {

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
    function index($flgInserido = NULL)
    {
        $param["view"] = $this->load->view("app_gerencial/dashboard", array(), TRUE);
        $this->load->view("app_gerencial/index", $param);
	}

	function listagem_ligar($flgInserido = NULL)
    {
        $this->db->where(array("c.flgLigacao" => 1));

        $this->index($flgInserido);
    }

    function ver($idCliente)
    {
        $dadosCliente = $this->manupula_cliente_model->retornaDadosCliente($idCliente);
        $produtosCliente = $this->manupula_cliente_model->retornaProdutosCliente($idCliente);
        $pagamentosCliente = $this->manupula_cliente_model->retornaPagamentosCliente($idCliente);

        $paramView["dadosCliente"] = $dadosCliente;
        $paramView["produtosCliente"] = $produtosCliente;
        $paramView["pagamentosCliente"] = $pagamentosCliente;
        $param["view"] = $this->load->view("app_gerencial/cliente/ver_cliente", $paramView, TRUE);
        $this->load->view("app_gerencial/index", $param);
    }

    function editar($idCliente = NULL)
    {
        $dadosCliente = NULL;
        if(!empty($idCliente)) {
            $dadosCliente = $this->manupula_cliente_model->retornaDadosCliente($idCliente);
        }

        $param["view"] = $this->load->view("app_gerencial/cliente/inserir_cliente", array("dadosCliente" => $dadosCliente), TRUE);
        $this->load->view("app_gerencial/index", $param);
    }

    function ajax_salvar()
    {
        $dadosPost = $this->post_all();

        $insert = $this->manupula_cliente_model->insereEditaCliente($dadosPost);

        echo "success";
    }

    function ajax_excluir()
    {
        $dadosPost = $this->post_all();

        $idCliente = $dadosPost["idRegistro"];

        $this->manupula_cliente_model->excluiCliente($idCliente);
    }

}

<?php

require_once(APPPATH.'libraries/MY_Controller.php');
class Produtos extends MY_Controller {

    /**
     * Método construtor da classe
     *
     * @access public
     */
    function __construct()
    {
        parent::__construct();

        $this->load->model("app_gerencial/manipula_produto_model");
    }

    /**
     * Método principal da classe
     *
     * @access public
     */
    function index($flgInserido = NULL)
    {
        $dadosBusca = $_GET;
        $param["deleteMethod"] = "produtos/ajax_excluir";
        $param["searchMethod"] = "produtos/index";
        $param["referenceModel"] = "produtos";
        $param["listName"] = "Produtos";
        $param["fields"] = array(
            array("name" => "ID", "field" => "idProduto"),
            array("name" => "Nome", "field" => "descNome"),
            array("name" => "Exibe no aplicativo?", "field" => "flgAplicativo")
        );

        foreach($param["fields"] as $key => $value) {
            if(!empty($dadosBusca[$value["field"]])) {
                $param["fields"][$key]["search"] = $dadosBusca[$value["field"]];
            }
        }

        $dados = $this->manipula_produto_model->retornaDados(NULL, $dadosBusca);

        $param["values"] = $this->objectToArray($dados);
        $param["registroInserido"] = $flgInserido;

        $param["view"] = $this->load->view("app_gerencial/listagem", $param, TRUE);
        $this->load->view("app_gerencial/index", $param);
    }

    function ver($idProduto)
    {
        $dados = $this->manipula_produto_model->retornaDados($idProduto);

        $param["view"] = $this->load->view("app_gerencial/produto/ver_produto", array("dadosProduto" => $dados), TRUE);
        $this->load->view("app_gerencial/index", $param);
    }

    function editar($idProduto = NULL)
    {
        $dados = NULL;
        if(!empty($idCliente)) {
            $dados = $this->manipula_produto_model->retornaDados($idProduto);
        }

        $param["view"] = $this->load->view("app_gerencial/produto/inserir_produto", array("dadosProduto" => $dados), TRUE);
        $this->load->view("app_gerencial/index", $param);
    }

    function ajax_salvar()
    {
        $dadosPost = $this->post_all();

        if(isset($dadosPost["flgAplicativo"])) {
            $dadosPost["flgAplicativo"] = 1;
        } else {
            $dadosPost["flgAplicativo"] = 0;
        }

        $insert = $this->manipula_produto_model->insereEdita($dadosPost);

        echo "success";
    }

    function ajax_excluir()
    {
        $dadosPost = $this->post_all();

        $idCliente = $dadosPost["idRegistro"];

        $this->manipula_produto_model->excluiCliente($idCliente);
    }

}

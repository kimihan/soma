<?php

require_once(APPPATH.'libraries/MY_Controller.php');
class Cobrancas extends MY_Controller {

    /**
     * Método construtor da classe
     *
     * @access public
     */
    function __construct()
    {
        parent::__construct();

        $this->load->model("app_gerencial/manipula_cobranca_model");
    }

    /**
     * Método principal da classe
     *
     * @access public
     */
    function index($flgInserido = NULL)
    {
        $dadosBusca = $_GET;
        $param["deleteMethod"] = "cobrancas/ajax_excluir";
        $param["searchMethod"] = "cobrancas/index";
        $param["referenceModel"] = "cobrancas";
        $param["listName"] = "Cobranças";
        $param["fields"] = array(
            array("name" => "ID", "field" => "idCobranca"),
            array("name" => "Nome", "field" => "descNome"),
            array("name" => "Data gerado", "field" => "dataGerado"),
            array("name" => "Data pagamento", "field" => "dataPagamento"),
            array("name" => "Data vencimento", "field" => "dataVencimento"),
            array("name" => "Valor", "field" => "vrPreco", "removeFilter" => TRUE),
            array("name" => "Pago?", "field" => "flgPago")
        );

        foreach($param["fields"] as $key => $value) {
            if(!empty($dadosBusca[$value["field"]])) {
                $param["fields"][$key]["search"] = $dadosBusca[$value["field"]];
            }
        }

        $dados = $this->manipula_cobranca_model->retornaDados(NULL, $dadosBusca);

        $param["values"] = $this->objectToArray($dados);
        $param["registroInserido"] = $flgInserido;

        $param["view"] = $this->load->view("app_gerencial/listagem", $param, TRUE);
        $this->load->view("app_gerencial/index", $param);
    }

    function ver($idCobranca)
    {
        $dados = $this->manipula_cobranca_model->retornaDados($idCobranca);

        $param["view"] = $this->load->view("app_gerencial/cobranca/ver_cobranca", array("dadosProduto" => $dados), TRUE);
        $this->load->view("app_gerencial/index", $param);
    }

    function editar($idCobranca = NULL)
    {
        $dados = NULL;
        if(!empty($idCobranca)) {
            $dados = $this->manipula_cobranca_model->retornaDados($idCobranca);
        }

        $param["view"] = $this->load->view("app_gerencial/cobranca/inserir_cobranca", array("dadosProduto" => $dados), TRUE);
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

        $insert = $this->manipula_cobranca_model->insereEdita($dadosPost);

        echo "success";
    }

    function ajax_excluir()
    {
        $dadosPost = $this->post_all();

        $idCobranca = $dadosPost["idRegistro"];

        $this->manipula_cobranca_model->excluiCliente($idCobranca);
    }

}

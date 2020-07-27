<?php

require_once(APPPATH.'libraries/MY_Controller.php');
class Vendas extends MY_Controller {

    /**
     * Método construtor da classe
     *
     * @access public
     */
    function __construct() 
    {
        parent::__construct(TRUE);

        $this->load->model("app_gerencial/manipula_servico_model");
    }

    /**
     * Método principal da classe
     *
     * @access public
     */
    function index($flgInserido = NULL)
    {
        $dadosBusca = $_GET;
        $param["deleteMethod"] = "vendas/ajax_excluir";
        $param["searchMethod"] = "vendas/index";
        $param["referenceModel"] = "vendas";
        $param["listName"] = "Vendas";
        $param["fields"] = array(
            array("name" => "ID", "field" => "idServico"),
            array("name" => "Data venda", "field" => "dataVenda"),
            array("name" => "Nome", "field" => "descNome"),
            array("name" => "Valor", "field" => "vrPreco")
        );

        foreach($param["fields"] as $key => $value) {
            if(!empty($dadosBusca[$value["field"]])) {
                $param["fields"][$key]["search"] = $dadosBusca[$value["field"]];
            }
        }

        $dados = $this->manipula_servico_model->retornaDadosVendas(NULL, $dadosBusca);
    
        $param["values"] = $this->objectToArray($dados);
        $param["removeEdit"] = TRUE;
        $param["registroInserido"] = $flgInserido;

        $param["view"] = $this->load->view("app_gerencial/listagem", $param, TRUE);
        $this->load->view("app_gerencial/index", $param);
    } 
    
    function ver($idVenda)
    {
        $dados = $this->manipula_servico_model->retornaDadosVendas($idVenda);

        $param["view"] = $this->load->view("app_gerencial/venda/ver_venda", array("dadosVenda" => $dados), TRUE);
        $this->load->view("app_gerencial/index", $param);
    }

    function editar($idVenda = NULL)
    {
        $this->load->model("app_gerencial/manupula_vendedor_model");
        $this->load->model("app_gerencial/manupula_cliente_model");
        $this->load->model("app_gerencial/manipula_produto_model");

        $dados = NULL;
        if(!empty($idVenda)) {
            $dados = $this->manipula_servico_model->retornaDadosVendas($idVenda);
        }

        $dadosVendedores = $this->manupula_vendedor_model->retornaDadosVendedor(NULL, NULL);
        $dadosClientes = $this->manupula_cliente_model->retornaDadosCliente(NULL, NULL);
        $dadosProdutos = $this->manipula_produto_model->retornaDados(NULL, NULL);
        
        $param["view"] = $this->load->view("app_gerencial/venda/inserir_venda", 
            array("dadosVendedores" => $dadosVendedores, "dadosVenda" => $dados, "dadosClientes" => $dadosClientes, "dadosProdutos" => $dadosProdutos), 
            TRUE);
        $this->load->view("app_gerencial/index", $param);
    }

    function ajax_salvar()
    {
        $dadosPost = $this->post_all();

        $dados = $this->manipula_servico_model->insereVenda($dadosPost);

        echo "success";
    }

    function ajax_excluir()
    {
        $dadosPost = $this->post_all();

        $idServico = $dadosPost["idRegistro"];

        $this->manipula_servico_model->excluiVenda($idServico);
    }
}

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
        parent::__construct(TRUE);

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
        //$param["deleteMethod"] = "cobrancas/ajax_excluir";
        $param["removeEdit"] = TRUE;
        $param["searchMethod"] = "cobrancas/index";
        $param["referenceModel"] = "cobrancas";
        $param["listName"] = "Cobranças";
        $param["fields"] = array(
            array("name" => "ID", "field" => "idCobranca", "removeFilter" => TRUE),
            array("name" => "Nome", "field" => "descNome"),
            array("name" => "Data gerado", "field" => "dataGerado"),
            array("name" => "Data pagamento", "field" => "dataPagamento"),
            array("name" => "Data vencimento", "field" => "dataVencimento"),
            array("name" => "Valor", "field" => "vrPreco", "removeFilter" => TRUE),
            array("name" => "Paga?", "field" => "flgPago", "removeFilter" => TRUE),
            array("name" => "Cancelada?", "field" => "flgCancelado", "removeFilter" => TRUE)
        );

        if(!empty($dadosBusca["dataGerado_start"])) {
            $dadosBusca["dataGerado_start"] = formataDataMysql($dadosBusca["dataGerado_start"]);
            $dadosBusca["co.dataGerado >="] = $dadosBusca["dataGerado_start"];
            unset($dadosBusca["dataGerado_start"]);
        } else if(isset($dadosBusca["dataGerado_start"])) {
            unset($dadosBusca["dataGerado_start"]);
        }

        if(!empty($dadosBusca["dataGerado_end"])) {
            $dadosBusca["dataGerado_end"] = formataDataMysql($dadosBusca["dataGerado_end"]);
            $dadosBusca["co.dataGerado <="] = $dadosBusca["dataGerado_end"];
            unset($dadosBusca["dataGerado_end"]);
        } else if(isset($dadosBusca["dataGerado_end"])) {
            unset($dadosBusca["dataGerado_end"]);
        }

        if(!empty($dadosBusca["dataPagamento_start"])) {
            $dadosBusca["dataPagamento_start"] = formataDataMysql($dadosBusca["dataPagamento_start"]);
            $dadosBusca["co.dataPagamento >="] = $dadosBusca["dataPagamento_start"];
            unset($dadosBusca["dataPagamento_start"]);
        } else if(isset($dadosBusca["dataPagamento_start"])) {
            unset($dadosBusca["dataPagamento_start"]);
        }

        if(!empty($dadosBusca["dataPagamento_end"])) {
            $dadosBusca["dataPagamento_end"] = formataDataMysql($dadosBusca["dataPagamento_end"]);
            $dadosBusca["co.dataPagamento <="] = $dadosBusca["dataPagamento_end"];
            unset($dadosBusca["dataPagamento_end"]);
        } else if(isset($dadosBusca["dataPagamento_end"])) {
            unset($dadosBusca["dataPagamento_end"]);
        }

        if(!empty($dadosBusca["dataVencimento_start"])) {
            $dadosBusca["dataVencimento_start"] = formataDataMysql($dadosBusca["dataVencimento_start"]);
            $dadosBusca["co.dataVencimento >="] = $dadosBusca["dataVencimento_start"];
            unset($dadosBusca["dataVencimento_start"]);
        } else if(isset($dadosBusca["dataVencimento_start"])) {
            unset($dadosBusca["dataVencimento_start"]);
        }

        if(!empty($dadosBusca["dataVencimento_end"])) {
            $dadosBusca["dataVencimento_end"] = formataDataMysql($dadosBusca["dataVencimento_end"]);
            $dadosBusca["co.dataVencimento <="] = $dadosBusca["dataVencimento_end"];
            unset($dadosBusca["dataVencimento_end"]);
        } else if(isset($dadosBusca["dataVencimento_end"])) {
            unset($dadosBusca["dataVencimento_end"]);
        }

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

        $param["view"] = $this->load->view("app_gerencial/cobranca/ver_cobranca", array("dadosCobranca" => $dados), TRUE);
        $this->load->view("app_gerencial/index", $param);
    }

    function editar($idCobranca = NULL)
    {
        $this->load->model("app_gerencial/manupula_cliente_model");

        $dados = NULL;
        if(!empty($idCobranca)) {
            $dados = $this->manipula_cobranca_model->retornaDados($idCobranca);
        }

        $dadosClientes = $this->manupula_cliente_model->retornaDadosCliente(NULL, NULL);

        $param["view"] = $this->load->view("app_gerencial/cobranca/inserir_cobranca", array("dadosClientes" => $dadosClientes), TRUE);
        $this->load->view("app_gerencial/index", $param);
    }

    function cancelar($idCobranca)
    {
        $param["view"] = $this->load->view("app_gerencial/cobranca/cancelar_cobranca", array("idCobranca" => $idCobranca), TRUE);
        $this->load->view("app_gerencial/index", $param);
    }

    function ajax_cancela_cobranca($idCobranca)
    {
        $dadosPost = $this->post_all();
        $dadosPost["idCobranca"] = $idCobranca;
        $dadosPost["flgCancelado"] = 1;

        $insert = $this->manipula_cobranca_model->insereEdita($dadosPost);
    }

    function ajax_servicos_cliente()
    {
        $this->load->model("app_gerencial/manipula_servico_model");
        $this->load->model("produto_model");

        $dadosPost = $this->post_all();
        $idCliente = $dadosPost["idCliente"];

        $this->db->select("pr.descNome as nomeProduto");
        $this->db->join("{$this->produto_model} pr", "s.Produto_idProduto = pr.idProduto");
        $servicosCliente = $this->manipula_servico_model->retornaDadosVendas(NULL, array("Cliente_idCliente" => $idCliente));

        echo json_encode($servicosCliente);
    }

    function ajax_preco_servico()
    {
        $this->load->model("app_gerencial/manipula_servico_model");
        $dadosPost = $this->post_all();
        $idServico = $dadosPost["idServico"];

        $servicosCliente = $this->manipula_servico_model->retornaDadosVendas($idServico);
        $servicosCliente->vrPreco = number_format($servicosCliente->vrPreco, 2, ",", "");

        echo json_encode($servicosCliente);
    }

    function ajax_salvar()
    {
        $dadosPost = $this->post_all();

        $dadosPost["vrPreco"] = str_replace(".", "", $dadosPost["vrPreco"]);
        $dadosPost["vrPreco"] = str_replace(",", ".", $dadosPost["vrPreco"]);

        $insert = $this->manipula_cobranca_model->insereEdita($dadosPost);

        echo "success";
    }

    function ajax_excluir()
    {
        $dadosPost = $this->post_all();

        $idCobranca = $dadosPost["idRegistro"];

        $this->manipula_cobranca_model->excluiCliente($idCobranca);
    }

    function ajax_marcar_pago()
    {
        $dadosPost = $this->post_all();

        $idCobranca = $dadosPost["idCobranca"];

        $this->manipula_cobranca_model->marcarPaga($idCobranca);
    }

}

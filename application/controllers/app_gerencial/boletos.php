<?php

require_once(APPPATH.'libraries/MY_Controller.php');
class Boletos extends MY_Controller {

    /**
     * Método construtor da classe
     *
     * @access public
     */
    function __construct()
    {
        parent::__construct();

        $this->load->model("app_gerencial/manipula_boleto_model");
    }

    /**
     * Método principal da classe
     *
     * @access public
     */
    function index($flgInserido = NULL)
    {
        $dadosBusca = $_GET;
        $param["deleteMethod"] = "";
        $param["searchMethod"] = "boletos/index";
        $param["referenceModel"] = "boletos";
        $param["removeEdit"] = TRUE;
        $param["removeSee"] = TRUE;
        $param["removeInsert"] = TRUE;
        $param["listName"] = "Boletos";
        $param["fields"] = array(
            array("name" => "ID", "field" => "idBoleto", "removeFilter" => TRUE),
            array("name" => "Nome", "field" => "descNome"),
            array("name" => "Data gerado", "field" => "dataGerado"),
            array("name" => "Data vencimento", "field" => "dataVencimento"),
            array("name" => "Valor", "field" => "vrPreco", "removeFilter" => TRUE),
            array("name" => "Cancelado?", "field" => "flgCancelado", "removeFilter" => TRUE)
        );
        
        if(!empty($dadosBusca["dataGerado_start"])) {
            $dadosBusca["dataGerado_start"] = formataDataMysql($dadosBusca["dataGerado_start"]);
            $dadosBusca["b.dataGerado >="] = $dadosBusca["dataGerado_start"];
            unset($dadosBusca["dataGerado_start"]);
        } else if(isset($dadosBusca["dataGerado_start"])) {
            unset($dadosBusca["dataGerado_start"]);
        }

        if(!empty($dadosBusca["dataGerado_end"])) {
            $dadosBusca["dataGerado_end"] = formataDataMysql($dadosBusca["dataGerado_end"]);
            $dadosBusca["b.dataGerado <="] = $dadosBusca["dataGerado_end"];
            unset($dadosBusca["dataGerado_end"]);
        } else if(isset($dadosBusca["dataGerado_end"])) {
            unset($dadosBusca["dataGerado_end"]);
        }

        if(!empty($dadosBusca["dataVencimento_start"])) {
            $dadosBusca["dataVencimento_start"] = formataDataMysql($dadosBusca["dataVencimento_start"]);
            $dadosBusca["b.dataVencimento >="] = $dadosBusca["dataVencimento_start"];
            unset($dadosBusca["dataVencimento_start"]);
        } else if(isset($dadosBusca["dataVencimento_start"])) {
            unset($dadosBusca["dataVencimento_start"]);
        }

        if(!empty($dadosBusca["dataVencimento_end"])) {
            $dadosBusca["dataVencimento_end"] = formataDataMysql($dadosBusca["dataVencimento_end"]);
            $dadosBusca["b.dataVencimento <="] = $dadosBusca["dataVencimento_end"];
            unset($dadosBusca["dataVencimento_end"]);
        } else if(isset($dadosBusca["dataVencimento_end"])) {
            unset($dadosBusca["dataVencimento_end"]);
        }

        foreach($param["fields"] as $key => $value) {
            if(!empty($dadosBusca[$value["field"]])) {
                $param["fields"][$key]["search"] = $dadosBusca[$value["field"]];
            }
        }

        $dados = $this->manipula_boleto_model->retornaDados(NULL, $dadosBusca);

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
}

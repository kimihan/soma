<?php

/**
 * Classe do modelo que representa a tabela produto
 *
 * @package         LojaVirtual
 * @subpackage      Models
 * @author
 */
require_once(APPPATH . "libraries/MY_Model.php");

class Pagamento_model extends MY_Model {

    /**
     * Nome da tabela
     * @access protected
     * @var string
     */
    protected $name = "pagamento";
    private $idProduto;
    private $idPeriodicidade;
    private $idFormaPagamento;
    private $idPlanoPagseguro;

    function __construct() {
        parent::__construct(array($this->name));

        $this->CI->load->model(["formas_pagamento_model", "app_gerencial/manupula_cliente_model"]);
    }

    public function init() {
        $operadora = $this->CI->formas_pagamento_model->retornaDados($this->getIdFormaPagamento())->operadora;

        if (strtolower($operadora) == "pagseguro") {
            $result = $this->getPlanoPagseguro();

            if (empty($result) || count($result) < 1) {
                return false;
            } else {
                return $this->pagamentoPagseguro($result);
            }
        }

        return false;
    }

    public function getPlanoPagseguro() {
        $this->CI->db->select("pp.*, p.*, ps.*")
                ->from("produtoplano pp")
                ->join("produto p", "pp.idProduto = p.idProduto")
                ->join("planospagseguro ps", "pp.idPlanoPagseguro = ps.id");

        if ($this->getIdPlanoPagseguro()) {
            $this->CI->db->where(["pp.idProduto" => $this->getIdProduto(), "ps.idPeriodicidadeÍndice" => $this->getIdPeriodicidade()]);
        }

        $result = $this->CI->db->get()->row();

        return $result;
    }

    private function pagamentoPagseguro($result) {
        $dadosCliente = $this->CI->session->userdata("sCliente");
        $dados = [];
        parse_str($this->CI->input->post()["dados"], $dados);
        $dateNascimento = explode("-", $dadosCliente["dataNascimento"]);

        $dados["numCpf"] = preg_replace('/[^0-9]/', '', $dados["numCpf"]);
        $dados["dataNascimento"] = $dateNascimento[2] . "/" . $dateNascimento[1] . "/" . $dateNascimento[0];
        $dados["token"] = $this->CI->input->post()["token"];
        $pagSeguro = new pagseguro_model();
        $dataSender = $dadosCliente;
        $dataSender["hashReady"] = $this->CI->input->post()["hashReady"];

        $retorno = $pagSeguro->setPlain($result->code)->setIdServico($dados["servico"])
                        ->setDatasender($dataSender)->setDataPaymentMethod($dados)->createPreApprovals();
        if (!empty(json_decode($retorno)->code)) {
            return json_decode($retorno)->code;
        }

        return false;
    }

    public function linkBoleto() {
        $dadosCliente = $this->CI->session->userdata("sCliente");
        $dadosProduto = current($this->CI->manupula_cliente_model->retornaProdutosCliente($dadosCliente["idCliente"]));
        $link = $dadosProduto->descBoletoPaghiper;
        
        return $link;
    }

    public function getIdProduto() {
        return $this->idProduto;
    }

    public function getIdPeriodicidade() {
        return $this->idPeriodicidade;
    }

    public function getIdFormaPagamento() {
        return $this->idFormaPagamento;
    }

    public function getIdPlanoPagseguro() {
        return $this->idPlanoPagseguro;
    }

    public function setIdProduto($idProduto) {
        $this->idProduto = $idProduto;
        return $this;
    }

    public function setIdPeriodicidade($idPeriodicidade) {
        $this->idPeriodicidade = $idPeriodicidade;
        return $this;
    }

    public function setIdFormaPagamento($idFormaPagamento) {
        $this->idFormaPagamento = $idFormaPagamento;
        return $this;
    }

    public function setIdPlanoPagseguro($idPlanoPagseguro) {
        $this->idPlanoPagseguro = $idPlanoPagseguro;
        return $this;
    }

}

<?php

require_once(APPPATH.'libraries/MY_Controller.php');
class Pagamento extends MY_Controller {

    /**
     * Método construtor da classe
     *
     * @access public
     */
    function __construct() 
    {
        parent::__construct();

        if(parent::verificarLoginCliente()) {
            $this->load->helper('url');
            redirect('app_cliente/login', 'refresh');
        }

        $this->load->model(["pagseguro_model", "app_gerencial/manipula_servico_model"]);
    }

    function pre_approvals_pagseguro()
    {
        $dadosCliente = $this->session->userdata("sCliente");
        $dados = [];
        $dadosVendedorEndereco = [];
        parse_str($this->input->post()["dados"], $dados);

        $dateNascimento = explode("-", $dadosCliente["dataNascimento"]);

        $dados["numCpf"] = preg_replace('/[^0-9]/', '', $dados["numCpf"]);
        $dados["dataNascimento"] = $dateNascimento[2] . "/" . $dateNascimento[1] . "/" . $dateNascimento[0];
        $dados["token"] = $this->input->post()["token"];
        if($dados["periodoPagseguro"] != "-1") {
            $pagSeguro = new pagseguro_model();
            $dataSender = $dadosCliente;
            $dataSender["hashReady"] = $this->input->post()["hashReady"];

            $retorno = $pagSeguro->setSessionId($this->input->post()["sessionIdPagSeguro"])->setPlain($dados["periodoPagseguro"])->setIdServico($dados["servico"])
                        ->setDatasender($dataSender)->setDataPaymentMethod($dados)->createPreApprovals();

            echo $retorno;
        }

        return false;
    }

    function payment_pagseguro() {
        $dados = $this->input->post();
        $dadosServico = (array) $this->manipula_servico_model->retornaDados($dados["servico"]);
        $merge = array_merge($dadosServico, $dados);

        $pagSeguro = new pagseguro_model();
        $retorno = $pagSeguro->setDataPayment($merge)->createPayment();
    }

    function cria_boletos_paghiper()
    {
        $this->load->model("paghiper_model");
        $this->load->model("servico_model");
        $this->load->model("app_gerencial/manupula_cliente_model");

        $dadosCliente = $this->session->userdata("sCliente");
        $idCliente = $dadosCliente["idCliente"];
        $dadosProduto = $this->manupula_cliente_model->retornaProdutosCliente($idCliente);
        $dadosServico = current($dadosProduto);
        $idServico = $dadosServico->idServico;

        $boleto = $this->paghiper_model->geraBoletosMensais($idCliente, number_format($dadosServico->vrPreco, 2, ".", ""));

        $this->servico_model->update(array("descBoletoPaghiper" => json_decode($boleto)->status_request->bank_slip_group), array("idServico" => $idServico));
    }
}

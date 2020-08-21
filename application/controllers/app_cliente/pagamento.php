<?php

require_once(APPPATH . 'libraries/MY_Controller.php');

class Pagamento extends MY_Controller {

    /**
     * Método construtor da classe
     *
     * @access public
     */
    function __construct() {
        parent::__construct();

        if (parent::verificarLoginCliente()) {
            $this->load->helper('url');
            redirect('app_cliente/login', 'refresh');
        }

        $this->load->model(["pagseguro_model", "app_gerencial/manipula_servico_model", "pagamento_model",
            "app_gerencial/manupula_cliente_model"]);

        ini_set('max_execution_time', 300);
    }

    function pre_approvals_pagseguro() {
        $dadosCliente = $this->session->userdata("sCliente");
        $dadosProduto = current($this->manupula_cliente_model->retornaProdutosCliente($dadosCliente["idCliente"]));
        $dados = [];
        parse_str($this->input->post()["dados"], $dados);

        if (!empty($dadosProduto->descBoletoPaghiper) || !empty($dadosProduto->descPagseguro)) {
            echo json_encode(["error" => true]);
            return false;
        }

        $pagamento = new pagamento_model();
        $retorno = $pagamento->setIdPeriodicidade($dados["periodo"])
                ->setIdFormaPagamento($dados["formaPagamento"])
                ->setIdProduto($dadosProduto->idProduto)
                ->init();

        if (!empty($retorno)) {
            $edita = ["idServico" => $dados["servico"], "descPagseguro" => $retorno];
            $this->manipula_servico_model->insereEdita($edita);
        }

        echo json_encode($retorno);
        return false;
    }

    function cria_boletos_paghiper() {
        $this->load->model("paghiper_model");
        $this->load->model("servico_model");
        $this->load->model("app_gerencial/manupula_cliente_model");

        $dadosCliente = $this->session->userdata("sCliente");
        $idCliente = $dadosCliente["idCliente"];
        $dadosProduto = current($this->manupula_cliente_model->retornaProdutosCliente($idCliente));
        $dadosServico = $dadosProduto;
        $idServico = $dadosServico->idServico;

        if (!empty($dadosProduto->descBoletoPaghiper) || !empty($dadosProduto->descPagseguro)) {
            echo json_encode(["error" => true]);
            return false;
        }

        $boleto = $this->paghiper_model->geraBoletosMensais($idCliente, number_format($dadosServico->vrPreco, 2, ".", ""));

        if (!empty($boleto)) {
            $boleto = json_decode($boleto);
            if (!empty($boleto->status_request->bank_slip_group)) {
                $link = $boleto->status_request->bank_slip_group;
                $this->servico_model->update(array("descBoletoPaghiper" => $link), array("idServico" => $idServico));

                echo json_encode(["link" => $link]);
                return json_encode(["link" => $link]);
            }
        }

        echo json_encode(["error" => true]);
        return json_encode(["error" => true]);
    }

    function baixarBoleto() {
        $pagamento = new Pagamento_model();
        $link = $pagamento->linkBoleto();   

        header('Content-type: application/pdf');
        header('Content-Disposition: attachment; filename="downloaded.pdf"');
        readfile($link);

        return json_encode($link);
    }

}

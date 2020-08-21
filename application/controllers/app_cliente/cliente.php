<?php

require_once(APPPATH.'libraries/MY_Controller.php');
class Cliente extends MY_Controller {

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

        $this->load->model(["cliente_model", "endereco_model", "usuario_model", "formas_pagamento_model",
                            "app_gerencial/manupula_cliente_model", "pagseguro_model"]);
    }

    /**
     * Método principal da classe
     *
     * @access public
     */
    function index()
    {
		return $this->template->load("app_cliente/template", "app_cliente/index");
    } 
    
    function cadastro()
    {
        $dadosCliente = $this->session->userdata("sCliente");

        if(empty($dadosCliente["Endereco_idEndereco"])) {
            return $this->template->load("app_cliente/template", "app_cliente/cadastro/cadastro_cliente", ["dadosCliente" => $dadosCliente]);
          } else {
            redirect('app_cliente/cliente/cadastro_pagamento', 'refresh');
        }        
    }

    function cadastro_endereco()
    {
        $dadosCliente = $this->session->userdata("sCliente");

        if(empty($dadosCliente["Endereco_idEndereco"])) {
            return $this->template->load("app_cliente/template", "app_cliente/cadastro/cadastro_endereco_cliente");        
          } else {
            redirect('app_cliente/cliente/cadastro_pagamento', 'refresh');
        }
    }

    function cadastro_pagamento()
    {
        $dadosCliente = $this->session->userdata("sCliente");
        $dadosEndereco = $this->input->post();
        
        if(count($dadosEndereco) == 7) {
                $dadosEndereco["numCep"] = preg_replace('/[^0-9]/', '', $dadosEndereco["numCep"]);
                $idEndereco = $this->endereco_model->insert($dadosEndereco);
                if($idEndereco) {
                    $this->db->where('idUsuario', $dadosCliente['Usuario_idUsuario']);
                    $this->db->set('Endereco_idEndereco', $idEndereco);
                    $this->db->update($this->usuario_model);
                }
        }

        $sessionIdPagSeguro = $this->pagseguro_model->createSessionId();
        $formasPagamento = $this->formas_pagamento_model->retornaDados();
        $dadosProduto = $this->manupula_cliente_model->retornaProdutosCliente($dadosCliente["idCliente"]);
        
        $this->db->select("*")->from("periodicidade");

        $periodicidade = $this->db->get()->result();

        $dadosView = ["sessionIdPagSeguro" => $sessionIdPagSeguro, "formasPagamento" => $formasPagamento, 
                        "dadosCliente" => $dadosCliente, "dadosProduto" => array_shift($dadosProduto), "periodicidade" => $periodicidade];

        //var_dump(array_shift($dadosProduto));exit();
        
        return $this->template->load("app_cliente/template", "app_cliente/cadastro/cadastro_pagamento_cliente", $dadosView);        
    }

    function buscar_cliente() 
    {
        $dados = $this->input->post();

        echo json_encode($this->cliente_model->buscar_cliente($dados));
    }
}

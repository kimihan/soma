<?php

require_once(APPPATH.'libraries/MY_Controller.php');
class Cadastro extends MY_Controller {

    /**
     * Método construtor da classe
     *
     * @access public
     */
    function __construct() 
    {
        parent::__construct();

        if(!parent::verificarLoginVendedor()) {
            $this->load->helper('url');
            redirect('app_vendedor/venda', 'refresh');
        }

        $this->load->model("usuario_model");
        $this->load->model("endereco_model");
        $this->load->model("vendedor_model");
    }

    /**
     * Método principal da classe
     *
     * @access public
     */
    function index()
    {
		return $this->template->load("app_vendedor/template", "app_vendedor/cadastro/cadastro_vendedor");
    } 
    
    function cadastro_endereco()
    {
        return $this->template->load("app_vendedor/template", "app_vendedor/cadastro/cadastro_endereco_vendedor");
    }

    function salvar()
    {
        try {
            $dadosVendedor = [];
            $dadosVendedorEndereco = [];
            parse_str($this->input->post()["dadosVendedor"], $dadosVendedor);
            parse_str($this->input->post()["dadosVendedorEndereco"], $dadosVendedorEndereco);

            $idEndereco = $this->endereco_model->insert($dadosVendedorEndereco);

            if($idEndereco) {
                $dadosVendedor["Endereco_idEndereco"] = $idEndereco;
                $dadosVendedor["numCpf"] = preg_replace('/[^0-9]/', '', $dadosVendedor["numCpf"]);
                $dadosVendedor["numTelefone"] = preg_replace('/[^0-9]/', '', $dadosVendedor["numTelefone"]);
                $dadosVendedor["numWhatsapp"] = preg_replace('/[^0-9]/', '', $dadosVendedor["numWhatsapp"]);
                $idUsuario = $this->usuario_model->insert($dadosVendedor);

                if(!empty($dadosVendedor["flgBanca"])) {
                    $dadosVendedor["flgBanca"] = ($dadosVendedor["flgBanca"] == "on") ? 1 : 0;
                }

                if($idUsuario) {
                    $dadosVendedor["Usuario_idUsuario"] = $idUsuario;
                    $idVendedor = $this->vendedor_model->insert($dadosVendedor);
                }
            }
        
            echo ($idVendedor) ? "sucesso" : "error";

            return $idVendedor;
        } catch (\Exception $e) {
            echo "error";

            return false;
        }
    }
}


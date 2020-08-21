<?php

require_once(APPPATH.'libraries/MY_Controller.php');
class Venda extends MY_Controller {

    /**
     * Método construtor da classe
     *
     * @access public
     */
    function __construct() 
    {
        parent::__construct();
        
        if(parent::verificarLoginVendedor()) {
            $this->load->helper('url');
            redirect('app_vendedor/login', 'refresh');
        }

        $this->load->model(["cliente_model", "usuario_model", "endereco_model", "comissao_model", "servico_model", "vendavendedor_model"]);
    }

    /**
     * Método principal da classe
     *
     * @access public
     */
    function index()
    {
        $this->load->model("app_gerencial/manupula_vendedor_model");
        $this->load->library('session');

        $dadosVendedor = $this->session->userdata('sVendedor');
        $dadosProdutos = $this->manupula_vendedor_model->retornaProdutoVendedor($dadosVendedor["idVendedor"], ["flgAplicativo" => FLG_APLICATIVO]);

        return $this->template->load("app_vendedor/template", "app_vendedor/venda/cadastrar_venda", ["dadosProdutos" => $dadosProdutos]);
    }

    function cadastrar_venda_endereco()
    {
        return $this->template->load("app_vendedor/template", "app_vendedor/venda/cadastrar_endereco_venda");
    }

    function salvar()
    {   ignore_user_abort(true);
        $now = date("Y-m-d H:i:s");

        $dadosVendedor = $this->session->userdata('sVendedor');
        $dadosVenda = [];
        $dadosVendaEndereco = [];
        parse_str($this->input->post()["dadosVenda"], $dadosVenda);
        parse_str($this->input->post()["dadosVendaEndereco"], $dadosVendaEndereco);

        $dadosVendaEndereco["flgLigacao"] = (!empty($dadosVendaEndereco["flgLigacao"]) && $dadosVendaEndereco["flgLigacao"] == "on") ? 1 : 0;

        $idEndereco = ($dadosVendaEndereco["flgLigacao"] === 1) ? NULL : $this->endereco_model->insert($dadosVendaEndereco);

        $dateNascimento = explode("/", $dadosVenda["dataNascimento"]);

        $dadosVenda["Endereco_idEndereco"] = $idEndereco;
        $dadosVenda["numCpf"] = preg_replace('/[^0-9]/', '', $dadosVenda["numCpf"]);
        $dadosVenda["numTelefone"] = preg_replace('/[^0-9]/', '', $dadosVenda["numTelefone"]);
        $dadosVenda["numWhatsapp"] = preg_replace('/[^0-9]/', '', $dadosVenda["numWhatsapp"]);
        $dadosVenda["dataNascimento"] = $dateNascimento[2] . "-" . $dateNascimento[1] . "-" . $dateNascimento[0];
        $idUsuario = $this->usuario_model->insert($dadosVenda);

        if($idUsuario) {
            $dadosCliente = ["flgLigacao" => $dadosVendaEndereco["flgLigacao"], "Usuario_idUsuario" => $idUsuario];

            $idCliente = $this->cliente_model->insert($dadosCliente);

            if($idCliente) {
                $dataVencimento = date("Y-m-d H:i:s", +strtotime("+1 month"));
                $produto = explode("-", $dadosVenda["produto"]);
                $vrPreco = str_replace(".", "", $produto[1]);
                $dadosServico = ["dataVenda" => $now, "vrPreco" => str_replace(",", ".", $vrPreco), "Produto_idProduto" => $produto[0],
                                    "Cliente_idCliente" => $idCliente, "dataVencimento" => $dataVencimento];

                $idServico = $this->servico_model->insert($dadosServico);
            }

            if($idServico) {
                $dadosComissao = ["vrComissao" => 0, "flgPago" => 0, "flgTipoComissao" => 1, "dataGerado" => $now,
                                    "Vendedor_idVendedor" => $dadosVendedor["idVendedor"], "Servico_idServico" => $idServico];

                $idComissao = $this->comissao_model->insert($dadosComissao);     
                
                if($idComissao) {
                    $dadosVendaVendedor = ["Venda_idVenda" => $idServico, "Vendedor_idVendedor" => $dadosVendedor["idVendedor"], 
                                            "numComissao" => $idComissao];

                    $idVendaVendedor = $this->vendavendedor_model->insert($dadosVendaVendedor);
                }


                $aux = 0;
                if (!file_exists(PATH_UPLOAD . "/{$idServico}")) {
                    mkdir(PATH_UPLOAD . "/{$idServico}", 0777, true);
                }
                $config['upload_path']          = PATH_UPLOAD . "/{$idServico}";
                $config['allowed_types'] = '*';
                $config['max_size'] = 1024 * 15;
                $this->load->library('upload', $config);
            
                foreach($_FILES as $key => $val) {
                    $explode = explode(".", $val["name"]);
                    $ext = "." . $explode[count($explode) - 1];

                    if ($this->upload->do_upload($key)) {
                        $aux = $aux + 1;
                    } else {
                        echo $this->upload->display_errors();
                        echo json_encode($config);
                    }
                }

                echo ($aux === count($_FILES)) ? json_encode(["sucesso" => "sucesso", "idServico" => $idServico]) : json_encode(["sucesso" => "error"]);

                return true;
            }
        }

        echo "error";
        return false;
    }
}

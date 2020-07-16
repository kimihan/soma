<?php
/**
 * Classe do modelo que representa a tabela cliente
 *
 * @subpackage      Models
 * @author
 */
class Manipula_servico_model  {

    protected $CI;
    /**
     * Método construtor da classe
     *
     * @access public
     */
    function __construct()
    {
        $this->CI = &get_instance();

        $this->CI->load->model("servico_model");
        $this->CI->load->model("produto_model");
    }

    function insereEdita($dados)
    {
        if(!empty($dados["idServico"])) {
            $arrayWhere = array();
            $arrayWhere["idServico"] = $dados["idServico"];
            $this->CI->servico_model->update($dados, $arrayWhere);
        } else {
            unset($dados["idServico"]);

            $idServico = $this->CI->servico_model->insert($dados);
        }
    }

    function retornaDados($idServico = NULL, $arrayWhere = NULL)
    {
        $query = $this->CI->db->select("s.*")
            ->from("{$this->CI->servico_model} s");

        if(!empty($arrayWhere)) {
            foreach ($arrayWhere as $key => $value) {
                if(!empty($value)) {
                    $this->CI->db->like($key, $value);
                }
            }
        }

        if(!empty($idServico)) {
            $this->CI->db->where(array("s.idServico" => $idServico));

            $result = $this->CI->db->get()->row();
        } else {
            $result = $this->CI->db->get()->result();
        }

        return $result;
    }

    function exclui($idServico)
    {
        $arrayExclusao = array();
        $arrayExclusao["idServico"] = $idServico;
        $this->CI->servico_model->excluir($arrayExclusao);
    }

    function retornaDadosVendas($idServico = NULL, $arrayWhere = NULL)
    {
        $this->CI->load->model("vendavendedor_model");
        $this->CI->load->model("cliente_model");
        $this->CI->load->model("usuario_model");
        $this->CI->load->model("vendedor_model");

        $query = $this->CI->db->select("s.*, cl.*, u.*")
            ->from("{$this->CI->servico_model} s")
            ->join("{$this->CI->cliente_model} cl", "s.Cliente_idCliente = idCliente", "LEFT")
            ->join("{$this->CI->usuario_model} u", "cl.Usuario_idUsuario = idUsuario", "LEFT");
            
        if(!empty($arrayWhere)) {
            foreach ($arrayWhere as $key => $value) {
                if(!empty($value)) {
                    $this->CI->db->like($key, $value);
                }
            }
        }

        if(!empty($idServico)) {
            $this->CI->db->where(array("s.idServico" => $idServico));
        }

        $dadosVendas = $this->CI->db->get()->result();

        foreach($dadosVendas as $key => $value) {
            $query = $this->CI->db->select("v.*, vv.*, u.*")
                ->from("{$this->CI->vendavendedor_model} vv")
                ->join("{$this->CI->vendedor_model} v", "vv.Vendedor_idVendedor = idVendedor")
                ->join("{$this->CI->usuario_model} u", "v.Usuario_idUsuario = idUsuario")
                ->where("vv.Venda_idVenda", $value->idServico);

            $dadosVendedores = $this->CI->db->get()->result();
            
            $dadosVendas[$key]->vendedores = $dadosVendedores;

        }

        if(!empty($idServico)) {
            return current($dadosVendas);
        } else {
            return $dadosVendas;
        }
    }

    function insereVenda($dadosVenda)
    {
        $this->CI->load->model("vendavendedor_model");
        $this->CI->load->model("comissao_model");

        $dadosServico = array();
        $dadosServico["dataVenda"] = $dadosVenda["dataVenda"];
        $time = strtotime($dadosServico["dataVenda"]);
        $vencimento = date("Y-m-d", strtotime("+1 month", $time));
        $dadosServico["dataVencimento"] = $vencimento;
        $dadosServico["vrPreco"] = $dadosVenda["vrPreco"];
        $dadosServico["Produto_idProduto"] = $dadosVenda["idProduto"];
        $dadosServico["Cliente_idCliente"] = $dadosVenda["idCliente"];

        $idServico = $this->CI->servico_model->insert($dadosServico);
        for($x = 0; $x <=2; $x++) {
            if(isset($dadosVenda["idVendedor$x"]) && is_numeric($dadosVenda["idVendedor$x"])) {
                $dadosVendaVendedor = array();
                $dadosVendaVendedor["Venda_idVenda"] = $idServico;
                $dadosVendaVendedor["Vendedor_idVendedor"] = $dadosVenda["idVendedor$x"];
                $dadosVendaVendedor["numComissao"] = $dadosVenda["vrComissao$x"];

                $idVendaVendedor = $this->CI->vendavendedor_model->insert($dadosVendaVendedor);

                if(!empty($dadosVenda["vrComissao$x"])) {
                    $dadosComissao = array();
                    $dadosComissao["vrComissao"] = ($dadosVenda["vrComissao$x"] * 0.01) * $dadosServico["vrPreco"] ;
                    $dadosComissao["flgPago"] = 0;
                    $dadosComissao["flgTipoComissao"] = 1;
                    $dadosComissao["dataGerado"] = $dadosServico["dataVenda"];
                    $dadosComissao["Vendedor_idVendedor"] = $dadosVenda["idVendedor$x"];
                    $dadosComissao["Servico_idServico"] = $idServico;

                    $idComissao = $this->CI->comissao_model->insert($dadosComissao);        
                }                            
            }    
        }        
    }

    function excluiVenda($idServico) 
    {
        $this->CI->load->model("vendavendedor_model");
        $this->CI->load->model("comissao_model");

        $arrayExclusao = array();
        $arrayExclusao["Servico_idServico"] = $idServico;
        $this->CI->comissao_model->excluir($arrayExclusao);

        $arrayExclusao = array();
        $arrayExclusao["Venda_idVenda"] = $idServico;
        $this->CI->vendavendedor_model->excluir($arrayExclusao);

        $arrayExclusao = array();
        $arrayExclusao["idServico"] = $idServico;
        $this->CI->servico_model->excluir($arrayExclusao);
    }
}

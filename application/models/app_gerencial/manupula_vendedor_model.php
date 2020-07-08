<?php
/**
 * Classe do modelo que representa a tabela cliente
 *
 * @subpackage      Models
 * @author
 */
class Manupula_vendedor_model  {

    protected $CI;
    /**
     * Método construtor da classe
     *
     * @access public
     */
    function __construct()
    {
        $this->CI = &get_instance();

        $this->CI->load->model("vendedor_model");
        $this->CI->load->model("usuario_model");
        $this->CI->load->model("endereco_model");
        $this->CI->load->model("produto_model");
    }

    function insereEditaVendedor($dadosVendedor)
    {
        if(!empty($dadosVendedor["idVendedor"])) {
            $arrayWhere = array();
            $arrayWhere["idEndereco"] = $dadosVendedor["idEndereco"];
            $this->CI->endereco_model->update($dadosVendedor, $arrayWhere);

            $arrayWhere = array();
            $arrayWhere["idUsuario"] = $dadosVendedor["idUsuario"];
            $this->CI->usuario_model->update($dadosVendedor, $arrayWhere);

        } else {
            unset($dadosVendedor["idVendedor"]);

            $idEndereco = $this->CI->endereco_model->insert($dadosVendedor);

            $dadosVendedor["Endereco_idEndereco"] = $idEndereco;
            $idUsuario = $this->CI->usuario_model->insert($dadosVendedor);

            $dadosVendedor["Usuario_idUsuario"] = $idUsuario;
            $idVendedor = $this->CI->vendedor_model->insert($dadosVendedor);


        }
    }

    function retornaDadosVendedor($idVendedor = NULL, $arrayWhere = NULL)
    {
        $query = $this->CI->db->select("v.*, u.*, e.*")
            ->from("{$this->CI->vendedor_model} v")
            ->join("{$this->CI->usuario_model} u", "v.Usuario_idUsuario = u.idUsuario")
            ->join("{$this->CI->endereco_model} e", "u.Endereco_idEndereco = e.idEndereco");

        if(!empty($arrayWhere)) {
            foreach ($arrayWhere as $key => $value) {
                if(!empty($value)) {
                    $this->CI->db->like($key, $value);
                }
            }
        }

        if(!empty($idVendedor)) {
            $this->CI->db->where(array("v.idVendedor" => $idVendedor));

            $result = $this->CI->db->get()->row();
        } else {
            $result = $this->CI->db->get()->result();
        }

        return $result;
    }

    function retornaProdutoVendedor($idVendedor = NULL, $arrayWhere = NULL)
    {
        $query = $this->CI->db->select("v.idVendedor, FORMAT(u.vrPreco, 2, 'de_DE') as vrPreco, e.*, u.vrComissao, u.vrPreco precoVenda")
            ->from("{$this->CI->vendedor_model} v")
            ->join("produtoVendedor u", "v.idVendedor = u.Vendedor_idVendedor")
            ->join("{$this->CI->produto_model} e", "u.Produto_idProduto = e.idProduto");

        if(!empty($arrayWhere)) {
            foreach ($arrayWhere as $key => $value) {
                if(!empty($value)) {
                    $this->CI->db->like($key, $value);
                }
            }
        }

        if(!empty($idVendedor)) {
            $this->CI->db->where(array("v.idVendedor" => $idVendedor));
        }

        return $this->CI->db->get()->result();
    }

    function excluiVemdedor($idVendedor)
    {
        $query = $this->CI->db->select("v.idVendedor, u.idUsuario, e.idEndereco")
            ->from("{$this->CI->vendedor_model} v")
            ->join("{$this->CI->usuario_model} u", "v.Usuario_idUsuario = u.idUsuario")
            ->join("{$this->CI->endereco_model} e", "u.Endereco_idEndereco = e.idEndereco")
            ->where(array("v.idVendedor" => $idVendedor));

        $result = $this->CI->db->get()->row();

        $arrayExclusao = array();
        $arrayExclusao["idVendedor"] = $result->idVendedor;
        $this->CI->vendedor_model->excluir($arrayExclusao);

        $arrayExclusao = array();
        $arrayExclusao["idUsuario"] = $result->idUsuario;
        $this->CI->usuario_model->excluir($arrayExclusao);

        $arrayExclusao = array();
        $arrayExclusao["idEndereco"] = $result->idEndereco;
        $this->CI->endereco_model->excluir($arrayExclusao);
    }
}

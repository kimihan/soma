<?php
/**
 * Classe do modelo que representa a tabela cliente
 *
 * @subpackage      Models
 * @author
 */
class Manipula_produto_model  {

    protected $CI;
    /**
     * Método construtor da classe
     *
     * @access public
     */
    function __construct()
    {
        $this->CI = &get_instance();

        $this->CI->load->model("produto_model");
    }

    function insereEdita($dados)
    {
        if(!empty($dados["idProduto"])) {
            $arrayWhere = array();
            $arrayWhere["idProduto"] = $dados["idProduto"];
            $this->CI->produto_model->update($dados, $arrayWhere);
        } else {
            unset($dados["idProduto"]);

            $idProduto = $this->CI->produto_model->insert($dados);
        }
    }

    function retornaDados($idProduto = NULL, $arrayWhere = NULL)
    {
        $query = $this->CI->db->select("p.*")
            ->from("{$this->CI->produto_model} p");

        if(!empty($arrayWhere)) {
            foreach ($arrayWhere as $key => $value) {
                if(!empty($value)) {
                    $this->CI->db->like($key, $value);
                }
            }
        }

        if(!empty($idProduto)) {
            $this->CI->db->where(array("p.idProduto" => $idProduto));

            $result = $this->CI->db->get()->row();
        } else {
            $result = $this->CI->db->get()->result();
        }

        return $result;
    }

    function exclui($idProduto)
    {
        $arrayExclusao = array();
        $arrayExclusao["idProduto"] = $idProduto;
        $this->CI->produto_model->excluir($arrayExclusao);
    }
}

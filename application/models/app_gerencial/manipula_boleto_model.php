<?php
/**
 * Classe do modelo que representa a tabela cliente
 *
 * @subpackage      Models
 * @author
 */
class Manipula_boleto_model  {

    protected $CI;
    /**
     * Método construtor da classe
     *
     * @access public
     */
    function __construct()
    {
        $this->CI = &get_instance();

        $this->CI->load->model("boleto_model");
        $this->CI->load->model("cobranca_model");
    }

    function retornaDados($idBoleto = NULL, $arrayWhere = NULL)
    {
        $query = $this->CI->db->select("b.*, c.*")
            ->from("{$this->CI->boleto_model} b")
            ->join("{$this->CI->cobranca_model} c", "b.Cobranca_idCobranca = c.idCobranca");

        if(!empty($arrayWhere)) {
            foreach ($arrayWhere as $key => $value) {
                if(!empty($value)) {
                    $this->CI->db->like($key, $value);
                }
            }
        }

        if(!empty($idProduto)) {
            $this->CI->db->where(array("b.idBoleto" => $idBoleto));

            $result = $this->CI->db->get()->row();
        } else {
            $result = $this->CI->db->get()->result();
        }

        return $result;
    }

    function exclui($idBoleto)
    {
        $arrayExclusao = array();
        $arrayExclusao["idBoleto"] = $idBoleto;

        $this->CI->boleto_model->excluir($arrayExclusao);
    }
}

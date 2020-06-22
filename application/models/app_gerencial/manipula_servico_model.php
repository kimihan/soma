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
}

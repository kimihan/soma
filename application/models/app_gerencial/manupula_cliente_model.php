<?php
/**
 * Classe do modelo que representa a tabela cliente
 *
 * @subpackage      Models
 * @author
 */
class Manupula_cliente_model  {

    protected $CI;
    /**
     * Método construtor da classe
     *
     * @access public
     */
    function __construct()
    {
        $this->CI = &get_instance();

        $this->CI->load->model("cliente_model");
        $this->CI->load->model("usuario_model");
        $this->CI->load->model("endereco_model");
    }

    function insereEditaCliente($dadosCliente)
    {
        if(!empty($dadosCliente["idCliente"])) {
            $arrayWhere = array();
            $arrayWhere["idEndereco"] = $dadosCliente["idEndereco"];
            $this->CI->endereco_model->update($dadosCliente, $arrayWhere);

            $arrayWhere = array();
            $arrayWhere["idUsuario"] = $dadosCliente["idUsuario"];
            $this->CI->usuario_model->update($dadosCliente, $arrayWhere);

            /*
            $arrayWhere = array();
            $arrayWhere["idCliente"] = $dadosCliente["idCliente"];
            $this->CI->cliente_model->update($dadosCliente, $arrayWhere);
            */
        } else {
            unset($dadosCliente["idCliente"]);

            $idEndereco = $this->CI->endereco_model->insert($dadosCliente);

            $dadosCliente["Endereco_idEndereco"] = $idEndereco;
            $idUsuario = $this->CI->usuario_model->insert($dadosCliente);

            $dadosCliente["Usuario_idUsuario"] = $idUsuario;
            $idCliente = $this->CI->cliente_model->insert($dadosCliente);


        }
    }

    function retornaDadosCliente($idCliente = NULL)
    {
        $query = $this->CI->db->select("c.*, u.*, e.*")
            ->from("{$this->CI->cliente_model} c")
            ->join("{$this->CI->usuario_model} u", "c.Usuario_idUsuario = u.idUsuario")
            ->join("{$this->CI->endereco_model} e", "u.Endereco_idEndereco = e.idEndereco");

        if(!empty($idCliente)) {
            $this->CI->db->where(array("c.idCliente" => $idCliente));

            $result = $this->CI->db->get()->row();
        } else {
            $result = $this->CI->db->get()->result();
        }

        return $result;
    }

    function excluiCliente($idCliente)
    {
        $query = $this->CI->db->select("c.idCliente, u.idUsuario, e.idEndereco")
            ->from("{$this->CI->cliente_model} c")
            ->join("{$this->CI->usuario_model} u", "c.Usuario_idUsuario = u.idUsuario")
            ->join("{$this->CI->endereco_model} e", "u.Endereco_idEndereco = e.idEndereco")
            ->where(array("c.idCliente" => $idCliente));

        $result = $this->CI->db->get()->row();

        $arrayExclusao = array();
        $arrayExclusao["idCliente"] = $result->idCliente;
        $this->CI->cliente_model->excluir($arrayExclusao);

        $arrayExclusao = array();
        $arrayExclusao["idUsuario"] = $result->idUsuario;
        $this->CI->usuario_model->excluir($arrayExclusao);

        $arrayExclusao = array();
        $arrayExclusao["idEndereco"] = $result->idEndereco;
        $this->CI->endereco_model->excluir($arrayExclusao);
    }
}

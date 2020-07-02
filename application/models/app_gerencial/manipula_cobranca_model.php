<?php
/**
 * Classe do modelo que representa a tabela cliente
 *
 * @subpackage      Models
 * @author
 */
class Manipula_cobranca_model  {

    protected $CI;
    /**
     * Método construtor da classe
     *
     * @access public
     */
    function __construct()
    {
        $this->CI = &get_instance();

        $this->CI->load->model("cobranca_model");
        $this->CI->load->model("cliente_model");
        $this->CI->load->model("usuario_model");
        $this->CI->load->model("servico_model");
    }

    function insereEdita($dados)
    {
        if(!empty($dados["idCobranca"])) {
            $arrayWhere = array();
            $arrayWhere["idCobranca"] = $dados["idCobranca"];
            $this->CI->cobranca_model->update($dados, $arrayWhere);
        } else {
            unset($dados["idCobranca"]);

            $idCobranca = $this->CI->cobranca_model->insert($dados);
        }
    }


    function retornaDados($idCobranca = NULL, $arrayWhere = NULL)
    {
        $query = $this->CI->db->select("co.*, cl.*, u.*, s.*")
            ->from("{$this->CI->cobranca_model} co")
            ->join("{$this->CI->cliente_model} cl", "co.Cliente_idCliente = cl.idCliente")
            ->join("{$this->CI->usuario_model} u", "cl.Usuario_idUsuario = u.idUsuario")
            ->join("{$this->CI->servico_model} s", "co.Servico_idServico = s.idServico");

        if(!empty($arrayWhere)) {
            foreach ($arrayWhere as $key => $value) {
                if(!empty($value)) {
                    $this->CI->db->like($key, $value);
                }
            }
        }

        if(!empty($idCobranca)) {
            $this->CI->db->where(array("co.idCobranca" => $idCobranca));

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

    function retornaCobrancasPagas($dataInicial = NULL, $dataFinal = NULL)
    {
        $query = $this->CI->db->select("count(1) as num_cobrancas")
            ->from("{$this->CI->cobranca_model} co")
            ->where("flgPago = 1");
            
        if(!empty($dataInicial)) {
            $this->CI->db->where("co.dataVencimento >=", $dataInicial);
        }

        if(!empty($dataFinal)) {
            $this->CI->db->where("co.dataVencimento <=", $dataFinal);
        }

        return  $this->CI->db->get()->row()->num_cobrancas;
    }

    function retornaCobrancasAVencer($dataInicial = NULL, $dataFinal = NULL)
    {
        $query = $this->CI->db->select("count(1) as num_cobrancas")
            ->from("{$this->CI->cobranca_model} co")
            ->where("flgPago = 0")
            ->where("co.dataVencimento >= now()");

        if(!empty($dataInicial)) {
            $this->CI->db->where("co.dataVencimento >=", $dataInicial);
        }

        if(!empty($dataFinal)) {
            $this->CI->db->where("co.dataVencimento <=", $dataFinal);
        }
            
        return  $this->CI->db->get()->row()->num_cobrancas;
    }

    function retornaCobrancasVencidas($dataInicial = NULL, $dataFinal = NULL)
    {
        $query = $this->CI->db->select("count(1) as num_cobrancas")
            ->from("{$this->CI->cobranca_model} co")
            ->where("flgPago = 0")
            ->where("co.dataVencimento < now()");
            
        if(!empty($dataInicial)) {
            $this->CI->db->where("co.dataVencimento >=", $dataInicial);
        }

        if(!empty($dataFinal)) {
            $this->CI->db->where("co.dataVencimento <=", $dataFinal);
        }

        return  $this->CI->db->get()->row()->num_cobrancas;
    }

    function retornaValorRecebido($dataInicial = NULL, $dataFinal = NULL)
    {
        $query = $this->CI->db->select("sum(vrPreco) as valor")
            ->from("{$this->CI->cobranca_model} co")
            ->where("flgPago = 1");

        if(!empty($dataInicial)) {
            $this->CI->db->where("co.dataVencimento >=", $dataInicial);
        }

        if(!empty($dataFinal)) {
            $this->CI->db->where("co.dataVencimento <=", $dataFinal);
        }

        return  $this->CI->db->get()->row()->valor;
    }

    function retornaValorAReceber($dataInicial = NULL, $dataFinal = NULL)
    {
        $query = $this->CI->db->select("sum(vrPreco) as valor")
            ->from("{$this->CI->cobranca_model} co")
            ->where("flgPago = 0")
            ->where("co.dataVencimento >= now()");

        if(!empty($dataInicial)) {
            $this->CI->db->where("co.dataVencimento >=", $dataInicial);
        }

        if(!empty($dataFinal)) {
            $this->CI->db->where("co.dataVencimento <=", $dataFinal);
        }

        return  $this->CI->db->get()->row()->valor;
    }

    function retornaValorVencido($dataInicial = NULL, $dataFinal = NULL)
    {
        $query = $this->CI->db->select("sum(vrPreco) as valor")
            ->from("{$this->CI->cobranca_model} co")
            ->where("flgPago = 0")
            ->where("co.dataVencimento < now()");

        if(!empty($dataInicial)) {
            $this->CI->db->where("co.dataVencimento >=", $dataInicial);
        }

        if(!empty($dataFinal)) {
            $this->CI->db->where("co.dataVencimento <=", $dataFinal);
        }

        return  $this->CI->db->get()->row()->valor;
    }

    function retornaValorTotal()
    {
        $query = $this->CI->db->select("sum(vrPreco) as valor")
            ->from("{$this->CI->cobranca_model} co");
            
        if(!empty($dataInicial)) {
            $this->CI->db->where("co.dataVencimento >=", $dataInicial);
        }

        if(!empty($dataFinal)) {
            $this->CI->db->where("co.dataVencimento <=", $dataFinal);
        }
        return  $this->CI->db->get()->row()->valor;
    }
}

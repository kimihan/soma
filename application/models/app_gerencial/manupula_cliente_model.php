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
        $this->CI->load->model("servico_model");
        $this->CI->load->model("produto_model");
        $this->CI->load->model("cobranca_model");
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

    function retornaDadosCliente($idCliente = NULL, $arrayWhere = NULL)
    {
        $query = $this->CI->db->select("c.*, u.*, e.*")
            ->from("{$this->CI->cliente_model} c")
            ->join("{$this->CI->usuario_model} u", "c.Usuario_idUsuario = u.idUsuario")
            ->join("{$this->CI->endereco_model} e", "u.Endereco_idEndereco = e.idEndereco", 'left');

        if(!empty($arrayWhere)) {
            foreach ($arrayWhere as $key => $value) {
                if(!empty($value)) {
                    $this->CI->db->like($key, $value);
                }
            }
        }

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

    function retornaProdutosCliente($idCliente)
    {
        $query = $this->CI->db->select("p.*, s.*")
            ->from("{$this->CI->produto_model} p")
            ->join("{$this->CI->servico_model} s", "s.Produto_idProduto = p.idProduto")
            ->where(array("s.Cliente_idCliente" => $idCliente));

        $result = $this->CI->db->get()->result();

        return  $result;
    }

    function retornaPagamentosCliente($idCliente)
    {
        $query = $this->CI->db->select("c.*, p.*")
            ->from("{$this->CI->cobranca_model} c")
            ->join("{$this->CI->servico_model} s", "c.Servico_idServico = s.idServico")
            ->join("{$this->CI->produto_model} p", "s.Produto_idProduto = p.idProduto")
            ->where(array("c.Cliente_idCliente" => $idCliente, "c.flgPago" => 1));

        $result = $this->CI->db->get()->result();

        return  $result;
    }    

    function retornaClientesAdimplentes($dataInicial = NULL, $dataFinal = NULL)
    {
        $query = $this->CI->db->select("count(1) as num_clientes")
            ->from("{$this->CI->cliente_model} c")
            ->join("{$this->CI->servico_model} s", "s.Cliente_idCliente = c.idCliente", "left")
            ->where("s.dataVencimento >= now()");

        if(!empty($dataInicial)) {
            $this->CI->db->where("c.dataCadastro >=", $dataInicial);
        }

        if(!empty($dataFinal)) {
            $this->CI->db->where("c.dataCadastro <=", $dataFinal);
        }

        return $this->CI->db->get()->row()->num_clientes;
    }

    function retornaClientesInadimplentes($dataInicial = NULL, $dataFinal = NULL)
    {
        $query = $this->CI->db->select("count(1) as num_clientes")
            ->from("{$this->CI->cliente_model} c")
            ->join("{$this->CI->servico_model} s", "s.Cliente_idCliente = c.idCliente", "left")
            ->where("s.dataVencimento < now()");

        if(!empty($dataInicial)) {
            $this->CI->db->where("c.dataCadastro >=", $dataInicial);
        }

        if(!empty($dataFinal)) {
            $this->CI->db->where("c.dataCadastro <=", $dataFinal);
        }

        return $this->CI->db->get()->row()->num_clientes;
    }

    function retornaTotalClientes($dataInicial = NULL, $dataFinal = NULL)
    {
        $query = $this->CI->db->select("count(1) as num_clientes")
            ->from("{$this->CI->cliente_model} c")
            ->join("{$this->CI->servico_model} s", "s.Cliente_idCliente = c.idCliente", "left");

        if(!empty($dataInicial)) {
            $this->CI->db->where("c.dataCadastro >=", $dataInicial);
        }

        if(!empty($dataFinal)) {
            $this->CI->db->where("c.dataCadastro <=", $dataFinal);
        }

        return $this->CI->db->get()->row()->num_clientes;
    }
}

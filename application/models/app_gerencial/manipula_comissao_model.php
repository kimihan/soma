<?php
/**
 * Classe do modelo que representa a tabela cliente
 *
 * @subpackage      Models
 * @author
 */
class Manipula_comissao_model  {

    protected $CI;
    /**
     * Método construtor da classe
     *
     * @access public
     */
    function __construct()
    {
        $this->CI = &get_instance();

        $this->CI->load->model("comissao_model");
        $this->CI->load->model("servico_model");
        $this->CI->load->model("usuario_model");
        $this->CI->load->model("vendedor_model");
    }

    function retornaDados($idComissao = NULL, $arrayWhere = NULL)
    {
        $query = $this->CI->db->select("c.*, v.*, s.*, u.*")
            ->from("{$this->CI->comissao_model} c")
            ->join("{$this->CI->vendedor_model} v", "c.Vendedor_idVendedor = v.idVendedor")
            ->join("{$this->CI->usuario_model} u", "v.Usuario_idUsuario = u.idUsuario")
            ->join("{$this->CI->servico_model} s", "c.Servico_idServico = s.idServico");

        if(!empty($arrayWhere)) {
            foreach ($arrayWhere as $key => $value) {
                if(!empty($value)) {
                    $this->CI->db->like($key, $value);
                }
            }
        }
        $this->CI->db->order_by("flgPago", "DESC");
        $this->CI->db->order_by("dataGerado", "DESC");

        if(!empty($idComissao)) {
            $this->CI->db->where(array("c.idComissao" => $idComissao));

            $result = $this->CI->db->get()->row();
        } else {
            $result = $this->CI->db->get()->result();
        }

        foreach($result as $key => $value) {
            $query = $this->CI->db->select("idComissao")
                ->from("{$this->CI->comissao_model} c")
                ->where(array("c.Vendedor_idVendedor" => $value->Vendedor_idVendedor))
                ->where(array("c.Servico_idServico" => $value->Servico_idServico))
                ->where("idComissao < $value->idComissao");

            $comissao = $this->CI->db->get()->row();
 
            if(!empty($comissao->idComissao)) {
                $result[$key]->flgPrimeiraComissao = 0;
            } else {
                $result[$key]->flgPrimeiraComissao = 1;
            }
        }

        return $result;
    }

    function retornaDadosComissao($idComissao = NULL, $arrayWhere = NULL)
    {
        $query = $this->CI->db->select("c.*, v.*, u.*, SUM(vrComissao) as vrComissaoPagar, CASE WHEN sum(flgTipoComissao) > 0 THEN 1 ELSE 0 END as flgPrimeiraComissao")
            ->from("{$this->CI->vendedor_model} v")
            ->join("{$this->CI->comissao_model} c", "c.Vendedor_idVendedor = v.idVendedor AND c.flgPago = 0")
            ->join("{$this->CI->usuario_model} u", "v.Usuario_idUsuario = u.idUsuario");

        if(!empty($arrayWhere)) {
            foreach ($arrayWhere as $key => $value) {
                if(!empty($value)) {
                    $this->CI->db->like($key, $value);
                }
            }
        }

        $this->CI->db->order_by("dataGerado", "DESC");

        if(!empty($idComissao)) {
            $this->CI->db->where(array("c.idComissao" => $idComissao));

            $result = $this->CI->db->get()->row();
        } else {
            $result = $this->CI->db->get()->result();
        }

        return $result;
    }

    function retornaDadosComissaoVendedor($idVendedor = NULL)
    {
        $this->CI->load->model("cliente_model");
        $this->CI->load->model("vendavendedor_model");

        $query = $this->CI->db->select("c.*, v.*, vv.numComissao, u.*, s.*, uc.descNome as nomeCliente")
            ->from("{$this->CI->comissao_model} c")
            ->join("{$this->CI->vendedor_model} v", "c.Vendedor_idVendedor = v.idVendedor")
            ->join("{$this->CI->vendavendedor_model} vv", "vv.Vendedor_idVendedor = v.idVendedor")
            ->join("{$this->CI->usuario_model} u", "v.Usuario_idUsuario = u.idUsuario")
            ->join("{$this->CI->servico_model} s", "c.Servico_idServico = s.idServico")
            ->join("{$this->CI->cliente_model} cl", "s.Cliente_idCliente = cl.idCliente")
            ->join("{$this->CI->usuario_model} uc", "cl.Usuario_idUsuario = uc.idUsuario");

        if(!empty($arrayWhere)) {
            foreach ($arrayWhere as $key => $value) {
                if(!empty($value)) {
                    $this->CI->db->like($key, $value);
                }
            }
        }

        $this->CI->db->order_by("dataGerado", "DESC");
        $this->CI->db->group_by("s.idServico");

        $this->CI->db->where(array("c.Vendedor_idVendedor" => $idVendedor));
        $this->CI->db->where("c.flgPago = 0");

        $result = $this->CI->db->get()->result();

        return $result;
    }


    function exclui($idBoleto)
    {
        $arrayExclusao = array();
        $arrayExclusao["idBoleto"] = $idBoleto;

        $this->CI->boleto_model->excluir($arrayExclusao);
    }

    function marcaComissoesPagas($idVendedor)
    {
        $arrayUpdate["flgPago"] = 1;
        $arrayWhere["Vendedor_idVendedor"] = $idVendedor;

        $this->CI->comissao_model->update($arrayUpdate, $arrayWhere);
    }
}

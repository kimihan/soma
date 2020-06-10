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
    }

    function insereEditaCliente($dadosCliente)
    {
        $this->CI->load->model("cliente_model");
        $this->CI->load->model("usuario_model");
        $this->CI->load->model("endereco_model");

        if(!empty($dadosCliente["idCliente"])) {
            $acao = "editar";
        } else {
            unset($dadosCliente["idCliente"]);

            $idEndereco = $this->CI->endereco_model->insert($dadosCliente);

            $dadosCliente["Endereco_idEndereco"] = $idEndereco;
            $idUsuario = $this->CI->usuario_model->insert($dadosCliente);

            $dadosCliente["Usuario_idUsuario"] = $idUsuario;
            $idCliente = $this->CI->cliente_model->insert($dadosCliente);
            /*
            $dadosEndereco["numCep"] = $dadosCliente["numCep"];
            $dadosEndereco["descLogradouro"] = $dadosCliente["descLogradouro"];
            $dadosEndereco["numLocal"] = $dadosCliente["numLocal"];
            $dadosEndereco["descComplemento"] = $dadosCliente["descComplemento"];
            $dadosEndereco["descBairro"] = $dadosCliente["descBairro"];
            $dadosEndereco["descCidade"] = $dadosCliente["descCidade"];
            $dadosEndereco["siglaUf"] = $dadosCliente["siglaUf"];
            $idEndereco = $this->CI->db->insert("endereco", $dadosEndereco);

            $dadosUsuario["descNome"] = $dadosCliente["descNome"];
            $dadosUsuario["descEmail"] = $dadosCliente["descEmail"];
            $dadosUsuario["descSenha"] = $dadosCliente["descSenha"];
            $dadosUsuario["descRg"] = $dadosCliente["descRg"];
            $dadosUsuario["dataNascimento"] = $dadosCliente["dataNascimento"];
            $dadosUsuario["flgSexo"] = $dadosCliente["flgSexo"];
            $dadosUsuario["flgTipoPessoa"] = $dadosCliente["flgTipoPessoa"];
            $dadosUsuario["numCpf"] = $dadosCliente["numCpf"];
            $dadosUsuario["numTelefone"] = $dadosCliente["numTelefone"];
            $dadosUsuario["numWhatsapp"] = $dadosCliente["numWhatsapp"];
            $dadosUsuario["Endereco_idEndereco"] = $idEndereco;
            $idUsuario = $this->CI->db->insert_id("usuario", $dadosUsuario);

            $dadosClienteInserir["Usuario_idUsuario"] = $idUsuario;
            $idCliente = $this->CI->db->insert_id("cliente", $dadosClienteInserir);

            var_dump($idUsuario);
            */
        }
    }
}

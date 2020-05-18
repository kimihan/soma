<?php
/**
* Classe do modelo que representa a tabela usuario
*
* @package         LojaVirtual
* @subpackage      Models
* @author
*/
require_once(APPPATH."libraries/MY_Model.php");
class Usuario_model extends MY_Model {

    /**
     * Nome da tabela
     * @access protected
     * @var string
     */
    protected $name = "usuario";

    /**
     * Validators
     * @access protected
     * @var string
     */
    protected $validators = array(
                                array("field"=>"descNome",
                    "label"=>"Descnome",
                    "rules"=>"required|max_length[100]"),
                    array("field"=>"descEmail",
                    "label"=>"Descemail",
                    "rules"=>"required|max_length[80]"),
                    array("field"=>"descSenha",
                    "label"=>"Descsenha",
                    "rules"=>"max_length[45]"),
                    array("field"=>"descRg",
                    "label"=>"Descrg",
                    "rules"=>"max_length[20]"),
                    array("field"=>"dataNascimento",
                    "label"=>"Datanascimento",
                    "rules"=>"date"),
                    array("field"=>"flgSexo",
                    "label"=>"Flgsexo",
                    "rules"=>"max_length[1]"),
                    array("field"=>"flgTipoPessoa",
                    "label"=>"Flgtipopessoa",
                    "rules"=>"max_length[1]"),
                    array("field"=>"numCpf",
                    "label"=>"Numcpf",
                    "rules"=>"required|integer"),
                    array("field"=>"numTelefone",
                    "label"=>"Numtelefone",
                    "rules"=>"integer"),
                    array("field"=>"numWhatsapp",
                    "label"=>"Numwhatsapp",
                    "rules"=>"integer"),
                    array("field"=>"Endereco_idEndereco",
                    "label"=>"Endereco idendereco",
                    "rules"=>"required|integer")

    );
}
               
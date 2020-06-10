<?php
/**
* Classe do modelo que representa a tabela endereco
*
* @package         LojaVirtual
* @subpackage      Models
* @author
*/
require_once(APPPATH."libraries/MY_Model.php");
class Endereco_model extends MY_Model {

    /**
     * Nome da tabela
     * @access protected
     * @var string
     */
    protected $name = "endereco";

    /**
     * Validators
     * @access protected
     * @var string
     */
    protected $validators = array(
                                array("field"=>"numCep",
                    "label"=>"Numcep",
                    "rules"=>"required|integer"),
                    array("field"=>"descLogradouro",
                    "label"=>"Desclogradouro",
                    "rules"=>"required|max_length[45]"),
                    array("field"=>"numLocal",
                    "label"=>"Numlocal",
                    "rules"=>"required|max_length[45]"),
                    array("field"=>"descComplemento",
                    "label"=>"Desccomplemento",
                    "rules"=>"max_length[45]"),
                    array("field"=>"descBairro",
                    "label"=>"Descbairro",
                    "rules"=>"max_length[45]"),
                    array("field"=>"descCidade",
                    "label"=>"Desccidade",
                    "rules"=>"max_length[45]"),
                    array("field"=>"siglaUf",
                    "label"=>"Siglauf",
                    "rules"=>"max_length[2]")

    );

    function __construct()
    {
        parent::__construct(array($this->name));
    }

}
               
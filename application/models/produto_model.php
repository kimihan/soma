<?php
/**
* Classe do modelo que representa a tabela produto
*
* @package         LojaVirtual
* @subpackage      Models
* @author
*/
require_once(APPPATH."libraries/MY_Model.php");
class Produto_model extends MY_Model {

    /**
     * Nome da tabela
     * @access protected
     * @var string
     */
    protected $name = "produto";

    /**
     * Validators
     * @access protected
     * @var string
     */
    protected $validators = array(
                                array("field"=>"descNome",
                    "label"=>"Descnome",
                    "rules"=>"required|max_length[60]"),
                    array("field"=>"descCoberturas",
                    "label"=>"Desccoberturas",
                    "rules"=>"text"),
                    array("field"=>"flgAplicativo",
                    "label"=>"Flgaplicativo",
                    "rules"=>"required|integer")

    );
}
               
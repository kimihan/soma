<?php
/**
* Classe do modelo que representa a tabela produtovendedor
*
* @package         LojaVirtual
* @subpackage      Models
* @author
*/
require_once(APPPATH."libraries/MY_Model.php");
class Produtovendedor_model extends MY_Model {

    /**
     * Nome da tabela
     * @access protected
     * @var string
     */
    protected $name = "produtovendedor";

    /**
     * Validators
     * @access protected
     * @var string
     */
    protected $validators = array(
                                array("field"=>"vrPreco",
                    "label"=>"Vrpreco",
                    "rules"=>"required|numeric")

    );
}
               
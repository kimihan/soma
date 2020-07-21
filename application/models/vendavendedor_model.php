<?php
/**
* Classe do modelo que representa a tabela vendavendedor
*
* @package         LojaVirtual
* @subpackage      Models
* @author
*/
require_once(APPPATH."libraries/MY_Model.php");
class Vendavendedor_model extends MY_Model {

    /**
     * Nome da tabela
     * @access protected
     * @var string
     */
    protected $name = "vendavendedor";

    /**
     * Validators
     * @access protected
     * @var string
     */
    protected $validators = array(
                                array("field"=>"numComissao",
                    "label"=>"Numcomissao",
                    "rules"=>"required|integer"),
                    array("field"=>"Venda_idVenda",
                    "label"=>"Venda_idVenda",
                    "rules"=>"required|integer"),
                    array("field"=>"Vendedor_idVendedor",
                    "label"=>"Vendedor_idVendedor",
                    "rules"=>"required|integer")

    );

    function __construct()
    {
        parent::__construct(array($this->name));
    }

}
               
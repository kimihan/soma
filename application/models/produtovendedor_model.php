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
                    "rules"=>"required|numeric"),
                    array("field"=>"vrComissao",
                    "label"=>"vrComissao",
                    "rules"=>"required|numeric"),
                    array("field"=>"Vendedor_idVendedor",
                    "label"=>"Vendedor_idVendedor",
                    "rules"=>"required|numeric"),
                    array("field"=>"Produto_idProduto",
                    "label"=>"Produto_idProduto",
                    "rules"=>"required|numeric")
    );

    function __construct()
    {
        parent::__construct(array($this->name));
    }
}
               
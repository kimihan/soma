<?php
/**
* Classe do modelo que representa a tabela servico
*
* @package         LojaVirtual
* @subpackage      Models
* @author
*/
require_once(APPPATH."libraries/MY_Model.php");
class Servico_model extends MY_Model {

    /**
     * Nome da tabela
     * @access protected
     * @var string
     */
    protected $name = "servico";

    /**
     * Validators
     * @access protected
     * @var string
     */
    protected $validators = array(
                                array("field"=>"dataVenda",
                    "label"=>"Datavenda",
                    "rules"=>"date"),
                    array("field"=>"dataVencimento",
                    "label"=>"Datavencimento",
                    "rules"=>"date"),
                    array("field"=>"vrPreco",
                    "label"=>"Vrpreco",
                    "rules"=>"required|numeric"),
                    array("field"=>"Produto_idProduto",
                    "label"=>"Produto idproduto",
                    "rules"=>"required|integer"),
                    array("field"=>"Cliente_idCliente",
                    "label"=>"Cliente idcliente",
                    "rules"=>"required|integer")

    );

    function __construct()
    {
        parent::__construct(array($this->name));
    }
}
               
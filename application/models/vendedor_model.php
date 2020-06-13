<?php
/**
* Classe do modelo que representa a tabela vendedor
*
* @package         LojaVirtual
* @subpackage      Models
* @author
*/
require_once(APPPATH."libraries/MY_Model.php");
class Vendedor_model extends MY_Model {

    /**
     * Nome da tabela
     * @access protected
     * @var string
     */
    protected $name = "vendedor";

    /**
     * Validators
     * @access protected
     * @var string
     */
    protected $validators = array(
                                array("field"=>"dataCadastro",
                    "label"=>"Datacadastro",
                    "rules"=>"required|timestamp"),
                    array("field"=>"flgBanca",
                    "label"=>"Flgbanca",
                    "rules"=>"required|integer"),
                    array("field"=>"Usuario_idUsuario",
                    "label"=>"Usuario idusuario",
                    "rules"=>"required|integer")

    );

    function __construct()
    {
        parent::__construct(array($this->name));
    }
}
               
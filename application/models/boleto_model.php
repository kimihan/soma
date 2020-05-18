<?php
/**
* Classe do modelo que representa a tabela boleto
*
* @package         LojaVirtual
* @subpackage      Models
* @author
*/
require_once(APPPATH."libraries/MY_Model.php");
class Boleto_model extends MY_Model {

    /**
     * Nome da tabela
     * @access protected
     * @var string
     */
    protected $name = "boleto";

    /**
     * Validators
     * @access protected
     * @var string
     */
    protected $validators = array(
                                array("field"=>"dataGerado",
                    "label"=>"Datagerado",
                    "rules"=>"required|timestamp"),
                    array("field"=>"dataVencimento",
                    "label"=>"Datavencimento",
                    "rules"=>"required|date"),
                    array("field"=>"flgCancelado",
                    "label"=>"Flgcancelado",
                    "rules"=>"required|integer"),
                    array("field"=>"Cobranca_idCobranca",
                    "label"=>"Cobranca idcobranca",
                    "rules"=>"required|integer")

    );
}
               
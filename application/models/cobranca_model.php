<?php
/**
* Classe do modelo que representa a tabela cobranca
*
* @package         LojaVirtual
* @subpackage      Models
* @author
*/
require_once(APPPATH."libraries/MY_Model.php");
class Cobranca_model extends MY_Model {

    /**
     * Nome da tabela
     * @access protected
     * @var string
     */
    protected $name = "cobranca";

    /**
     * Validators
     * @access protected
     * @var string
     */
    protected $validators = array(
                                array("field"=>"dataGerado",
                    "label"=>"Datagerado",
                    "rules"=>"required|timestamp"),
                    array("field"=>"dataPagamento",
                    "label"=>"Datapagamento",
                    "rules"=>"date"),
                    array("field"=>"dataVencimento",
                    "label"=>"Datavencimento",
                    "rules"=>"required|date"),
                    array("field"=>"vrPreco",
                    "label"=>"Vrpreco",
                    "rules"=>"required|numeric"),
                    array("field"=>"flgPago",
                    "label"=>"Flgpago",
                    "rules"=>"required|integer"),
                    array("field"=>"Cliente_idCliente",
                    "label"=>"Cliente idcliente",
                    "rules"=>"required|integer"),
                    array("field"=>"Servico_idServico",
                    "label"=>"Servico idservico",
                    "rules"=>"required|integer")

    );
}
               
<?php
/**
* Classe do modelo que representa a tabela comissao
*
* @package         LojaVirtual
* @subpackage      Models
* @author
*/
require_once(APPPATH."libraries/MY_Model.php");
class Comissao_model extends MY_Model {

    /**
     * Nome da tabela
     * @access protected
     * @var string
     */
    protected $name = "comissao";

    /**
     * Validators
     * @access protected
     * @var string
     */
    protected $validators = array(
                                array("field"=>"dataGerado",
                    "label"=>"Datagerado",
                    "rules"=>"required|timestamp"),
                    array("field"=>"vrComissao",
                    "label"=>"Vrcomissao",
                    "rules"=>"required|numeric"),
                    array("field"=>"flgPago",
                    "label"=>"Flgpago",
                    "rules"=>"required|integer"),
                    array("field"=>"Vendedor_idVendedor",
                    "label"=>"Vendedor idvendedor",
                    "rules"=>"required|integer"),
                    array("field"=>"Servico_idServico",
                    "label"=>"Servico idservico",
                    "rules"=>"required|integer")

    );
}
               
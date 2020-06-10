<?php
/**
* Classe do modelo que representa a tabela cliente
*
* @package         LojaVirtual
* @subpackage      Models
* @author
*/
require_once(APPPATH."libraries/MY_Model.php");
class Cliente_model extends MY_Model {

    /**
     * Nome da tabela
     * @access protected
     * @var string
     */
    protected $name = "cliente";

    /**
     * Validators
     * @access protected
     * @var string
     */
    protected $validators = array(
                                array("field"=>"dataCadastro",
                    "label"=>"Datacadastro",
                    "rules"=>"timestamp"),
                    array("field"=>"flgLigacao",
                    "label"=>"Flgligacao",
                    "rules"=>"required|integer"),
                    array("field"=>"descPagseguroId",
                    "label"=>"Descpagseguroid",
                    "rules"=>"max_length[60]"),
                    array("field"=>"flgFormaPagamento",
                    "label"=>"Flgformapagamento",
                    "rules"=>"required|integer"),
                    array("field"=>"flgPeriodicidadePagamento",
                    "label"=>"Flgperiodicidadepagamento",
                    "rules"=>"required|integer"),
                    array("field"=>"Usuario_idUsuario",
                    "label"=>"Usuario idusuario",
                    "rules"=>"required|integer")

    );

    function __construct()
    {
        parent::__construct(array($this->name));
    }

    function getDadosCliente($idCliente)
    {
        
    }

}
               
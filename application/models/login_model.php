<?php

require_once(APPPATH."libraries/MY_Model.php");
class login_model extends MY_Model {

    protected $name = "Usuario";

    function __construct()
    {
        parent::__construct(array($this->name));
    }

    public function logarVendendor($dadosLogin) {
        $CI =& get_instance();
        $CI->load->model("app_gerencial/manupula_vendedor_model");

        $where = ["descEmail" => $dadosLogin["descEmail"]];

        $dadosVendedor = (array) $CI->manupula_vendedor_model->retornaDadosVendedor(null, $where)[0];

        if(count($dadosVendedor) > 0 and $dadosVendedor["descSenha"] === $dadosLogin["descSenha"]) {
            $CI->load->library('session');
            unset($dadosVendedor["descSenha"]);

            $CI->session->set_userdata('sVendedor', $dadosVendedor);

            return true;   
        } else {
            return false;
        }
        
    }

}
               
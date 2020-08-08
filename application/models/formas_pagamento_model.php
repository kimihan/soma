<?php

require_once(APPPATH."libraries/MY_Model.php");
class Formas_pagamento_model extends MY_Model {

    /**
     * Nome da tabela
     * @access protected
     * @var string
     */
    protected $name = "formasPagamento";

    /**
     * Validators
     * @access protected
     * @var string
     */
    protected $validators = [
        [
            "field"=>"nome",
            "label"=>"Nome",
            "rules"=>"required|max_length[200]"
        ]
    ];

    function __construct()
    {
        parent::__construct(array($this->name));
    }

    function retornaDados($id = NULL, $arrayWhere = NULL)
    {
        $query = $this->CI->db->select("f.*")
            ->from("{$this} f");

        if(!empty($arrayWhere)) {
            foreach ($arrayWhere as $key => $value) {
                if(!empty($value)) {
                    $this->CI->db->like($key, $value);
                }
            }
        }

        if(!empty($id)) {
            $this->CI->db->where(array("f.id" => $id));

            $result = $this->CI->db->get()->row();
        } else {
            $result = $this->CI->db->get()->result();
        }

        return $result;
    }
}
               
<?php

class MY_Controller extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->helper("url_helper");

        $this->load->library("MY_Input");
    }

    function post_all($campos_permitidos = NULL, $filter = FALSE)
    {
        $post = array();
        $dados=$_POST;

        if(!empty($campos_permitidos))
        {
            $campos_permitidos = array_flip($campos_permitidos);
            $dados = array_intersect_key ($dados, $campos_permitidos);
        }
        foreach ($dados as $key => $value)
        {
            $dados[$key] = $this->input->post($key, $filter);
        }
        return $dados;
    }
}
?>
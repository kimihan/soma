<?php

class MY_Controller extends CI_Controller
{

    function __construct($verificaLogado = FALSE)
    {
        //session_start();
        parent::__construct();

        $this->load->helper("url_helper");
        $this->load->helper("geral_helper");
        $this->load->library("MY_Input");

        if(!empty($verificaLogado)) {
            if(empty($_SESSION["usuarioLogado"])) {
                header("Location: ".base_url()."app_gerencial/login");
            }
        }
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

    function objectToArray($data)
    {
        if (is_array($data) || is_object($data))
        {
            $result = array();
            foreach ($data as $key => $value)
            {
                $result[$key] = $this->objectToArray($value);
            }
            return $result;
        }
        return $data;
    }

    function verificarLoginVendedor() {
        $this->load->library('session');
        
        return (count($this->session->userdata("sVendedor")) > 0) ? false : true;
    }
    
    function verificarLoginCliente() {
        $this->load->library('session');
        
        return (count($this->session->userdata("sCliente")) > 0) ? false : true;
    }
}
?>
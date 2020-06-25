<?php

require_once(APPPATH.'libraries/MY_Controller.php');
class Cadastro extends MY_Controller {

    /**
     * Método construtor da classe
     *
     * @access public
     */
    function __construct() 
    {
        parent::__construct();
    }

    /**
     * Método principal da classe
     *
     * @access public
     */
    function index()
    {
        
		return $this->template->load("app_vendedor/template", "app_vendedor/cadastro/cadastro_vendedor");
    } 
    
    function cadastro_endereco()
    {
        $cookie= array(

            'name'   => 'remember_me',
            'value'  => 'test',                            
            'expire' => '300',                                                                                   
            'secure' => TRUE
 
        );
 
        $this->input->set_cookie($cookie);

        return $this->template->load("app_vendedor/template", "app_vendedor/cadastro/cadastro_endereco_vendedor");
    }

    function salvar()
    {
        $dadosPost = $this->input->post();

        var_dump($dadosPost);

        return true;
    }
}

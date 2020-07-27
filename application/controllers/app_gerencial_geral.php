<?php

require_once(APPPATH.'libraries/MY_Controller.php');
class App_gerencial_geral extends MY_Controller {

    /**
     * Método construtor da classe
     *
     * @access public
     */
    function __construct()
    {
        parent::__construct();
    }

    function consulta_cep($cep)
    {
        //criando o recurso cURL
        $cr = curl_init();
        
        //definindo a url de busca 
        curl_setopt($cr, CURLOPT_URL, "https://viacep.com.br/ws/".$cep."/json/");
        
        curl_setopt($cr, CURLOPT_RETURNTRANSFER, true);
        
        //definindo uma variável para receber o conteúdo da página...
        $retorno = curl_exec($cr);
        
        //fechando-o para liberação do sistema.
        curl_close($cr); //fechamos o recurso e liberamos o sistema...
        
        //mostrando o conteúdo...
        echo $retorno;
    }
}

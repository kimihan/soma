<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Class paghiper_library
 */
class Paghiper_pagamento_library
{

    function __construct()
    {

    }

    function multiple_bank($params)
    {
        $params = json_encode($params);

        $url = "https://api.paghiper.com/transaction/multiple_bank_slip/";

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POST, count($params));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $output=curl_exec($ch);

        curl_close($ch);
        return $output;

    }

    function emiteBoleto($params)
    {
        $url = "https://api.paghiper.com/transaction/create/";

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, count($params));
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $output=curl_exec($ch);

        curl_close($ch);
        return $output;

    }

    public function envia_post($url, $params)
    {
        if(is_object($params))
        {
            $params = (array)$params;
        }
        return $this->httpPost($url, $params);
    }

    public function envia_requisicao_retorno_automatico($params)
    {
        if(is_object($params))
        {
            $params = (array)$params;
        }

        $postData = "";
        foreach($params as $k => $v)
        {
            $postData .= $k . '='.$v.'&';
        }
        $postData = rtrim($postData, '&');

        ob_start();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, URL_PAGHIPER_CONFIRM);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $resposta = curl_exec($ch);
        curl_close($ch);

        return $resposta;
    }

    /**
     * Função que retorna uma string no formato de post. Função é utilizando quando o paghiper envia um post com dados de pagamento e
     * deve ser retornado um post com os campos recebidos e o token da conta no paghiper.
     * @param $params array Array recebido do paghiper
     * @return string Retorna um string
     */
    public function retorna_dados_post_envio($params)
    {
        /**
        $post = "idTransacao={$params['idTransacao']}" .
        "&status={$params['status']}" .
        "&codRetorno={$params['codRetorno']}" .
        "&valorOriginal={$params['valorOriginal']}" .
        "&valorLoja={$params['valorLoja']}" .
        "&token={$params['token']}";
        return $post;
         */
        return http_build_query($params);
    }

    public function checkout_transparent($url, $obj_paghiper)
    {
        return $this->envia_post($url, $obj_paghiper);
    }

    /**
     * Função que envia uma requisição para paghiper
     * @param $url string
     * @param $params array
     * @return mixed
     */
    private function httpPost($url,$params)
    {
        $postData = '';
        //create name value pairs seperated by &
        foreach($params as $k => $v)
        {
            $postData .= $k . '='.$v.'&';
        }
        $postData = rtrim($postData, '&');

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, count($postData));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $output=curl_exec($ch);

        curl_close($ch);
        return $output;

    }
}

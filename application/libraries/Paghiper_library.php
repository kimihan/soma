<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: BRUNO
 * Date: 15/02/17
 * Time: 12:15
 */

/**
 * Class paghiper_library
 */
class Paghiper_library
{
    public $paghiper_domain;

    function __construct()
    {
        $this->paghiper_domain = new Paghiper_domain();
    }

    /**
     * Função que recebe a url e os parametros para enviar para paghiper
     * @param $url string Url
     * @param $params array Atributos solicitados pelo paghiper
     * @return mixed
     */
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

    /**
     * Função que retorna html com data-href = link para o boleto de um pedido
     * @param $link Link do boleto paghiper
     * @return string
     */
    public function retorna_html_form_pagamento($link)
    {

        $html = "<div id=\"link_paghiper\" data-href=\"{$link}\"></div>";
        return $html;
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

/**
 * Class paghiper_domain
 * @descricao Class responsável por criar o objeto com os atributos para envio ao paghiper
 */
class Paghiper_domain
{
    /**
     * @var string Especifica o e-mail do vendedor cadastrado no PagHiper.
     * O e-mail informado deve estar vinculado à conta do PagHiper.
     * Presença: Obrigatória. Tipo: Alfanumérico. Formato: Um e-mail válido, com limite de 200 caracteres.
     */
    public $email_loja;

    /**
     * @var string Código de referência da loja.
     * Define um código para referenciar o pagamento. Útil para vincular o pagamento a um pedido criado na sua loja..
     * Presença: Opcional. Tipo: Alfanumérico. Formato: Livre, com até 64 caracteres.
     */
    public $id_plataforma;

    /**
     * @var string URL de retorno automático de dados
     * Endereço da página onde o PagHiper enviará o POST com as informações da transação. Note que, este campo tem prioridade ao valor que estiver configurado no seu painel.
     * Presença: Opcional. Tipo: Alfanumérico. Formato: Livre, com até 255 caracteres. Ex: http://www.meusite.com.br/retorno_automatico/
     */
    public $urlRetorno;

    /**
     * @var string Modelo de layout do boleto
     * Define a forma do boleto que será exibido, pode ser padrão A4 ou carnê. Note que, caso o valor seja vazio será adotado o modelo padrão A4.
     * Presença: Opcional. Tipo: Texto. Formato: Padrão. As opções são: “boletoA4” para o formato padrão A4 ou “boletoCarne” para o formato de carnê.
     */
    public $tipoBoleto;

    /**
     * @var int Quantidade de dias para o vencimento do boleto
     * Define o prazo de vencimento do boleto bancário. O valor é considerado em dias corridos a partir da data de requisição.
     * Presença: Opcional. Tipo: Inteiro. Formato: Número inteiro, com um digito. As opções são: 2, 3, 4, 5, 6 ou 7.
     */
    public $vencimentoBoleto;

    /**
     * @var float Especifica o valor do frete
     * Presença: Opcional. Tipo: Decimal. Formato: Decimal, com duas casas decimais separadas por ponto. Ex: 1023.29
     */
    public $frete;

    /**
     * @var string Especifica a modalidade de envio
     * Presença: Opcional. Tipo: Alfanumérico. Formato: Referência do tipo de frete. Ex: SEDEX, SEDEX10, PAC, TRANSPORTADORA.
     */
    public $tipo_frete;

    /**
     * @var float Valor total em Reais (R$) de desconto da compra
     * Presença: Opcional. Tipo: Decimal. Formato: Decimal, com duas casas decimais separadas por ponto. Ex: 15.99
     */
    public $descontoBoleto;

    /**
     * @var string Especifica o e-mail do comprador
     * Presença: Obrigatório. Tipo: Texto. Formato: Um e-mail válido, com limite de 200 caracteres.
     */
    public $email;

    /**
     * @var string Especifica o nome do comprador
     * Presença: Obrigatório. Tipo: Texto. Formato: Nome completo ou abreviado, com limite de 200 caracteres.
     */
    public $nome;

    /**
     * @var string Especifica o CPF do comprador
     * Presença: Obrigatório, para cliente pessoa fisica. Tipo: Numérico. Formato: Somente números, com no máximo 15 caracteres.
     */
    public $cpf;

    /**
     * @var string Especifica o RG do comprador
     * Presença: Opcional. Tipo: Numérico. Formato: Somente números, com no máximo 11 caracteres.
     */
    public $rg;

    /**
     * @var date Especifica a Data de nascimento do comprador
     * Presença: Opcional. Tipo: Data. Formato: Formato brasileiro, com no máximo 10 caracteres. Ex: 10/10/1980
     */
    public $data_nascimento;

    /**
     * @var string Especifica a Razão social do comprador
     * Presença: Opcional. Tipo: Texto. Formato: Razão social completa ou abreviado, com limite de 200 caracteres.
     */
    public $razao_social;

    /**
     * @var string Especifica o CNPJ do comprador
     * Presença: Obrigatório, para cliente pessoa jurídica, campo CPF se torna opcional. Tipo: Numérico. Formato: Somente números, com no máximo 14 caracteres.
     */
    public $cnpj;

    /**
     * @var string Especifica a Nota Fiscal do comprador
     * Presença: Opcional. Tipo: Numérico. Formato: Somente números, com no máximo 11 caracteres.
     */
    public $nota_fiscal;

    /**
     * @var string Exibe ou não a frase do boleto
     * Frase pré-configurada no painel do PagHiper, esta frase passa por uma pré-aprovação antes de ser exibida no boleto.
     * Presença: Opcional. Tipo: Booleano. Formato: Valor booleano (true ou false)
     */
    public $frase_fixa_boleto;

    /**
     * @var string Especifica Telefone do comprador
     * Presença: Opcional. Tipo: Numérico. Formato: Somente números, com o DDD no início. Ex: 1132320909
     */
    public $telefone;

    /**
     * @var string Especifica Celular do comprador
     * Presença: Opcional. Tipo: Numérico. Formato: Somente números com, o DDD no início. Ex: 11999661020
     */
    public $celular;

    /**
     * @var string Especifica o Logradouro do comprador para o envio
     * Presença: Opcional. Tipo: Texto. Formato: Livre, com até 200 caracteres.
     */
    public $endereco;

    /**
     * @var string Especifica o Bairro do comprador para o envio
     * Presença: Opcional. Tipo: Texto. Formato: Livre, com até 200 caracteres.
     */
    public $bairro;

    /**
     * @var string Especifica a Cidade do comprador para o envio
     * Presença: Opcional. Tipo: Texto. Formato: Livre, com até 100 caracteres.
     */
    public $cidade;

    /**
     * @var string 	Especifica o Estado do comprador para o envio
     * Presença: Opcional. Tipo: Char. Formato: Dois caracteres. Ex: SP
     */
    public $estado;

    /**
     * @var string Especifica o CEP do comprador para o envio
     * Presença: Opcional. Tipo: Numérico. Formato: Somente números, com no máximo 8 caracteres. Ex: 01311300
     */
    public $cep;

    /**
     * @var int Especifica o Número domiciliar do comprador para o envio
     * Presença: Opcional. Tipo: Numérico. Formato: Somente números, com no máximo 8 caracteres.
     */
    public $numero_casa;

    /**
     * @var string Especifica o Complemento domiciliar do comprador para o envio
     * Presença: Opcional. Tipo: Texto. Formato: Livre, com até 200 caracteres. Ex: Casa, Apartamento.
     */
    public $complemento;

    /**
     * @var string Tipo da requisição
     * Presença: Opcional. Tipo: Texto. Formato: Poderá deixar vazio* ou enviar: json e html
     * json: Os parâmetros do boleto serão apresentados em em formato json.(Exemplo)
     * html: O boleto será apresentado em formato padrao (html).
     * vazio será interpretado como html
     */
    public $api;

    /**
     * @var string Tipo da requisição
     * Presença: Obrigatória. Tipo: Texto. Formato: Padrão. Sempre deixar “pagamento”
     */
    public $pagamento;

    public function __construct() {

    }

    public function set($params)
    {
        if(is_object($params))
        {
            $params = (array)$params;
        }
        if(is_array($params))
        {
            //se tiver arr_items seta
            if(isset($params['itens']))
            {
                $this->set_itens($params);
            }
            //seta produtos se ja estiver no array no formato de envio para o paghiper [produto_codigo_1, produto_valor_1, produto_descricao_1...]
            $this->set_items_array($params);
            $this->email_loja = isset($params['email_loja'])? $params['email_loja'] : null;
            $this->id_plataforma = isset($params['id_plataforma'])? $params['id_plataforma'] : null;
            $this->urlRetorno = isset($params['urlRetorno'])? $params['urlRetorno'] : null;
            $this->tipoBoleto = isset($params['tipoBoleto'])? $params['tipoBoleto'] : null;
            $this->vencimentoBoleto = isset($params['vencimentoBoleto'])? $params['vencimentoBoleto'] : null;
            $this->frete = null;//isset($params['frete'])? $params['frete'] : null;
            $this->tipo_frete = null;//isset($params['tipo_frete'])? $params['tipo_frete'] : null;
            $this->descontoBoleto = null;//isset($params['descontoBoleto'])? $params['descontoBoleto'] : null;
            $this->email = isset($params['email'])? $params['email'] : null;
            $this->nome = isset($params['nome'])? $params['nome'] : null;
            $arr_sinal = ['.','-'];
            $arr_sub = ['',''];
            $this->flg_tipo_pessoa = $params['flg_tipo_pessoa'];
            $this->cpf = isset($params['cpf'])? str_replace($arr_sinal, $arr_sub, $params['cpf']) : null;
            $this->cnpj = isset($params['cnpj'])? $params['cnpj'] : null;
            $this->rg = isset($params['rg'])? $params['rg'] : null;
            $this->data_nascimento = isset($params['data_nascimento'])? $params['data_nascimento'] : null;
            $this->razao_social = isset($params['razao_social'])? $params['razao_social'] : null;
            $this->flg_tipo_pessoa = $params['flg_tipo_pessoa'];
            $this->cpf = isset($params['cpf'])? str_replace($arr_sinal, $arr_sub, $params['cpf']) : null;
            $this->cnpj = isset($params['cnpj'])? $params['cnpj'] : null;
            $this->rg = isset($params['rg'])? $params['rg'] : null;
            $this->data_nascimento = isset($params['data_nascimento'])? $params['data_nascimento'] : null;
            $this->razao_social = isset($params['razao_social'])? $params['razao_social'] : null;
            $this->nota_fiscal = isset($params['nota_fiscal'])? $params['nota_fiscal'] : null;
            $this->frase_fixa_boleto = isset($params['frase_fixa_boleto'])? $params['frase_fixa_boleto'] : null;
            $this->telefone = isset($params['telefone'])? $params['telefone'] : null;
            $this->celular = isset($params['celular'])? $params['celular'] : null;
            $this->endereco = isset($params['endereco'])? $params['endereco'] : null;
            $this->bairro = isset($params['bairro'])? $params['bairro'] : null;
            $this->cidade = isset($params['cidade'])? $params['cidade'] : null;
            $this->estado = isset($params['estado'])? $params['estado'] : null;
            $this->cep = isset($params['cep'])? $params['cep'] : null;
            $this->numero_casa = isset($params['numero_casa'])? $params['numero_casa'] : null;
            $this->complemento = isset($params['complemento'])? $params['complemento'] : null;
            $this->api = isset($params['api'])? $params['api'] : null;
            $this->idPartners = "SHJ1RTNZ";
            $this->pagamento = isset($params['pagamento'])? $params['pagamento'] : "pagamento"; //sempre deixar pagamento
            $return_verifica_atributos = $this->verifica_atributos_obrigatorios();
            if(!$return_verifica_atributos['status'])
            {
                return $return_verifica_atributos;
            }
            return ['status'=>true,'object'=>$this];
        }
        else
        {
            return ['status'=>false, 'message'=>'Ocoreu uma falha no sistema. Não foi possivel gerar boleto.','object'=>$this];
        }
    }

    /**
     * Funcao que seta itens do pedido que já foram passado como parametro no formato requisitado pelo paghiper.
     * @param $params
     */
    public function set_items_array($params)
    {

        $array_key = array_keys($params);
        $p = 1;
        if(array_search("produto_codigo_{$p}", $array_key) !== false)
        {
            if($params["produto_codigo_{$p}"] == "1" && $params["produto_descricao_{$p}"] == "pedido")
            {
                if(isset($params['id_plataforma']))
                {
                    if(!empty($params['id_plataforma']))
                    {
                        $this->{"produto_codigo_".$p} = $params['id_plataforma'];
                        $this->{"produto_descricao_".$p} = "Pagamento do pedido nº {$params['id_plataforma']}";
                    }
                }
                $this->{"produto_valor_".$p} = $params["produto_valor_{$p}"];
                $this->{"produto_qtde_".$p} = $params["produto_qtde_{$p}"];
            }
        }
    }

    /**
     * Funçao que seta os items do pedido.
     * @param $arr_item array Recebe um array com [codigo, valor, descricao, qtde]
     * @return array
     */
    public function set_itens($params)
    {
        $arr_itens = $params['itens'];
        if(is_array($arr_itens))
        {
            $seq = 1;

            if(count($arr_itens) == 1)
            {
                $item = $arr_itens[0];

                if(isset($item['codigo']) && isset($item['valor']) && isset($item['descricao']) && isset($item['qtde']))
                {
                    $this->{"produto_codigo_".$seq} = $item['codigo'];
                    $this->{"produto_descricao_".$seq} = $item['descricao'];

                    if(!empty($item['codigo']) && !empty($item['valor']) && !empty($item['descricao']) && !empty($item['qtde']))
                    {
                        if(($item['codigo'] == "1" && $item['descricao'] == "pedido" && $item['qtde'] == "1") && isset($params['id_plataforma']))
                        {
                            if(!empty($params['id_plataforma']))
                            {
                                $this->{"produto_codigo_".$seq} = $params['id_plataforma'];
                                $this->{"produto_descricao_".$seq} = "Pagamento do pedido nº {$params['id_plataforma']}";
                            }
                        }
                        $this->{"produto_valor_".$seq} = $item['valor'];
                        $this->{"produto_qtde_".$seq} = $item['qtde'];
                    }
                }
            }
            if(count($arr_itens) == 1)
            {
                return ['status'=>true];
            }
            return ['status'=>false, 'message'=>'Falha do sistema!'];
        }

        return ['status'=>false,'message'=>"Os itens do pedido devem ser informados para gerar o pagamentos"];

    }

    private function verifica_atributos_obrigatorios()
    {
        $arr_atributos_ausente = [];
        if(empty($this->email_loja))
        {
            $arr_atributos_ausente['email_loja'] = "email do vendedor cadastro no paghiper";
        }
        if(empty($this->email))
        {
            $arr_atributos_ausente['email'] = "email do comprador";
        }
        if(empty($this->nome))
        {
            $arr_atributos_ausente['nome'] = "nome do comprador";
        }
        if(empty($this->cpf) && empty($this->cnpj))
        {
            $arr_atributos_ausente['cpf'] = "cpf ou cnpj do comprador";
            $arr_atributos_ausente['cnpj'] = "";
        }
        if(empty($this->pagamento))
        {
            $arr_atributos_ausente['pagamento'] = "pagamento";
        }
        if(empty($arr_atributos_ausente))
        {
            return ['status'=>true];
        }
        else
        {
            $att_msg = "";
            foreach($arr_atributos_ausente as $key => $name)
            {
                if(empty($att_msg))
                {
                    $att_msg .= "{$name}";
                }
                else
                {
                    $att_msg .= ", {$name}";
                }
            }
            $msg = "Os atributos {$att_msg}, são obrigatórios e não estão preenchidos.";
            //var_dump($msg);
            return ['status'=>false, 'message'=>$msg, 'object'=>$this];
        }
    }
}

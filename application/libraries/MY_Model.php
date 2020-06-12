<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * MY_model
 *
/**
 * MY_Model Class
 * Extensão da classe Model
 *
 */
class MY_Model {

	protected $id = '';
	protected $name = '';
	protected $validators = array();
	protected $insert_buffer = array();
	/**
	 * Filtros que podem ser utilizados no where
	 *
	 * @var array
	 */
	protected $filtros = array();
    protected $CI;
	/**
	 * Constructor
	 *
	 * @access public
	 * @return void
	 */
	function __construct($array)
	{
	    $this->name = $array[0];
	    $this->CI = &get_instance();
        if (empty($this->name))
		{
			throw new Exception('Nome da tabela não definido para o atributo "name".');
		}
	}

	/**
	 * Seta os filtros que serão adicionados a query. Utilizado principalmente para pesquisas
	 *
	 * @param array $filtros O array deve ser composto de arrays com os campos na chave, concatenados ao tipo de operação (like, >, <, etc., = não é necessário) e os seus respectivos valores
	 * Exemplo: array(
	 *                  array('nome_produto like'=>'guitarra'),
	 *                  array('palavra_chave like'=>'guitarra')
	 *                  )
	 */
	function set_filtros($filtros)
	{
		$this->filtros = $filtros;
	}

    /**
     * @param $filtros
     * @return array
     */
    function get_filtros()
    {
        return $this->filtros;
    }

	/**
	 * Retorna o array de validators , se for passado os campos ele retorna somente os validators com estes campos
	 *
	 * @access public
	 * @param array $fields
	 * @return array
	 */
	function get_validators($fields = NULL)
	{
		if(is_null($fields))
		{
			return $this->validators;
		}
		else
		{
			$all_validators = $this->validators;
			$validators = NULL;
			foreach($all_validators as $k => $v)
			{
				if(in_array($v['field'],$fields))
				{
					$validators[] = $v;
				}
			}
			return $validators;
		}
	}

    public function get_table_id()
    {
        return empty($this->id) ? 'id_' . $this->name : $this->id;
    }

    public function select_id($table_alias = '')
    {
        $this->CI->db->select($this->get_table_id())
                ->from("{$this->name} {$table_alias}");

        return $this;
    }

    /**
     * Filtra os campos do array passado de acordo com o array de validators do modelo
     *
     * @access public
     * @param array $data
     * @param boolean $secure
     * @param array $array_campos_secure
     * @return array
     */
    function filtra_campos($data, $secure = FALSE, $array_campos_secure = NULL)
    {
        // cria array de campos da tabela através dos validators
        if (!empty($this->validators))
        {
			$array_no_strip_tags = array();
            foreach ($this->validators as $k => $v)
            {
				// Coloca num array todos os campos que nao usarao strip_tags
                if(strpos($v['rules'],'no_strip_tags') !== FALSE)
                {
                     $array_no_strip_tags[] = $v['field'];
                }

                if(!$secure || (!strpos($v['rules'],'secure') || (in_array($v['field'],(array)$array_campos_secure))))
                {
                     $array_campos_tabela[] = $v['field'];
                }
            }

            foreach ($data as $k => $v)
            {
                //seta campos como NULL que estiverem em branco
                if($data[$k] === '')
                {
                    $data[$k] = NULL;
                }

                if (array_search($k, $array_campos_tabela) === FALSE)
                {
                    unset($data[$k]);
                }

				// Procura o campo atual no array de campos que permite html. Se o campo não permite, usa strip_tags.
                if (isset($data[$k]) && array_search($k, $array_no_strip_tags) === FALSE)
                {
                    $data[$k] = strip_tags($data[$k]);
                }
            }
        }
        return $data;
    }

	/**
	 * Método padrão para inserção
	 *
	 * @param array $data
	 * @param boolean $filtra_campos
	 * @param boolean $buffer transforma o insert em buffer, para ser acionado pelo insert_buffer_commit()
	 * @return object
	 */
	//alias
	function insert($data, $filtra_campos = TRUE, $buffer = FALSE)
	{
		return $this->inserir($data, $filtra_campos, $buffer);
	}
	function inserir($data, $filtra_campos = TRUE, $buffer = FALSE)
	{
		if ($filtra_campos == TRUE)
		{
			$data = $this->filtra_campos($data);
		}
		if (!empty($buffer))
		{
			$this->insert_buffer[] = $data;
		}
		else
		{
			if($this->CI->db->insert($this->name, $data))
			{
				return $this->CI->db->insert_id();
			}
		}
		return false;
	}
	/*
	   * insere os inserts que estao no $this->insert_buffer de uma vez só
	*/
	function insert_buffer_commit()
	{
		if(!empty($this->insert_buffer))
		{
			//pega a primeira linha, as colunas dela
			$colunas = array_keys(current($this->insert_buffer));
			if(!empty($colunas))
			{
				//monta o insert
				$full_insert = '';
				foreach($this->insert_buffer as $linha)
				{
					//pega os campos do INSERT, na ordem das colunas
					$insert = '';
					foreach($colunas as $coluna)
					{
						if(!empty($insert))
							$insert .= ',';
						$valor_campo = (!empty($linha[$coluna])?mysql_real_escape_string($linha[$coluna]):NULL);
						$insert .= is_null($valor_campo) ? 'NULL' : "'{$valor_campo}'";
					}
					if(!empty($full_insert))
						$full_insert .=',';
					$full_insert .= '('. $insert .')';
				}
				$query = 'INSERT INTO ' . $this->name . '(' . implode(',',$colunas) . ') VALUES ' . $full_insert;
				//limpa o buffer do insert
				$this->insert_buffer = array();
				return $this->CI->db->query($query);
			}

		}
		return NULL;
	}
	/**
	 * Método padrão para inserção com securanca, que ignora os campos que tem a regra como 'secure' a nao ser que os mesmos sejam especificados
	 *
	 * @param array $data
	 * @param array $array_campos_secure
	 * @param boolean $buffer
	 * @return object
	 */
	//alias
	function insert_secure($data, $filtra_campos = TRUE, $buffer = FALSE)
	{
		return $this->inserir_secure($data, $filtra_campos, $buffer);
	}
	function inserir_secure($data, $array_campos_secure = NULL, $buffer = FALSE)
	{
		$data = $this->filtra_campos($data, true, $array_campos_secure);
		if (!empty($buffer))
		{
			$this->insert_buffer[] = $data;
		}
		else
		{
			if($this->db->insert($this->name, $data))
			{
				return $this->db->insert_id();
			}
		}
		return false;
	}

	/**
	 *
	 * Método para inserir multiplas tuplas
	 *
	 * O array data deve estar neste formato :
	 *  $data = array(array('nome_coluna' => $valor1,'nome_coluna2' => $valor2, 'nome_coluna3' => $valor3));
	 *
	 * @param array $data
	 * @return boolean
	 */
	function inserir_multiple($data,$filtra_campos = TRUE)
	{
		if (empty($data))
		{
			return FALSE;
		}

		// filtra campos
		if($filtra_campos == TRUE)
		{
			foreach($data as $k => $v)
			{
				$aux = $this->filtra_campos($v);
				if(!empty($aux))
					$data2[$k] = $aux;
			}
		}
		if(isset($data2))
		{
			// Pega a primeira posicao do array $data
			$colunas = array_keys(($data2[0]));

			// Separa as colunas na string
			$colunas_string = implode(',',$colunas);

			foreach($data2 as $k => $v)
			{
				// verifica se as chaves são iguais
				if((count(array_diff_key($v,$data2[0]))) == 0)
					$valores[] = '(' . implode(',',$this->db->escape($v)) . ')';
				else
					throw new Exception('As chaves dos nomes dos campos precisam ser as mesmas para todas as inserções');
			}

			// Separa os valores na string
			$valores_string = implode(',',$valores);

			if(!empty($colunas))
			{
				$query = 'INSERT INTO ' . $this->name . '(' . $colunas_string . ') VALUES ' . $valores_string;
				return $this->db->query($query);
			}
		}
		return FALSE;
	}

	/**
	 * Método padrão para atualização
	 *
	 * @param array $data
	 * @param string|array $where
	 * @param boolean $filtra_campos
	 * @return object
	 */
	//alias
	function update($data, $where = NULL, $filtra_campos = TRUE)
	{
		return $this->alterar($data, $where, $filtra_campos);
	}

	function alterar($data, $where = NULL, $filtra_campos = TRUE)
	{
		if ($filtra_campos == TRUE)
		{
			$data = $this->filtra_campos($data);
		}

		$var = $this->CI->db->update($this->name, $data, $where);

		return $var;
	}

	/**
	 * Método padrão para atualização com securanca, que ignora os campos que tem a regra como 'secure' a nao ser que os mesmos sejam especificados
	 *
	 * @param array $data
	 * @param string|array $where
	 * @param array $array_campos_secure
	 * @return object
	 */
	function update_secure($data, $where = NULL, $filtra_campos = TRUE)
	{
		return $this->alterar_secure($data, $where, $filtra_campos);
	}
	function alterar_secure($data, $where = NULL , $array_campos_secure = NULL)
	{
		$data = $this->filtra_campos($data, true, $array_campos_secure);
		$var = $this->db->update($this->name, $data, $where);
		//echo $this->db->last_query();
		return $var;
	}

	/**
	 * Método padrão para exclusão
	 *
	 * @access public
	 * @param mixed $where
	 * @return
	 */
	//alias
	function delete($where)
	{
		return $this->excluir($where);
	}
	function excluir($where)
	{
		return $this->CI->db->delete($this->name, $where);
	}

	/**
	 * Lista dados da tabela
	 *
	 * @access public
	 * @return object
	 */
	function buscar($where = NULL, $linha_inicio = NULL, $quantidade_registros = NULL)
	{
		if (empty($where)) {
			$query = $this->CI->db->get($this->name, $linha_inicio, $quantidade_registros);
		} else {
			$query = $this->CI->db->get_where($this->name, $where, $linha_inicio, $quantidade_registros);
		}
		return $query->result();
	}

    /**
     * Lista dados da tabela
     *
     * @access public
     * @return object
     */
    function find_one($where = NULL, $campos = '*')
    {
        $this->db->select($campos);

        if (empty($where)) {
            $query = $this->db->get($this->name);
        }
        else {
            $query = $this->db->get_where($this->name, $where);
        }

        return $query->row();
    }

	/**
	 * Retorna o nome da tabela.
	 *
	 * @access get_name
	 * @return string
	 */
	public function get_name()
	{
		return $this->name;
	}

	/**
	 * Método mágico, retorna o nome da tabela
	 * @return string
	 */
	public function __toString()
	{
		return $this->get_name();
	}

	/**
	 * Método que retorna o maior valor do campo passado
	 * @access public
	 * @param string
	 * @return string|int
	 */
	public function get_max($campo)

	{
		$this->db->select_max($campo, 'maximo');
		$query = $this->db->get("{$this}");
		return $query->row()->maximo;
	}


	/**
	 * Método que retorna os campos dos validators para queries sql
	 *
	 * @param string $apelido
	 * @param boolean $filtra_blob
	 * @access public
	 * @return string
	 */
	public function retorna_campos_apelido($apelido, $filtra_blob = FALSE, $flg_array = FALSE)
	{
		$resp="";
		$resp_array = array();
		$validators = $this->get_validators();
		foreach($validators as $array_field)
		{
			if(strpos($array_field['field'], 'img_')===false && strpos($array_field['field'], 'arq_')===false)
			{
				$campo = $array_field["field"];
				if($resp != "")
					$resp .= ",";
				$resp .= " {$apelido}.{$campo} as {$apelido}_{$campo} ";
				$resp_array[$campo] = "{$apelido}_{$campo}";
			}
		}
		if(empty($flg_array))
		{
			return $resp;
		}
		else
		{
			return $resp_array;
		}
	}

	/**
	 * Método que retorna os campos dos validators que NAO estao marcados como secure
	 *
	 * @param string $apelido
	 * @access public
	 * @return string
	 */
	public function retorna_campos_seguros($apelido)
	{
		$resp="";
		$validators = $this->get_validators();
		$campos = array();
		foreach($validators as $array_field)
		{
			if(strpos($array_field['rules'], 'secure')===false)
			{

				$campo = $array_field["field"];
				$campos[] =" {$apelido}.{$campo} ";
			}
		}
		return implode(',',$campos);
	}

	/**
	 * Cria where para ser utilizado nas queries. Útil principalmente nas pesquisas, uma vez que trata as aspas
	 *
	 * @access public
	 * @return object Objeto db
	 */
	public function cria_where ()
	{
		if (!empty($this->filtros))
		{
			// Trata array de pesquisa
			$ultimo_campo = '';
			$where = '';
			foreach ($this->filtros as $campo => $termo)
			{
				// Verifica última palavra da string. Se usar like tem tratamento especial
				if (end(explode(' ', $campo)) == 'like')
				{
					// Separa por espaço primeiro para depois fazer a verificação de aspas
					$separado_por_espaco = array_filter(explode(' ',$termo), 'array_filter_verifica_nulo_vazio');
					if (empty($separado_por_espaco))
					{
						continue;
					}
					$array_pesquisa = $this->trata_aspas($separado_por_espaco);
					if (empty($array_pesquisa))
					{
						continue;
					}
					$count = 0;
					foreach ($array_pesquisa as $termo)
					{
						// Define se expressão possuirá parenteses
						$parenteses_inicio = $count==0 && $ultimo_campo != $campo?'(':null;
						$parenteses_fim = $count==max(array_flip($array_pesquisa))?')':null;
						// Se é o primeiro campo ou o mesmo campo, adiciona where
						if (empty($ultimo_campo) || $ultimo_campo == $campo)
						{
							$ultimo_campo = $campo;
							$where .= " AND {$parenteses_inicio}{$campo} '%{$termo}%'{$parenteses_fim}";
						}
						else
						{
							$ultimo_campo = $campo;
							$where .= " OR {$parenteses_inicio}{$campo} '%{$termo}%'{$parenteses_fim}";
						}
						$count++;
					}
				}
				else
				{
					if ($termo != '')
					{
						///tira o ESCAPE quando usa where in
						if(end(explode(' ', trim($campo))) == 'IN')
						{
							// Where comum (sem like)
							$termo = trim($termo,'(,)');
							$array_termo = explode(',', trim($termo));

							foreach($array_termo as $k => $v)
							{
								$array_termo[$k] = $this->db->escape(trim($v));
							}

							$termo = implode(",",$array_termo);

							$this->db->where(array($campo => "(".$termo.")"),'', FALSE);
						}
						else
						{
							// Where comum (sem like)
							$this->db->where(array($campo => $termo),'', TRUE);
						}
					}
					/*
					if ($termo != '')
					{
						// Where comum (sem like)
						//$this->db->where(array($campo => $termo),'', FALSE);
						$this->db->where(array($campo => $termo),'', TRUE);
					}
					*/
				}
			}

			// Se tiver criado where para filtros de like, adiciona à query aqui
			if (!empty($where))
			{
				$where = ltrim($where,  ' AND )');
				$this->db->where("({$where})");
			}

			return $this->db;
		}

	}

	/**
	 * Trata as aspas utilizadas na pesquisa
	 *
	 * @access protected
	 * @param array $separado_por_espaco
	 * @return array
	 */
	protected function trata_aspas($separado_por_espaco)
	{
		$count = 0;
		// verificação de aspas
		foreach ($separado_por_espaco as $chave_termo => $termo)
		{
			// Se possui aspas como primeira letra
			if (isset($termo[0]) && $termo[0] == '"')
			{
				$array_pesquisa[$count] = str_replace('"', '', $termo);
				$ultima_chave = $chave_termo;
				// Se a palavra foi aberta e fechada
				$aspas_abertas = (substr($termo, -1) == '"')?false:true;
			} else {
				// Se aspas for ultima letra e se for outra palavra da expressao (se nao a palavra é repetida caso tenha palavra em uma aspas)
				$aspas_fechadas = (substr($termo, -1) == '"');
				if (isset($array_pesquisa[$count]) && ($aspas_abertas == true || ($chave_termo != $ultima_chave && $aspas_fechadas)))
				{
					$array_pesquisa[$count] .= ' '.str_replace('"', '', $termo);

					$aspas_abertas = !$aspas_fechadas;
					if ($aspas_abertas != true)
					{
						$count++;
					}
					$aspas = true;
				}
				else
				{
					$array_pesquisa[] = $termo;
					$count++;
				}
			}

		}
		return $array_pesquisa;
	}

	/**
	 * Limpa os filtros utilizados nas queries. Sempre importante utilizar após a query ser chamada
	 *
	 * @access public
	 */
	function limpa_filtros()
	{
		$this->filtros = array();
	}

	/**
	 * Verifica se há dados no filtro e gera warning.
	 *
	 * @access public
	 */
	function __destruct ()
	{
		if (!empty($this->filtros))
		{
			trigger_error ('Você precisa limpar os filtros da query utilizando o método limpa_filtros() do modelo.', E_USER_WARNING);
		}
	}

	/*
	 * Retorna as colunas de uma tabela, utilizando os validators do modelo
	*/
	function retorna_colunas()
	{
		// $columns = $this->db->query('show columns from '.$this);

		foreach($this->validators as $k => $v)
		{
			$colunas[] = $v['field'];
			if (!empty($this->id))
			{
				array_unshift($colunas, $this->id);
			}
			$colunas = array_unique($colunas);
		}
		return $colunas;
	}

	/*
	 * Retorna as colunas de uma tabela, utilizando o show columns do banco de dados
	*/
	function retorna_colunas_banco()
	{
		$columns = $this->db->query('show columns from '.$this);
		return $columns->result();
	}

	/**
	 * Retorna as colunas da tabela para serem colocadas numa query, adicionando apelido e campos de excessão que não devem ser retornados
	 *
	 * @access public
	 * @param string $apelido_tabela
	 * @param array $excessao
	 * @return string
	 */
	function retorna_colunas_query($apelido_tabela = NULL, $excessao = array())
	{
		$colunas = $this->retorna_colunas();

		// Filtra campos de excessão
		$res = array_diff($colunas, $excessao);

		$retorno = '';
		foreach($res as $v)
		{
			$retorno .= "{$apelido_tabela}.{$v}, ";
		}

		$retorno = rtrim($retorno, ', ');

		return $retorno;
	}

	/**
	 * Adiciona regras a aos campos especificados
	 *
	 * @access public
	 * @param array $campos
	 * @return void
	 */
	function adiciona_regras($campos)
	{
		$count = 0;
		$total_campos = count($campos);

		foreach($this->validators as $k => $v)
		{
			foreach($campos as $campo => $regra)
			{
				if ($v['field'] == $campo)
				{
					$count++;
					$this->validators[$k]['rules'] .= '|'.$regra;
				}
				if ($count == $total_campos)
				{
					break(2);
				}
			}
		}
	}

	/**
	 * Remove regras dos campos especificados
	 *
	 * @access public
	 * @param array $campos
	 * @return void
	 */
	function remove_regras($campos)
	{
		$count = 0;
		$total_campos = count($campos);

		foreach($this->validators as $k => $v)
		{
			foreach($campos as $campo => $regra)
			{
				if ($v['field'] == $campo)
				{
					$count++;
					// Remove a regra especificada
					$this->validators[$k]['rules'] = str_replace($regra, '', $this->validators[$k]['rules']);
					// Retira pipes duplicados das regras
					$this->validators[$k]['rules'] = str_replace('||', '', $this->validators[$k]['rules']);
					// Retira pipes do inicio e do fim da string de regras
					$this->validators[$k]['rules'] = trim($this->validators[$k]['rules'], '|');
				}
				if ($count == $total_campos)
				{
					break(2);
				}
			}
		}
	}

	/**
	 * Adiciona regras a todos os campos do validators
	 *
	 * @access public
	 * @param string $regras
	 * @param array $excessoes Esses campos nao receberao as regras
	 * @return void
	 */
	function adiciona_regras_geral($regras, $excessoes = array())
	{
		foreach($this->validators as $k => $v)
		{
			// Verifica se campo nao esta nas excessoes
			if (!in_array($v['field'], $excessoes))
			{
				$this->validators[$k]['rules'] .= '|'.$regras;
			}

		}
	}


	/*
	   Retorna o array colocando NULL aonde for STRIGN e 0 aonde for int caso o valor do campo seja NULL, 0 ou ''
	*/
	function trata_array_campos_vazios($arr)
	{
		$new_array = array();
		foreach($arr as $k => $value)
		{
			$validators = $this->get_validators(array($k));
			if(!empty($validators))
			{
				$validator = current($validators);
				$regras = $validator['rules'];

				if(strpos($regras,'integer') !== false ||strpos($regras,'numeric')  !== false )
				{
					$new_value = empty($value)?'0':$value;
				}
				else
				{
					$new_value = empty($value)?NULL:$value;
				}
				$new_array[$k] = $new_value;
			}
			else
			{
				$new_array[$k] = $value;
			}
		}
		return $new_array;
	}

    /**
     * Retorna o valor do campo de determinado registro da tabela
     *
     * @access public
     * @param $nome_campo
     * @param $nome_chave
     * @param $valor_chave
     * @return string
     */
    function retorna_valor_campo($nome_campo, $where = null)
    {
        $this->db->select($nome_campo)
                 ->from($this->name)
                 ->where($where);

        $query = $this->db->get();
        if ($query->num_rows() > 0)
        {
            return $query->row()->{$nome_campo};
        }
        else
        {
            return FALSE;
        }
    }

}
// END MY_Model Class

/* End of file MY_Model.php */
/* Location: ./system/application/libraries/MY_Model.php */

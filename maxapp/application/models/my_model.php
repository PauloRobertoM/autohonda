<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Class created for skin cupcake
**/

class MY_Model extends CI_Model
{
	protected $_primary_key	=	'id';
	protected $_order_by	=	'DESC';
	public $query			=	NULL;

	public function __construct()
	{
		parent::__construct();
	}


	public function get($data = NULL, $tabela = NULL)
	{
		$this->clear();
		$tablename	=	(!is_null($tabela)) ? $tabela : $this->_tablename ;


		/**
		 * @name SELECT
		 * @example data['select'] = 'id, titulo';
		 * @tutorial If the select parameter is not set, the default id ALL ('*') by CI
		 */
		if(!is_null($data) && array_key_exists("distinct", $data))
		{
			$this->db->distinct($data['distinct']);

			unset($data['distinct']);
		}


		/**
		 * @name SELECT
		 * @example data['select'] = 'id, titulo';
		 * @tutorial If the select parameter is not set, the default id ALL ('*') by CI
		 */
		if(!is_null($data) && array_key_exists("select", $data))
		{
			$this->db->select($data['select']);
		
			unset($data['select']);
		}


		/**
		 * @name JOIN
		 * @example ONE data['join'] =	array(
		 * 								array('join_table'=>'blogs', 'field_join_id'=>'search 1', 'field_id'=>'search 2', 'join_type'=>'left')
		 * 							);
		 * 
		 * @example MULTIPLE data['join'] =	array(
		 * 								array('join_table'=>'blogs', 'field_join_id'=>'search 1', 'field_id'=>'search 2', 'join_type'=>'left'),
		 * 								array('join_table'=>'noticias', 'field_join_id'=>'search 1', 'field_id'=>'search 2', 'join_type'=>'left'),
		 * 								array('join_table'=>'arquivos', 'field_join_id'=>'search 1', 'field_id'=>'search 2', 'join_type'=>'left')
		 * 							);
		 * @tutorial Options join_type are: left, right, outer, inner, left outer, and right outer.
		 */
		if(!is_null($data) && array_key_exists("join", $data))
		{
			foreach($data['join'] as $keys => $queries)
			{
				$this->db->join($queries['join_table'], $queries['field_join_id'] . ' = ' . $queries['field_id'], $queries['join_type']);
			}

			unset($data['join']);
		}


		/**
		 * @name WHERE
		 * @example data['where'] = array('field'=>'search 1', 'field'=>'search 2');
		 */
		if(!is_null($data) && array_key_exists("where", $data))
		{
			$this->db->where($data['where']);

			unset($data['where']);
		}


		if($this->db->field_exists('excluido', $tablename))
		{
			$this->db->where('excluido', 0);
		}


		/**
		 * @tutorial This is consult QUERY function
		 * @return object
		 */
		$query	=	$this->db->get($tablename, 1);


		/**
		 * @return array OR if < 0 RETURN total rows in table
		 */
		if($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else
		{
			return (int)$query->num_rows();
		}

		$query->free_result();
	}


	public function get_query($data = NULL, $pagina = NULL, $tabela = NULL, $site = FALSE)
	{
		$this->clear();
		$tablename	=	(!is_null($tabela)) ? $tabela : $this->_tablename ;
		$max		=	($site === FALSE) ? config('pagination_max_reg') : config('pagination_max_site') ;
		$page		=	(is_null($pagina) || $pagina == 0) ? 1 : $pagina ;
		$not_secure =	(!is_null($data) && array_key_exists("not_secure", $data)) ? $data['not_secure'] : TRUE ;


		/**
		* @name SELECT
		* @example data['select'] = 'id, titulo';
		* @tutorial If the select parameter is not set, the default id ALL ('*') by CI
		*/
		if(!is_null($data) && array_key_exists("select", $data))
		{
			$this->db->select($data['select'], $not_secure);

			unset($data['select']);
		}


		/**
		 * @name SELECT
		 * @example data['select'] = 'id, titulo';
		 * @tutorial If the select parameter is not set, the default id ALL ('*') by CI
		 */
		if(!is_null($data) && array_key_exists("distinct", $data))
		{
			$this->db->distinct($data['distinct']);

			unset($data['distinct']);
		}


		/**
		* @name WHERE NOT IN
		* @example data['select_max'] = array('field'=>'nome', 'value'=>'Frank'));
		*/
		if(!is_null($data) && array_key_exists("select_max", $data))
		{
			$this->db->select_max($data['select_max']['field'], $data['select_max']['value']);

			unset($data['select_max']);
		}


		/**
		* @name WHERE LIKE
		* @example data['like'] = array('field'=>'titulo', 'search'=>'Frank', 'match'=>'both|before|after');
		*/
		if(!is_null($data) && array_key_exists("like", $data))
		{
			if(count($data['like']) > 0)
			{
				foreach($data['like'] as $keys => $likies)
				{
					$match = (!isset($likies['match'])) ? 'both' :$likies['match'];
					$this->db->like($likies['field'], $likies['search'], $match);
				}
	
				unset($data['like']);
			}
		}
		
		//busca inscritos
		/*if(!is_null($data) && array_key_exists("like", $data))
		{
			//foreach($data['like'] as $item => $val)
			//{
				$match = (!isset($data['like']['match'])) ? 'both' :$data['like']['match'];
				$this->db->like($data['like']['field'], $data['like']['search'], $match);
			//}

			unset($data['like']);
		}*/


		/**
		* @name WHERE IN
		* @example data['in'] = array('field'=>'nome', 'search'=>array('Frank', 'Todd', 'James'));
		*/
		if(!is_null($data) && array_key_exists("in", $data))
		{
			$this->db->where_in($data['in']['field'], $data['in']['search']);

			unset($data['in']);
		}


		/**
		* @name WHERE NOT IN
		* @example data['not_in'] = array('field'=>'nome', 'search'=>array('Frank', 'Todd', 'James'));
		*/
		if(!is_null($data) && array_key_exists("not_in", $data))
		{
			$this->db->where_not_in($data['not_in']['field'], $data['not_in']['search']);

			unset($data['not_in']);
		}


		/**
		 * @name QUERY
		 * @example data['query'] = 'SELECT n1 . * FROM ci_blog n1.....';
		 */
		if(!is_null($data) && array_key_exists("query", $data))
		{
			$this->db->query($data['query']);

			unset($data['query']);
		}


		/**
		 * @name JOIN
		 * @example ONE data['join'] =	array(
		 * 								array('join_table'=>'blogs', 'field_join_id'=>'search 1', 'field_id'=>'search 2', 'join_type'=>'left')
		 * 							);
		 * 
		 * @example MULTIPLE data['join'] =	array(
		 * 								array('join_table'=>'blogs', 'field_join_id'=>'search 1', 'field_id'=>'search 2', 'join_type'=>'left'),
		 * 								array('join_table'=>'noticias', 'field_join_id'=>'search 1', 'field_id'=>'search 2', 'join_type'=>'left'),
		 * 								array('join_table'=>'arquivos', 'field_join_id'=>'search 1', 'field_id'=>'search 2', 'join_type'=>'left')
		 * 							);
		 * @tutorial Options join_type are: left, right, outer, inner, left outer, and right outer.
		 */
		if(!is_null($data) && array_key_exists("join", $data))
		{
			foreach($data['join'] as $keys => $queries)
			{
				$this->db->join($queries['join_table'], $queries['field_join_id'] . ' = ' . $queries['field_id'], $queries['join_type']);
			}

			unset($data['join']);
		}


		/**
		 * @name WHERE
		 * @example data['where'] = array('field'=>'search 1', 'field'=>'search 2');
		 */
		if(!is_null($data) && array_key_exists("where", $data))
		{
			$this->db->where($data['where'], NULL, $not_secure);

			unset($data['where']);
		}


		/**
		 * @name GROUP BY
		 * @example data['group'] = array('field 1', 'field 2', 'field 3');
		 */
		if(!is_null($data) && array_key_exists("group", $data))
		{
			$this->db->group_by($data['group']);

			unset($data['group']);
		}


		/**
		 * @name ORDER BY
		 * @example data['order'] = array('field'=>'id', 'hang'=>'DESC');
		 * @tutorial hang not required
		 */
		if(!is_null($data) && array_key_exists("order", $data))
		{
			$hang = (array_key_exists("hang", $data['order'])) ? $data['order']['hang'] : $this->_order_by;
			$this->db->order_by($data['order']['field'], $hang);

			unset($data['order']);
		}
		else
		{
			$this->db->order_by($this->_tablename . '.' . $this->_primary_key, $this->_order_by);
		}


		/**
		 * @name WHERE LIMIT
		 * @example data['limit'] = 10;
		 * @tutorial if the limit parameter is not set, the default setting in file  
		 * 				config/settings => pagination_max_reg or pagination_max_site enters into force
		 */
		if(!is_null($data) && array_key_exists("limit", $data))
		{
			$limit		=	(is_null($data['limit'])) ? $max : $data['limit'] ;
			$offset		=	(array_key_exists("offset", $data)) ? $data['offset'] : (($page - 1) * $limit) ;

			$this->db->limit($limit, $offset);

			unset($data['limit']);
			unset($data['offset']);
		}
		else
		{
			if(is_null(@$data['total']))
			{
				$offset		=	(@array_key_exists("offset", $data)) ? $data['offset'] : (($page - 1) * $max) ;
				$this->db->limit($max, $offset);
			}
		}


		/**
		 * @name WHERE EXCLUIDO = 0
		 */
		if($this->db->field_exists('excluido', $tablename))
		{
			$this->db->where($this->_tablename . ".excluido", 0);
		}


		/**
		 * @name GET OR FROM
		 * @example data['from'] = 'ci_blog';
		 */
		if(!is_null($data) && array_key_exists("from", $data))
		{
			$this->db->from($data['from']);
			$query = $this->db->get();
		} 
		else
		{
			$query = $this->db->get($tablename);
		}

		//pre($this->db->last_query());

		return $query;
	}


	public function insert_itens($data = NULL, $id = NULL, $field = NULL)
	{
		$datas = array_filter($data);

		if(!empty($datas))
		{
			if(!is_null($id))
			{
				/* Deletando todos os registro relacionado ao @$id */
				$this->db->delete($this->_tablename, array($field => $id));
			}

			$this->db->insert_batch($this->_tablename, $data);
			$return_id = $this->db->insert_id();

			$this->Model_logs->add((int)$return_id, $this->_tablename, 'ADD', $_SERVER['REQUEST_URI']);

			return $return_id;
		}
	}


	public function insert($data = NULL)
	{
		try {
			$this->db->insert($this->_tablename, $data);
			$return_id = $this->db->insert_id();

			$this->Model_logs->add((int)$return_id, $this->_tablename, 'INSERT', $_SERVER['REQUEST_URI']);

			return $return_id;
		}
		catch(Exception $e)
		{
			show_error($e);
			return FALSE;
		}
	}


	public function update($data = NULL, $id = NULL, $field = 'id')
	{
		if(!is_null($id))
		{
			try {
				$this->db->where($field, (int)$id);
				$this->db->update($this->_tablename, $data);
				$return_id = $id;

				$this->Model_logs->add((int)$id, $this->_tablename, 'UPDATE', $_SERVER['REQUEST_URI']);

				return $return_id;
			}
			catch(Exception $e)
			{
				show_error($e);
				return FALSE;
			}
		}
	}


	public function status($data = NULL, $id = NULL, $field = 'id')
	{
		if(!is_null($id))
		{
			try {
				$sql['where']	=	array("id" => $id);
				$query			=	$this->get($sql, NULL);

				if($query['status'] == 1) // Inativo
				{
					// Inativando
					$status_new		=	0;
					$status_img		=	"minus";
					$status_msg		=	"Ativar";
				}
				elseif($query['status'] == 0) // Ativo
				{
					// Ativando
					$status_new		=	1;
					$status_img		=	"tick";
					$status_msg		=	"Desativar";
				}

				$this->db->set("status", $status_new);
				$this->db->where($field, (int)$id);
				$this->db->update($this->_tablename, $data);

				$this->Model_logs->add((int)$id, $this->_tablename, 'UPD STATUS', $_SERVER['REQUEST_URI']);

				return json_encode(array("img"=>$status_img, "msg"=>$status_msg));
			}
			catch(Exception $e)
			{
				show_error($e);
				return FALSE;
			}
		}
	}


	public function destaque($data = NULL, $id = NULL, $field = 'id')
	{
		if(!is_null($id))
		{
			try {
				$sql['where']	=	array("id" => $id);
				$query			=	$this->get($sql, NULL);

				if($query['destaque'] == 1) // Inativo
				{
					// Inativando
					$status_new		=	0;
					$status_img		=	"minus";
					$status_msg		=	"Ativar";
				}
				elseif($query['destaque'] == 0) // Ativo
				{
					// Ativando
					$status_new		=	1;
					$status_img		=	"tick";
					$status_msg		=	"Desativar";
				}

				$this->db->set("destaque", $status_new);
				$this->db->where($field, (int)$id);
				$this->db->update($this->_tablename, $data);

				$this->Model_logs->add((int)$id, $this->_tablename, 'UPD DESTAQUE', $_SERVER['REQUEST_URI']);

				return json_encode(array("img"=>$status_img, "msg"=>$status_msg));
			}
			catch(Exception $e)
			{
				show_error($e);
				return FALSE;
			}
		}
	}


	public function del($data = NULL, $id = NULL, $field = 'id')
	{
		try {
			if($this->db->field_exists('excluido', $this->_tablename))
			{
				$this->db->set('excluido', 1); // 0=Ativo, 1=Inativo
				$this->db->where($field, (int)$id);
				$this->db->update($this->_tablename, $data);

				$this->Model_logs->add((int)$id, $this->_tablename, 'DEL', $_SERVER['REQUEST_URI']);
				
				return TRUE;
			}
		}
		catch(Exception $e)
		{
			show_error($e);
			return FALSE;
		}
	}


	public function delete($id = NULL, $field = 'id')
	{
		try {
			$this->db->where($field, (int)$id);
			$this->db->delete($this->_tablename);
			$return_id = $this->db->affected_rows();

			$this->Model_logs->add((int)$id, $this->_tablename, 'DELETE', $_SERVER['REQUEST_URI']);

			return TRUE;
		}
		catch(Exception $e)
		{
			show_error($e);
			return FALSE;
		}
	}


	public function render_pagination($modulo = NULL, $data = NULL, $tabela = NULL, $page_atual = NULL, $site = FALSE, $url = NULL)
	{
		$data['total']	=	TRUE;
		$query	=	$this->get_query($data, NULL, $tabela, $site);
		$total	=	$query->num_rows();
		$this->free_query($query);

		if($site === FALSE)
		{
			return paginacao_painel($total, config('pagination_max_reg'), $page_atual, $modulo, $url);
		}
		else
		{
			return paginacao_site($total, config('pagination_max_site'), $page_atual, $modulo, $url);
		}
	}


	public function render_pagination_site_ajax($modulo = NULL, $data = NULL, $tabela = NULL, $page_atual = NULL, $site = FALSE, $url = NULL)
	{
		return (int)paginacao_site_ajax($total, config('pagination_max_site'), $page_atual, $modulo, $url);
	}


	public function render_pagination_ajax($modulo = NULL, $data = NULL, $tabela = NULL, $page_atual = NULL, $limit = 5)
	{
		$query = $this->get_query($data, NULL, $tabela, FALSE);
		$total	=	$query->num_rows();
		$this->free_query($query);

		return paginacao_painel_ajax($total, $limit, $page_atual, $modulo);
	}


	public function num_total_reg($tabela = NULL)
	{
		$table = (is_null($tabela)) ? $this->_tablename : $tabela ;

		$this->db->select("id");

		if($this->db->field_exists('status', $table))
		{
			$this->db->where('status', 1);
		}

		if(session('tipo') == 3)
		{
			$this->db->where(array("usuario_id" => session('uid')));
		}

		if($this->db->field_exists('excluido', $table))
		{
			$this->db->where('excluido', 0);
		}

		$query	=	$this->db->get($table);
		$num	=	$query->num_rows();
		$query->free_result();

		return $num;
	}


	public function num_reg($sql = NULL, $tabela = NULL)
	{
		$table = (is_null($tabela)) ? $this->_tablename : $tabela ;

		$this->db->select("id");

		$this->db->where($sql);

		if($this->db->field_exists('status', $table))
		{
			$this->db->where('status', 1);
		}

		if($this->db->field_exists('excluido', $table))
		{
			$this->db->where('excluido', 0);
		}

		$query	=	$this->db->get($table);
		$num	=	$query->num_rows();
		$query->free_result();

		return $num;
	}


	public function free_query($query = NULL)
	{	
		if(!is_null($query))
		{
			$query->free_result();
		}
	}


	private function clear()
	{
		unset($data);
	}

}
/* End of file my_model.php */
/* Location: ./application/models/my_model.php */
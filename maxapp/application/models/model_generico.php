<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_generico extends MY_Model
{
	protected $_tablename	=	NULL;


	public function set_tablename($tablename = NULL)
	{
		if(!is_null($tablename))
		{
			$this->_tablename = $tablename;
		}
	}


	/**
	 * @name render_query
	 * @return array OR object
	 */
	public function render_query($data = NULL)
	{
		$array = array();

		if(!is_null($data) && !empty($data))
		{
			/**
			 * @name QUERY
		 	 * @example data['query'] = $this->db->get($_tablename);
			 */
			if(array_key_exists("query", $data))
			{
				$query = $data['query'];
			}


			/**
			 * @name TYPE
			 * @example data['type'] = 'array' OR 'object';
			 * @tutorial Default is object
			 */
			if(array_key_exists("type", $data))
			{
				if($data['type'] == 'array')
				{
					$result	=	$query->result_array();
				}
				elseif($data['type'] == 'object')
				{
					$result	=	$query->result();
				}
			}
			else
			{
				$result	=	$query->result();
			}


			/**
			 * @tutorial This is result QUERY with TYPE selected
			 * @return array OR object OR total rows in table
			 */
			if($data['query']->num_rows() > 0)
			{
				$rows = array();
				foreach($result as $row)
				{
					$rows	=	$row;

					if(isset($data['files']) && !is_null($data['files']) && !empty($data['files']))
					{
						$id_file				=	($data['type'] == 'array') ? @$row['id'] : @$row->id;
						$data_files['where']	=	array(
								singular($data['files'])."_id"	=>	$id_file
						);
						$data_files['model']	=	$data['files'];
						$files					=	$this->get_files($data_files);

						$rows['files']			=	$files;
					}

					$array[] = $rows;
				}
			}
			else
			{
				/**
				 * @return total rows in table
				 */
				//$array[] = array('num_rows' => $data['query']->num_rows());
			}
		}

		// application/models/model_generico.php
		$this->free_query($query);

		return $array;
	}


	/**
	 * @name get_files
	 * @return array OR object
	 */
	public function get_files($data = NULL)
	{
		if(!is_null($data) && !empty($data))
		{
			$array_files = array();

			// application/helpers/basics_helper.php
			$model_files		=	load_model('generico', $data['model'] . '_arquivos');

			$data['join']		=	array(
				array(
					'join_table'	=>	'arquivos',
					'field_join_id'	=>	'ci_arquivos.id',
					'field_id'		=>	'ci_'.$data['model'].'_arquivos.arquivo_id',
					'join_type'		=>	'left'
				)
			);
			$data['order']		=	array(
				'field'	=>	'ci_'.$data['model'].'_arquivos.destaque',
				'hang'	=>	'DESC'
			);
			$data['total']		=	TRUE;

			unset($data['model']);

			// application/models/my_model.php
			$query_files	=	$model_files->get_query($data, NULL, NULL, FALSE);

			if($query_files->num_rows() > 0)
			{
				return $query_files->result_array();
			}
		}

		// application/models/model_generico.php
		$this->free_query($query_files);
	}


	public function free_query($query = NULL)
	{	
		if(!is_null($query))
		{
			$query->free_result();
		}
	}

}

/* End of file model_generico.php */
/* Location: ./application/models/model_generico.php */
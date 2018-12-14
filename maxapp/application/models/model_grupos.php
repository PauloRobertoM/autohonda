<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_grupos extends MY_Model
{
	protected $_tablename 	=	'grupos'; 


	public function insert_grupos_modulos($data = NULL, $id_group = NULL)
	{
		$datas = array_filter($data);

		if(!empty($datas))
		{
			if(!is_null($id_group))
			{
				/* Deletando todos os registro relacionado ao @id_group */
				$this->db->delete('grupos_modulos', array('grupo_id' => $id_group));
			}

			$this->db->insert_batch('grupos_modulos', $data);
			$return_id = $this->db->insert_id();

			$this->Model_logs->add((int)$return_id, 'grupos_modulos', 'ADD', $_SERVER['REQUEST_URI']);

			return $return_id;
		}
	}


	public function get_categorias_grupos()
	{
		$grupos = array();
		$this->db->select('id, titulo');
		$this->db->where('status', 1);
		$this->db->where('excluido', 0);
		$this->db->order_by("titulo ASC");
		$query_grupos = $this->db->get('grupos');
		foreach($query_grupos->result() as $grupo)
		{
			$grupos_modulos = array();
			$this->db->select('*');
			$this->db->from('grupos_usuarios');
			$this->db->join('grupos_modulos', 'ci_grupos_modulos.grupo_id = ci_grupos_usuarios.grupo_id', 'left');
			$this->db->join('modulos', 'ci_modulos.id = ci_grupos_modulos.modulo_id', 'left');
			$this->db->where('grupos_usuarios.usuario_id', (int)session('uid'));
			$this->db->where('grupos_modulos.grupo_id', $grupo->id);
			$this->db->where('grupos_modulos.view', 1);
			$this->db->where('modulos.status', 1);
			$this->db->where('modulos.excluido', 0);
			$this->db->group_by("grupos_modulos.modulo_id");
			$this->db->order_by("modulos.titulo ASC");
			$query_modulos = $this->db->get();
			if($query_modulos->num_rows() <= 0) continue;
			foreach($query_modulos->result() as $grupos_modulo)
			{
				array_push($grupos_modulos,array(
					"id"		=>	$grupos_modulo->id,
					"titulo"	=>	$grupos_modulo->titulo,
					"url"		=>	url_title($grupos_modulo->url, '-', TRUE)
				));
			}

			array_push($grupos,array(
				"id"		=>	$grupo->id,
				"titulo"	=>	$grupo->titulo,
				"url"		=>	url_title($grupo->titulo, '-', TRUE),
				"modulos"	=>	$grupos_modulos
			));

			$query_modulos->free_result();
		}
		return $grupos;
		$query_grupos->free_result();
	}


}

/* End of file model_grupos.php */
/* Location: ./application/models/model_grupos.php */
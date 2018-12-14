<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_usuarios extends MY_Model
{
	protected $_tablename	=	'usuarios';


	public function grupo_user($id_group, $id_user, $keys)
	{
		if($keys == '1')
		{
			$this->db->select('usuario_id');
			$this->db->where('grupo_id',	(int)$id_group);
			$this->db->where('usuario_id',	(int)$id_user);
			if($this->db->get('grupos_usuarios')->num_rows() <= 0)
			{
				try {
					$this->db->set('usuario_id',	(int)$id_user);
					$this->db->set('grupo_id',		(int)$id_group);
					$this->db->insert('grupos_usuarios');
					$return_id = $this->db->insert_id();

					$this->Model_logs->add((int)$return_id, 'grupos_usuarios', 'ADD', $_SERVER['REQUEST_URI']);
				}
				catch(Exception $e)
				{
					show_error($e);
				}
				return $return_id;
			}
		}
	}


	public function get_grupos($id_user=NULL)
	{
		$listas = array();
		if(is_null($id_user))
		{
			$this->db->select('id, titulo');
			$this->db->where('status', 1);
			$this->db->where('excluido', 0);
			$this->db->order_by("titulo");
			$query = $this->db->get('grupos');
			foreach($query->result() as $lista)
			{
				array_push($listas,array(
					"id"		=>	$lista->id,
					"titulo"	=>	$lista->titulo,
					"checked"	=>	FALSE
				));
			}
		}
		else
		{
			$this->db->select('grupos.id, grupos.titulo, grupos_usuarios.usuario_id');
			$this->db->from('grupos');
			$this->db->join('grupos_usuarios', 'ci_grupos_usuarios.grupo_id=grupos.id AND ci_grupos_usuarios.usuario_id="'.(int)$id_user.'"', 'left');
			$this->db->where('ci_grupos.status', 1);
			$this->db->where('ci_grupos.excluido', 0);
			$query = $this->db->get();
			if($query->num_rows() > 0)
			{
				foreach($query->result() as $lista)
				{
					array_push($listas,array(
						"id"		=>	$lista->id,
						"titulo"	=>	$lista->titulo,
						"checked"	=>	($lista->usuario_id == $id_user) ? TRUE : FALSE
					));
				}
			}
			else
			{
				$query->free_result();

				$this->db->select('id, titulo');
				$this->db->where('status', 1);
				$this->db->where('excluido', 0);
				$this->db->order_by("titulo");
				$query = $this->db->get('grupos');
				foreach($query->result() as $lista)
				{
					array_push($listas,array(
						"id"		=>	$lista->id,
						"titulo"	=>	$lista->titulo,
						"checked"	=>	FALSE
					));
				}
			}
		}
		return $listas;
	}


	public function insert_grupos_usuarios($data = NULL, $id_usuario = NULL)
	{
		$datas = array_filter($data);

		if(!empty($datas))
		{
			if(!is_null($id_usuario))
			{
				$this->db->delete('grupos_usuarios', array('usuario_id' => $id_usuario));
			}

			$this->db->insert_batch('grupos_usuarios', $data);
			$return_id = $this->db->insert_id();

			$this->Model_logs->add((int)$return_id, 'grupos_usuarios', 'ADD', $_SERVER['REQUEST_URI']);

			return $return_id;
		}
	}

}

/* End of file model_usuarios.php */
/* Location: ./application/models/model_usuarios.php */
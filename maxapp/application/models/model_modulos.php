<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_modulos extends MY_Model
{
	protected $_tablename	=	'modulos'; 


	public function get_modulos()
	{
		$this->db->select('*');
		$this->db->from('grupos_usuarios');
		$this->db->join('grupos_modulos', 'ci_grupos_modulos.grupo_id = ci_grupos_usuarios.grupo_id', 'left');
		$this->db->join('modulos', 'ci_modulos.id = ci_grupos_modulos.modulo_id', 'left');
		$this->db->where('grupos_usuarios.usuario_id', (int)session('uid'));
		$this->db->where('grupos_modulos.view', 1);
		$this->db->where('modulos.status', 1);
		$this->db->where('modulos.excluido', 0);
		$this->db->group_by("grupos_modulos.modulo_id ASC");
		$this->db->order_by("modulos.titulo ASC");
		return $this->db->get()->result();
	}


	private function get_modulos_id($id = NULL, $limit = NULL)
	{
		$this->db->select('id, titulo, url, model, status');
		$this->db->where('modulos.status', 1);

		if(!is_null($id))
		{
			$this->db->where('modulos.id', $id);
		}

		if(!is_null($limit))
		{
			$this->db->limit($limit);
		}

		$this->db->order_by("modulos.id DESC");
		return $this->db->get($this->_tablename)->result();
	}


	public function get_list_modulos($id = NULL)
	{
		$listas = array();
		if(is_null($id))
		{
			$this->db->select('*');
			$this->db->where('status',	1);
			$this->db->where('excluido', 0);
			$this->db->order_by("titulo ASC");
			$query = $this->db->get($this->_tablename);
			foreach($query->result() as $lista)
			{
				array_push($listas,array(
					"id"		=>	$lista->id,
					"nome"		=>	$lista->titulo,
					"view"		=>	'',
					"add"		=>	'',
					"upd"		=>	'',
					"del"		=>	''
				));
			}
			$query->free_result();
		}
		else
		{
			$this->db->select('modulos.id, modulos.titulo, grupos_modulos.grupo_id, grupos_modulos.view, grupos_modulos.add, grupos_modulos.upd, grupos_modulos.del');
			$this->db->from($this->_tablename);
			$this->db->join('grupos_modulos', 'ci_grupos_modulos.modulo_id = ci_modulos.id AND ci_grupos_modulos.grupo_id="'.(int)$id.'" ', 'left');
			$this->db->where('modulos.status',	1);
			$this->db->where('modulos.excluido',0);
			$this->db->order_by("titulo ASC");
			$query = $this->db->get();
			if($query->num_rows() > 0)
			{
				foreach($query->result() as $lista)
				{
					array_push($listas,array(
						"id"		=>	$lista->id,
						"nome"		=>	$lista->titulo,
						"view"		=>	($lista->view == 1) ? 'checked' : '',
						"add"		=>	($lista->add == 1) ? 'checked' : '',
						"upd"		=>	($lista->upd == 1) ? 'checked' : '',
						"del"		=>	($lista->del == 1) ? 'checked' : ''
					));
				}
			}
			else
			{
				$query->free_result();

				$this->db->select('*');
				$this->db->where('status',	1);
				$this->db->where('excluido', 0);
				$this->db->order_by("titulo ASC");
				$query = $this->db->get($this->_tablename);
				foreach($query->result() as $lista)
				{
					array_push($listas,array(
						"id"		=>	$lista->id,
						"nome"		=>	$lista->titulo,
						"view"		=>	'',
						"add"		=>	'',
						"upd"		=>	'',
						"del"		=>	''
					));
				}
			}
		}
		return $listas;
	}


	public function check_model($method = 'view', $url = NULL, $redirect = FALSE)
	{
		if($this->router->class != 'app' && !is_null($method) && !is_null($url))
		{
			if(session('uid'))
			{
				$this->db->select('grupos_modulos.'.$method);
				$this->db->from('modulos');
				$this->db->join('grupos_modulos', 'ci_grupos_modulos.modulo_id = ci_modulos.id', 'left');
				$this->db->join('grupos_usuarios', 'ci_grupos_usuarios.grupo_id = ci_grupos_modulos.grupo_id', 'inner');
				$this->db->where('modulos.url', $url);
				$this->db->where('grupos_usuarios.usuario_id', (int)session('uid'));
				$this->db->where('modulos.status', 1);
				$this->db->where('modulos.excluido', 0);
				$this->db->order_by('grupos_modulos.view DESC');
				$query	=	$this->db->get()->row();
				$num	=	$query->$method;
				
				//echo $this->db->last_query();
	
				if($num <= 0)
				{
					if($redirect === FALSE)
					{
						redirect(site_url('painel/home'), 'refresh');
						exit;
					}
					else
					{
						exit();
						die();
					}
				}
			}
			else
			{
				redirect(base_url('painel/logout'), 'refresh');
				exit;
			}
		}
	}


	public function check_actions($method = 'add', $router = NULL)
	{
		if($this->router->class != 'app' && !is_null($router))
		{
			$this->db->select('grupos_modulos.view, grupos_modulos.add, grupos_modulos.upd, grupos_modulos.del');
			$this->db->from($this->_tablename);
			$this->db->join('grupos_modulos', 'ci_grupos_modulos.modulo_id = ci_modulos.id', 'left');
			$this->db->join('grupos_usuarios', 'ci_grupos_usuarios.grupo_id = ci_grupos_modulos.grupo_id', 'left');
			$this->db->where('modulos.url', $router);
			$this->db->where('grupos_usuarios.usuario_id', (int)session('uid'));
			$this->db->where('modulos.status', 1);
			$this->db->where('modulos.excluido', 0);
			$this->db->order_by('grupos_modulos.view DESC');
			$query	=	$this->db->get()->row()->$method;

			if($query == 1)
			{
				return TRUE;
			}
		}
		else
		{
			return FALSE;
		}
	}

}

/* End of file model_modulos.php */
/* Location: ./application/models/model_modulos.php */
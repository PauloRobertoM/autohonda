<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends MY_Controller
{
	protected $_namemodel	=	'usuarios';


	public function __construct()
	{
		parent::__construct();
		
		// application/core/my_controller.php
		$this->check_user();
		$this->Model_modulos->check_model('view', $this->uri->segment(2));
	}


	/*
	 * @tutorial Este metodo importa todas consultas do metodo da classe pai(index) em core/MY_Controller.php
	 */
	public function index($pagina = NULL)
	{
		parent::index($pagina);
		// Adicione aqui as condicoes especificas para este modulo

		// core/MY_Controller.php
		$this->adm_template_load('lays/layout', $this->_namemodel . '/list', $this->_data);
	}


	/*
	 * @tutorial Este metodo importa todas consultas do metodo da classe pai(add_upd) em core/MY_Controller.php
	 */
	public function add_upd($id = NULL, $pagina = NULL)
	{
		parent::add_upd($id, $pagina);
		$data =	$this->_data;

		// application/models/model_usuarios.php
		$model				=	load_model($this->_namemodel);
		$data['grupos']		=	$model->get_grupos($id);

		$this->set_data($data);

		// core/MY_Controller.php
		$this->adm_template_load('lays/layout', $this->_namemodel . '/form', $this->_data);
	}


	public function send($pagination = NULL)
	{
		$this->Model_modulos->check_model('upd', $this->uri->segment(2));

		if(!is_null($pagination) && post('pagination') == $pagination)
		{
			// application/helpers/basics_helper.php
			$model	=	load_model($this->_namemodel);

			if(post("id") != "")
			{
				$data = array(
					'nome'			=>	post("nome"),
					'email'			=>	post("email"),
					'username'		=>	post("username"),
					'password'		=>	do_hash(post("password"))
				);

				if(post("password") == "")
				{
					array_pop($data);
				}

				// application/models/my_model.php
				$user_id = $model->update($data, post("id"), 'id');
			}
			else
			{
				$data = array(
					'nome'			=>	post("nome"),
					'email'			=>	post("email"),
					'username'		=>	post("username"),
					'password'		=>	do_hash(post("password")),
					'created'		=>	date("Y-m-d H:i:s"),
					'hits'			=>	0,
					'setor_id'		=>	0,
					'gabinete_id'	=>	0,
					'tipo'			=>	1, // 0=admin; 1=usuario; 2=cliente
					'num_reg'		=>	0,
					'status'		=>	0,
					'excluido'		=>	0
				);

				// application/models/my_model.php
				$user_id = $model->insert($data);
			}

			$data_grupos = array();
			for($i=0 ; $i<count(post('grupo')) ; $i++)
			{
				array_push($data_grupos, array(
					"usuario_id"	=>	$user_id,
					"grupo_id"		=>	(int)$_POST['grupo'][$i]
				));
			}
			$model->insert_grupos_usuarios($data_grupos, $user_id);			

			// core/MY_Controller.php
			$this->adm_template_load('lays/layout', 'lays/form_info', array("message"=>"Atualizando...!"));

			redirect(site_url('painel/'.$this->_namemodel.'/'.$pagination), 'refresh');
		}
	}

}

/* End of file usuarios.php */
/* Location: ./application/controllers/painel/usuarios.php */
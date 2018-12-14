<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Class created for skin cupcake
**/

class Grupos extends MY_Controller
{
	protected $_namemodel	=	'grupos';


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
					'titulo'	=>	post("titulo"),
					'email'		=>	post("email")
				);

				// application/models/my_model.php
				$group_id = $model->update($data, post("id"), 'id');
			}
			else
			{
				$data = array(
					'titulo'	=>	post("titulo"),
					'email'		=>	post("email"),
					'status'	=>	0,
					'excluido'	=>	0
				);

				// application/models/my_model.php
				$group_id = $model->insert($data);
			}

			$data_db = array();
			foreach(post('modulo') as $modulo_id)
			{
				$datas = array_filter(post('modulo'));
				if(!empty($datas))
				{
					array_push($data_db, array(
						"grupo_id"		=>	$group_id,
						"modulo_id"		=>	$modulo_id,
						"view"			=>	(@$_POST["view"][$modulo_id]	==	NULL) ? 0 : 1,
						"add"			=>	(@$_POST["add"][$modulo_id]		==	NULL) ? 0 : 1,
						"upd"			=>	(@$_POST["upd"][$modulo_id]		==	NULL) ? 0 : 1,
						"del"			=>	(@$_POST["del"][$modulo_id]		==	NULL) ? 0 : 1
					));
				}
			}
			
			$model->insert_grupos_modulos($data_db, $group_id);

			// core/MY_Controller.php
			$this->adm_template_load('lays/layout', 'lays/form_info', array("message"=>"Atualizando...!"));

			redirect(site_url('painel/'.$this->_namemodel.'/'.$pagination), 'refresh');
			//exit();
		}
	}

}

/* End of file grupos.php */
/* Location: ./application/controllers/grupos.php */
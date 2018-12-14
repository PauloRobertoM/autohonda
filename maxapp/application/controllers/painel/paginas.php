<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Class created for skin cupcake
**/

class Paginas extends MY_Controller
{
	protected $_namemodel	=	'paginas';


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
			$model	=	load_model('generico', $this->_namemodel);

			if(post("id") != "")
			{
				$data = array(
					'data'			=>	format_data_db(post("data")),
					'titulo'		=>	post("titulo"),
					'slug'			=>	url_title(convert_accented_characters(post("titulo")), '-', TRUE),
					'conteudo'		=>	(post("conteudo"))
				);

				// application/models/my_model.php
				$id = $model->update($data, post("id"), 'id');
			}
			else
			{
				$data = array(
					'data'			=>	format_data_db(post("data")),
					'titulo'		=>	post("titulo"),
					'slug'			=>	url_title(convert_accented_characters(post("titulo")), '-', TRUE),
					'conteudo'		=>	(post("conteudo")),
					'status'		=>	0,
					'excluido'		=>	0
				);

				// application/models/my_model.php
				$model->insert($data);
			}

			// core/MY_Controller.php
			$this->adm_template_load('lays/layout', 'lays/form_info', array("message"=>"Atualizando...!"));

			redirect(site_url('painel/'.$this->_namemodel.'/'.$pagination), 'refresh');
			//exit();
		}
	}

}

/* End of file paginas.php */
/* Location: ./application/controllers/paginas.php */
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Class created for skin cupcake
**/

class Arquivos extends MY_Controller
{
	protected $_namemodel	=	'arquivos';


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
		$data =	$this->_data;

		// application/models/model_usuarios.php
		$model				=	load_model('generico', 'modulos');

		$sql['where']		=	array("file"=>1, "status"=>1);
		$query				=	$model->get_query($sql, NULL, NULL, FALSE);

		// application/models/model_generico.php
		$data['modulos']	=	$model->render_query(
				array(
						'query'	=>	$query,
						'type'	=>	'array'
				)
		);

		$this->set_data($data);
		
		// core/MY_Controller.php
		$this->adm_template_load('lays/layout', $this->_namemodel . '/list', $this->_data);
	}


	public function crop($id = NULL, $pagina = NULL)
	{
		parent::crop($id, $pagina);

		// core/MY_Controller.php
		$this->adm_template_load('lays/layout', $this->_namemodel . '/crop', $this->_data);
	}


	public function get_edit()
	{
		if(post("id") != "")
		{
			// application/helpers/basics_helper.php
			$model		=	load_model('generico', $this->_namemodel);

			$field		=	post("rel");
			$row		=	$model->get(array("id"=>(int)post("id")), NULL);
			echo $row[$field];
		}
	}


	public function send_edit()
	{
		$this->Model_modulos->check_model('upd', $this->uri->segment(2), TRUE);

		// application/helpers/basics_helper.php
		$model		=	load_model('generico', $this->_namemodel);

		$data = array(
			post('rel')	=>	post("value")
		);

		// application/models/my_model.php
		$model->update($data, post("id"), 'id');
		
		echo post('value');
	}

}

/* End of file arquivos.php */
/* Location: ./application/controllers/arquivos.php */
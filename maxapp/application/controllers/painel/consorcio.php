<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Consorcio extends MY_Controller
{
	protected $_namemodel	=	'consorcio';


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
		
		/*$sql['order']		=	array("field" => "data", "hang" => "DESC");
		//$sql['limit']		=	20;
		
		$data['lista']		=	$this->get_data($this->_namemodel, $pagina, $sql);*/

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

		########################	Carros     #######################
		// application/helpers/basics_helper.php
		$model_carros			=	load_model('generico', 'carros');
		$array_carros['where']	=	array(
				'status' => 1
		);
		// application/models/my_model.php
		$query_carros			=	$model_carros->get_query($array_carros, NULL, NULL, FALSE);
		// application/models/model_generico.php
		$data['carros']			=	$model_carros->render_query(array(
				'query'	=>	$query_carros,
				'type'	=>	'array'
			)
		);

		$this->set_data($data);

		// core/MY_Controller.php
		$this->adm_template_load('lays/layout', $this->_namemodel . '/form', $this->_data);
	}


	public function send($pagination = NULL)
	{
		$this->Model_modulos->check_model('upd', $this->uri->segment(2));
		
		$this->set_rules_validation();
		if($this->form_validation->run() == TRUE)
		{
			if(!is_null($pagination) && post('pagination') == $pagination)
			{
				// application/helpers/basics_helper.php
				$model	=	load_model('generico', $this->_namemodel);

				if(post("id") != "")
				{
					
					$data_update = array(
							'titulo'		=>	post("titulo"),
							'carro_id'		=>	(int)post("carro_id"),
							'parcelas'		=>	(int)post("parcelas"),
							'telefone'		=>	format_telefone(post("telefone")),
							'taxa_adm'		=>	format_decimals(post("taxa_adm")),
							'fundo_res'		=>	format_decimals(post("fundo_res")),
							'seguro'		=>	format_decimals(post("seguro"))				
					);

					// application/models/my_model.php
					$noticia_id = $model->update($data_update, post("id"), 'id');
				}
				else
				{

					$data_insert = array(
							'titulo'		=>	post("titulo"),
							'carro_id'		=>	(int)post("carro_id"),
							'parcelas'		=>	(int)post("parcelas"),
							'telefone'		=>	format_telefone(post("telefone")),
							'taxa_adm'		=>	format_decimals(post("taxa_adm")),
							'fundo_res' 	=>	format_decimals(post("fundo_res")),
							'seguro'		=>	format_decimals(post("seguro")),
							'status'		=>	0,
							'excluido'		=>	0
					);

					// application/models/my_model.php
					$noticia_id = $model->insert($data_insert);
				}
			}

			redirect(site_url('painel/'.$this->_namemodel.'/'.$pagination), 'refresh');
		}
		$this->adm_template_load('lays/layout', $this->_namemodel . '/form', $this->_data);
	}

	private function set_rules_validation()
	{
		$config = array(
			array(
				'field' => 'titulo',
				'label' => 'Titulo',
				'rules' => 'required'
			)
		);

		$this->form_validation->set_rules($config);
	}
	
}

/* End of file noticias.php */
/* Location: ./application/controllers/noticias.php */
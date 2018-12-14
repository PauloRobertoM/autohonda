<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Planos extends MY_Controller
{
	protected $_namemodel	=	'planos';


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
							'titulo'			=>	post("titulo"),
							'carro_id'			=>	(int)post("carro_id"),
							'telefone'			=>	format_telefone(post("telefone")),
							'coeficiente1'		=>	format_decimals(post("coeficiente1")),
							'coeficiente1_1'	=>	format_decimals(post("coeficiente1_1")),
							'coeficiente1_2'	=>	format_decimals(post("coeficiente1_2")),
							'coeficiente2'		=>	format_decimals(post("coeficiente2")),
							'coeficiente2_1'	=>	format_decimals(post("coeficiente2_1")),
							'coeficiente2_2'	=>	format_decimals(post("coeficiente2_2")),
							'coeficiente3'		=>	format_decimals(post("coeficiente3")),
							'coeficiente3_1'	=>	format_decimals(post("coeficiente3_1")),
							'coeficiente3_2'	=>	format_decimals(post("coeficiente3_2")),
							'coeficiente4'		=>	format_decimals(post("coeficiente4")),
							'coeficiente4_1'	=>	format_decimals(post("coeficiente4_1")),
							'coeficiente4_2'	=>	format_decimals(post("coeficiente4_2")),
							'coeficiente5'		=>	format_decimals(post("coeficiente5")),
							'coeficiente5_1'	=>	format_decimals(post("coeficiente5_1")),
							'coeficiente5_2'	=>	format_decimals(post("coeficiente5_2")),
							'coeficiente6'		=>	format_decimals(post("coeficiente6")),
							'coeficiente6_1'	=>	format_decimals(post("coeficiente6_1")),
							'coeficiente6_2'	=>	format_decimals(post("coeficiente6_2")),
							'coeficiente7'		=>	format_decimals(post("coeficiente7")),
							'coeficiente7_1'	=>	format_decimals(post("coeficiente7_1")),
							'coeficiente7_2'	=>	format_decimals(post("coeficiente7_2")),
							'coeficiente8'		=>	format_decimals(post("coeficiente8")),
							'coeficiente8_1'	=>	format_decimals(post("coeficiente8_1")),
							'coeficiente8_2'	=>	format_decimals(post("coeficiente8_2")),
							'coeficiente9'		=>	format_decimals(post("coeficiente9")),					
							'coeficiente9_1'	=>	format_decimals(post("coeficiente9_1")),				
							'coeficiente9_2'	=>	format_decimals(post("coeficiente9_2"))					
					);

					// application/models/my_model_php
					$noticia_id = $model->update($data_update, post("id"), 'id');
				}
				else
				{

					$data_insert = array(
							'titulo'		=>	post("titulo"),
							'carro_id'		=>	(int)post("carro_id"),
							'telefone'		=>	format_telefone(post("telefone")),
							'coeficiente1'		=>	format_decimals(post("coeficiente1")),
							'coeficiente1_1'	=>	format_decimals(post("coeficiente1_1")),
							'coeficiente1_2'	=>	format_decimals(post("coeficiente1_2")),
							'coeficiente2'		=>	format_decimals(post("coeficiente2")),
							'coeficiente2_1'	=>	format_decimals(post("coeficiente2_1")),
							'coeficiente2_2'	=>	format_decimals(post("coeficiente2_2")),
							'coeficiente3'		=>	format_decimals(post("coeficiente3")),
							'coeficiente3_1'	=>	format_decimals(post("coeficiente3_1")),
							'coeficiente3_2'	=>	format_decimals(post("coeficiente3_2")),
							'coeficiente4'		=>	format_decimals(post("coeficiente4")),
							'coeficiente4_1'	=>	format_decimals(post("coeficiente4_1")),
							'coeficiente4_2'	=>	format_decimals(post("coeficiente4_2")),
							'coeficiente5'		=>	format_decimals(post("coeficiente5")),
							'coeficiente5_1'	=>	format_decimals(post("coeficiente5_1")),
							'coeficiente5_2'	=>	format_decimals(post("coeficiente5_2")),
							'coeficiente6'		=>	format_decimals(post("coeficiente6")),
							'coeficiente6_1'	=>	format_decimals(post("coeficiente6_1")),
							'coeficiente6_2'	=>	format_decimals(post("coeficiente6_2")),
							'coeficiente7'		=>	format_decimals(post("coeficiente7")),
							'coeficiente7_1'	=>	format_decimals(post("coeficiente7_1")),
							'coeficiente7_2'	=>	format_decimals(post("coeficiente7_2")),
							'coeficiente8'		=>	format_decimals(post("coeficiente8")),
							'coeficiente8_1'	=>	format_decimals(post("coeficiente8_1")),
							'coeficiente8_2'	=>	format_decimals(post("coeficiente8_2")),
							'coeficiente9'		=>	format_decimals(post("coeficiente9")),					
							'coeficiente9_1'	=>	format_decimals(post("coeficiente9_1")),				
							'coeficiente9_2'	=>	format_decimals(post("coeficiente9_2")),
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
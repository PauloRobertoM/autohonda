<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paginas extends MY_Controller
{
	protected $_namemodel	=	'paginas';

	public function __construct()
	{
		parent::__construct();
	}


	public function index($slug = NULL)
	{
		
		if(!is_null($slug))
		{
			if($this->check_page($slug) > 0)
			{
				$html			=	$this->paginas($slug);
				$data['titulo']	=	$html['titulo'];
				$data['view']	=	$html['conteudo'];
			}
			else
			{
				$data['titulo']	=	"Página não encontrada";
				$data['view']	=	"Desculpe-nos! Esta página não existe no momento!";
			}

			$this->load->view('site/paginas', $data);
		}
	}


	private function check_page($slug = NULL)
	{
		if(!is_null($slug))
		{
			// application/helpers/basics_helper.php
			$model			=	load_model('generico', $this->_namemodel);

			$sql['where']	=	array("slug" => url_title(convert_accented_characters($slug), '-', TRUE));

			// application/models/my_model.php
			$query			=	$model->get($sql, NULL);

			return $query;
		}
	}


	private function paginas($slug = NULL)
	{
		if(!is_null($slug))
		{
			// application/helpers/basics_helper.php
			$model			=	load_model('generico', $this->_namemodel);

			$sql['where']	=	array(
					"status"	=>	1,
					"slug"		=>	url_title(convert_accented_characters($slug), '-', TRUE)
			);

			// application/models/my_model.php
			$query			=	$model->get_query($sql, NULL, NULL, TRUE);

			// application/models/model_generico.php
			$data			=	$model->render_query(
				array(
					'query'	=>	$query,
					'type'	=>	'array'
				)
			);

			return $data[0];
		}
	}

}

/* End of file paginas.php */
/* Location: ./application/controllers/site/paginas.php */
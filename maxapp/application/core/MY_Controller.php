<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
	protected $template_data	=	array();
	public $modulos_check		=	NULL;
	public $_data				=	array();


	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('America/Sao_Paulo');
	}


	public function index($pagina = NULL)
	{
		$data['page']	=	(!is_null($pagina)) ? $pagina : 0 ;

		// application/helpers/basics_helper.php
		$model			=	load_model('generico', $this->_namemodel);

		// application/models/my_model.php
		if(isset($this->sql_extra))
		{
			$sql		=	$this->sql_extra;
		} else {
			$sql		=	NULL;
		}

		$sql['order']			=	array(
			'field'		=>	'data_pub',
			'hang'		=>	'DESC'
		);

		$sql['order']			=	array(
			'field'		=>	'id',
			'hang'		=>	'DESC'
		);

		// application/models/my_model.php
		$query			=	$model->get_query($sql, $pagina, NULL, FALSE);

		// application/models/model_generico.php
		$data['lista']	=	$model->render_query(
			array(
				'query'	=>	$query,
				'type'	=>	'array'
			)
		);

		// application/models/my_model.php
		$data['pagination']	=	$model->render_pagination($this->_namemodel, $sql, NULL, $pagina, FALSE, NULL);

		$this->set_data($data);
	}


	public function add_upd($id = NULL, $pagina = NULL)
	{
		$this->Model_modulos->check_model('upd', $this->uri->segment(2));

		$data['id']			=	$id;
		$data['pagination']	=	$pagina;

		// application/helpers/basics_helper.php
		$model				=	load_model('generico', $this->_namemodel);

		// application/models/my_model.php
		$sql['where']		=	array("id" => $id);
		$data['res']		=	$model->get($sql, NULL);

		$this->set_data($data);
	}


	public function crop($id = NULL, $pagina = NULL)
	{
		$this->Model_modulos->check_model('upd', $this->uri->segment(2));

		$data['id']			=	$id;
		$data['pagination']	=	$pagina;

		// application/models/model_usuarios.php
		$model				=	load_model('generico', $this->_namemodel);

		// application/models/my_model.php
		$sql['where']		=	array("id" => $id);
		$data['res']		=	$model->get($sql, NULL);

		$this->set_data($data);
	}


	protected function get_data($nmodel = NULL, $pagina = NULL, $sql = NULL)
	{
		if(!is_null($nmodel))
		{
			if(@array_key_exists("files", $sql))
			{
				$files = $sql['files'];
				unset($sql['files']);
			}
			else
			{
				$files = NULL;
			}

			// application/models/model_*.php
			$model		=	load_model('generico', $nmodel);

			// application/models/my_model.php
			$query		=	$model->get_query($sql, $pagina, NULL, TRUE);

			// application/models/model_*.php
			$data		=	$model->render_query(
				array(
					'query'	=>	$query,
					'type'	=>	'array',
					'files'	=>	$files
				)
			);

			return $data;
		}
	}


	protected function pagination($modulo = NULL, $data = NULL, $page_atual = NULL, $url = NULL, $nmodel = NULL)
	{
		$data['total']	=	TRUE;

		// application/models/model_*.php
		$model			=	load_model('generico', $modulo);

		$query			=	$model->get_query($data, NULL, NULL, TRUE);
		$total			=	$query->num_rows();
		$model->free_query($query);

		$name_model		=	(is_null($nmodel)) ? $modulo : $nmodel ;

		return paginacao_site($total, config('pagination_max_site'), $page_atual, $name_model, $url);
	}
	
	//paginacao modulo
	protected function pagination_mod($modulo = NULL, $data = NULL, $page_atual = NULL, $url = NULL, $nmodel = NULL, $mod = NULL)
	{
		$data['total']	=	TRUE;

		// application/models/model_*.php
		$model			=	load_model('generico', $modulo);

		$query			=	$model->get_query($data, NULL, NULL, TRUE);
		$total			=	$query->num_rows();
		$model->free_query($query);

		$name_model		=	(is_null($nmodel)) ? $modulo : $nmodel ;

		return paginacao_modulo($total, config('pagination_max_site'), $page_atual, $name_model, $url, $mod);
	}



	protected function pagination_inscritos($modulo = NULL, $data = NULL, $page_atual = NULL, $url = NULL, $nmodel = NULL)
	{
		$data['total']	=	TRUE;

		// application/models/model_*.php
		$model			=	load_model('generico', $modulo);

		$query			=	$model->get_query($data, NULL, NULL, TRUE);
		$total			=	$query->num_rows();
		$model->free_query($query);

		$name_model		=	(is_null($nmodel)) ? $modulo : $nmodel ;

		return paginacao_site_inscritos($total, config('pagination_max_site'), $page_atual, $name_model, $url);
	}


	public function template_set($name, $value)
	{
		$this->template_data[$name] = $value;
	}


	public function adm_template_load($template = '', $view = '', $view_data = array(), $return = FALSE)
	{
		if($this->check_painel() === TRUE)
		{
			if(file_exists(APPPATH.'views/painel/' . $template . '.php'))
			{
				$path_template = 'painel/' . $template;
			}
			else
			{
				show_404();
			}

			if(file_exists(APPPATH.'views/painel/' . $view . '.php'))
			{
				$path_views = 'painel/' . $view;
			}
			else
			{
				show_404();
			}
			
			$this->template_set('contents', $this->load->view($path_views, $view_data, TRUE));
			return $this->load->view($path_template, $this->template_data, $return);
		}
	}


	public function site_template_load($template = '', $view = '', $view_data = array(), $return = FALSE)
	{
		if($this->check_painel() === FALSE) // SITE
		{
			if(isset($_GET['versaoclassica'])) session("versaoclassica", 1);
			$viewatual = ($this->agent->is_mobile() && !session("versaoclassica")) ? "site" : "site";
			
			if(file_exists(APPPATH.'views/'.$viewatual.'/' . $template . '.php'))
			{
				$path_template = $viewatual.'/' . $template;
			}
			else
			{
				$path_template = 'demo/' . $template;
			}

			if(file_exists(APPPATH.'views/'.$viewatual.'/' . $view . '.php'))
			{
				$path_views = $viewatual.'/' . $view;
			}
			elseif(file_exists(APPPATH.'views/demo/' . $view . '.php'))
			{
				$path_views = 'demo/' . $view;
			}
			else
			{
				show_404();
			}
		}

		$this->template_set('contents', $this->load->view($path_views, $view_data, TRUE));
		return $this->load->view($path_template, $this->template_data, $return);
	}


	public function get_view($view = NULL, $slug = NULL)
	{
		//if(isset($_GET['versaoclassica'])) session("versaoclassica", 1);
		//$viewatual = ($this->agent->is_mobile() && !session("versaoclassica")) ? "mobile" : "site";

		if(file_exists(APPPATH.'views/'.$viewatual.'/' . $view . '.php'))
		{
			$path_view		=	$view;
		}
		else
		{
			$path_view		=	(is_null($slug)) ? 'interna' : $slug ;
		}

		return $path_view;
	}


	protected function check_user()
	{
		if(!$this->session->userdata('logged_in'))
		{
			redirect(site_url('painel/logout'), 'refresh');
			return false;
			exit();
		}
	}


	private function check_painel()
	{
		return ($this->uri->segment(1) == 'painel') ? TRUE : FALSE ;
	}


	protected function temp_html($data)
	{
		$this->template_load('lays/layout', 'apps', $data);
	}


	public function show_grupos()
	{
		$model		=	load_model('grupos');
		return $model->get_categorias_grupos();
	}


	public function status()
	{
		$this->Model_modulos->check_model('upd', $this->uri->segment(2));

		if($this->input->is_ajax_request())
		{
			if(post('id') !== FALSE)
			{
				$model		=	load_model('generico', $this->_namemodel);

				// application/models/my_model.php
				echo $model->status(NULL, post("id"), 'id');
			}
		}
	}


	public function destaque()
	{
		$this->Model_modulos->check_model('upd', $this->uri->segment(2));

		if($this->input->is_ajax_request())
		{
			if(post('id') !== FALSE)
			{
				$model		=	load_model('generico', $this->_namemodel);

				// application/models/my_model.php
				echo $model->destaque(NULL, post("id"), 'id');
			}
		}
	}


	public function del()
	{
		$this->Model_modulos->check_model('del', $this->uri->segment(2));

		if($this->input->is_ajax_request())
		{
			if(post('id') !== FALSE)
			{
				$model		=	load_model('generico', $this->_namemodel);

				// application/models/my_model.php
				$query = $model->del(NULL, post("id"), 'id');

				if($query === TRUE)
				{
					return json_encode(array("status"=>"complete"));
				}
				elseif($query === FALSE)
				{
					return json_encode(array("status"=>"error"));
				}
			}
		}
	}


	public function delete($arquivos = NULL)
	{
		$this->Model_modulos->check_model('del', $this->uri->segment(2));

		if($this->input->is_ajax_request())
		{
			if(post('id') !== FALSE)
			{
				if(is_null($arquivos))
				{
					$model		=	load_model('generico', $this->_namemodel);

					// application/models/my_model.php
					$query		=	$model->delete(post("id"), 'id');
				}
				else
				{
					$model		=	load_model('generico', post('modulo') . '_arquivos');

					// application/models/my_model.php
					$query		=	$model->delete(post("id"), 'id');
					//pre($query);
				}

				if($query === TRUE)
				{
					return json_encode(array("status"=>"complete"));
				}
				elseif($query === FALSE)
				{
					return json_encode(array("status"=>"error"));
				}
			}
		}
	}


	public function json_calendar()
	{
		$array = array();

		//j/n/Y
		$sql_calendar['where']	=	array(
			'status'		=>	1,
			'MONTH(data)'	=>	(post("month")) ? post("month") : date("m"),
			'YEAR(data)'	=>	(post("year")) ? post("year") : date("Y"),
		);
		$sql_calendar['limit']	=	31;
		// core/MY_Controller.php
		$data			=	$this->get_data('eventos', NULL, $sql_calendar);

		//echo $this->db->last_query();

		foreach($data as $eventos)
		{
			// var_dump($eventos);
			// exit;
			array_push($array,
				array(
					date("j/n/Y", strtotime($eventos['data'])),
					$eventos['titulo'],
					//url_site($eventos, 'eventos'),
					'http://url/2016/calendario/'.date("d/m/Y", strtotime($eventos['data'])),
					'',
					''
				)
			);
		}

		echo json_encode($array);
	}


	protected function set_data($data = NULL)
	{
		if(!is_null($data))
		{
			$this->_data = $data;
		}
	}


	public function upload($file = NULL, $field = NULL, $dir = NULL)
	{
		if(!is_null($file['tmp_name']))
		{
			$this->load->library('upload');
			
			$directory				=	(is_null($dir)) ? $this->_namemodel : $dir ;
			$data					=	explode('/', date("d/m/Y"));
			$folder					=	$data[2] . '/' . $data[1] . '/' . $data[0];
			$image_upload_folder	=	config('upload_path') . $directory . '/' . $folder;
			get_folder($image_upload_folder, NULL, TRUE);

			$this->upload_config = array(
					'upload_path'   	=> $image_upload_folder,
					'file_name' 		=> set_name_file_random($file),
					'allowed_types'     => config('allowed_types'),
					'max_size'  		=> config('max_size'),
					'max_width'  		=> config('max_width'),
					'overwrite'  		=> config('overwrite'),
					//'xss_clean'  		=> config('xss_clean'),
					'remove_space'  	=> config('remove_spaces'),
					'encrypt_name'  	=> config('encrypt_name'),
			);
			
			
			$this->upload->initialize($this->upload_config);

			if(!$this->upload->do_upload($field))
			{
				$status = array(
					"status"	=>	NULL,
					"error"		=>	$this->upload->display_errors('<p>', '</p>')
				);
			}
			else
			{
				$upload = $this->upload->data();
                
				$status = array(
					"status"	=>	$upload,
					'folder'	=>	$folder,
					"error"		=>	NULL
				);
			}

			return json_encode($status);

			unset($config);
		}
	}

	public function multi_upload($field = NULL, $dir = NULL, $ix = NULL)
	{
		if(!is_null($_FILES[$field]['tmp_name'][$ix]))
		{
			$this->load->library('upload');

			$directory				=	(is_null($dir)) ? $this->_namemodel : $dir ;
			$data					=	explode('/', date("d/m/Y"));
			$folder					=	$data[2] . '/' . $data[1] . '/' . $data[0];
			$image_upload_folder	=	config('upload_path') . $directory . '/' . $folder;
			get_folder($image_upload_folder, NULL, TRUE);

			$this->upload_config = array(
					'upload_path'   	=> $image_upload_folder,
					'file_name' 		=> set_name_file_random($_FILES[$field], $ix).'pdf',
					'allowed_types'     => config('allowed_types'),
					'max_size'  		=> config('max_size'),
					'max_width'  		=> config('max_width'),
					'overwrite'  		=> config('overwrite'),
					//'xss_clean'  		=> config('xss_clean'),
					'remove_space'  	=> config('remove_spaces'),
					'encrypt_name'  	=> config('encrypt_name'),
			);
			
			//echo pre($this->upload_config); die();
			
			$this->upload->initialize($this->upload_config);

			if(!$this->upload->do_multi_upload($field, $ix))
			{
				$status = array(
					"status"	=>	array("file_name" => NULL),
					"error"		=>	$this->upload->display_errors('<p>', '</p>'),
					"folder"	=>	NULL
				);
			}
			else
			{
				$upload = $this->upload->get_multi_upload_data();
				foreach($upload as $data_upload)
				{
					$status = array(
						"status"	=>	$data_upload,
						'folder'	=>	$folder,
						"error"		=>	NULL
					);
				}
			}
		}
		else
		{
			$status = array(
				"status"	=>	array("file_name" => NULL),
				"error"		=>	'Nenhum arquivo enviado',
				"folder"	=>	NULL
			);
		}
        
       
		return json_encode($status);
		unset($config);
	}


	public function arquivos()
	{
		// application/helpers/basics_helper.php
		$model		=	load_model('generico', 'arquivos');

		if(is_null(post("pagina")) || post("pagina") == 0)
		{
			// application/models/my_model.php
			$query			=	$model->get_query(NULL, NULL, NULL, FALSE);
			
			// application/models/model_generico.php
			$data['lista']	=	$model->render_query(
					array(
							'query'	=>	$query,
							'type'	=>	'array'
					)
			);

			// application/models/my_model.php
			$data['pagination']	=	$model->render_pagination_ajax($this->_namemodel, NULL, NULL, 1, 5);

			return $data;
		}
		else
		{
			$sql['where']	=	array(
					"modulo_id"		=>	post('modulo'),
					"DATE(data)"	=>	fdata_db(post('data'))
			);

			if(post("data") == "")
			{
				array_pop($sql['where']);
			}

			if(post("modulo") == 0)
			{
				unset($sql['where']["modulo_id"]);
			}

			// application/models/my_model.php
			$query		=	$model->get_query($sql, post("pagina"), NULL, FALSE);

			$data		=	array();

			// application/models/my_model.php
			$data[0]	=	$model->render_pagination_ajax($this->_namemodel, $sql, NULL, post("pagina"), 5);

			// application/models/model_generico.php
			$data		=	$model->render_query(
					array(
							'query'	=>	$query,
							'type'	=>	'object'
					)
			);

			echo json_encode($data);
		}
	}


	protected function arquivos_relacionados($data = NULL)
	{
		//$this->Model_modulos->check_model('upd', $this->uri->segment(2), TRUE);

		/**
		 * @name TABLENAME
		 * @example data['tablename'] = 'noticias_arquivos';
		 */
		if(!is_null($data) && array_key_exists("tablename", $data))
		{
			// application/helpers/basics_helper.php
			$model		=	load_model('generico', $data['tablename']);
		}
		else
		{
			die();
		}


		/**
		 * @name SELECT
		 * @example data['select'] = 'id, titulo';
		 */
		if(!is_null($data) && array_key_exists("select", $data))
		{
			$sql['select']	=	$data['select'];
		}


		/**
		 * @name WHERE
		 * @example data['where'] = array('field'=>'noticia_id', 'id'=>2);
		 */
		if(!is_null($data) && array_key_exists("where", $data))
		{
			$sql['where'] = array(
					$data['where']['field'] => (int)$data['where']['id']
			);
		}

		$sql['join']	=	array(
				array(
						'join_table'	=>	'arquivos',
						'field_join_id'	=>	'arquivos.id',
						'field_id'		=>	$data['tablename'] . '.arquivo_id',
						'join_type'		=>	'left'
				)
		);

		$sql['order']	=	array(
				'field'	=>	'arquivos.id',
				'hang'	=>	'DESC'
		);

		$sql['total']	=	TRUE;

		// application/models/my_model.php
		$query			=	$model->get_query($sql, NULL, NULL, FALSE);

		// application/models/model_generico.php
		$data['lista']	=	$model->render_query(
			array(
				'query'	=>	$query,
				'type'	=>	'array'
			)
		);

		return $data;
	}


	protected function banners_laterais()
	{
		################### HALF BANNER ########################
		$sql_half_banner['where']	=	array(
			'status'		=>	1,
			'tipo'			=>	2,
			'data_fim <='	=>	'NOW()',
		);
		$sql_half_banner['limit']	=	1;
		$sql_half_banner['order']	=	array(
			'field'	=>	'id',
			'hang'	=>	'DESC'
		);
		// core/MY_Controller.php
		$data['half_banner']	=	$this->get_data('banners', NULL, $sql_half_banner);

		################### MINI BANNER ########################
		$sql_mini_banner['where']	=	array(
		'status'		=>	1,
		'tipo'			=>	3,
		'data_fim <='	=>	'NOW()',
		);
		$sql_mini_banner['total']	=	TRUE;
		$sql_mini_banner['order']	=	array(
				'field'	=>	'id',
				'hang'	=>	'DESC'
		);
		// core/MY_Controller.php
		$data['mini_banner']	=	$this->get_data('banners', NULL, $sql_mini_banner);

		return $data;
	}

}

/* End of file my_controller.php */
/* Location: ./application/controllers/my_controller.php */
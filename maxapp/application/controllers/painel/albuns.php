<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Class created for skin cupcake
**/
class Albuns extends MY_Controller
{
	protected $_namemodel	=	'albuns';


	public function __construct()
	{
		parent::__construct();
		session_start();
		
		// application/core/my_controller.php
		$this->check_user();
		$this->Model_modulos->check_model('view', $this->uri->segment(2));
	}


	/*
	 * @tutorial Este metodo importa todas consultas do metodo da classe pai(index) em core/MY_Controller.php
	 */
	public function index($pagina = NULL)
	{
		$data['page']	=	(!is_null($pagina)) ? $pagina : 0 ;
		
		$data['form_album'] = TRUE;

		$url			=	"?";
		$sql			=	NULL;

		#####################################################################
		// COMPILANDO A URL STRING E SQL DA BUSCA
		if(get_post("data") != "") {
			$sql["where"]	=	array(
					"DATE(data)" => format_data_in_time_db(get_post("data"))
			);
			$url	.=	"data=" . get_post("data") . "&";
		}
		if(get_post("titulo") != "") {
			$sql["like"] 	=	array(
				array(
					"field"		=>	"titulo",
					"search"	=>	get_post("titulo"),
					"match"		=>	"both"
				)
			);
		}
		if(get_post("credito") != "") {
			$sql["where"]	=	array(
					"credito" => get_post("credito")
			);
			$url	.=	"credito=" . get_post("credito") . "&";
		}
		$url		=	substr($url, 0, -1);
		############################################

		// application/helpers/basics_helper.php
		$model			=	load_model('generico', $this->_namemodel);

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
		$data['pagination']	=	$model->render_pagination($this->_namemodel, $sql, NULL, $pagina, FALSE, $url);

		// core/MY_Controller.php
		$this->adm_template_load('lays/layout', $this->_namemodel . '/list', $data);
	}


	/*
	 * @tutorial Este metodo importa todas consultas do metodo da classe pai(add_upd) em core/MY_Controller.php
	 */
	public function add_upd($id = NULL, $pagina = NULL)
	{
		
		parent::add_upd($id, $pagina);
		$data =	$this->_data;

		$data['form_album'] = TRUE;
		
		// Arquivos relacionado
		$array	=	array(
				'tablename' =>	'albuns_arquivos',
				'select'	=>	'albuns_arquivos.id as id, albuns_arquivos.album_id as album_id, albuns_arquivos.destaque as destaque, arquivos.id as arquivo_id, arquivos.legenda as legenda, arquivos.arquivo as arquivo, arquivos.folder as folder',
				'where'		=>	array(
						'field'	=>	'album_id',
						'id'	=>	(int)$id
				),
				'total'		=>	TRUE
		);
		$data['arquivos_albuns']	=	$this->arquivos_relacionados($array);

		$this->set_data($data);

		if(post("id"))
		{
			// Validacao de dados do formulario
			$this->set_rules_validation();
			if($this->form_validation->run() == TRUE)
			{
				// application/helpers/basics_helper.php
				$model	=	load_model('generico', $this->_namemodel);

				$data = array(
						'data'			=>	format_data_db(post("data")),
						'titulo'		=>	post("titulo"),
						'credito'		=>	post("credito"),
						'conteudo'		=>	stripslashes(post("conteudo"))
				);

				// application/models/my_model.php
				$id = $model->update($data, post("id"), 'id');
	
				redirect(site_url('painel/'.$this->_namemodel.'/'.$pagina), 'refresh');
			}
		}

		// core/MY_Controller.php
		$this->adm_template_load('lays/layout', $this->_namemodel . '/form', $this->_data);
	}


	public function save()
	{
		if($this->input->is_ajax_request())
		{
			// application/helpers/basics_helper.php
			$model	=	load_model('generico', $this->_namemodel);
			$data = array(
					'data'			=>	format_data_db(post("data")),
					'titulo'		=>	post("titulo"),
					'credito'		=>	post("credito"),
					'conteudo'		=>	post("conteudo"),
					'status'		=>	0,
					'excluido'		=>	0
			);

			$id = $model->insert($data); // application/models/my_model.php


			if(isset($_SESSION['session_arquivos']) && count($_SESSION['session_arquivos']) > 0)
			{
				####################	ARQUIVOS	#####################
				// application/helpers/basics_helper.php
				$model_arquivos	=	load_model('generico', $this->_namemodel . "_arquivos");
	
				foreach($_SESSION['session_arquivos'] as $session_arquivos)
				{
					$data_arquivos	=	array(
							'arquivo_id'	=>	$session_arquivos['arquivo_id'],
							'album_id'		=>	$id
					);
					$model_arquivos->insert($data_arquivos); // application/models/my_model.php
				}
				unset($_SESSION['session_arquivos']);
			}


			echo json_encode(
				array(
					"id"		=>		$id,
					"data"		=>		format_data_db(post("data")),
					"titulo"	=>		post("titulo"),
					"credito"	=>		post("credito"),
					"conteudo"	=>		post("conteudo")
				)
			);
		}
	}


	public function do_uploads()
	{
		$this->load->library('upload');
		$this->load->library('image_lib');

		if(!empty($_FILES['file']))
		{
			$folder							=	date("Y/m/d");
			$image_upload_folder			=	config('upload_path') . 'arquivos/' . $folder;
			get_folder($image_upload_folder, 0755, TRUE);

			$this->upload_config = array(
					'upload_path'   	=>	$image_upload_folder,
					'file_name' 		=>	set_name_file_random($_FILES['file']),
					'allowed_types'     =>	'gif|jpg|png',
					'max_size'  		=>	config('max_size'),
					'max_width'  		=>	config('max_width'),
					'overwrite'  		=>	config('overwrite'),
					//'xss_clean'  		=>	config('xss_clean'),
					'remove_space'  	=>	config('remove_spaces'),
					'encrypt_name'  	=>	config('encrypt_name'),
			);

			$this->upload->initialize($this->upload_config);
			if(!$this->upload->do_upload('file'))
			{
				$status = array(
					"status"	=>	$this->upload->display_errors('<p>', '</p>'),
					"error"		=>	TRUE
				);
			}
			else
			{
				$upload = $this->upload->data();

				/*if($upload['is_image'] == 1)
				{
					$this->resize_config = array(
							'image_library'		=>	'gd2',
							'source_image'		=>	$upload['full_path'],
							'create_thumb'		=>	FALSE,
							'maintain_ratio'	=>	TRUE,
							'master_dim'		=>	'auto',
							'width'				=>	800
					);
					$this->image_lib->initialize($this->resize_config);
					$this->image_lib->resize();
					$this->image_lib->clear();
				}*/

				$model_arquivos		=	load_model('generico', 'arquivos');
				$data_arquivos		=	array(
						'data'			=>	date("Y-m-d H:i:s"),
						'modulo_id'		=>	0,
						'local'			=>	'',
						'credito'		=>	'',
						'legenda'		=>	$upload['raw_name'],
						'arquivo'		=>	$upload['file_name'],
						'extension'		=>	$upload['file_ext'],
						'folder'		=>	$folder
				);
				$id = $model_arquivos->insert($data_arquivos);

				if(post('action') == "update")
				{
					####################	ARQUIVOS	#####################
					// application/helpers/basics_helper.php
					$model_arquivos	=	load_model('generico', $this->_namemodel . "_arquivos");
					$data_arquivos	=	array(
						'arquivo_id'	=>	$id,
						'album_id'		=>	post("id_post")
					);
					$model_arquivos->insert($data_arquivos); // application/models/my_model.php
				}
				else
				{
					if(!isset($_SESSION['session_arquivos']))
					{
						$_SESSION['session_arquivos']	=	array();
					}

					array_push($_SESSION['session_arquivos'],
						array(
							'arquivo_id'	=>	$id
						)
					);
				}

				$status = array(
					"id"		=>	$id,
					"status"	=>	$upload,
					'folder'	=>	$folder,
					"error"		=>	FALSE
				);
			}

			echo json_encode($status);
		}
	}


	public function delfiles()
	{
		if($this->input->is_ajax_request())
		{
			// application/helpers/basics_helper.php
			$model		=	load_model('generico', $this->_namemodel . '_arquivos');
			// application/models/my_model.php
			$model->delete(post("id"), 'id');
		}		
	}


	public function destacafiles()
	{
		if($this->input->is_ajax_request())
		{
			########	REMOVENDO DESTAQUE DE TODOS AS FOTOS DO DEFINIDO ALBUM	########
			// application/helpers/basics_helper.php
			$model_unmark	=	load_model('generico', $this->_namemodel . '_arquivos');
			$data_unmark	=	array(
					'destaque'		=>	0
			);
			// application/models/my_model.php
			$model_unmark->update($data_unmark, post("rel"), 'album_id');


			########################	DESCANDO UMA FOTO		######################
			// application/helpers/basics_helper.php
			$model_mark	=	load_model('generico', $this->_namemodel . '_arquivos');
			$data_mark	=	array(
				'destaque'		=>	1
			);
			// application/models/my_model.php
			$model_mark->update($data_mark, post("id"), 'id');
		}		
	}


	/*
	 * @tutorial Este metodo seta os campos para validacao deste controler
	 * @doc Manual http://ellislab.com/codeigniter/user-guide/libraries/form_validation.html
	 * @doc Regras http://ellislab.com/codeigniter/user-guide/libraries/form_validation.html#rulereference
	 */
	private function set_rules_validation()
	{
		$config = array(
			array(
					'field' => 'data',
					'label' => 'Data',
					'rules' => 'required'
			),
			array(
				'field' => 'titulo',
				'label' => 'Titulo',
				'rules' => 'required'
			)
		);
		
		$this->form_validation->set_rules($config);
	}

}

/* End of file albuns.php */
/* Location: ./application/controllers/painel/albuns.php */
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Carros extends MY_Controller
{
	protected $_namemodel	=	'carros';


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


					// core/MY_Controller.php
                    if($_FILES['arquivo']['tmp_name'])
                    {
                        // core/MY_Controller.php
                        $fileinfo	=	json_decode($this->upload($_FILES['arquivo'], 'arquivo'));
                        $file		=	$fileinfo->status->file_name;
                        $folder		=	$fileinfo->folder;
                    }
                    else
                    {
                        $file		=	NULL;
                        $folder		=	post('folder');
                    }
					
					$tamanhos = $this->CalculaPercetual($this->input->post());

					$configCrop['image_library']	=	'gd2';
					$configCrop['source_image']		=	$fileinfo->status->full_path;
					$configCrop['new_image']		=	$fileinfo->status->file_path;
					$configCrop['maintain_ratio']	=	FALSE;
					$configCrop['quality']			=	100;
					$configCrop['width']			=	$tamanhos['wcrop'];
					$configCrop['height']			=	$tamanhos['hcrop'];
					$configCrop['x_axis']			=	$tamanhos['x'];
					$configCrop['y_axis']			=	$tamanhos['y'];

					$this->image_lib->initialize($configCrop);

					if ( ! $this->image_lib->crop())
		            {
		                // Recupera as mensagens de erro e envia o usuário para a home
		                $data = array('error' => $this->image_lib->display_errors());
		                $this->load->view('home',$data);
		            }
		            else
		            {
		                // Grava a informação na sessão
		                $this->session->set_flashdata('urlImagem', $urlImagem);
		 
		                // Grava os dados da imagem recortada na sessão
		                $this->session->set_flashdata('dadosImagem', $dadosImagem);
		 
		                // Grava os dados da imagem original na sessão
		                $this->session->set_flashdata('dadosCrop', $tamanhos);
		            }
				
					$data_update = array(
							'titulo'		=>	post("titulo"),
							'valor'			=>	format_valor(post("valor")),
							'tac'			=>	format_valor(post("tac")),
							'folder'		=>	$folder,
							'arquivo'		=>	$file
					);

					if(!$_FILES['arquivo']['tmp_name'])
					{
						unset($data_update["arquivo"]);
						unset($data_update["folder"]);
					}

					// application/models/my_model.php
					$noticia_id = $model->update($data_update, post("id"), 'id');
				}
				else
				{
					if($_FILES['arquivo']['tmp_name'])
                    {
                        // core/MY_Controller.php
                        $fileinfo	=	json_decode($this->upload($_FILES['arquivo'], 'arquivo'));
                        $file		=	$fileinfo->status->file_name;
                        $folder		=	$fileinfo->folder;
                    }
                    else
                    {
                        $file		=	NULL;
                        $folder		=	post('folder');
                    }

					$data_insert = array(
							'titulo'		=>	post("titulo"),
							'valor'			=>	format_valor(post("valor")),
							'tac'			=>	format_valor(post("tac")),
							'folder'		=>	$folder,
							'arquivo'		=>	$file,
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


	public function dragdrop()
	{
		$this->Model_modulos->check_model('upd', $this->uri->segment(2));

		if($this->input->is_ajax_request())
		{
			// application/helpers/basics_helper.php
			$model		=	load_model('generico', 'noticias_arquivos');

			$data = array(
					'noticia_id'	=>	post("id"),
					'arquivo_id'	=>	post("arquivo_id")
			);

			// application/models/my_model.php
			$id = $model->insert($data);

			echo json_encode(array("id" => (int)$id));
		}
	}

	private function CalculaPercetual($dimensoes){
        // Verifica se a largura da imagem original é
        // maior que a da área de recorte, se for calcula o tamanho proporcional
        if($dimensoes['woriginal'] > $dimensoes['wvisualizacao']){
            $percentual = $dimensoes['woriginal'] / $dimensoes['wvisualizacao'];
 
            $dimensoes['x'] = round($dimensoes['x'] * $percentual);
            $dimensoes['y'] = round($dimensoes['y'] * $percentual);
            $dimensoes['wcrop'] = round($dimensoes['wcrop'] * $percentual);
            $dimensoes['hcrop'] = round($dimensoes['hcrop'] * $percentual);
        }
 
        // Retorna os valores a serem utilizados no processo de recorte da imagem
        return $dimensoes;
    }
}

/* End of file noticias.php */
/* Location: ./application/controllers/noticias.php */
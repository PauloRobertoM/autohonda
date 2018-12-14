<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Class created for skin cupcake
**/

class Files extends MY_Controller
{
	private $upload_config;

	public function __construct()
	{
		parent::__construct();
	}


	public function download($namemodel = NULL, $foldername = NULL, $filename = NULL)
	{
		if(!is_null($namemodel) && !is_null($foldername) && !is_null($filename))
		{
			$file = FCPATH . '_ups/' . $namemodel . '/' . str_replace("-", "/", $foldername) . '/' . $filename;

			switch(strtolower(substr(strrchr(basename($file),"."),1)))
			{
				case "pdf": $tipo="application/pdf"; break;
				case "doc": $tipo="application/msword"; break;
				case "xls": $tipo="application/vnd.ms-excel"; break;
				case "gif": $tipo="image/gif"; break;
				case "png": $tipo="image/png"; break;
				case "jpg": $tipo="image/jpg"; break;
				case "mp3": $tipo="audio/mpeg"; break;
				case "php": // deixar vazio por seguranca
				case "htm": // deixar vazio por seguranca
				case "html": // deixar vazio por seguranca
			}

			header('Content-Description: File Transfer');
			header('Content-Disposition: attachment; filename="' . basename($file) . '"');
			header('Content-Type: '.$tipo);
			header('Content-Transfer-Encoding: binary');
			header('Content-Length: ' . filesize($file));
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Pragma: public');
			header('Expires: 0');
			readfile($file);
		}
	}


	public function do_upload($namemodel = NULL)
	{
		if(!is_null($namemodel))
		{
			$this->load->library('upload');

			if(!empty($_FILES))
			{
				$data					=	explode('/', post('data'));
				$folder					=	$data[2] . '/' . $data[1] . '/' . $data[0];
				$image_upload_folder	=	config('upload_path') . $namemodel . '/' . $folder;
				get_folder($image_upload_folder, 0755, TRUE);

				$this->upload_config = array(
						'upload_path'   	=> $image_upload_folder,
						'file_name' 		=> set_name_file_random($_FILES['file']),
						'allowed_types'     => $this->config->item('allowed_types'),
						'max_size'  		=> $this->config->item('max_size'),
						'max_width'  		=> $this->config->item('max_width'),
						'overwrite'  		=> $this->config->item('overwrite'),
						'xss_clean'  		=> $this->config->item('xss_clean'),
						'remove_space'  	=> $this->config->item('remove_spaces'),
						'encrypt_name'  	=> $this->config->item('encrypt_name'),
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

					$data_db = array(
							'data'			=>	format_data_in_time_db(post('data')),
							'modulo_id'		=>	post('modulo'),
							'local'			=>	'',
							'credito'		=>	'',
							'legenda'		=>	$upload['raw_name'],
							'arquivo'		=>	$upload['file_name'],
							'extension'		=>	$upload['file_ext'],
							'folder'		=>	$folder
					);

					// application/helpers/basics_helper.php
					$model		=	load_model('generico', 'arquivos');

					// application/models/my_model.php
					$id = $model->insert($data_db);

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
	}


}

/* End of file files.php */
/* Location: ./application/controllers/files.php */

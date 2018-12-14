<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');

	if(!function_exists('status2'))
	{
		function status2($status = NULL, $slug = NULL)
		{
			if($status == 0)
			{
				$dados = array(
						"info"	=>	'Novo'
				);
			}
			elseif($status == 1)
			{
				$dados = array(
						"info"	=>	'Lido'
				);
			}
	
			if(is_null($slug))
			{
				$return = $dados;
			}
			else
			{
				$return = $dados[$slug];
			}
				
			return $return;
		}
	}


	if(!function_exists('status')) 
	{
		function status($status = NULL, $slug = NULL)		
		{
			if($status == 1)
			{
				$dados = array(
					"image"	=>	'tick',
					"info"	=>	'Desativar'
				);
			}
			elseif($status == 0)
			{
				$dados = array(
					"image"	=>	'minus',
					"info"	=>	'Ativar'
				);
			}

			if(is_null($slug))
			{
				$return = $dados;				
			}
			else
			{
				$return = $dados[$slug];
			}
			
			return $return;
		}
	}


	if(!function_exists('status_solicitacao')) 
	{
		function status_solicitacao($status = NULL, $slug = NULL)		
		{
			if($status == 0)
			{
				$dados = array(
					"image"	=>	'tick',
					"info"	=>	'Pendente',
					"color"	=>	'text-error'
				);
			}
			elseif($status == 1)
			{
				$dados = array(
					"image"	=>	'minus',
					"info"	=>	'Concluído',
					"color"	=>	'text-success'
				);
			}

			if(is_null($slug))
			{
				$return = $dados;				
			}
			else
			{
				$return = $dados[$slug];
			}
			
			return $return;
		}
	}


	if(!function_exists('destaque')) 
	{
		function destaque($destaque = NULL, $slug = NULL)		
		{
			if($destaque == 1)
			{
				$dados = array(
					"image"	=>	'tick',
					"info"	=>	'Destaque - Desativar'
				);
			}
			elseif($destaque == 0)
			{
				$dados = array(
					"image"	=>	'minus',
					"info"	=>	'Destaque - Ativar'
				);
			}

			if(is_null($slug))
			{
				$return = $dados;				
			}
			else
			{
				$return = $dados[$slug];
			}
			
			return $return;
		}
	}


	if(!function_exists('btn_comments'))
	{
		function btn_comments($array)
		{
			$class_link		=	array("class"=>"btn btn-mini tip", "title"=>$array['title']);
			$content_link	=	img("assets/painel/img/icons/dark/".$array['img'].".png");
			return anchor(site_url('painel/'.$array['nameform'].'/comment/'.$array['id'].'/'.$array['page']), $content_link, $class_link) . PHP_EOL;
		}
	}


	if(!function_exists('btn_destaque'))
	{
		function btn_destaque($array)
		{
			$content_link	=	img("assets/painel/img/icons/dark/".$array['img'].".png");
			$anchor			=	"<a href='javascript:void(0);' id='".$array['id']."' class='btn btn-mini tip destaque' rel='".$array['nameform']."' title='".$array['title']."'>".$content_link."</a>".PHP_EOL;
			return $anchor;
		}
	}


	if(!function_exists('btn_status'))
	{
		function btn_status($array)
		{
			$content_link	=	img("assets/painel/img/icons/dark/".$array['img'].".png");
			$anchor			=	"<a href='javascript:void(0);' id='".$array['id']."' class='btn btn-mini tip status' rel='".$array['nameform']."' title='".$array['title']."'>".$content_link."</a>".PHP_EOL;
			return $anchor;
		}
	}


	if(!function_exists('btn_editar_arquivo'))
	{
		function btn_editar_arquivo($array)
		{
			$class_link	=	array("class"=>"btn btn-mini tip", "title"=>$array['title']);
			$content_link	=	img("assets/painel/img/icons/dark/".$array['img'].".png");
			return anchor(site_url('painel/'.$array['nameform'].'/crop/'.$array['id'].'/'.$array['page']), $content_link, $class_link) . PHP_EOL;
		}
	}


	if(!function_exists('btn_editar'))
	{
		function btn_editar($array)
		{
			$class_link		=	array("class"=>"btn btn-mini tip", "title"=>$array['title']);
			$content_link	=	img("assets/painel/img/icons/dark/".$array['img'].".png");
			return anchor(site_url('painel/'.$array['nameform'].'/upd/'.$array['id'].'/'.$array['page']), $content_link, $class_link) . PHP_EOL;
		}
	}


	if(!function_exists('btn_ver_comentarios'))
	{
		function btn_ver_comentarios($array)
		{
			$class_link		=	array("class"=>"btn btn-mini tip", "title"=>$array['title']);
			$content_link	=	img("assets/painel/img/icons/dark/".$array['img'].".png");
			return anchor(site_url('painel/comentarios/'.$array['nameform'].'/'.$array['id'].'/'.$array['page'].'/'.$array['reg_id']), $content_link, $class_link) . PHP_EOL;
		}
	}


	if(!function_exists('btn_ver'))
	{
		function btn_ver($array)
		{
			$class_link		=	array("class"=>"btn btn-mini tip", "title"=>$array['title']);
			$content_link	=	img("assets/painel/img/icons/dark/".$array['img'].".png");
			return anchor(site_url('painel/'.$array['nameform'].'/show/'.$array['id'].'/'.$array['page']), $content_link, $class_link) . PHP_EOL;
		}
	}


	if(!function_exists('btn_excluir'))
	{
		function btn_excluir($array)
		{
			//$class_link	=	array("class"=>"btn btn-mini tip del", "title"=>$array['title'], "rel"=>$array['nameform'], "id"=>$array['id']);
			$content_link	=	img("assets/painel/img/icons/dark/".$array['img'].".png");
			//return anchor("javascript:void(0);", $content_link, $class_link) . PHP_EOL;
			$anchor			=	"<a href='javascript:void(0);' id='".$array['id']."' class='btn btn-mini tip del' rel='".$array['nameform']."' title='".$array['title']."'>".$content_link."</a>".PHP_EOL;
			return $anchor;
		}
	}


	if(!function_exists('btn_excluir_arquivo'))
	{
		function btn_excluir_arquivo($array)
		{
			$content_link	=	img("assets/painel/img/icons/dark/".$array['img'].".png");
			$anchor			=	"<a href='javascript:void(0);' id='".$array['id']."' class='btn btn-mini tip del_files' rel='".$array['nameform']."' title='".$array['title']."'>".$content_link."</a>".PHP_EOL;
			return $anchor;
		}
	}


	if(!function_exists('btn_ativar'))
	{
		function btn_ativar($array)
		{
			$class_link		=	array("class"=>"btn btn-mini tip ativar", "title"=>$array['title'], "rel"=>$array['nameform'], "id"=>$array['id']);
			$content_link	=	img("assets/painel/img/icons/dark/".$array['img'].".png");
			return anchor("javascript:void(0);", $content_link, $class_link) . PHP_EOL;
		}
	}


	if(!function_exists('session'))
	{
		function session($value = NULL, $data = NULL)
		{
			if(!is_null($value))
			{
				$ci	=& get_instance();
				if(!is_null($data))
				{
					if(is_array($data))
					{
						$ci->session->set_userdata($data);
					}
					else
					{
						$ci->session->set_userdata(array($value => $data));
					}
				}
				else
				{
					return $ci->session->userdata($value);
				}
			}
		}
	}


	if(!function_exists('config'))
	{
		function config($value)
		{
			if(!is_null($value))
			{
				$ci	=& get_instance();
				return $ci->config->item($value);
			}
		}
	}


	if(!function_exists('object_collect'))
	{
		function object_collect($array, $key, $value)
		{
			foreach($array as $a)
				$_array[$a->$key] = $a->$value;
			
			return $_array;
		}
	}


	if(!function_exists('get_post')) 
	{
		function get_post($field, $xss_clean = true)
		{
			$ci	=& get_instance();
			$ci->load->library('input');
			return $ci->input->get_post($field, $xss_clean);
		}
	}


	if(!function_exists('post')) 
	{
		function post($field, $xss_clean = true)
		{
			$ci	=& get_instance();
			$ci->load->library('input');
			return $ci->input->post($field, $xss_clean);
		}
	}


	if(!function_exists('get')) 
	{
		function get($field, $xss_clean = true)
		{
			$ci =& get_instance();
			$ci->load->library('input');
			return $ci->input->get($field, $xss_clean);
		}
	}


	if(!function_exists('params')) 
	{
		function params($field, $xss_clean = true)
		{
			$ci =& get_instance();
			$ci->load->library('input');
			return $ci->input->get_post($field, $xss_clean);
		}
	}


	if(!function_exists('load_model')) 
	{
		function load_model($modelname = NULL, $tablename = NULL, $premodelname = "Model_")
		{
			if(!is_null($modelname))
			{
				$name_model = $premodelname . $modelname;

				$ci =& get_instance();
				$ci->load->model($name_model);
				$mdl = $ci->$name_model;

				if(!is_null($tablename))
				{
					$mdl->set_tablename($tablename);
				}

				return $mdl;
			}
		}
	}


	if(!function_exists('show_sql')) 
	{
		function show_sql($die = FALSE)
		{
			$ci =& get_instance();
			pre($ci->db->last_query());
			
			if($die === TRUE)
				die();
		}
	}

/* End of file basics_helper.php */
/* Location: ./application/helpers/basics_helper.php */
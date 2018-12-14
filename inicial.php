<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Inicial extends MY_Controller
{
	protected $_namemodel	=	'inicial';

	public function __construct()
	{
		parent::__construct();
	}


	public function index()
	{
		$data['index']			=	TRUE;

		################### TWITTER ########################
		$this->load->library('twitter');
		$data['twitter']		=	$this->twitter->show();

		################### Categorias ########################
		$sql0['where']			=	array('status'	=>	1);
		$sql0['order']			=	array('field'	=>	'titulo',	'hang'	=>	'ASC');
		$sql0['total']			=	TRUE;
        
		// core/MY_Controller.php
		$data['categorias']		=	$this->get_data('categorias',	NULL,	$sql0);
        
		################### Portifolio ########################
		$sql1['where']			=	array('status'	=>	1, 'destaque' => 1);
		$sql1['order']			=	array('field'	=>	'RAND()',	'hang'	=>	'');
		$sql1['total']			=	TRUE;
		// core/MY_Controller.php
		$data['portifolios']	=	$this->get_data('portifolio',	NULL,	$sql1);

		// $ci =& get_instance();
		// pre($ci->db->last_query());

		$this->site_template_load('site/lays/layout', 'site/'.$this->_namemodel, $data);
	}


	public function servicos()
	{
		
		################### TWITTER ########################
		$this->load->library('twitter');
		$data['twitter']		=	$this->twitter->show();
		
		$this->site_template_load('site/lays/layout', 'site/servicos', $data);
	}

}

/* End of file inicial.php */
/* Location: ./application/controllers/site/inicial.php */
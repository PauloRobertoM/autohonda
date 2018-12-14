<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Topo_interna extends MY_Controller
{
	protected $_namemodel	=	'banners';

	public function __construct()
	{
		parent::__construct();
	}


	public function index($pagina = NULL)
	{
		
		$data['album']			=	TRUE;

		// Definindo titulo da pagina
		$data['titulo']		=	"banners";

		###################  	BANNERS  	#########################
		$sql1['where']		=	array("status"	=>	1, "excluido"	=>	0,	"tipo"	=>	4);
		$sql1['order']		=	array("field" => "data", "hang" => "DESC");
		$sql1['limit']		=	1;

		$data['listagem']	=	$this->get_data($this->_namemodel, $pagina, $sql1);
		
		$this->load->view('site/topo-interna', $data);
	}
}

/* End of file albuns.php */
/* Location: ./application/controllers/site/albuns.php */
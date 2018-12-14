<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Class created for skin cupcake
**/

class Model_logs extends MY_Model
{
	protected $_tablename	=	'logs';


	public $id;
	public $registro_id;
	public $user_id;
	public $user_ip;
	public $created;
	public $tabela;
	public $acao;
	public $browser;
	public $url;


	public function __construct()
	{
		parent::__construct();

		$this->id			=	NULL;
		$this->registro_id	=	NULL;
		$this->user_id		=	(int)session('uid');
		$this->user_ip		=	$this->input->ip_address();
		$this->created		=	date("Y-m-d H:i:s");
		$this->tabela		=	'';
		$this->acao			=	'';
		$this->browser		=	$this->input->user_agent();
		$this->url			=	NULL;
	}


	public function add($registro_id, $tabela, $acao, $url)
	{
		try {
			$this->db->set('registro_id',	(int)$registro_id);
			$this->db->set('user_id',		$this->user_id);
			$this->db->set('user_ip',		$this->user_ip);
			$this->db->set('created',		$this->created);
			$this->db->set('tabela',		$tabela);
			$this->db->set('acao',			$acao);
			$this->db->set('browser',		$this->browser);
			$this->db->set('url',			$url);
			$this->db->insert($this->_tablename);
			$return_id = $this->db->insert_id();
		}
		catch(Exception $e)
		{
			show_error($e);
		}
		return $return_id;
	}


	public function get_last_logs($total = 10)
	{
		$this->db->order_by("id DESC");
		return $this->db->get($this->_tablename, (int)$total);
	}


	public function show_logs()
	{
		$logs	=	array();
		$query	=	$this->get_last_logs(7);

		foreach($query->result() as $log)
		{
			$this->load->model("Model_usuarios");
			$nome = $this->Model_usuarios->get(array("id" => $log->user_id), NULL, NULL);
			$name = explode(" ", $nome['nome']);

			array_push($logs, array(
				"nome"	=>	$name[0],
				"acao"	=>	$log->acao
			));
		}

		return $logs;
	}


	public function num_total()
	{
		return $this->db->get($this->_tablename)->num_rows();
	}

}

/* End of file model_logs.php */
/* Location: ./application/models/model_logs.php */
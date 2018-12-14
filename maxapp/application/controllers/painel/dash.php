<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Class created for skin cupcake
**/

class Dash extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->check_user();
	}


	public function index($modulo = NULL)
	{
// 		$model			=	load_model('generico', 'editorias');
// 		$query			=	$model->get_query(NULL, NULL, NULL, FALSE);
// 		$data['query']	=	$model->render_query($query);
		$data['logs']	=	$this->Model_logs->show_logs();

		$this->adm_template_load('lays/layout', 'dash', $data);
	}


	public function config()
	{
		// application/models/model_usuarios.php
		$model	=	load_model("usuarios");

		if(post("nome") != "" && post("email") != "" && post("username") != "")
		{
			$data = array(
				'nome'			=>	post("nome"),
				'email'			=>	post("email"),
				'username'		=>	post("username"),
				'password'		=>	do_hash(post("password"))
			);

			if(post("password") == "")
			{
				array_pop($data);
			}

			// application/models/my_model.php
			$user_id = $model->update($data, session('uid'), 'id');

			$data['retorno']	=	array('sucesso' => 'Atualizado com sucesso...!', 'error' => NULL);
		}
		else
		{
			$data['retorno']	=	array('sucesso' => NULL, 'error' => 'Todos os campos são obrigatórios!');
		}

		// application/models/my_model.php
		$data['res']			=	$model->get(array("id" => session('uid')), NULL, NULL);

		$this->adm_template_load('lays/layout', 'config', $data);
	}


	public function analytics()
	{
		$client = new SoapClient(NULL, array(
			'location' 	=>	'http://www.maxhostel.com.br/analytics/wsdl.php',
			'uri'		=>	'http://oab-rn.org.br/2013/painel',
			'trace'		=>	1)
		);

		/**
		 * Caso o cliente tenha sua propria conta no google insira o email e password no metodo abaixo.
		 * $result = $client->pageview($_ID, $email = NULL, $password = NULL);
		 */
		$result = $client->pageview('oab-rn.org.br', NULL, NULL);

		if(is_soap_fault($result))
		{
			trigger_error("SOAP FAULT: (faultcode: {$result->faultcode},
			faultstring: {$result->faultstring})", E_ERROR);
		}
		else
		{
			$days = array();

			foreach($result as $i => $value)
			{
				$dia = mktime(0, 0, 0, substr($i,4,2), substr($i,6,2), substr($i,0,4));

				array_push($days, array(
					"x" => date("Y-m-d", $dia),
					"y" => (int)$value['ga:visits'],
					"z" => (int)$value['ga:pageviews']
				));
			}

			echo json_encode($days);
		}
	}


	public function mensagens()
	{
		$model		=	$this->Model_contatos;

		// application/models/my_model.php
		$query		=	$model->get_query(NULL, array("excluido" => 0, "lido" => 0), NULL, TRUE, NULL, 5);
		
		$_ul = "<ul>";

			if($query->num_rows() > 0)
			{
				foreach($query->result() as $res)
				{
					$_ul .= "<li><a href='".site_url('painel/contatos/upd/'.$res->id.'/0')."'><span>".string_days($res->data)."</span>";
					$_ul .= "<h4>Nome:</h4> " . $res->nome . " [" . date("d/m/Y H:i", strtotime($res->data)) . "]";
					$_ul .= "</a><li>";
				}
			}
			else
			{
				$_ul .= "<li><a href='".site_url('painel/contatos')."'>";
				$_ul .= "<h4>Nenhum contato recebido!</h4>";
				$_ul .= "</a><li>";
			}

		$_ul .= "</ul>";

		// application/models/my_model.php
		$model->free_query($query);

		echo $_ul;
	}

}

/* End of file dash.php */
/* Location: ./application/controllers/dash.php */
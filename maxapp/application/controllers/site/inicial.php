<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inicial extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		// Definindo titulo da pagina
		$data['titulo']		=	"Inicial";
		
		$this->load->view('site/inicial', $data);		
	}
	
	public function financiamento()
	{
		// Definindo titulo da pagina
		$data['titulo']		=	"Financiamento";
		
		$this->load->view('site/index', $data);		
	}
	
	public function send2()
	{
		// Definindo titulo da pagina
		$data['titulo']		=	"Financiamento";
		
		###################     LISTA DOS CARROS 		#########################	
		$sql['where']      =	array("status"  =>  1, "excluido"   =>  0);
		$sql['order']      =	array("field" => "id", "hang" => "DESC");
		$sql['total']	   =   	true;

		$data['carros']   =   $this->get_data('carros', $pagina, $sql);
		
		$this->load->view('site/index2', $data);		
	}
	
	public function send3()
	{
		// Definindo titulo da pagina
		$data['titulo']		=	"Financiamento";
		
		###################     LISTA DOS CARROS 		#########################	
		$sql['where']      =	array("status"  =>  1, "excluido"   =>  0);
		$sql['order']      =	array("field" => "id", "hang" => "DESC");
		$sql['total']	   =   	true;

		$data['carros']   =   $this->get_data('carros', $pagina, $sql);
		
		###################     LISTA DOS PLANOS 		#########################	
		$sql1['where']      =	array("status"  =>  1, "excluido"   =>  0);
		$sql1['order']      =	array("field" => "id", "hang" => "DESC");
		$sql1['limit']	   =   	1;

		$data['plano']   =   $this->get_data('planos', $pagina, $sql1);
		
		$this->load->view('site/index3', $data);		
	}
	
	public function consorcio()
	{
		// Definindo titulo da pagina
		$data['titulo']		=	"Consórcio";
		
		###################     LISTA DOS CARROS 		#########################	
		$sql['where']      =	array("status"  =>  1, "excluido"   =>  0);
		$sql['order']      =	array("field" => "id", "hang" => "DESC");
		$sql['total']	   =   	true;

		$data['carros']   =   $this->get_data('carros', $pagina, $sql);
		
		$this->load->view('site/consorcio', $data);		
	}
	
	public function finish(){
		$data['titulo']  = 	"Finalizado";
		
		$this->load->view('site/finalizado', $data);
	}
	
	public function send()
	{
		if((post('nome') != '') && (post('email') != '') && (post('telefone')) && (post('active') == '0'))
		{
			$teltotal = substr(post("telefone"), 6);
		
			$tel = str_replace('-', '', $teltotal);
			// application/helpers/basics_helper.php
			$url = 'https://staging.api.meuprospere.com.br/v1/contacts';
			$data = array("name" => post("nome"), "phones" => array(0 => array('code' => 84, 'number' => $tel)), "emails" => array(0 => array('address' => post("email"))));
			$data_string = json_encode($data);
			
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'access-token: bJd3Xf8S7bSV2CLEVXxCeaGK',
			'uid: joaopaulo@maxmeio.com'));
			
			$result1 = curl_exec($ch);
			
			if($result1 === false)
			{
				$result1 = 'Curl error: ' . curl_error($ch);
			}
			else
			{	
			}
			
			curl_close($ch);
			
			// application/helpers/basics_helper.php
			$model			=	load_model('generico', 'simulacoes');

			$data = array(
				'data'			=>	date("Y-m-d H:i:s"),
				'nome'			=>	post("nome"),
				'email'			=>	post("email"),
				'telefone'		=>	post("telefone"),
				'carro_id'		=>	(int) post("veiculos"),
				'parcelas'		=>	(int) post("parcelas"),
				'entrada'		=>	post("entrada"),
				'lido'			=>	0,
				'status'		=>	0,
				'excluido'		=>	0
			);

			// application/models/my_model.php
			$model->insert($data);
			
			$sql['where']      =	array("status"  =>  1, "excluido"   =>  0, "id" => post("veiculos"));
			$sql['order']      =	array("field" => "id", "hang" => "DESC");
			$sql['limit']	   =  	1;
			
			$carros   =   $this->get_data('carros', $pagina, $sql);
			
			$sql2['where']      =	array("status"  =>  1, "excluido"   =>  0);
			$sql2['order']      =	array("field" => "id", "hang" => "DESC");
			$sql2['limit']	   	=  	1;
			
			$planos   =   $this->get_data('planos', $pagina, $sql2);
			
			if(calcula_porcentagem(post("entrada"), $carros[0]['valor']) > 40)
			{
				$coeficiente = 'coeficiente'.post('parcelas').'_'.'2';
			} else if((calcula_porcentagem(post("entrada"), $carros[0]['valor']) <= 40) && (calcula_porcentagem(post("entrada"), $carros[0]['valor']) >= 30))
			{
				$coeficiente = 'coeficiente'.post('parcelas').'_'.'1';
			} else
			{
				$coeficiente = 'coeficiente'.post('parcelas');
			}
			
			$plano = floatval($planos[0][$coeficiente]);	
			$entrada = floatval(post("entrada"));
			$valor = floatval($carros[0]['valor']);
			$tac = floatval($carros[0]['tac']);
					
			$result = calcula_parcela($entrada, $valor, $tac, $plano);
			$result = number_format($result, 2);
		}
		elseif (post('active') == '1'){
			
			$model			=	load_model('generico', 'simulacoes_credito');

			$data = array(
				'data'			=>	date("Y-m-d H:i:s"),
				'nome'			=>	post("nome"),
				'email'			=>	post("email"),
				'telefone'		=>	post("telefone"),
				'cpf'			=>	post("cpf"),
				'nascimento'	=>	post("nascimento"),
				'carro_id'		=>	(int) post("veiculos"),
				'parcelas'		=>	(int) post("parcelas"),
				'entrada'		=>	post("entrada"),
				'lido'			=>	0,
				'status'		=>	0,
				'excluido'		=>	0
			);

			// application/models/my_model.php
			$result = $model->insert($data);
			
		}
		
		echo json_encode($result);
	}
	
	/*public function send()
	{
		if((post('nome') != '') && (post('email') != '') && (post('telefone')) && (post('active') == '0'))
		{
			// application/helpers/basics_helper.php
			$model			=	load_model('generico', 'simulacoes');

			$data = array(
				'data'			=>	date("Y-m-d H:i:s"),
				'nome'			=>	post("nome"),
				'email'			=>	post("email"),
				'telefone'		=>	post("telefone"),
				'carro_id'		=>	(int) post("veiculos"),
				'parcelas'		=>	(int) post("parcelas"),
				'entrada'		=>	post("entrada"),
				'lido'			=>	0,
				'status'		=>	0,
				'excluido'		=>	0
			);

			// application/models/my_model.php
			$model->insert($data);
			
			$sql['where']      =	array("status"  =>  1, "excluido"   =>  0, "id" => post("veiculos"));
			$sql['order']      =	array("field" => "id", "hang" => "DESC");
			$sql['limit']	   =  	1;
			
			$carros   =   $this->get_data('carros', $pagina, $sql);
			
			$sql2['where']      =	array("status"  =>  1, "excluido"   =>  0, "carro_id" => post("veiculos"));
			$sql2['order']      =	array("field" => "id", "hang" => "DESC");
			$sql2['limit']	   	=  	1;
			
			$planos   =   $this->get_data('planos', $pagina, $sql2);
			
			$coeficiente = 'coeficiente'.post('parcelas');
			
			$plano = floatval($planos[0][$coeficiente]);	
			$entrada = floatval(post("entrada"));
			$valor = floatval($carros[0]['valor']);
			$tac = floatval($carros[0]['tac']);
					
			$result = calcula_parcela($entrada, $valor, $tac, $plano);
			$result = number_format($result, 2);
		}
		elseif (post('active') == '1'){
			
			$model			=	load_model('generico', 'simulacoes_credito');

			$data = array(
				'data'			=>	date("Y-m-d H:i:s"),
				'nome'			=>	post("nome"),
				'email'			=>	post("email"),
				'telefone'		=>	post("telefone"),
				'cpf'			=>	post("cpf"),
				'nascimento'	=>	post("nascimento"),
				'carro_id'		=>	(int) post("veiculos"),
				'parcelas'		=>	(int) post("parcelas"),
				'entrada'		=>	post("entrada"),
				'lido'			=>	0,
				'status'		=>	0,
				'excluido'		=>	0
			);

			// application/models/my_model.php
			$result = $model->insert($data);
			
		}
		
		echo json_encode($result);
	}*/
	
	public function send_consorcio()
	{
		if((post('nome') != '') && (post('email') != '') && (post('telefone')) && (post('active') == '0'))
		{
			// application/helpers/basics_helper.php
			$model			=	load_model('generico', 'simulacoes');

			$data = array(
				'data'			=>	date("Y-m-d H:i:s"),
				'nome'			=>	post("nome"),
				'email'			=>	post("email"),
				'telefone'		=>	post("telefone"),
				'carro_id'		=>	(int) post("veiculos"),
				'parcelas'		=>	(int) post("parcelas"),
				'entrada'		=>	post("entrada"),
				'lido'			=>	0,
				'status'		=>	0,
				'excluido'		=>	0
			);

			// application/models/my_model.php
			$model->insert($data);
			
			$parcelas = (int) post("parcelas");
			
			$sql['where']      =	array("status"  =>  1, "excluido"   =>  0, "id" => post("veiculos"));
			$sql['order']      =	array("field" => "id", "hang" => "DESC");
			$sql['limit']	   =  	1;
			
			$carros   =   $this->get_data('carros', $pagina, $sql);
			
			$sql2['where']      =	array("status"  =>  1, "excluido"   =>  0, "carro_id" => post("veiculos"), "parcelas" => $parcelas);
			$sql2['order']      =	array("field" => "id", "hang" => "DESC");
			$sql2['limit']	   	=  	1;
			
			$consorcio   =   $this->get_data('consorcio', $pagina, $sql2);
			
			$taxa_adm = floatval($consorcio[0]['taxa_adm']);	
			$fundo_res = floatval($consorcio[0]['fundo_res']);	
			$seguro = floatval($consorcio[0]['seguro']);	
			$entrada = floatval(post("entrada"));
			$valor = floatval($carros[0]['valor']);
					
			$result = calcula_consorcio($entrada, $valor, $taxa_adm, $fundo_res, $seguro, $parcelas);
			$result = number_format($result, 2);
		}
		elseif (post('active') == '1'){
			
			$model			=	load_model('generico', 'simulacoes_credito');

			$data = array(
				'data'			=>	date("Y-m-d H:i:s"),
				'nome'			=>	post("nome"),
				'email'			=>	post("email"),
				'telefone'		=>	post("telefone"),
				'cpf'			=>	post("cpf"),
				'nascimento'	=>	post("nascimento"),
				'carro_id'		=>	(int) post("veiculos"),
				'parcelas'		=>	(int) post("parcelas"),
				'entrada'		=>	post("entrada"),
				'lido'			=>	0,
				'status'		=>	0,
				'excluido'		=>	0
			);

			// application/models/my_model.php
			$result = $model->insert($data);
			
		}
		
		echo json_encode($result);
	}
	
	public function consulta()
	{
		$veiculo = $_POST['veiculo'];
		
		$sql['where']      =	array("status"  =>  1, "excluido"   =>  0, "carro_id" => $veiculo);
		$sql['order']      =	array("field" => "id", "hang" => "DESC");
		$sql['total']	   =   	true;

		$dados  =   $this->get_data('planos', $pagina, $sql);
		
		$coeficientes = array();
		
		for($i = 3; $i <= 11; $i++){
			$key = ('coeficiente'.($i - 2));
			$coeficientes[] = $dados[0][$key];
		}	
		
		$coeficientes[] = $dados[0]['telefone'];
		
		echo json_encode($coeficientes);
	}
}

/* End of file inicial.php */
/* Location: ./application/controllers/site/inicial.php */
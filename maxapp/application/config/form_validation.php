<?php defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(
	'atualizacao' => array(
		array(
			'field' => 'numero_seguranca',
			'label' => 'Número de Segurança',
			'rules' => 'required'
		),
		array(
			'field' => 'nome',
			'label' => 'Nome',
			'rules' => 'required'
		),
		array(
			'field' => 'endereco',
			'label' => 'Endereço',
			'rules' => 'required'
		),
		array(
			'field' => 'cidade',
			'label' => 'Cidade',
			'rules' => 'required'
		),
		array(
			'field' => 'email',
			'label' => 'E-mail',
			'rules' => 'required|valid_email'
		),
		array(
			'field' => 'naturalidade',
			'label' => 'Naturalidade',
			'rules' => 'required'
		),
		array(
			'field' => 'identidade',
			'label' => 'Identidade',
			'rules' => 'required'
		),
		array(
			'field' => 'cpf',
			'label' => 'CPF',
			'rules' => 'required'
		),
		array(
			'field' => 'cep',
			'label' => 'CEP',
			'rules' => 'required'
		),
		array(
			'field' => 'bairro',
			'label' => 'Bairro',
			'rules' => 'required'
		),
		array(
			'field' => 'uf',
			'label' => 'Estado',
			'rules' => 'required'
		),
		array(
			'field' => 'estado_civil',
			'label' => 'Estado Civil',
			'rules' => 'required'
		),
		array(
			'field' => 'data_nascimento',
			'label' => 'Data de nascimento',
			'rules' => 'required'
		),
		array(
			'field' => 'orgao_emissor',
			'label' => 'Orgão Emissor',
			'rules' => 'required'
		),
		array(
			'field' => 'inscricao_oab',
			'label' => 'Inscrição OAB',
			'rules' => 'required'
		),
		array(
			'field' => 'numero_residencial',
			'label' => 'Número Residencial',
			'rules' => 'required'
		)
	),
	'ouvidoria_login' => array(
		array(
			'field' => 'login',
			'label' => 'Login',
			'rules' => 'required'
		),
		array(
			'field' => 'senha',
			'label' => 'Senha',
			'rules' => 'required'
		)
	),
	'ouvidoria_cadastro' => array(
		array(
			'field' => 'nome',
			'label' => 'Nome',
			'rules' => 'required'
		),
		array(
			'field' => 'email',
			'label' => 'E-mail',
			'rules' => 'required|valid_email'
		),
		array(
			'field' => 'login',
			'label' => 'Login',
			'rules' => 'required'
		),
		array(
			'field' => 'senha',
			'label' => 'Senha',
			'rules' => 'required'
		)
	),
	'ouvidoria_add' => array(
		array(
			'field' => 'assunto',
			'label' => 'Assunto',
			'rules' => 'required'
		),
		array(
			'field' => 'setor_id',
			'label' => 'Setor',
			'rules' => 'required'
		),
		array(
			'field' => 'resposta',
			'label' => 'Forma de resposta',
			'rules' => 'required'
		),
		array(
			'field' => 'conteudo',
			'label' => 'Descrição',
			'rules' => 'required'
		)
	),
	'ouvidoria_perfil' => array(
		array(
			'field' => 'nome',
			'label' => 'Nome',
			'rules' => 'required'
		),
		array(
			'field' => 'email',
			'label' => 'E-mail',
			'rules' => 'required|valid_email'
		),
		array(
			'field' => 'login',
			'label' => 'Login',
			'rules' => 'required'
		)
	)
);

/* End of file form_validation.php */
/* Location: ./application/config/form_validation.php */
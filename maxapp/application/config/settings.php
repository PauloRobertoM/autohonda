<?php	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Settings Configuration
 *
 * Global configuration settings that apply to all system models.
**/

$config = array(
		// CONFIGURAÇÕES GERAIS
		"environment"			=>	FALSE, //FALSE=development; TRUE=production
		"titulo_sistema"		=>	'MaxPainel',
		"http_host"				=>	'http://' . $_SERVER['HTTP_HOST'],
		"path_root"				=>	FCPATH,

		// CONFIGURAÇÕES PARA O PAINEL
		"path_painel"			=>	'views/painel',
		"path_site"				=>	'views/site',
		"path_mobile"			=>	'views/mobile',
		"path_assets"			=>	'assets/',
		"assets_painel"			=>	'painel/',
		"email_from"            =>  'noreply@maxmeio.com',

		// CONFIGURACOES PARA O SITE
		"description_site"		=>	'',
		"author_site"			=>	'',
		"keywords_site"			=>	'',
		"copyright_site"		=>	'Todos os direitos reservados',
		"replyto_site"			=>	'atendimento@maxmeio.com',
		"titulo_site"			=>	'Ney Lopes Jr',
		"assets_site"			=>	'site/',
		"pagination_max_site"	=>	6,

		// CONFIGURACOES PARA O UPLOAD
		"allowed_types"			=>	'jpg|jpeg|gif|png|pdf|doc|xls|mp3|flv',
		"upload_path"			=>	FCPATH . '_ups/',
		"max_size"				=>	8192, // 8MB
		"max_width"				=>	4096,
		"overwrite"				=>	FALSE,
		"xss_clean"				=>	TRUE,
		"remove_spaces"			=>	TRUE,
		"encrypt_name"			=>	FALSE,

		"consumer_key"			=>	'5cllYEIKye8U2hsngSA035eS1',
		"consumer_secret"		=>	'BTK4qdFM1WxAnYhGLGmqJCvHX656ZM7oeGWdjVFBRBhQy9z0O0',
		"oauth_token"			=>	'169180911-dEPZ6R8TAy7JBnv3rHqxRhV5Enqp7OLrGJakH9xp',
		"oauth_token_secret"	=>	'idiy51HYsfkCV1pTs62BR55opCXZA4Qfm1Ju0PbqtEOoY',

		// CONFIGURACOES PARA A PAGINACAO PAINEL
		"pagination_max_reg"	=>	15
);

/* End of file settings.php */
/* Location: ./application/config/settings.php */
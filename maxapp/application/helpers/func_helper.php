<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Class created for skin cupcake
**/

if(!function_exists('ajuste_titulo'))
{
	function ajuste_titulo($textoAjustado)
	{
		//$textoAjustado = ascii_to_entities($textoAjustado);
		$textoAjustado = str_replace("Ã©",	"é", $textoAjustado);
		$textoAjustado = str_replace("Ã§",	"ç", $textoAjustado);
		$textoAjustado = str_replace("Ã£",	"ã", $textoAjustado);
		$textoAjustado = str_replace("Ã¡",	"á", $textoAjustado);
		$textoAjustado = str_replace("Ã³",	"ó", $textoAjustado);
		$textoAjustado = str_replace("Âª",	"ª", $textoAjustado);
		$textoAjustado = str_replace("Ãª",	"ê", $textoAjustado);
		//$textoAjustado = str_ireplace("",	"", $textoAjustado);
		//$textoAjustado = str_ireplace("",	"", $textoAjustado);
		//$textoAjustado = stripslashes($textoAjustado);
		//$textoAjustado = str_ireplace("<o:p>","", $textoAjustado);
		// Remove atributos de tags html como style, font...
		//$textoAjustado = preg_replace("/<(\w+) [^>]+>/", "<$1>", $textoAjustado);
		return $textoAjustado;
	}
}


if(!function_exists('make_link_twitter'))
{
	function make_link_twitter($text){
		return preg_replace('!(((f|ht)tp(s)?://)[-a-zA-Zа-яА-Я()0-9@:%_+.~#?&;//=]+)!i', '<a href="$1">$1</a>', $text);
	}
}


if(!function_exists('show_date_twitter'))
{
	function show_date_twitter($date)
	{
		$stf = 0;
		$cur_time = time();
		$diff = $cur_time - $date;
		$phrase = array('segundo','minuto','hora','dia','semana','mês','ano','decada');
		$length = array(1,60,3600,86400,604800,2630880,31570560,315705600);

		for($i = sizeof($length) - 1; ($i >= 0) && (($no =  $diff/$length[$i]) <= 1); $i--);

		if($i < 0)
			$i=0;
		$_time = $cur_time - ($diff % $length[$i]);
		$no = floor($no);
		if($no != 1)
			$phrase[$i] .= 's';
		$value = sprintf("%d %s ",$no,$phrase[$i]);

		if(($stf == 1) && ($i >= 1) && (($cur_tm-$_time) > 0))
			$value .= time_ago($_time);

		return $value.' atrás ';
	}
}


if(!function_exists('show_data_diferenca'))
{
	function show_data_diferenca($var_date)
	{
		$date_db		=	new DateTime($var_date);
		$date_hj		=	new DateTime(date("Y-m-d H:i:s"));
		$diferenca		=	$date_db->diff($date_hj);

		$ano = "";
		$mes = "";
		$dia = "";
		$hora = "";
		$minuto = "";

		if($diferenca->format('%y') > 0) {
			$ano	.=	$diferenca->format('%y');
			$ano	.=	($diferenca->format('%y') == 1) ? "A " : " A " ;
		}
		if($diferenca->format('%m') > 0) {
			$mes	.=	$diferenca->format('%m');
			$mes	.=	($diferenca->format('%m') == 1) ? "MES " : "MESES " ;
		}
		if($diferenca->format('%d') > 0) {
			$dia	.=	$diferenca->format('%d');
			$dia	.=	($diferenca->format('%d') == 1) ? "D " : "D " ;
		}
		if($diferenca->format('%h') > 0) {
			$hora	.=	$diferenca->format('%h');
			$hora	.=	($diferenca->format('%h') == 1) ? "H " : "H " ;
		}
		if($diferenca->format('%i') > 0) {
			$minuto	.=	$diferenca->format('%i');
			$minuto	.=	($diferenca->format('%i') == 1) ? "M " : "M " ;
		}
		
		return $ano . $mes . $dia . $hora . $minuto;
	}
}


if(!function_exists('busca_cep'))
{
	function busca_cep($cep = NULL, $format = 'json')
	{
		if(!is_null($cep))
		{
			$resultado = @file_get_contents('http://republicavirtual.com.br/web_cep.php?cep='.urlencode($cep).'&formato='.$format);

			if($resultado)
			{
				parse_str($resultado, $retorno);
				return $retorno;
			}
		}
	}
}


if(!function_exists('show_file_size'))
{
	function show_file_size($filepath)
	{
		$filesize = "0 KB";
	
		if(file_exists($filepath))
		{
			$units		=	array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
			$size		=	filesize($filepath);
			$power		=	$size > 0 ? floor(log($size, 1024)) : 0;
			$filesize	=	number_format($size / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
		}
	
		return $filesize;
	}
}


if(!function_exists('string_days'))
{
	function string_days($data)
	{
		$data	=	date("Y-m-d", strtotime($data));
	
		if($data == date("Y-m-d", strtotime("-1 day")))
		{
			$return = "Ontem";
		}
		elseif($data == date("Y-m-d", strtotime("now")))
		{
			$return = "Hoje";
		}
		elseif($data == date("Y-m-d", strtotime("+1 day")))
		{
			$return = "Amanhã";
		}
		else
		{
			setlocale(LC_ALL, 'pt_BR.UTF-8');
			$return = strftime("%b", strtotime($data));
		}
	
		return $return;
	}
}

if(!function_exists('date_week'))
{
	function date_week($data = NULL, $windows = NULL)
	{
		$dias_semana = array(
			0	=>	'Domingo',
			1	=>	'Segunda-Feira',
			2	=>	'Terça-Feira',
			3	=>	'Quarta-Feira',
			4	=>	'Quinta-Feira',
			5	=>	'Sexta-Feira',
			6	=>	'Sábado'
		);
		
		$dia = date('d', strtotime($data));
		$mes = date('m', strtotime($data));
		$ano = date('Y', strtotime($data));
		$jd = gregoriantojd($mes, $dia, $ano);
		return $dias_semana[jddayofweek($jd,0)];
	}
}

if(!function_exists('format_valor'))
{
	function format_valor($value)
	{
			$result = str_replace('.', '', $value);
			$result = str_replace(',', '.', $result);
			$result = floatval($result);

			return $result;
	}
}

if(!function_exists('calcula_porcentagem')){
	function calcula_porcentagem($entrada, $valor)
	{
		$porcentagem = ((100 * $entrada) / $valor);
		return $porcentagem;
	}
}

if(!function_exists('calcula_parcela'))
{
	function calcula_parcela($entrada, $credito, $tac, $coef)
	{
		$financiado = ($credito - $entrada);	
		$parcela = (($financiado + $tac) * $coef);
		return $parcela;
	}
}

if(!function_exists('calcula_consorcio'))
{
	function calcula_consorcio($entrada, $credito, $taxa_adm, $fundo_res, $seguro, $parcelas)
	{
		$fundo_com = (($credito - $entrada)/$parcelas);
		$taxas = $taxa_adm + $fundo_res + $seguro;
		$valor_taxas = ((($credito - $entrada) * $taxas)/100);
		$taxas_parcelas = ($valor_taxas/$parcelas);
		$parcela = ($fundo_com + $taxas_parcelas);
		return $parcela;
	}
}

if(!function_exists('format_decimals'))
{
	function format_decimals($value)
	{
			$result = str_replace(',', '.', $value);
			$result = floatval($result);

			return $result;
	}
}

if(!function_exists('format_telefone'))
{
	function format_telefone($value)
	{
		$result = str_replace([')','(',' ','-'], '', $value);
		
		return $result;
	}
}

if(!function_exists('format_data_in_time_db'))
{
	function format_data_in_time_db($data)
	{
		$date 	=	explode("/", $data);
	
		return $date[2] . "-" . $date[1] . "-" . $date[0] . " " . date('H:i:s');
	}
}


if(!function_exists('format_data_db'))
{
	function format_data_db($data)
	{
		$data 	=	explode(" ", $data);
		$date 	=	explode("/", $data[0]);
	
		return $date[2] . "-" . $date[1] . "-" . $date[0] . " " . $data[1];
	}
}


if(!function_exists('fdata_db'))
{
	function fdata_db($data = NULL)
	{
		if(!is_null($data) && !empty($data))
		{
			$date 	=	explode("/", $data);
			return $date[2] . "-" . $date[1] . "-" . $date[0];
		}
	}
}


if(!function_exists('show_extension_name'))
{
	function show_extension_name($file = NULL)
	{
		if(!is_null($file))
		{
			return str_replace(".", "", $file);
		}
	}
}


if(!function_exists('show_data_site'))
{
	function show_data_site($date, $formato = "%d de %B de %Y", $windows = NULL)
	{
		if(is_null($windows))
		{
			setlocale(LC_ALL, 'pt_BR.UTF-8');
		}
		else
		{
			setlocale(LC_TIME, 'ptb');
		}
	
		return strftime($formato, strtotime($date));
	}
}


if(!function_exists('set_name_file_random'))
{
	function set_name_file_random($file = NULL)
	{
		if(!is_null($file))
		{
			$fileParts		=	@pathinfo(strtolower($file['name']));
			$uniq_id		=	@md5(uniqid(rand(1,9999), true));
			return strtolower($uniq_id . "." . @$fileParts['extension']);
		}
	}
}


if(!function_exists('set_name_file_random2'))
{
	function set_name_file_random2($file = NULL)
	{
		if(!is_null($file))
		{
			$fileParts		=	@pathinfo(strtolower($file['name'][0]));
			$uniq_id		=	@md5(uniqid(rand(1,9999), true));
			return strtolower($uniq_id . "." . @$fileParts['extension']);
		}
	}
}


if(!function_exists('get_folder'))
{
	function get_folder($dir = NULL, $mode = NULL, $recursive = FALSE)
	{
		if(!is_null($dir))
		{
			if(!is_dir($dir))
			{
				$mode = (!is_null($mode)) ? $mode : 0777 ;
				@mkdir($dir, $mode, $recursive);
			}
			return $dir;
		}
	}
}


if(!function_exists('url_site'))
{
	function url_site($itens = NULL, $modulo = NULL)
	{
		$slash = '/';
	
		if(!is_null($itens))
		{
			if(is_object($itens))
			{
				return site_url($modulo . $slash . (int)$itens->id . $slash . url_title(word_limiter($itens->titulo, 15), '-', TRUE));
			}
			elseif(is_array($itens))
			{
				return site_url($modulo . $slash . (int)$itens['id'] . $slash . url_title(word_limiter($itens['titulo'], 15), '-', TRUE));
			}
		}
	}
}

if(!function_exists('url_newsletter'))
{
	function url_newsletter($itens = NULL, $modulo = NULL)
	{
		$slash = '/';
	
		if(!is_null($itens))
		{
			if(is_object($itens))
			{
				return site_url($modulo . $slash . "visualizar" . $slash . (int)$itens->id, TRUE);
			}
			elseif(is_array($itens))
			{
				return site_url($modulo . $slash . "visualizar" . $slash . (int)$itens['id'], TRUE);
			}
		}
	}
}


if(!function_exists('path_painel_assets'))
{
	function path_painel_assets($datastr = NULL)
	{
		$CI =& get_instance();
		$assets_site = base_url() . config('path_assets') . config('assets_painel');
		return $assets_site . $datastr;
	}
}


if(!function_exists('path_base_assets'))
{
	function path_base_assets($datastr = NULL)
	{
		$CI =& get_instance();
		$assets_site = base_url() . config('path_assets') . config('assets_site');
		return $assets_site . $datastr;
	}
}


if(!function_exists('lista_estados'))
{
	function lista_estados($select, $id=NULL, $type=1)
	{
		$array_state = array(
				"AC"	=>	'Acre',
				"AL"	=>	'Alagoas',
				"AM"	=>	'Amazonas',
				"AP"	=>	'Amapá',
				"BA"	=>	'Bahia',
				"CE"	=>	'Ceará',
				"DF"	=>	'Distrito Federal',
				"ES"	=>	'Espírito Santo',
				"GO"	=>	'Goiás',
				"MA"	=>	'Maranhão',
				"MG"	=>	'Minas Gerais',
				"MS"	=>	'Mato Grosso do Sul',
				"MT"	=>	'Mato Grosso',
				"PA"	=>	'Pará',
				"PB"	=>	'Paraíba',
				"PE"	=>	'Pernambuco',
				"PI"	=>	'Piauí',
				"PR"	=>	'Paraná',
				"RJ"	=>	'Rio de Janeiro',
				"RN"	=>	'Rio Grande do Norte',
				"RO"	=>	'Rondônia',
				"RR"	=>	'Roraima',
				"RS"	=>	'Rio Grande do Sul',
				"SC"	=>	'Santa Catarina',
				"SE"	=>	'Sergipe',
				"SP"	=>	'São Paulo',
				"TO"	=>	'Tocantins'
		);
	
		if($type == 1)
		{
			foreach($array_state as $row => $key)
			{
				$listas[$row] = $key;
			}
			return form_dropdown($select, $listas, $id, array('class'=>'uniform'));
		}
		elseif($type == 2)
		{
			return $array_state[$id];
		}
	}
}


if(!function_exists('show_mes_completo'))
{
	function show_mes_completo($mes)
	{
		switch($mes)
		{
			case 1:
				$mes	=	"Janeiro";
			break;
			case 2:
				$mes	=	"Fevereiro";
			break;
			case 3:
				$mes	=	"Março";
			break;
			case 4:
				$mes	=	"Abril";
			break;
			case 5:
				$mes	=	"Maio";
			break;
			case 6:
				$mes	=	"Junho";
			break;
			case 7:
				$mes	=	"Julho";
			break;
			case 8:
				$mes	=	"Agosto";
			break;
			case 9:
				$mes	=	"Setembro";
			break;
			case 10:
				$mes	=	"Outubro";
			break;
			case 11:
				$mes	=	"Novembro";
			break;
			case 12:
				$mes	=	"Dezembro";
			break;
		}
	
		return $mes;
	}
}


if(!function_exists('show_data_time'))
{
	function show_data_time($datatime = NULL)
	{
		if(!is_null($datatime))
		{
			$datatime	=	strtotime($datatime);
			$datatime	=	date("d/m/Y H:i:d", $datatime);
			return $datatime;
		}
		else
		{
			return date("d/m/Y H:i:s");
		}
	}
}


if(!function_exists('show_data'))
{
	function show_data($data = NULL)
	{
		if(!is_null($data))
		{
			$data	=	strtotime($data);
			$data	=	date("d/m/Y", $data);
			return $data;
		}
		else
		{
			return date("d/m/Y");
		}
	}
}


if(!function_exists('show_time'))
{
	function show_time($time = NULL)
	{
		if(!is_null($time))
		{
			$time	=	strtotime($time);
			$time	=	date("H:i:d", $time);
			return $time;
		}
		else
		{
			return date("H:i:s");
		}
	}
}


if(!function_exists('convert_money'))
{
	function convert_money($money=NULL, $slug='.')
	{
		$source = array('.', ',');
		$replace = array('', '.');
		$valor = str_replace($source, $replace, $money); //remove os pontos e substitui a virgula pelo ponto
		return $valor; //retorna o valor formatado para gravar no banco
	}
}


if(!function_exists('mdatetime'))
{
	function mdatetime($datastr = "%d de %B de %Y", $date = NULL, $windows = NULL)
	{
		date_default_timezone_set('America/Sao_Paulo');
	
		if(is_null($windows))
		{
			setlocale(LC_ALL, 'pt_BR.UTF-8');
		}
		else
		{
			setlocale(LC_TIME, 'ptb'); // Para IIS no windows
		}
	
		$dt = (is_null($date)) ? date('d-m-Y') : $date ;
	
		return strftime($datastr, strtotime($dt));
	}
}


if(!function_exists('data_ext'))
{
	function data_ext($data)
	{
		$dia = date('d',strtotime($data));
		$mes = date('m',strtotime($data));
		$ano = date('Y',strtotime($data));
	
		$dt = $dia . " de " . show_mes_completo($mes) . " de " . $ano;
	
		return $dt;
	}
}


if(!function_exists('show_radio_player'))
{
	function show_radio_player($file)
	{
		if(!empty($file))
		{
			$radio	=	'<object type="application/x-shockwave-flash" data="assets/painel/mp3/player_mp3.swf" width="157" height="20">';
			$radio	.=		'<param name="movie" value="assets/painel/mp3/player_mp3.swf" />';
			$radio	.=		'<param name="wmode" value="transparent" />';
			$radio	.=		'<param name="FlashVars" value="mp3='.$file.'&showstop=1&skin=assets/painel/mp3/player.png&slidercolor1=AF080D&slidercolor2=700509&sliderovercolor=b1e1fc&buttonovercolor=b1e1fc&volume=150"/>';
			$radio	.=	'</object>';
			return $radio;
		}
	}
}


if(!function_exists('show_image_player'))
{
	function show_image_player($url = NULL, $width = '100', $height = '100')
	{
		if(!is_null($url))
		{
			$code				=	get_cod_video($url);

			if($code[0] == "youtube")
			{
				return "<img src='http://i1.ytimg.com/vi/".$code[1]."/0.jpg' width='".$width."' height='".$height."' />";
			}
			elseif($code[0] == "vimeo")
			{
				$hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/".$code[1].".php"));
				return "<img src='".$hash[0]["thumbnail_large"]."' width='".$width."' height='".$height."' />";
			}
			else
			{
				return 'error => String invalid';
			}
		}
	}
}


if(!function_exists('show_video_player'))
{
	function show_video_player($string = NULL, $largura = '640', $altura = '390')
	{
		if(!is_null($string))
		{
			$code = get_cod_video($string);

			if($code[0] == "youtube")
			{
				$string = '<object width="'.$largura.'" height="'.$altura.'"><param name="movie" value="http://www.youtube.com/v/'.$code[1].'"></param><embed src="http://www.youtube.com/v/'.$code[1].'" type="application/x-shockwave-flash" width="'.$largura.'" height="'.$altura.'"></embed></object>';
			}
			elseif($code[0] == "vimeo")
			{
				$string = '<iframe src="http://player.vimeo.com/video/'.$code[1].'?title=0&amp;byline=0&amp;portrait=0" width="'.$largura.'" height="'.$altura.'" frameborder="0"></iframe>';
			}
			else
			{
				$string = 'error => String invalid';
			}
			return $string;
		}
	}
}


if(!function_exists('get_cod_video'))
{
	function get_cod_video($string)
	{
		if(FALSE !== filter_var($string, FILTER_VALIDATE_URL))
		{
			$url_video	=	substr($string, 0 , 7);
			if($url_video	==	"http://")
			{
				$rules = array(
						'#http://(www\.)?youtube\.com/(watch\?v=|v/)([^ &\n]+)(&.*?(\n|\s))?#i'	=>	'youtube__$3',
						'#http://(www\.)?vimeo\.com/([^ ?\n/]+)((\?|/).*?(\n|\s))?#i'			=>	'vimeo__$2'
				);

				foreach ($rules as $link => $player){
					$string = preg_replace($link, $player, $string);
				}

				return explode("__", $string);
			}
			else
			{
				return 'error => Code invalid';
			}
		}
	}
}


if(!function_exists('show_img_tag'))
{
	function show_img_tag($data = NULL)
	{
		if(!is_null($data) && isset($data['path']) && isset($data['folder']) && isset($data['file']))
		{
			$directory = '_ups/' . $data['path'] . "/" . $data['folder'];

			if(file_exists($directory . "/" . $data['file']))
			{
				$image_properties = array(
					'src'		=>	site_url($directory."/".$data['file']),
					'alt'		=>	(isset($data['alt']))		?	$data['alt']	:	"",
					'class'		=>	(isset($data['class']))		?	$data['class']	:	"",
					'width'		=>	(isset($data['width']))		?	$data['width']	:	"",
					'height'	=>	(isset($data['height']))	?	$data['height']	:	"",
					'title'		=>	(isset($data['title']))		?	$data['title']	:	"",
					'rel'		=>	(isset($data['rel']))		?	$data['rel']	:	""
				);
			}
			else
			{
				if(isset($data['width']) || isset($data['height']))
				{
					$w = (isset($data['width'])) ? $data['width'] : '100' ;
					$h = (isset($data['height'])) ? $data['height'] : '100' ;
	
					$image_properties = array(
						'src'		=>	'http://lorempixel.com/'.$w.'/'.$h,
						'alt'		=>	"Lorem Pixel",
						'class'		=>	(isset($data['class']))		?	$data['class']	:	"",
						'title'		=>	"Imagem não encontrada [Lorem Pixel]",
						'rel'		=>	(isset($data['rel']))		?	$data['rel']	:	""
					);
				}
				else
				{
					$image_properties = array(
						'src'		=>	'http://lorempixel.com/728/90'
					);
				}
			}

			return img($image_properties);
		}
	}
}


if(!function_exists('filter'))
{
	function filter($type, $variable_name, $filter = FILTER_DEFAULT, $options = NULL)
	{
		if (is_array($type))
		{
			if (isset($type[$variable_name]))
			{
				return filter_var($type[$variable_name], $filter, $options);
			}
			return null;
		}
		return filter_input($type, $variable_name, $filter, $options);
	}
}


if(!function_exists('ajuste_para_rss'))
{
	function ajuste_para_rss($texto)
	{
		$textoAjustado = utf8_encode(html_entity_decode(htmlspecialchars_decode($texto)));
		$textoAjustado = str_ireplace("&#039;", "'", $textoAjustado);
		$textoAjustado = str_ireplace("<?xml:namespace prefix = o ns = \"urn:schemas-microsoft-com:office:office\" />","", $textoAjustado);
		$textoAjustado = str_ireplace("","'", $textoAjustado);
		$textoAjustado = str_ireplace("","'", $textoAjustado);
		$textoAjustado = str_ireplace("",'"', $textoAjustado);
		$textoAjustado = str_ireplace("",'"', $textoAjustado);
		$textoAjustado = str_ireplace("","-", $textoAjustado);
		$textoAjustado = stripslashes($textoAjustado);
		$textoAjustado = str_ireplace("<o:p>","", $textoAjustado);
		// Remove atributos de tags html como style, font...
		$textoAjustado = preg_replace("/<(\w+) [^>]+>/", "<$1>", $textoAjustado);
		return $textoAjustado;
	}
}


if(!function_exists('get_requests'))
{
	function get_requests($requests='request')
	{
		$br = '<br />';
		echo "<pre>";
		if($requests == 'get')
		{
			echo "_GET" . $br;
			print_r($_GET);
		}
		elseif($requests == 'post')
		{
			echo "_POST" . $br;
			print_r($_POST);
		}
		elseif($requests == 'request')
		{
			echo "_REQUEST" . $br;
			print_r($_REQUEST);
		}
		elseif($requests == 'server')
		{
			echo "_SERVER" . $br;
			print_r($_SERVER);
		}
		elseif($requests == 'session')
		{
			echo "_SESSION" . $br;
			print_r($_SESSION);
		}
		elseif($requests == 'files')
		{
			echo "_FILES" . $br;
			print_r($_FILES);
		}
		elseif($requests == 'all')
		{
			echo "_GET" . $br;
			print_r($_GET);
			echo "_POST" . $br;
			print_r($_POST);
			echo "_REQUEST" . $br;
			print_r($_REQUEST);
			echo "_SERVER" . $br;
			print_r($_SERVER);
			echo "_SESSION" . $br;
			print_r($_SESSION);
			echo "_FILES" . $br;
			print_r($_FILES);
		}
		echo "</pre>";
	}
}


if(!function_exists('pre'))
{
	function pre($string, $die = 0)
	{
		echo "<pre>";
		print_r($string);
		echo "</pre>";
		if($die != 0)
		{
			die();
		}
	}
}


if(!function_exists('paginacao_site_inscritos'))
{
	function paginacao_site_inscritos($qtdeTotal, $max, $pag, $modulo, $url)
	{
		$pag = ($pag == 0) ? 1 : $pag ;
	
		if($qtdeTotal > $max)
		{
			$num = ceil($qtdeTotal/$max);
			if($pag<=4)
			{
				$ini=1;
				$fim=min($num, 8);
			}
			elseif($pag >= $num-4)
			{
				$ini = max($num-8, 1);
				$fim = $num;
			}
			else
			{
				$ini = $pag - 4;
				$fim = $pag + 4;
			}
	
			$paginas = '<ul class="pagination">';
			if($pag >= 2)
			{
				$paginas .= '<li><a href="' . site_url($modulo . '/busca/' . ($pag-1) . '/' . $url) . '" class="botao">&laquo; Anterior</a></li>';
			}
			for($i=$ini; $i<=$fim; $i++)
			{
				if($i==$pag)
				{
					if($i!=$num || $num!=1)
					{
						$paginas .= '<li class="active"><a class="botao">' . $i . '</a></li>';
					}
				}
				else
				{
					$paginas .= ' <li><a href="' . site_url($modulo . '/busca/' . $i . '/' . $url) . '" class="botao"> ' . $i . ' </a></li> ';
				}
			}
			if($num > $pag)
			{
				$paginas .= '<li><a href="' . site_url($modulo . '/busca/' . ($pag+1)) . '/' . $url . '" class="botao">Próximo &raquo;</a></li>';
			}
			$paginas .= '</ul>';
	
			return $paginas;
		}
	}
}


if(!function_exists('paginacao_site'))
{
	function paginacao_site($qtdeTotal, $max, $pag, $modulo, $url)
	{
		$pag = ($pag == 0) ? 1 : $pag ;
	
		if($qtdeTotal > $max)
		{
			$num = ceil($qtdeTotal/$max);
			if($pag<=4)
			{
				$ini=1;
				$fim=min($num, 8);
			}
			elseif($pag >= $num-4)
			{
				$ini = max($num-8, 1);
				$fim = $num;
			}
			else
			{
				$ini = $pag - 4;
				$fim = $pag + 4;
			}
	
			$paginas = '<ul class="pagination">';
			if($pag >= 2)
			{
				$paginas .= '<li><a href="' . site_url($modulo . '/' . ($pag-1) . '/' . $url) . '" class="botao">&laquo; Anterior</a></li>';
			}
			for($i=$ini; $i<=$fim; $i++)
			{
				if($i==$pag)
				{
					if($i!=$num || $num!=1)
					{
						$paginas .= '<li class="active"><a class="botao">' . $i . '</a></li>';
					}
				}
				else
				{
					$paginas .= ' <li><a href="' . site_url($modulo . '/' . $i . '/' . $url) . '" class="botao"> ' . $i . ' </a></li> ';
				}
			}
			if($num > $pag)
			{
				$paginas .= '<li><a href="' . site_url($modulo . '/' . ($pag+1)) . '/' . $url . '" class="botao">Próximo &raquo;</a></li>';
			}
			$paginas .= '</ul>';
	
			return $paginas;
		}
	}
}

//Por Modulo
if(!function_exists('paginacao_modulo'))
{
	function paginacao_modulo($qtdeTotal, $max, $pag, $modulo, $url, $mod)
	{
		$pag = ($pag == 0) ? 1 : $pag ;
	
		if($qtdeTotal > $max)
		{
			$num = ceil($qtdeTotal/$max);
			if($pag<=4)
			{
				$ini=1;
				$fim=min($num, 8);
			}
			elseif($pag >= $num-4)
			{
				$ini = max($num-8, 1);
				$fim = $num;
			}
			else
			{
				$ini = $pag - 4;
				$fim = $pag + 4;
			}
	
			$paginas = '<ul class="pagination">';
			if($pag >= 2)
			{
				$paginas .= '<li><a href="' . site_url($mod . '/' . ($pag-1) . '/' . $url) . '" class="botao">&laquo; Anterior</a></li>';
			}
			for($i=$ini; $i<=$fim; $i++)
			{
				if($i==$pag)
				{
					if($i!=$num || $num!=1)
					{
						$paginas .= '<li class="active"><a class="botao">' . $i . '</a></li>';
					}
				}
				else
				{
					$paginas .= ' <li><a href="' . site_url($mod . '/' . $i . '/' . $url) . '" class="botao"> ' . $i . ' </a></li> ';
				}
			}
			if($num > $pag)
			{
				$paginas .= '<li><a href="' . site_url($mod . '/' . ($pag+1)) . '/' . $url . '" class="botao">Próximo &raquo;</a></li>';
			}
			$paginas .= '</ul>';
	
			return $paginas;
		}
	}
}



if(!function_exists('paginacao_site_ajax'))
{
	function paginacao_site_ajax($qtdeTotal, $max, $pag)
	{
		$pag = ($pag == 0) ? 1 : $pag ;

		if($qtdeTotal > $max)
		{
			$num = ceil($qtdeTotal/$max);
			if($pag<=4)
			{
				$ini=1;
				$fim=min($num, 8);
			}
			elseif($pag >= $num-4)
			{
				$ini = max($num-8, 1);
				$fim = $num;
			}
			else
			{
				$ini = $pag - 4;
				$fim = $pag + 4;
			}

			if($pag >= 2)
			{
				$paginas = ($pag-1);
			}
			for($i=$ini; $i<=$fim; $i++)
			{
				if($i==$pag)
				{
					if($i!=$num || $num!=1)
					{
						$paginas = $i;
					}
				}
				else
				{
					$paginas = $i;
				}
			}
			if($num > $pag)
			{
				$paginas = ($pag+1);
			}

			return $paginas;
		}
	}
}


if(!function_exists('paginacao_painel'))
{
	function paginacao_painel($qtdeTotal, $max, $pag, $modulo, $url)
	{
		if($qtdeTotal > $max)
		{
			$num = ceil($qtdeTotal/$max);
			if($pag<=4)
			{
				$ini=1;
				$fim=min($num, 8);
			}
			elseif($pag >= $num-4)
			{
				$ini = max($num-8, 1);
				$fim = $num;
			}
			else
			{
				$ini = $pag - 4;
				$fim = $pag + 4;
			}
	
			$paginas = '';
			if($pag >= 2)
			{
				$paginas .= ' <a href="' . site_url("painel/" . $modulo . '/' . ($pag-1) . '/' . $url) . '" class="btn btn-small"> << </a>';
			}
			for($i=$ini; $i<=$fim; $i++)
			{
				if($i==$pag)
				{
					if($i!=$num || $num!=1)
					{
						$paginas .= '<a class="btn btn-small btn-inverse"> ' . $i . ' </a>';
					}
				}
				else
				{
					$paginas .= ' <a href="' . site_url("painel/" . $modulo . '/' . $i . '/' . $url) . '" class="btn btn-small"> ' . $i . ' </a> ';
				}
			}
			if($num > $pag)
			{
				$paginas .= ' <a href="' . site_url("painel/" . $modulo . '/' . ($pag+1) . '/' . $url) . '" class="btn btn-small"> >> </a> ';
			}
			return $paginas;
		}
	}
}


if(!function_exists('paginacao_painel_ajax'))
{
	function paginacao_painel_ajax($qtdeTotal, $max, $pag, $modulo)
	{
		if($qtdeTotal > $max)
		{
			$num = ceil($qtdeTotal/$max);
			if($pag<=4)
			{
				$ini=1;
				$fim=min($num, 8);
			}
			elseif($pag >= $num-4)
			{
				$ini = max($num-8, 1);
				$fim = $num;
			}
			else
			{
				$ini = $pag - 4;
				$fim = $pag + 4;
			}
	
			$paginas = '';
			if($pag >= 2)
			{
				$paginas .= ' <a href="javascript:void(0);" rel="'.$modulo.'" page="'.($pag-1).'" class="tip pagination" title="Voltar página"> <i class="icon-chevron-left"></i> </a>';
			}
			if($num > $pag)
			{
				$paginas .= ' <a href="javascript:void(0);" rel="'.$modulo.'" page="'.($pag+1).'" class="tip pagination" title="Avançar página"> <i class="icon-chevron-right"></i> </a>';
			}
			return $paginas;
		}
	}
}

if(!function_exists('twittar'))
{
	function twittar($msg = "...", $url = NULL)
	{
		if(!is_null($msg) && !is_null($url))
		{
			$consumer_key		=	"5cllYEIKye8U2hsngSA035eS1";
			$consumer_secret	=	"BTK4qdFM1WxAnYhGLGmqJCvHX656ZM7oeGWdjVFBRBhQy9z0O0";
			$oauth_token 		=	"169180911-dEPZ6R8TAy7JBnv3rHqxRhV5Enqp7OLrGJakH9xp";
			$oauth_token_secret	=	"idiy51HYsfkCV1pTs62BR55opCXZA4Qfm1Ju0PbqtEOoY";
	
			if($consumer_key != "" && $consumer_secret != "" && $oauth_token != "" && $oauth_token_secret != "")
			{
				include_once(APPPATH . "third_party/twitteroauth/twitteroauth/twitteroauth.php");
	
				$CI =& get_instance();
				$CI->load->library('googleurl');
	
				$msg = trim($msg);
				$url = $CI->googleurl->shortURL($url);
	
				$lenmsg = strlen($msg);
				$lenurl = strlen($url);
	
				if(($lenmsg + $lenurl) >= 140)
				{
					$msg = substr($msg, 0, (140 - ($lenurl + 2)));
					$msg .= "... ".$url;
				}
				else
				{
					$msg .= " - ".$url;
				}
	
				$connection			=	new TwitterOAuth($consumer_key, $consumer_secret, $oauth_token, $oauth_token_secret);
				if(!$connection)
				{
					$result =  "Erro ao enviar dados para o Twitter";
				}
				else
				{
					$result = $connection->post('statuses/update', array('status' => $msg));
				}
			}
		}
	}
}


/* End of file func_helper.php */
/* Location: ./application/helpers/func_helper.php */
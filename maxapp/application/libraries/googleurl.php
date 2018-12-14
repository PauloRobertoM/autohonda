<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * GoogleURL
 * 
 * A simple class to replace all existing URL's with the Goo.gl URL's
 * 
 * @author Bas van Dorst <info@basvandorst.nl>
 * @version 1.0 
 * @package Google
 */
class Googleurl {
    
	/**
	* URL of the Google URL shortener API
	* @var string
	*/
	private $_api = "http://goo.gl/api/shorten";

	/**
	* Curl timeout
	* @var int
	*/
	private $_curl_timeout = 10;

	/**
	* URL-regex (http://flanders.co.nz/2009/11/08/a-good-url-regular-expression-repost/)
	* @var string
	*/
	private $_urlregex = '/(?:(?:ht|f)tp(?:s?)\:\/\/|~\/|\/)?(?:\w+:\w+@)?(?:(?:[-\w]+\.)+(?:com|org|net|gov|mil|biz|info|mobi|name|aero|jobs|museum|travel|[a-z]{2}))(?::[\d]{1,5})?(?:(?:(?:\/(?:[-\w~!$+|.,=]|%[a-f\d]{2})+)+|\/)+|\?|#)?(?:(?:\?(?:[-\w~!$+|.,*:]|%[a-f\d{2}])+=(?:[-\w~!$+|.,*:=]|%[a-f\d]{2})*)(?:&(?:[-\w~!$+|.,*:]|%[a-f\d{2}])+=(?:[-\w~!$+|.,*:=]|%[a-f\d]{2})*)*)*(?:#(?:[-\w~!$+|.,*:=]|%[a-f\d]{2})*)?/';

	/**
	* Replace existing URL with the Goo.gl URL.
	* 
	* @param string|array $input_url
	* @return string If the request succeeded, return Goo.gl URL else return the input URL.
	*/
	public function shortURL($input_url) 
	{
		/**
		* Get the first array value if $input_url is an array (result shortText)
		*/
		$url = ( is_array( $input_url ) ) ? $input_url[0] : $input_url;

		/**
		* Build an array with POST-fields
		*/
		$post_fields = array(
			"security_token" => "null",
			"url" => $url
		);  

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->_api);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query( $post_fields ) );
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_TIMEOUT, $this->_curl_timeout);
		$output = json_decode( curl_exec($ch) ); // Google returns JSON-output
		curl_close($ch);

		return (isset( $output->short_url )) ? $output->short_url : $input_url;
	}

	/**
	* Replace all normal links in a text/HTML-document to Goo.gl links
	* 
	* @param string $input_text
	* @return array|null
	*/
	public function shortText($input_text) 
	{
		return preg_replace_callback(
			self::$_urlregex, 
			__CLASS__.'::shortURL', 
			$input_text
		);
	}
}
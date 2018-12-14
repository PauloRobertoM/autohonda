<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Class created for skin cupcake
**/

class Template {

	var $template_data = array();

	public function set($name, $value)
	{
		$this->template_data[$name] = $value;
	}



	public function load($template = '', $view = '' , $view_data = array(), $return = FALSE)
	{
		$this->CI =& get_instance();
		$this->set('contents', $this->CI->load->view($view, $view_data, TRUE));
		return $this->CI->load->view($template, $this->template_data, $return);
	}

}

/* End of file Template.php */
/* Location: ./application/libraries/Template.php */
<?php
class Captcha_generate extends CI_Controller {
	function index()
	{
		$this->load->helper('captcha');
		$vals = array(
	    'word' => '',
	    'img_path' => './captcha/',
	    'img_url' => base_url().'captcha/',
	    'font_path' => './path/to/fonts/texb.ttf',
	    'img_width' => '150',
	    'img_height' => 30,
	    'expiration' => 7200
	    );
		
		$cap = create_captcha($vals);
		echo $cap['image'].'~'.$cap['word'];
	}
}
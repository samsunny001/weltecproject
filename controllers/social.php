<?php
class Social extends CI_Controller {

	public function index()
	{
		$data = array(
		'body' => 'social',
		'menu'	=> 'social',
		'page_title' => 'Social | WelTec Alumni',
		'meta_keywords' => '',
		'meta_description' => '',
		'heading' => 'Social'
		);
		$this->load->view('general',$data);
	}
}
?>
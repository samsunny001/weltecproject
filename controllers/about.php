<?php
class About extends CI_Controller {

	public function index()
	{
		$data = array(
		'body' => 'about',
		'menu'	=> 'about',
		'page_title' => 'About | WelTec Alumni',
		'meta_keywords' => '',
		'meta_description' => '',
		'heading' => 'Welcome to WelTec Alumni'
		);
		$this->load->view('general',$data);
	}
}
?>
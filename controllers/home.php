<?php
class Home extends CI_Controller {

	public function index()
	{
		$data = array(
		'body' => 'home',
		'menu'	=> 'home',
		'page_title' => 'Welcome to WelTec Alumni',
		'meta_keywords' => '',
		'meta_description' => '',
		'heading' => 'Welcome to WelTec Alumni'
		);
		$this->load->view('general',$data);
	}
}
?>
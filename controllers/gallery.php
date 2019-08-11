<?php
class Gallery extends CI_Controller {

	public function index()
	{
		$this->load->model('gallery_model');
		$data = array(
		'body' => 'gallery',
		'menu'	=> 'gallery',
		'page_title' => 'Gallery | WelTec Alumni',
		'meta_keywords' => '',
		'meta_description' => '',
		'heading' => 'Gallery',
		'records' => $this->gallery_model->show_pictures()
		);
		$this->load->view('general',$data);
	}
	
	public function add()
	{
		$this->load->view('gallery-add');
	}
	
	public function save()
	{
		$this->load->model('gallery_model');
		$this->gallery_model->save_picture();
	}
}
?>
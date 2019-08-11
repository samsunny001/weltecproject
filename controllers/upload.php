<?php

class Upload extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}
	/*
	function index()
	{
		$this->load->view('upload_form', array('error' => ' ' ));
	}
	*/
	function do_upload()
	{
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'doc|docx|pdf';
		$config['max_size']	= '2048';
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload())
		{
			$data = array('upload_data' => $this->upload->data());
			$this->load->model('user_model');
			$data['rows'] = $this->user_model->profile();
			$data['message'] = '<br />Upload fail!!';
			$this->load->view('upload_cv',$data);
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			$this->load->model('user_model');
			$data['rows'] = $this->user_model->profile();
			$data['message'] = '<br />Upload Success!!';
			$this->load->view('upload_cv',$data);
		}
	}
}
?>
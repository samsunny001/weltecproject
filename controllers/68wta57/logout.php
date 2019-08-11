<?php
class Logout extends CI_Controller
{
	function _construct()
	{
		parent::construct();
	}
	
	function index()
	{
		if($this->session->userdata('user_type')=='a') $redirect=admin_base_path(); else $redirect=base_url();
		$this->load->model('registration_model');
		$this->registration_model->update_login_log();
		$this->session->sess_destroy();
		redirect($redirect,'refresh');
	}
}
?>
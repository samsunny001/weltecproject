<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller {
	public function index()
	{
		if($this->session->userdata('uid'))
		{
			$data = array(
			'body' => 'admin/dashboard',
			'active_menu'	=> 'db',
			'heading' => 'Dashboard'
			);
			$this->load->view('admin/template_view',$data);
		}
		else 
		{
			$this->login();
		}		
	}
	
	function login()
	{
		$this->load->view('admin/login_template_view');
	}
	
	function verifylogin()
	{
		$this->form_validation->set_rules('username','Username','required|xss_clean|max_length[75]');
		$this->form_validation->set_rules('password','Password','required|xss_clean|max_length[75]|callback_checklogincredentials');
		if($this->form_validation->run() == FALSE)
		{
			$this->login();
		}
		else
		{
			redirect(admin_base_path(),'refresh');
		}
	}
	
	function checklogincredentials($password)
	{
		$this->load->model('admin_new_model');
		$username=$this->input->post('username');
		$result=$this->admin_new_model->check_login($username,$password);
		
		if($result)
		{
			$sess_array=array(
			'user_name' => $username,
			'name' => $result[0]['name'],
			'uid' => $result[0]['id']
			);
			
			$this->session->set_userdata($sess_array);
			return true;
		}
		else
		{
			$this->form_validation->set_message('checklogincredentials','Incorrect username or password');
			return false;
		}
	}
	
	function logout()
	{
		$this->session->sess_destroy();
		redirect(admin_base_path(),'refresh');
	}
	
	function changeemail()
	{
		if($this->session->userdata('uid'))
		{
			$this->load->model('admin_new_model');
			$data=array(
			'body' => 'admin/change_email',
			'heading' => 'Change Email',
			'record' => $this->admin_new_model->get_cur_data()
			);
			$this->load->view('admin/template_view',$data);
		}
		else 
		{
			redirect(admin_base_path(),'refresh');
		}
	}
	
	function saveemail()
	{
		if($this->session->userdata('uid'))
		{
			$this->form_validation->set_rules('email', 'Email', 'required|xss_clean|max_length[50]|valid_email');
			if ($this->form_validation->run() == FALSE)
			{
				$this->session->set_userdata('ce_msg', validation_errors());
			}
			else 
			{
				$this->load->model('admin_new_model');
				$this->admin_new_model->change_email();
				$this->session->set_userdata('ce_msg', 'Successfully changed the email address');
				redirect(admin_base_path().'home/changeemail','refresh');
			}
		}
		else 
		{
			redirect(admin_base_path(),'refresh');
		}
	}
}
?>
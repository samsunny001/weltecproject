<?php
class Changepassword extends CI_Controller
{
	public function index()
	{
		if($this->session->userdata('uid'))
		{
			$this->load->model('admin_new_model');
			$data=array(
			'body' => 'admin/change_password',
			'heading' => 'Change Password'
			);
			$this->load->view('admin/template_view',$data);
		}
		else 
		{
			redirect(admin_base_path(),'refresh');
		}
		
	}
	
	function savenewpw()
	{
		if($this->session->userdata('uid'))
		{
			$this->form_validation->set_rules('cur_pw','Current Password','required|xss_clean|max_length[50]|callback_check_curpw');
			$this->form_validation->set_rules('new_pw','New Password','required|xss_clean|max_length[50]|callback_check_pw_strength');
			if($this->form_validation->run() == FALSE)
			{
				$this->session->set_userdata('cpw_msg', validation_errors());
			}
			else 
			{
				$this->load->model('admin_new_model');
				$this->admin_new_model->changepw($this->input->post('new_pw'),$this->session->userdata('uid'));
				$this->session->set_userdata('cpw_msg', 'The password has been changed.');
			}
			redirect(admin_base_path().'changepassword','refresh');
		}
		else
		{
			redirect(admin_base_path(),'refresh');
		}
	}
	
	function check_curpw($password)
	{
		$this->load->model('admin_new_model');				
		$val=$this->admin_new_model->validate_cur_pw($password,$this->session->userdata('uid'));
		
		if($val==FALSE)
		{
			$this->form_validation->set_message('check_curpw','The current password is wrong.');
			return FALSE;
		}
		else 
		{
			return TRUE;
		}
	}

	function check_pw_strength($password)
	{
		$this->load->model('register_model');				
		$val=$this->register_model->password_strength_checker($password,$this->session->userdata('user_name'));
		if($val!="")
		{
			$this->form_validation->set_message('check_pw_strength',$val);
			return FALSE;
		}
		else 
		{
			return TRUE;
		}
		
	}
}
?>
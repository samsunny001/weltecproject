<?php
class Registration extends CI_Controller {

	public function index()
	{
		if($this->session->userdata('uid'))
		{
			$this->load->model('register_model');
			$total_rows = $this->register_model->data_count();
			if($total_rows>0)
			{
				$per_page = 25;
				$pages= ceil($total_rows/$per_page);
				if($this->input->post('page')) 
				{
					$page = (int) $this->input->post('page',TRUE); 
					if(!is_numeric($page)) $page=1;
				}
				else 
				{
					$page=1;
				}
				
				if($page>$pages) $page=$pages; elseif($page<1) $page=1;
				$lower=($page-1)*$per_page;
				if(($lower+$per_page)>$total_rows) $limit=$total_rows-$lower; else $limit=$per_page;
				$records = $this->register_model->list_data($lower,$limit);
			}
			else 
			{
				$records = FALSE;
				$pages = $page = $lower="";
			}
			$data = array(
			'body' => 'admin/registration',
			'active_menu'	=> 'registrations',
			'heading' => 'Registrations',
			'records' => $records,
			'pages'			=>	$pages,
			'page'			=>	$page,
			'lower'			=>	$lower,
			'total_rows'	=>	$total_rows
			);
			$this->load->view('admin/template_view',$data);
		}
		else
		{
			redirect(admin_base_path(),'refresh');
		}
	}
	
	function block()
	{
		if($this->session->userdata('uid'))
		{
			$this->form_validation->set_rules('usrid', 'Registration Id', 'required|xss_clean');
			if ($this->form_validation->run() == FALSE)
			{
				$this->session->set_userdata('reg_msg', validation_errors());
			}
			else
			{
				$this->load->model('register_model');
				$this->register_model->blockuser($this->input->post('usrid'));
				$this->session->set_userdata('reg_msg', 'User blocked!');
			}
			redirect(admin_base_path().'registration','refresh');
		}
		else
		{
			redirect(admin_base_path(),'refresh');
		}
	}
	
	function activate()
	{
		if($this->session->userdata('uid'))
		{
			$this->form_validation->set_rules('usrid', 'Registration Id', 'required|xss_clean');
			if ($this->form_validation->run() == FALSE)
			{
				$this->session->set_userdata('reg_msg', validation_errors());
			}
			else
			{
				$this->load->model('register_model');
				$this->register_model->activate_reg($this->input->post('usrid'), 2);
				$this->session->set_userdata('reg_msg', 'User activated!');
			}
			redirect(admin_base_path().'registration','refresh');
		}
		else
		{
			redirect(admin_base_path(),'refresh');
		}
	}
}
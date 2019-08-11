<?php
class Job extends CI_Controller {

	public function index()
	{
		if($this->session->userdata('uid'))
		{
			$this->load->model('job_oppurtunities_model');
			$total_rows = $this->job_oppurtunities_model->data_count();
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
				$records = $this->job_oppurtunities_model->list_data($lower,$limit);
			}
			else 
			{
				$records = FALSE;
				$pages = $page = $lower="";
			}
			$data = array(
			'body' => 'admin/job',
			'active_menu'	=> 'job',
			'heading' => 'Job Oppurtunities',
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
	
	function addnew()
	{
		if($this->session->userdata('uid'))
		{
			$data = array(
			'body' => 'admin/job_add_view',
			'active_menu'	=> 'job',
			'heading' => 'Job Oppurtunities'
			);
			$this->load->view('admin/template_view',$data);
		}
		else
		{
			redirect(admin_base_path(),'refresh');
		}
	}
	
	function edit($id)
	{
		if($this->session->userdata('uid'))
		{
			$this->load->model('job_oppurtunities_model');
			$data = array(
			'body' => 'admin/job_edit_view',
			'active_menu'	=> 'job',
			'heading' => 'Job Oppurtunities',
			'id'	=>	$id
			);
			$this->load->view('admin/template_view',$data);
		}
		else
		{
			redirect(admin_base_path(),'refresh');
		}
	}
	
	public function save()
	{
		if($this->session->userdata('uid'))
		{
			$this->form_validation->set_rules('jobtitle', 'Job Title', 'required|xss_clean|max_length[100]');
			$this->form_validation->set_rules('department', 'Department', 'xss_clean|exact_length[1]');
			$this->form_validation->set_rules('company', 'Company', 'required|xss_clean|max_length[100]');
			$this->form_validation->set_rules('description', 'Brief Description', 'required|xss_clean|max_length[5000]');
			$this->form_validation->set_rules('city', 'Location', 'required|xss_clean|max_length[100]');
			$this->form_validation->set_rules('address', 'Address', 'required|xss_clean|max_length[500]');
			$this->form_validation->set_rules('email', 'Email', 'required|xss_clean|max_length[100]|valid_email');
			$this->form_validation->set_rules('closing_date', 'Closing Date', 'xss_clean|exact_length[10]');
			if ($this->form_validation->run() == FALSE)
			{
				$this->session->set_userdata('job_msg', validation_errors());
			}
			else
			{
				$this->load->model('job_oppurtunities_model');
				$this->job_oppurtunities_model->save();
				$this->session->set_userdata('job_msg', 'Job added!');
			}
			redirect(admin_base_path().'job','refresh');
		}
		else
		{
			redirect(admin_base_path(),'refresh');
		}
	}

	public function savechanges()
	{
		if($this->session->userdata('uid'))
		{
			$this->form_validation->set_rules('jobtitle', 'Job Title', 'required|xss_clean|max_length[100]');
			$this->form_validation->set_rules('department', 'Department', 'xss_clean|exact_length[1]');
			$this->form_validation->set_rules('company', 'Company', 'required|xss_clean|max_length[100]');
			$this->form_validation->set_rules('description', 'Brief Description', 'required|xss_clean|max_length[5000]');
			$this->form_validation->set_rules('city', 'Location', 'required|xss_clean|max_length[100]');
			$this->form_validation->set_rules('address', 'Address', 'required|xss_clean|max_length[500]');
			$this->form_validation->set_rules('email', 'Email', 'required|xss_clean|max_length[100]|valid_email');
			$this->form_validation->set_rules('closing_date', 'Closing Date', 'xss_clean|exact_length[10]');
			$this->form_validation->set_rules('jobid', 'Job ID', 'required|xss_clean');
			if ($this->form_validation->run() == FALSE)
			{
				$this->session->set_userdata('job_msg', validation_errors());
			}
			else
			{
				$this->load->model('job_oppurtunities_model');
				$this->job_oppurtunities_model->savechanges();
				$this->session->set_userdata('job_msg', 'Job updated!');
			}
			redirect(admin_base_path().'job','refresh');
		}
		else
		{
			redirect(admin_base_path(),'refresh');
		}
	}

	public function delete()
	{
		if($this->session->userdata('uid'))
		{
			$this->form_validation->set_rules('jobid', 'Job ID', 'required|xss_clean');
			if ($this->form_validation->run() == FALSE)
			{
				$this->session->set_userdata('job_msg', validation_errors());
			}
			else
			{
				$this->load->model('job_oppurtunities_model');
				$this->job_oppurtunities_model->delete();
				$this->session->set_userdata('job_msg', 'Job deleted!');
			}
			redirect(admin_base_path().'job','refresh');
		}
		else
		{
			redirect(admin_base_path(),'refresh');
		}
	}
	
	public function applns()
	{
		if($this->session->userdata('uid'))
		{
			$this->load->model('job_oppurtunities_model');
			$total_rows = $this->job_oppurtunities_model->applns_count();
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
				$records = $this->job_oppurtunities_model->list_applns($lower,$limit);
			}
			else 
			{
				$records = FALSE;
				$pages = $page = $lower="";
			}
			$data = array(
			'body' => 'admin/jobapplns',
			'active_menu'	=> 'job',
			'heading' => 'Job Applications',
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
}
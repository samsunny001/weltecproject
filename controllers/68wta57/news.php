<?php
class News extends CI_Controller {

	public function index()
	{
		if($this->session->userdata('uid'))
		{
			$this->load->model('news_model');
			$total_rows = $this->news_model->data_count();
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
				$records = $this->news_model->list_data($lower,$limit);
			}
			else 
			{
				$records = FALSE;
				$pages = $page = $lower="";
			}
			$data = array(
			'body' => 'admin/news',
			'active_menu'	=> 'news',
			'heading' => 'News',
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
			'body' => 'admin/news_add_view',
			'active_menu'	=> 'news',
			'heading' => 'News'
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
			$this->load->model('news_model');
			$data = array(
			'body' => 'admin/news_edit_view',
			'active_menu'	=> 'news',
			'heading' => 'News',
			'id' => $id
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
			$this->form_validation->set_rules('primary_title', 'Primary Title', 'required|xss_clean|max_length[100]');
			$this->form_validation->set_rules('secondary_title', 'Secondary Title', 'xss_clean|max_length[100]');
			$this->form_validation->set_rules('news_date', 'Date', 'required|xss_clean|exact_length[10]');
			$this->form_validation->set_rules('content', 'News Content', 'required|xss_clean|max_length[5000]');
			if ($this->form_validation->run() == FALSE)
			{
				$this->session->set_userdata('news_msg', validation_errors());
			}
			else
			{
				$this->load->model('news_model');
				$this->news_model->save();
				$this->session->set_userdata('news_msg', 'News added!');
			}
			redirect(admin_base_path().'news','refresh');
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
			$this->form_validation->set_rules('primary_title', 'Primary Title', 'required|xss_clean|max_length[100]');
			$this->form_validation->set_rules('secondary_title', 'Secondary Title', 'xss_clean|max_length[100]');
			$this->form_validation->set_rules('news_date', 'Date', 'required|xss_clean|exact_length[10]');
			$this->form_validation->set_rules('content', 'News Content', 'required|xss_clean|max_length[5000]');
			$this->form_validation->set_rules('newsid', 'News Id', 'required|xss_clean');
			if ($this->form_validation->run() == FALSE)
			{
				$this->session->set_userdata('news_msg', validation_errors());
			}
			else
			{
				$this->load->model('news_model');
				$this->news_model->savechanges();
				$this->session->set_userdata('news_msg', 'News updated!');
			}
			redirect(admin_base_path().'news','refresh');
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
			$this->form_validation->set_rules('newsid', 'News Id', 'required|xss_clean');
			if ($this->form_validation->run() == FALSE)
			{
				$this->session->set_userdata('news_msg', validation_errors());
			}
			else
			{
				$this->load->model('news_model');
				$this->news_model->delete();
				$this->session->set_userdata('news_msg', 'News deleted!');
			}
			redirect(admin_base_path().'news','refresh');
		}
		else
		{
			redirect(admin_base_path(),'refresh');
		}
	}
}
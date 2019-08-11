<?php
class Donation extends CI_Controller {

	public function index()
	{
		if($this->session->userdata('uid'))
		{
			$this->load->model('donation_model');
			$total_rows = $this->donation_model->data_count();
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
				$records = $this->donation_model->list_data($lower,$limit);
			}
			else 
			{
				$records = FALSE;
				$pages = $page = $lower="";
			}
			$data = array(
			'body' => 'admin/donation',
			'active_menu'	=> 'donations',
			'heading' => 'Donations',
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
	
	function changestatus()
	{
		if($this->session->userdata('uid'))
		{
			$this->form_validation->set_rules('donid', 'Donation Id', 'required|xss_clean');
			$this->form_validation->set_rules('pstatus', 'Payment Status', 'required|xss_clean');
			if ($this->form_validation->run() == FALSE)
			{
				$this->session->set_userdata('don_msg', validation_errors());
			}
			else
			{
				$this->load->model('donation_model');
				$this->donation_model->changestatus();
				$this->session->set_userdata('don_msg', 'Payment status updated!');
			}
			redirect(admin_base_path().'donation','refresh');
		}
		else
		{
			redirect(admin_base_path(),'refresh');
		}
	}
}
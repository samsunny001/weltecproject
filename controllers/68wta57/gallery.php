<?php
class Gallery extends CI_Controller {

	public function index()
	{
		if($this->session->userdata('uid'))
		{
			$this->load->model('gallery_model');
			$data = array(
			'body' => 'admin/gallery_list_view',
			'active_menu'	=> 'gallery',
			'heading' => 'Gallery',
			'records' => $this->gallery_model->show_pictures()
			);
			$this->load->view('admin/template_view',$data);
		}
		else
		{
			redirect(admin_base_path(),'refresh');
		}
	}
	
	public function addnew()
	{
		if($this->session->userdata('uid'))
		{
			$data = array(
			'body' => 'admin/gallery_add_view',
			'active_menu'	=> 'gallery',
			'heading' => 'Gallery'
			);
			$this->load->view('admin/template_view',$data);
		}
		else
		{
			redirect(admin_base_path(),'refresh');
		}
	}
	
	public function edit($id)
	{
		if($this->session->userdata('uid'))
		{
			$this->load->model('gallery_model');
			$data = array(
			'body' => 'admin/gallery_edit_view',
			'active_menu'	=> 'gallery',
			'heading' => 'Gallery',
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
			$this->form_validation->set_rules('caption', 'Caption', 'xss_clean|max_length[100]');
			if ($this->form_validation->run() == FALSE)
			{
				$this->session->set_userdata('gal_msg', validation_errors());
			}
			else
			{
				$this->load->model('gallery_model');
				$this->gallery_model->save_picture();
				$this->session->set_userdata('gal_msg', 'Image uploaded!');
			}
			redirect(admin_base_path().'gallery/addnew','refresh');
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
			$this->form_validation->set_rules('caption', 'Caption', 'xss_clean|max_length[100]');
			$this->form_validation->set_rules('picid', 'Image Id', 'required|xss_clean');
			if ($this->form_validation->run() == FALSE)
			{
				$this->session->set_userdata('gal_msg', validation_errors());
			}
			else
			{
				$this->load->model('gallery_model');
				$this->gallery_model->savechanges();
				$this->session->set_userdata('gal_msg', 'Saved the changes made!');
			}
			redirect(admin_base_path().'gallery','refresh');
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
			$this->form_validation->set_rules('picid', 'Image Id', 'required|xss_clean');
			if ($this->form_validation->run() == FALSE)
			{
				$this->session->set_userdata('gal_msg', validation_errors());
			}
			else
			{
				$this->load->model('gallery_model');
				$this->gallery_model->delete();
				$this->session->set_userdata('gal_msg', 'Image deleted!');
			}
			redirect(admin_base_path().'gallery','refresh');
		}
		else
		{
			redirect(admin_base_path(),'refresh');
		}
	}
}
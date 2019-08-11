<?php
class Donation extends CI_Controller {

	public function index()
	{
		$data = array(
		'body' => 'donation',
		'menu'	=> 'donation',
		'page_title' => 'Donation | WelTec Alumni',
		'meta_keywords' => '',
		'meta_description' => '',
		'heading' => 'Donation'
		);
		$this->load->view('general',$data);
	}
	
	public function save()
	{
		$this->form_validation->set_rules('first_name', 'First Name', 'required|xss_clean|max_length[32]');
		$this->form_validation->set_rules('last_name', 'Last Name', 'xss_clean|max_length[64]');
		$this->form_validation->set_rules('address1', 'Address Line 1', 'required|xss_clean|max_length[100]');
		$this->form_validation->set_rules('address2', 'Address Line 2', 'xss_clean|max_length[100]');
		$this->form_validation->set_rules('city', 'City', 'required|xss_clean|max_length[50]');
		$this->form_validation->set_rules('country_code', 'Country', 'required|xss_clean|max_length[3]');
		$this->form_validation->set_rules('email', 'Email', 'required|xss_clean|max_length[127]|valid_email');
		$this->form_validation->set_rules('amount', 'Amount', 'required|xss_clean|max_length[8]|numeric');
		$this->form_validation->set_rules('donationtype', 'Type of Donation', 'required|xss_clean|max_length[34]');
	
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_userdata('donate_msg', validation_errors());
		}
		else
		{
			$this->load->model('donation_model');
			$this->donation_model->save();
			//$this->session->set_userdata('donate_msg', 'Thank you for your donation');
			
			$this->load->view('to_payment_gateway');
		}
	}
}
?>
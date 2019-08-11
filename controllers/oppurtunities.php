<?php
class Oppurtunities extends CI_Controller {

	public function index()
	{
		$this->load->model('job_oppurtunities_model');
		$data = array(
		'body' => 'oppurtunities',
		'menu'	=> 'oppurtunities',
		'page_title' => 'Job Oppurtunities | WelTec Alumni',
		'meta_keywords' => '',
		'meta_description' => '',
		'heading' => 'Job Oppurtunities',
		'records' => $this->job_oppurtunities_model->get_oppurtunities()
		);
		$this->load->view('general',$data);
	}
	
	public function applynow($id)
	{
		$this->load->model('job_oppurtunities_model');
		$this->load->model('user_model');
		$job = $this->job_oppurtunities_model->get_job_details($id);
		if($this->session->userdata('is_logged_in') && $job != FALSE)
		{
			$rows = $this->user_model->user_profile();
			if ($rows[0]['user_cv'] != '' && file_exists('./uploads/'.$rows[0]['user_cv']))
			{
				$data = array(
				'job_id' => $id,
				'uid'	=>	$rows[0]['id'],
				'fname' => $rows[0]['firstname'],
				'lname' => $rows[0]['lastname'],
				'email' => $rows[0]['email'],
				'cv' => $rows[0]['user_cv'],
				'applied_on' => cur_date_time(),
				'ip_address' => get_ip(),
				'status' => 1
				);
				$ref_num = $this->job_oppurtunities_model->saveapp($data);
				
				$this->session->set_userdata('an_msg', "Your CV has been send to the Company's email. <br />Your reference number is <b>$ref_num</b> Please keep this number for future communications.");
					
				//PHP mail
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				$headers .= 'From: '.SITE_EMAIL.' <'.SITE_EMAIL_SENDER.'>' . "\r\n";
				$to = $job[0]['email'];
				$company_name = $job[0]['company'];
				$applicant_name = $rows[0]['firstname'].' '.$rows[0]['lastname'];
				$applicant_email = $rows[0]['email'];
				$cv_link = base_url().'uploads/'.$rows[0]['user_cv'];
				$subject = "$ref_num | CV | ".SITE_NAME;
				$message = '<html><body width="100%" bgcolor="#f1f1f1" style="margin: 0;"><table cellspacing="0" cellpadding="15" border="0" align="center" width="700" style="width:100%; max-width:700px; margin:0 auto;background-color: #FFFFFF;font-family:\'Open Sans\', Arial, Helvetica, sans-serif;color: #333;font-size: 14px;line-height: 18px;border: 1px solid #151515"><tr bgcolor="#151515"><td width="50"><img src="'.base_url().'assets/img/logo.png"/></td><td width="650"><span style="font-size: 28px;color:#FFF">'.SITE_NAME.'</span></td></tr><tr><td colspan="2"><p style="font-size: 16px;">Ms. '.$company_name.'</p><p>We are happy to forward a CV of registered user.</p><p> Name of the applicant: '.$applicant_name.'<br />Email: '.$applicant_email.'</p><p>To view/download the CV <a href="'.$cv_link.'" target="_blank">click here</a>.</p><p><br/>Warm regards<br/>'.SITE_NAME.'</p></td></tr></table></body></html>';
				
				mail($to,$subject,$message,$headers);
				//echo $message;
			}
			else
			{
				$this->session->set_userdata('an_msg', "It is found that you haven't uploaded your CV. Please visit your profile  to upload the CV and try again.");
				
			}
			redirect(base_url().'oppurtunities','refresh');
		}
		else 
		{
			redirect(base_url());
		}
	}
	
	
	/*
	public function applynow($id)
	{
		$this->load->helper('captcha');
		$vals = array(
	    'word' => '',
	    'img_path' => './captcha/',
	    'img_url' => base_url().'captcha/',
	    'font_path' => './path/to/fonts/texb.ttf',
	    'img_width' => '150',
	    'img_height' => 30,
	    'expiration' => 7200
	    );
		
		$cap = create_captcha($vals);
		
		$id = (int) $id;
		$this->load->model('job_oppurtunities_model');
		$data = array(
		'body' => 'applynow',
		'menu'	=> 'oppurtunities',
		'page_title' => 'Job Oppurtunities | WelTec Alumni',
		'meta_keywords' => '',
		'meta_description' => '',
		'heading' => 'Job Oppurtunities',
		'records' => $this->job_oppurtunities_model->get_job_details($id),
		'cap' => $cap,
		'id' => $id
		);
		$this->load->view('general',$data);
	}
	
	public function saveapp()
	{
		$this->form_validation->set_rules('first_name', 'First Name', 'required|xss_clean|max_length[50]');
		$this->form_validation->set_rules('last_name', 'Last Name', 'xss_clean|max_length[50]');
		$this->form_validation->set_rules('email', 'Email', 'required|xss_clean|max_length[50]|valid_email');
		$this->form_validation->set_rules('captcha', 'Captcha word', 'required|xss_clean|exact_length[6]|callback_check_captcha');
		$this->form_validation->set_rules('job_id', 'Job Id', 'required|xss_clean');
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_userdata('an_msg', validation_errors());
		}
		else
		{
			$this->load->model('job_oppurtunities_model');
			$return = $this->job_oppurtunities_model->saveapp();
			if($return == "")
			{
				$job = $this->job_oppurtunities_model->get_job_details($this->input->post('job_id'));
				$ref_num = $this->session->userdata('ref_num');
				$this->session->set_userdata('an_msg', "Your CV has been successfully received at our end. <br />The same is also send to the Company's email. <br />Your reference number is <b>$ref_num</b> Please keep this number for future communications.");
				
				//PHP mail
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				$headers .= 'From: '.SITE_EMAIL.' <'.SITE_EMAIL_SENDER.'>' . "\r\n";
				$to = $job[0]['email'];
				$company_name = $job[0]['company'];
				$applicant_name = $this->input->post('first_name').' '.$this->input->post('last_name');
				$applicant_email = $this->input->post('email');
				$cv_link = base_url().'uploads/'.$this->session->userdata('cv_file');
				$subject = "$ref_num | CV | ".SITE_NAME;
				$message = '<html><body width="100%" bgcolor="#f1f1f1" style="margin: 0;"><table cellspacing="0" cellpadding="15" border="0" align="center" width="700" style="width:100%; max-width:700px; margin:0 auto;background-color: #FFFFFF;font-family:\'Open Sans\', Arial, Helvetica, sans-serif;color: #333;font-size: 14px;line-height: 18px;border: 1px solid #151515"><tr bgcolor="#151515"><td width="50"><img src="'.base_url().'assets/img/logo.png"/></td><td width="650"><span style="font-size: 28px;color:#FFF">'.SITE_NAME.'</span></td></tr><tr><td colspan="2"><p style="font-size: 16px;">Ms. '.$company_name.'</p><p>We are happy to forward a CV received via our website career page.</p><p> Name of the applicant: '.$applicant_name.'<br />Email: '.$applicant_email.'</p><p>To view/download the CV <a href="'.$cv_link.'" target="_blank">click here</a>.</p><p><br/>Warm regards<br/>'.SITE_NAME.'</p></td></tr></table></body></html>';
				
				mail($to,$subject,$message,$headers);
				
				//Email with SMTP
				//$this->load->library('email');
	
				//$this->email->from(SITE_EMAIL, SITE_EMAIL_SENDER);
				//$this->email->to($job[0]['email']);
				//$company_name = $job[0]['company'];
				//$applicant_name = $this->input->post('first_name').' '.$this->input->post('last_name');
				//$applicant_email = $this->input->post('email');
				//$cv_link = base_url().'uploads/'.$this->session->userdata('cv_file');
				
				//$subject = "$ref_num | CV | ".SITE_NAME;
				//$message = '<html><body width="100%" bgcolor="#f1f1f1" style="margin: 0;"><table cellspacing="0" cellpadding="15" border="0" align="center" width="700" style="width:100%; max-width:700px; margin:0 auto;background-color: #FFFFFF;font-family:\'Open Sans\', Arial, Helvetica, sans-serif;color: #333;font-size: 14px;line-height: 18px;border: 1px solid #151515"><tr bgcolor="#151515"><td width="50"><img src="'.base_url().'assets/img/logo.png"/></td><td width="650"><span style="font-size: 28px;color:#FFF">'.SITE_NAME.'</span></td></tr><tr><td colspan="2"><p style="font-size: 16px;">Ms. '.$company_name.'</p><p>We are happy to forward a CV received via our website career page.</p><p> Name of the applicant: '.$applicant_name.'<br />Email: '.$applicant_email.'</p><p>To view/download the CV <a href="'.$cv_link.'" target="_blank">click here</a>.</p><p><br/>Warm regards<br/>'.SITE_NAME.'</p></td></tr></table></body></html>';
				
				//$this->email->subject($subject);
				//$this->email->message($message);
				
				//$this->email->send();
			
				$this->session->unset_userdata('ref_num');
				$this->session->unset_userdata('cv_file');
			}
			else
			{
				$this->session->set_userdata('an_msg', $return);
			}
		}
		//echo $message;
		redirect(base_url().'oppurtunities/applynow/'.$this->input->post('job_id'),'refresh');
	}

	function _check_captcha($user_entered_captcha)
	{
		if($user_entered_captcha != $this->input->post('cword'))
		{
			$this->form_validation->set_message('check_captcha',"You have entered a wrong captcha word");
            return FALSE;
		}
		else
        {
            return TRUE;
        }
	}
	*/
}
?>
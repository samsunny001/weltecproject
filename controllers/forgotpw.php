<?php
class Forgotpw extends CI_Controller {

	public function index()
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
		
		$data = array(
		'body' => 'forgotpw',
		'menu'	=> 'forgotpw',
		'page_title' => 'Forgot Password | WelTec Alumni',
		'meta_keywords' => '',
		'meta_description' => '',
		'heading' => 'Forgot Password?',
		'cap' => $cap
		);
		$this->load->view('general',$data);
	}
	
	public function resetpw($id)
	{
		$f = '4652a5c0d8cf5ca8';
		$s = '75ecebcfadb8a8ab';
		$id = str_replace($f, "", $id);
		$id = str_replace($s, "", $id);

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
		
		$this->load->model('register_model');
		
		$data = array(
		'body' => 'resetpw',
		'menu'	=> 'forgotpw',
		'page_title' => 'Reset Password | WelTec Alumni',
		'meta_keywords' => '',
		'meta_description' => '',
		'heading' => 'Reset Password',
		'cap' => $cap,
		'id' => $id
		);
		$this->load->view('general',$data);
	}

	function savenew()
	{
		$this->form_validation->set_rules('id', 'Id', 'required|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'required|xss_clean|max_length[50]|valid_email');
		$this->form_validation->set_rules('pw', 'Password', 'required|xss_clean|max_length[50]|callback_check_pw_strength');
		$this->form_validation->set_rules('captcha', 'Captcha word', 'required|xss_clean|exact_length[6]|callback_check_captcha');
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_userdata('reg_msg', validation_errors());
		}
		else
		{
			$this->load->model('register_model');
			$this->register_model->reset_pw();
			$this->session->set_userdata('rpw_msg', 'Your new password has been saved.');
		}
		redirect(base_url(),'refresh');
	}

	public function sendnew()
	{
		$this->form_validation->set_rules('email', 'Email', 'required|xss_clean|max_length[50]|valid_email|callback_check_user_existence');
		$this->form_validation->set_rules('captcha', 'Captcha word', 'required|xss_clean|exact_length[6]|callback_check_captcha');
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_userdata('fpw_msg', validation_errors());
		}
		else
		{
			$this->load->model('register_model');
			$user = $this->register_model->createwpw($this->input->post('email'));
			
			
			//$newpw = $this->register_model->createwpw($this->input->post('email'));
			//$this->session->set_userdata('fpw_msg', "You will receive an email in <strong>".$this->input->post('email')."</strong> containing the new password.");
			
			$this->session->set_userdata('fpw_msg', "You will receive an email in <strong>".$this->input->post('email')."</strong> containing the link to reset your password.");
			
			$pw_reset_link = base_url().'forgotpw/resetpw/4652a5c0d8cf5ca8'.$user[0]['id'].'75ecebcfadb8a8ab';
			$name = $user[0]['firstname'].' '.$user[0]['lastname'];
			
			//PHP mail
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			$headers .= 'From: '.SITE_EMAIL.' <'.SITE_EMAIL_SENDER.'>' . "\r\n";
			$to = $this->input->post('email');
			$subject = 'Password reset link | '.SITE_NAME;
			$message = '<html><body width="100%" bgcolor="#f1f1f1" style="margin: 0;"><table cellspacing="0" cellpadding="15" border="0" align="center" width="700" style="width:100%; max-width:700px; margin:0 auto;background-color: #FFFFFF;font-family:\'Open Sans\', Arial, Helvetica, sans-serif;color: #333;font-size: 14px;line-height: 18px;border: 1px solid #151515"><tr bgcolor="#151515"><td width="50"><img src="'.base_url().'assets/img/logo.png"/></td><td width="650"><span style="font-size: 28px;color:#FFF">'.SITE_NAME.'</span></td></tr><tr><td colspan="2"><p>Dear '.$name.'</p><p>To reset your password <a href="'.$pw_reset_link.'" target="_blank">click here</a>.</p><p><br/>Warm regards<br/>'.SITE_NAME.'</p></td></tr></table></body></html>';
			mail($to,$subject,$message,$headers);
			
			/*Email
			$this->load->library('email');

			$this->email->from(SITE_EMAIL, SITE_EMAIL_SENDER);
			$this->email->to($this->input->post('email'));
			
			$subject = 'New Password | '.SITE_NAME;
			$message = '<html><body width="100%" bgcolor="#f1f1f1" style="margin: 0;"><table cellspacing="0" cellpadding="15" border="0" align="center" width="700" style="width:100%; max-width:700px; margin:0 auto;background-color: #FFFFFF;font-family:\'Open Sans\', Arial, Helvetica, sans-serif;color: #333;font-size: 14px;line-height: 18px;border: 1px solid #151515"><tr bgcolor="#151515"><td width="50"><img src="'.base_url().'assets/img/logo.png"/></td><td width="650"><span style="font-size: 28px;color:#FFF">'.SITE_NAME.'</span></td></tr><tr><td colspan="2"><p style="font-size: 16px;">Password reset successful...</p><p>New password is '.$newpw.'</p><p>It is recommended that you change your password after logging in.</p><p><br/>Warm regards<br/>'.SITE_NAME.'</p></td></tr></table></body></html>';
			
			$this->email->subject($subject);
			$this->email->message($message);
			
			$this->email->send();
			*/
		}
		redirect(base_url().'forgotpw','refresh');
	}
	
	function check_user_existence($email)
	{
		$this->load->model('register_model');
		$val=$this->register_model->is_user_exists($email);
		if($val==TRUE)
		{
			return TRUE;
		}
		else
        {
            $this->form_validation->set_message('check_user_existence',"$email is not registered");
            return FALSE;
        }
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
	
	function check_pw_strength($password)
	{
        $this->load->model('register_model');       
       
        $val=$this->register_model->password_strength_checker($password,$this->input->post('email'));
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
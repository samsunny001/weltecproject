<?php
class Register extends CI_Controller {

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
		'body' => 'registration',
		'menu'	=> 'registration',
		'page_title' => 'Register with us | WelTec Alumni',
		'meta_keywords' => '',
		'meta_description' => '',
		'heading' => 'Register with us',
		'cap' => $cap
		);
		$this->load->view('general',$data);
	}

	public function save()
	{
		$this->form_validation->set_rules('first_name', 'First Name', 'required|xss_clean|max_length[50]');
		$this->form_validation->set_rules('last_name', 'Last Name', 'xss_clean|max_length[50]');
		$this->form_validation->set_rules('stud_id', 'Student ID', 'required|xss_clean|max_length[50]|callback_check_studid_duplication');
		$this->form_validation->set_rules('email', 'Email', 'required|xss_clean|max_length[50]|valid_email|callback_check_user_duplication');
		$this->form_validation->set_rules('gender', 'Gender', 'required|xss_clean|max_length[6]');
		$this->form_validation->set_rules('department', 'Department', 'required|xss_clean');
		$this->form_validation->set_rules('pass_out_year', 'Year of Pass Out', 'required|xss_clean|exact_length[4]');
		$this->form_validation->set_rules('license', 'Driving License', 'required|xss_clean');
		$this->form_validation->set_rules('pw', 'Password', 'required|xss_clean|max_length[50]|callback_check_pw_strength');
		$this->form_validation->set_rules('captcha', 'Captcha word', 'required|xss_clean|exact_length[6]|callback_check_captcha');
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_userdata('reg_msg', validation_errors());
		}
		else
		{
			$this->load->model('register_model');
			$id = $this->register_model->save();
			
			$name = $this->input->post('first_name').' '.$this->input->post('last_name');
			$activation_link = base_url().'register/activate/4652a5c0d8cf5ca8'.$id.'75ecebcfadb8a8ab';
			
			//PHP mail
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			$headers .= 'From: '.SITE_EMAIL.' <'.SITE_EMAIL_SENDER.'>' . "\r\n";
			$to = $this->input->post('email');
			$subject = 'Account Activation | '.SITE_NAME;
			$message = '<html><body width="100%" bgcolor="#f1f1f1" style="margin: 0;"><table cellspacing="0" cellpadding="15" border="0" align="center" width="700" style="width:100%; max-width:700px; margin:0 auto;background-color: #FFFFFF;font-family:\'Open Sans\', Arial, Helvetica, sans-serif;color: #333;font-size: 14px;line-height: 18px;border: 1px solid #151515"><tr bgcolor="#151515"><td width="50"><img src="'.base_url().'assets/img/logo.png"/></td><td width="650"><span style="font-size: 28px;color:#FFF">'.SITE_NAME.'</span></td></tr><tr><td colspan="2"><p>Dear '.$name.'</p><p>Thank you for registering with us. <br / > Your login credentials are as follows: <br / >Username: '.$this->input->post('email').'<br / >Password: '.$this->input->post('pw').'<br / ><br / > To activate your account please <a href="'.$activation_link.'" target="_blank">click here</a>.</p><p><br/>Warm regards<br/>'.SITE_NAME.'</p></td></tr></table></body></html>';
			mail($to,$subject,$message,$headers);
			
			//echo $message;
			
			$this->session->set_userdata('reg_msg', 'Thank you for registering with WelTec Alumni. <br />You will receive an email in '.$this->input->post('email').' containing an account activation link. If you do not receive the mail in your Inbox, please check your Spam folder too.');
		}
		redirect(base_url().'register','refresh');
	}

	public function activate($id)
	{
		$f = '4652a5c0d8cf5ca8';
		$s = '75ecebcfadb8a8ab';
		$id = str_replace($f, "", $id);
		$id = str_replace($s, "", $id);

		$this->load->model('register_model');
		$this->load->model('user_model');
		$data = array(
		'body' => 'acc_activate_view',
		'menu'	=> 'registration',
		'page_title' => 'Account activation | WelTec Alumni',
		'meta_keywords' => '',
		'meta_description' => '',
		'heading' => 'Account activation',
		'id' => $id
		);
		$this->load->view('general',$data);
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
	
	function check_user_duplication($email)
	{
		$this->load->model('register_model');
		$val=$this->register_model->is_user_exists($email);
		if($val==TRUE)
		{
			$this->form_validation->set_message('check_user_duplication',"Registration failed!. <b>$email</b> is already registered");
            return FALSE;
		}
		else
        {
            return TRUE;
        }
	}
	
	
	function check_studid_duplication($stud_id)
	{
		$this->load->model('register_model');
		$val=$this->register_model->is_studid_exists($stud_id);
		if($val==TRUE)
		{
			$this->form_validation->set_message('check_studid_duplication',"Registration failed!. <b>$stud_id</b> is already registered");
            return FALSE;
		}
		else
        {
            return TRUE;
        }
	}
}
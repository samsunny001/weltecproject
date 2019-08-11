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
		$this->form_validation->set_rules('stud_id', 'Student ID', 'required|xss_clean|max_length[50]');
		$this->form_validation->set_rules('email', 'Email', 'required|xss_clean|max_length[50]|valid_email|callback_check_user_duplication');
		$this->form_validation->set_rules('gender', 'Gender', 'required|xss_clean|max_length[6]');
		$this->form_validation->set_rules('department', 'Department', 'required|xss_clean');
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
			$this->register_model->save();
			$this->session->set_userdata('reg_msg', 'Thank you for registering with WelTec Alumni');
		}
		redirect(base_url().'register','refresh');
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
			$this->form_validation->set_message('check_user_duplication',"$email is already registered");
            return FALSE;
		}
		else
        {
            return TRUE;
        }
	}
}
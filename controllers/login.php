<?php
class Login extends CI_Controller {

    public function __construct() {//using constructor for loading the user_login_model automatically on the user_login controller call.
        parent::__construct();
        $this->load->model('login_model');
    }
	/*
    function index() {
        $this->load->view('login');
    }
	*/
    public function index() {

        $this->form_validation->set_rules('email', 'Username', 'xss_clean|required|valid_email|max_length[50]');
        $this->form_validation->set_rules('password', 'Password', 'xss_clean|required|max_length[50]|callback_checklogincredentials');
        if ($this->form_validation->run() == FALSE) 
        {
        	$this->session->set_flashdata('login_msg', validation_errors());
        	redirect(base_url());
        } 
        else 
        {
        	redirect(base_url().'users/dashboard','refresh');
        }
		
    }
	public function forget_password() {
		$this->load->view('forget_password');
	}
public function forgot_email_method() {
		$email = $this->input->post('forgot_email');
		//echo $email;
		//echo var_dump(filter_var($email, FILTER_VALIDATE_EMAIL));
		if(filter_var($email, FILTER_VALIDATE_EMAIL) && $this->login_model->check_email($email)) {
			// connect db for email check in table
				$new_pass = $this->login_model->reset_password($email);
				$this->load->library('email'); // Note: no $config param needed
				$this->email->from('aluminator2017@gmail.com', 'Aluminator');  
                $this->email->to($email);  
                $this->email->subject('Aluminator');  
                $this->email->message("Your new password is: \r\n".$new_pass);  
                $this->email->send();
				//show_error($this->email->print_debugger());
			$this->load->view('forget_password' ,array('title' => 'My Title',
              'heading' => 'My Heading',
              'message' => 'Email Sent!'));
		} else {
			$this->load->view('forget_password', array('title' => 'My Title',
              'heading' => 'My Heading',
              'message' => 'Incorrect Email! For more queries please contact us at aluminator2015@gmail.com'));
		}
	}
	public function verify_account() {
			$id = $this->uri->segment(3); //https://ellislab.com/codeigniter/user-guide/libraries/uri.html
			//echo $id;
			$result = $this->login_model->verify_account($id);
			if($result) {
				echo "Account Verified!!";
			} else {
				echo "Account NOT Verified!!";
			}
	}
    
    public function logout() {
        /*$id = $this->uri->segment(3);
        if ($this->uri->segment(3) === FALSE) {
            $id = 0;
            show_404();
        }
        */
        $this->session->sess_destroy();
        redirect(base_url());
    }
	
	/*NEW FUNCTIONS*/
	function checklogincredentials($password)
	{
		$this->load->model('login_model');
		$username=$this->input->post('email');
		$result=$this->login_model->check($username,$password);
		if($result)
		{
			$sess_array=array(
			'id' => $result[0]['id'],
            'email' => $result[0]['email'],
            'name' => $result[0]['firstname'].'&nbsp;'.$result[0]['lastname'],
            'is_logged_in' => 1
			);
			$this->session->set_userdata($sess_array);
			return true;
		}
		else
		{
			if ($this->session->userdata('failed_login'))
			{
				$failed_login = $this->session->userdata('failed_login');
				$failed_login++;
				$this->session->set_userdata('failed_login',$failed_login);
				
				if ($this->session->userdata('failed_login')>=3)
				{
					$this->login_model->block_ip($username);
				}
			}
			else 
			{
				$this->session->set_userdata('failed_login',1);
				
			}
			
			$remaining_attempts = 3-$this->session->userdata('failed_login');
			if ($this->session->userdata('failed_login')>=3)
			{
				$this->form_validation->set_message('checklogincredentials',"Your login will resume after 24 hours");
			}
			else
			{
				$this->form_validation->set_message('checklogincredentials',"Incorrect userame and password <br /> You have $remaining_attempts more attempt(s)");
			}
			return false;
		}
	}

}

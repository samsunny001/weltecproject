<?php
class Forgotpw extends CI_Controller
{
	public function index()
	{
		$this->load->model('admin_new_model');
		$data=array(
		'heading' => 'Forgot Password'
		);
		$this->load->view('admin/forgotpw_view',$data);
	}
	
	public function sendnew()
	{
		$this->form_validation->set_rules('email', 'Email', 'required|xss_clean|max_length[50]|valid_email');
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_userdata('fpw_msg', validation_errors());
		}
		else
		{
			$this->load->model('admin_new_model');
			$newpw = $this->admin_new_model->createwpw($this->input->post('email'));
			$this->session->set_userdata('fpw_msg', "You will receive an email in <strong>".$this->input->post('email')."</strong> containing the new password.");
			
			//Email
			$this->load->library('email');

			$this->email->from(SITE_EMAIL, SITE_EMAIL_SENDER);
			$this->email->to($this->input->post('email'));
			
			$subject = 'New Password | '.SITE_NAME;
			$message = '<html><body width="100%" bgcolor="#f1f1f1" style="margin: 0;"><table cellspacing="0" cellpadding="15" border="0" align="center" width="700" style="width:100%; max-width:700px; margin:0 auto;background-color: #FFFFFF;font-family:\'Open Sans\', Arial, Helvetica, sans-serif;color: #333;font-size: 14px;line-height: 18px;border: 1px solid #151515"><tr bgcolor="#151515"><td width="50"><img src="'.base_url().'assets/img/logo.png"/></td><td width="650"><span style="font-size: 28px;color:#FFF">'.SITE_NAME.'</span></td></tr><tr><td colspan="2"><p style="font-size: 16px;">Password reset successful...</p><p>New password is '.$newpw.'</p><p>It is recommended that you change your password after logging in.</p><p><br/>Warm regards<br/>'.SITE_NAME.'</p></td></tr></table></body></html>';
			
			$this->email->subject($subject);
			$this->email->message($message);
			
			$this->email->send();
		}
		redirect(admin_base_path().'forgotpw','refresh');
	}
}
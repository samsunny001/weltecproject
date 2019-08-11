<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Users extends CI_Controller{
	public function __construct() {//using constructor for loading the user_login_model automatically on the user_login controller call.
    parent::__construct();
   $this->load->model('user_model');
}


public function dashboard()
{
	if($this->session->userdata('is_logged_in'))
	{
		$data['rows'] = $this->user_model->user_profile();
		$data['user_post'] = $this->user_model->get_user_posts();
		$data['menu'] = 1;
		$this->load->view('dashboard',$data);
	}
	else
	{
		redirect(base_url());
	}
}


//*********Functionality for user profile related actions*********

public function profile()
{
	if($this->session->userdata('is_logged_in'))
	{
		$data['rows'] = $this->user_model->user_profile();
		$data['menu'] = 2;
		$this->load->view('profile',$data);
	}
	else
	{
		redirect(base_url());
	}
}

public function edit_profile()
{
	if($this->session->userdata('is_logged_in'))
	{
		$data['rows'] = $this->user_model->user_profile();
		$data['menu'] = 2;
		$this->load->view('edit_profile',$data);
	}
	else
	{
		redirect(base_url());
	}
}

	public function update_profile()
	{
		if($this->session->userdata('is_logged_in'))
		{
			$this->form_validation->set_rules('firstname', 'First Name','xss_clean|required|min_length[2]|max_length[50]' );
			$this->form_validation->set_rules('lastname', 'Last Name', 'xss_clean|required|max_length[50]');
			$this->form_validation->set_rules('about', 'About me', 'xss_clean|required|max_length[500]');
			if($this->form_validation->run()== FALSE)
			{
				redirect(base_url().'users/edit_profile');
			}
			else
			{
				if($this->user_model->update_user($this->input->post('firstname'), $this->input->post('lastname'), $this->input->post('about')))
				{
					$this->session->set_flashdata(
		    			'Updation_successful', 
		    			'Profile Updated!'
						);
					redirect(base_url().'users/profile');
				}
				else
				{
					redirect(base_url().'users/edit_profile');
				}
			}
		}
		else
		{
			redirect(base_url());
		}
	}

public function edit_image()
{
	if($this->session->userdata('is_logged_in'))
	{
		$data['rows'] = $this->user_model->user_profile();
		$data['menu'] = 2;
		$this->load->view('edit_image',$data);
	}
	else
	{
		redirect(base_url());
	}
}

public function upload_cv_form() 
{
	if($this->session->userdata('is_logged_in'))
	{
		$data['rows'] = $this->user_model->user_profile();
		$data['menu'] = 2;
		$this->load->view('upload_cv',$data);
	}
	else
	{
		redirect(base_url());
	}
}
public function update_password() 
{
	if($this->session->userdata('is_logged_in'))
	{
		$data['rows'] = $this->user_model->user_profile();
		$data['menu'] = 2;
		$this->load->view('update_password',$data);
	}
	else
	{
		redirect(base_url());
	}
}

public function edit_password() {
	//$this->load->library(‘form_validation’);
	$data['rows'] = $this->user_model->profile();
	$this->form_validation->set_rules('oldpassword', 'Old Password', 'trim|required|xss_clean|min_length[2]');
    $this->form_validation->set_rules('newpassword', 'New Password', 'trim|required|xss_clean|min_length[2]');
	$this->form_validation->set_rules('confirmpassword', 'Confirm Password', 'trim|required|xss_clean|min_length[2]|matches[newpassword]');
	if ($this->form_validation->run() == FALSE) {
        $this->load->view('update_password', $data);
			}
	else {
		 $oldpassword = $this->input->post('oldpassword');
         $newpassword = $this->input->post('newpassword');
         $confirmpassword = $this->input->post('confirmpassword');
		 $checkpass = $this->user_model->check_password($data['rows'][0]->email,md5($oldpassword));
		if($checkpass) {
			$result = $this->user_model->change_password($oldpassword, $newpassword, $confirmpassword);
			$data['message'] = "<h3 style='color:green;'>Password Changed!!!!!</h3>";
			$this->load->view('update_password', $data);
		} else {
			$data['message'] = "<h3 style='color:red;'>Password Failed!!!!!!!</h3>";
			$this->load->view('update_password', $data);
		}
		//$this->load->view('update_password', $data);
	}
} //https://sathyalog.wordpress.com/2013/02/08/create-change-password-functionality-in-codeigniter-along-with-css-framework/
public function update_image()
{
	if($this->session->userdata('is_logged_in'))
	{
		 $config['upload_path'] ='./webroot/images/user_images/';
		 $config['allowed_types'] = 'jpg';
		 $config['max_size']    = '1000000';
		 $config['max_width']  = '640';
		 $config['max_height']  = '480';
		 $config['overwrite'] = TRUE;
		 $config['remove_spaces'] = TRUE;
		 $config['encrypt_name'] = FALSE;
	
	     $this->load->library('upload', $config);
	     $field_name = "profile_file";
			
		if ( ! $this->upload->do_upload($field_name))
		{
			/*
			$error = array('error' => $this->upload->display_errors());
			$data['rows'] = $this->user_model->profile();
			$this->load->view('edit_image',$data, $error);
			*/
			$this->session->set_flashdata('image_updated', "Picture Upload Failed!");
			redirect(base_url().'users/profile');
		}				
		else 
		{
	    	$image_path = $this->upload->data();
	    	$data = array(
				'image'  => $image_path[file_name],
	        );
			$user_id = $this->session->userdata('id');
			$this->db->where('id', $user_id);
	        $this->db->update('users', $data);
	        $this->session->set_flashdata('image_updated', "Profile Picture Changed!");
	        redirect(base_url().'users/profile');
	    }	
	}
	else
	{
		redirect(base_url());
	}		
}
public function view_profile()
{
	if ($this->uri->segment(3) === FALSE)
	{
	    $id = 0;
		//show_404();
		redirect(base_url().'users/dashboard');
	}
	if($this->session->userdata('is_logged_in'))
	{
		$id = (int) $this->uri->segment(3);
		$user_id = $this->session->userdata('id');
	 	if($id != $user_id)
	 	{
		 	$view_profile = $this->user_model->view_profile();
			
			if($view_profile === FALSE)
			{
				redirect(base_url().'users/dashboard');
			}
		
			$data['rows'] = $this->user_model->user_profile();
			$data['user_profile'] = $view_profile;
		 	$this->load->view('view_users_profile',$data);
		}
		else
		{
			redirect(base_url().'users/profile');
		}
	}
	else
	{
		redirect(base_url());
	}
}


//*********Functionality for posts related actions*********

public function get_all_posts()
{
	if($this->session->userdata('is_logged_in'))
	{
		$data['rows'] = $this->user_model->user_profile();
		$data['all_posts'] = $this->user_model->get_all_posts();
		$data['menu'] = 3;
		$this->load->view('all_posts',$data);
	}
	else
	{
		redirect(base_url());
	}
}

	public function get_user_posts(){
	if($this->session->userdata('is_logged_in')){
	$data['row'] = $this->user_model->get_user_posts();
	$this->load->view('Client/my_posts',$data);
	}
	else{
		redirect('user_login');
	}
}


public function view_post()
{
	if($this->session->userdata('is_logged_in'))
	{
		$id = (int) $this->uri->segment(3);	
		if (is_numeric($id))
		{
			$view_post = $this->user_model->get_one_posts($id);
			$view_comments = $this->user_model->get_comments($id);
			$data['onepost'] = $view_post;
			$data['c_row'] = $view_comments;
			$data['rows'] = $this->user_model->user_profile();
			$data['menu'] = 3;
			$this->load->view('view_post',$data);	
		}
		else
		{
			redirect(base_url().'users/dashboard');
		}
		/*
		if ($this->uri->segment(3) === FALSE)
		{
		    $id = 0;
			redirect(base_url().'users/dashboard');
		}
		else
		{
		    $id = (int) $this->uri->segment(3);
		}
		$view_post = $this->user_model->get_one_posts($id);
		$view_comments = $this->user_model->get_comments($id);
		if($view_post === FALSE)
		{
			redirect(base_url().'users/dashboard');
		}
		if($view_comments === FALSE)
		{
		}
		if($view_post)
		{
			$data['onepost'] = $view_post;
		}
		$data['onepost'] = $view_post;
		$data['c_row'] = $view_comments;
		$data['rows'] = $this->user_model->user_profile();
		$data['menu'] = 3;
		$this->load->view('view_post',$data);
		*/
	}
	else
	{
		redirect(base_url());
	}
}



public function compose_post()
{
	if($this->session->userdata('is_logged_in'))
	{
		$this->form_validation->set_rules('mypost', 'The Post','xss_clean|required|max_length[5000]');
		$this->form_validation->set_rules('poster_name', 'Name','xss_clean|required');
		if($this->form_validation->run() == TRUE)
		{
			if($this->user_model->insert_post($this->input->post('mypost'), $this->input->post('poster_name')))
			{
				redirect(base_url().'users/dashboard');
			}
			else
			{
				redirect(base_url().'users/dashboard');
			}
		}
		else
		{
			redirect(base_url().'users/dashboard');
		}
	}
	else
	{
		redirect(base_url());
	}
}

public function add_comment()
{
	if($this->session->userdata('is_logged_in'))
	{
		$this->form_validation->set_rules('mycomment','Comment','xss_clean|required|max_length[5000]');
		$this->form_validation->set_rules('postid','Post Id','xss_clean|required');
		$this->form_validation->set_rules('poster_name','Name','xss_clean|required');
		if($this->form_validation->run() == TRUE)
		{
			if($this->user_model->insert_comment($this->input->post('mycomment'), $this->input->post('postid'),$this->input->post('poster_name')))
			{
				$this->session->set_flashdata('post_comment_msg', 'Your Comment Posted!');
			}
			else
			{
				$this->session->set_flashdata('post_comment_msg', 'Posting failed!');
			}
		}
		else
		{
			$this->session->set_flashdata('post_comment_msg', 'Posting failed!');
		}
		redirect(base_url()."users/view_post/".$this->input->post('postid'));
	}
	else
	{
		redirect(base_url());
	}
}
//*********Functionality for user Friend Request related actions*********	

	public function add_friend(){
	if($this->session->userdata('is_logged_in')){
	$id = $this->uri->segment(3);
	$friend_name = $this->uri->segment(4);
	if($this->user_model->addfriend($id,$friend_name))
	{
		redirect("users/view_profile/$id");
	}
	}
	else{
		redirect('user_login');
	}
}

//GET Friend List and Freind Requests
public function get_friends(){
	if($this->session->userdata('is_logged_in')){
	$data['get_friends'] = $this->user_model->get_friend_request();
	$data['get_my_friendsone'] = $this->user_model->get_my_friends_1();
	$data['get_my_friends2'] = $this->user_model->get_my_friends_2();
	$data['rows'] = $this->user_model->user_profile();
	$data['menu'] = 5;
	$this->load->view('friends',$data);
	}
	else{
		redirect('user_login');
	}
}

//FRIEND REQUEST ACTIONS
public function request_action(){
	$id = $this->uri->segment(3);
	$action = $this->uri->segment(4);
	if($action === 'accept'){
		if($this->user_model->friend_accept($id)){
			$this->session->set_flashdata(
    			'Friend_added', 
    			'Friend request accepted'
				);
			redirect('users/get_friends');
		}
	}else if($action === 'reject'){
		if($this->user_model->reject_friend($id)){
			$this->session->set_flashdata(
    			'Friend_added', 
    			'Friend request accepted'
				);
			redirect('users/get_friends');
		}
	}
	
}



public function search_people()
{
	if($this->session->userdata('is_logged_in'))
	{
		$data['rows'] = $this->user_model->user_profile();
		$data['menu'] = 4;
		$this->load->view('search', $data);
	}
	else 
	{
		redirect(base_url());
	}	
}
public function search_friend()
{
	if($this->session->userdata('is_logged_in'))
	{
		$this->form_validation->set_rules('search','Search','xss_clean|max_length[100]');
		if($this->form_validation->run() == TRUE)
		{
			$data['query'] = $this->user_model->get_search($this->input->post('search'));
			$data['rows'] = $this->user_model->user_profile();
			$data['menu'] = 4;
		    $this->load->view('searchresult', $data);
		}
		else
		{
			$this->session->set_flashdata('search_msg', 'Search Failed!');
			redirect(base_url().'users/search');
		}	
	}
	else 
	{
		redirect(base_url());
	}
}
	
	
	public function chat(){		
	$data['get_friends'] = $this->user_model->get_friend_request();
	$data['get_my_friendsone'] = $this->user_model->get_my_friends_1();
	$data['get_my_friends2'] = $this->user_model->get_my_friends_2();
	$data['rows'] = $this->user_model->profile();
	$this->load->view('friends_online',$data);
		
	}
	
	function do_upload()
	{
		if($this->session->userdata('is_logged_in'))
		{
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'doc|docx|pdf';
			$config['max_size']	= '2048';
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload())
			{
				/*
				$data = array('upload_data' => $this->upload->data());
				$this->load->model('user_model');
				$data['rows'] = $this->user_model->profile();
				$data['message'] = '<br />Upload fail!!';
				$this->load->view('upload_cv',$data);
				*/
				$this->session->set_flashdata('cv_updated', "CV Upload Failed!");
	        	redirect(base_url().'users/profile');
			}
			else
			{
				/*
				$data = array('upload_data' => $this->upload->data());
				$this->load->model('user_model');
				$data['rows'] = $this->user_model->profile();
				$data['message'] = '<br />Upload Success!!';
				$this->load->view('upload_cv',$data);
				*/
				$image_path = $this->upload->data();
		    	$data = array(
					'user_cv'  => $image_path[file_name],
		        );
				$user_id = $this->session->userdata('id');
				$this->db->where('id', $user_id);
		        $this->db->update('users', $data);
				$this->session->set_flashdata('cv_updated', "CV Updated!");
	        	redirect(base_url().'users/profile');
			}
		}
		else 
		{
			redirect(base_url());
		}
	}

	function savenewpw()
	{
		if($this->session->userdata('is_logged_in'))
		{
			$this->form_validation->set_rules('cur_pw','Current Password','required|xss_clean|max_length[50]|callback_check_curpw');
			$this->form_validation->set_rules('new_pw','New Password','required|xss_clean|max_length[50]|callback_check_pw_strength');
			if($this->form_validation->run() == FALSE)
			{
				$this->session->set_flashdata('cpw_msg', validation_errors());
			}
			else 
			{
				$this->user_model->changepw($this->input->post('new_pw'),$this->session->userdata('id'));
				$this->session->set_flashdata('cpw_msg', 'The password has been changed.');
			}
			redirect(base_url().'users/update_password');
		}
		else
		{
			redirect(base_url());
		}
	}
	
	function check_curpw($password)
	{		
		$val=$this->user_model->validate_cur_pw($password,$this->session->userdata('id'));
		
		if($val==FALSE)
		{
			$this->form_validation->set_message('check_curpw','The current password is wrong.');
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
		$val=$this->register_model->password_strength_checker($password,$this->session->userdata('email'));
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
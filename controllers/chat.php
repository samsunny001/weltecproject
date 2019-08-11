<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Chat extends CI_Controller{
	public function __construct() {//using constructor for loading the user_login_model automatically on the user_login controller call.
    parent::__construct();
   $this->load->model('user_model');
   $this->load->model('chat_model');
}


public function index(){
	if($this->session->userdata('is_logged_in')){
	$data['get_my_friendsone'] = $this->user_model->get_my_friends_1();
	$data['get_my_friends2'] = $this->user_model->get_my_friends_2();
	$data['rows'] = $this->user_model->profile();
	$this->load->view('online_people',$data);
	}
	else{
		redirect('user_login');
	}
	
}


function chater_check(){
	$id = $this->uri->segment(3);
	//$data['onlinefriend'] = $this->chat_model->get_person_online($id);
	 if($this->chat_model->get_person_online($id)){ 
	     $data['onlinefriend'] = $this->chat_model->get_person_online($id);
		 $data['rows'] = $this->user_model->profile();
	   redirect('chat/get_assign_chat_id/'.$id);
	 }else{
		 	$this->session->set_flashdata(
    			'NotOnline', 
    			'The requested member is not currently online'
				);
				
				redirect('chat/index');
	 }
	
}

public function get_assign_chat_id(){
if ($this->uri->segment(3) === FALSE)
{
    $id = 0;
	show_404();
}
	$id = $this->uri->segment(3);
	if($this->chat_model->get_chat_id($id)){
		$getchatid1 = $this->chat_model->get_chat_id($id);
		$data = array();
		foreach($getchatid1 as $gc1){
			$chatid = $gc1->id;
		}
		 redirect('chat/chat_window/'.$chatid);
		 
		
	}
	if($this->chat_model->get_chat_id_otherside($id)){
		$getchatid2 = $this->chat_model->get_chat_id_otherside($id);
		$data = array();
		foreach($getchatid2 as $gc2){
			$chatid1 = $gc2->id;
		}
		 redirect('chat/chat_window/'.$chatid1);
		
	}
		$this->chat_model->set_chat_id($id);
		redirect('chat/get_assign_chat_id/'.$id);
	
}


public function chat_window(){
	$id = $this->uri->segment(3);
	$this->load->view('chat',$id);
}
public function ajax_add_chat_message(){
	
	/*Parameters we need to Pass in to the ajax function
	* chat_id
	*content
	*/
	
	$chat_id = $this->input->post('chat_id');
	$user_id = $this->input->post('user_id');
	$chat_message_content = $this->input->post('chat_message_content');
	$this->chat_model->add_chat_messages($chat_id, $user_id, $chat_message_content);
	
	//grab and return all chat messages
	echo $this->_get_chat_message($id);
	
}

function ajax_get_chat_message(){
	$id = $this->input->post('chat_id');
	
	//loading private function and passing chat_id in that i.e $id that will be use to retrive chats  
	echo $this->_get_chat_message($id);
}



//creating private function by putting uderscore '_' infront of that
   function _get_chat_message($id){
	   
	$chat_messages = $this->chat_model->get_chat_message($id);
	
	if($chat_messages->num_rows > 0){
	//Returning chat messeges
	//Creating Html un ordered list to dislpay the messages
		
		$chat_messages_html = '<div id="chat_message">';
		
		foreach($chat_messages->result() as $chat_msg){
			
	
		$chat_messages_html .= '<p id="animate"><b>'.$chat_msg->firstname.' :-  </b>'.$chat_msg->content.'<br><small>'.$chat_msg->created.'</small></p><br>';

		}
		
		$chat_messages_html .= '</div>';
		//Creating an arry to hold our chats and pass back to jquery code 
	 	$result = array('status' => 'ok', 'content' => $chat_messages_html);
		
		//Encoding the array into json to for making it accessible in jquery code
		return json_encode($result);
		exit();
	}
	else{
		
		//Returning empty content if we do not have any chats
		
		//Creating an arry to hold our chats and pass back to jquery code 
	 	$result = array('status' => 'ok', 'content' => '');
		
		//Encoding the array into json to for making it accessible in jquery code
		return json_encode($result);
		exit();
	}
}
}
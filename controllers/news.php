<?php
class News extends CI_Controller {

	public function index()
	{
		/*
		$this->load->model('news_model');
		$latest_news = $this->common_functions_model->show_latest_news(1);
		if ($latest_news != FALSE)
		{
			redirect(base_url().'news/details/'.$latest_news[0]->id,'refresh');
		}
		*/
		
		$this->load->model('news_model');
		$total_rows = $this->news_model->data_count();
		if($total_rows>0)
		{
			$per_page = 5;
			$pages= ceil($total_rows/$per_page);
			if($this->input->post('page')) 
			{
				$page = (int) $this->input->post('page',TRUE); 
				if(!is_numeric($page)) $page=1;
			}
			else 
			{
				$page=1;
			}
			
			if($page>$pages) $page=$pages; elseif($page<1) $page=1;
			$lower=($page-1)*$per_page;
			if(($lower+$per_page)>$total_rows) $limit=$total_rows-$lower; else $limit=$per_page;
			$records = $this->news_model->list_data($lower,$limit);
		}
		else 
		{
			$records = FALSE;
			$pages = $page = $lower="";
		}
		$this->load->helper('text');
		$data = array(
		'body' => 'news',
		'menu'	=> 'news',
		'page_title' => 'News | WelTec Alumni',
		'meta_keywords' => '',
		'meta_description' => '',
		'heading' => 'News',
		'records' => $records,
		'pages'			=>	$pages,
		'page'			=>	$page,
		'lower'			=>	$lower,
		'total_rows'	=>	$total_rows
		);
		$this->load->view('general',$data);
	}
	
	public function details($id)
	{
		$this->load->model('news_model');
		$data = array(
		'body' => 'news_details',
		'menu'	=> 'news',
		'page_title' => 'News | WelTec Alumni',
		'meta_keywords' => '',
		'meta_description' => '',
		'heading' => 'News',
		'id' => $id
		);
		$this->load->view('general',$data);
	}
	
	public function addview()
	{
		$this->load->view('add_news');
	}
	
	public function save()
	{
		$this->load->model('news_model');
		$this->news_model->save();
		echo "Added";
	}
}
?>
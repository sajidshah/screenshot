<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Screenshot extends MY_Controller
{
	function __construct() 
	{
		parent::__construct();
		$this->load->model('cms/screen_shot_model');
		$this->load->helper('text');
		$this->load->library('pagination');
	}
	
	function index($id= 0, $limit=0,$start=0)
	{
		
		if($limit==0) $limit=ADMIN_DEFAULT_ROWS;
		else $limit=$limit;
		$shots = 0;
		$data['screen_shots']=$this->screen_shot_model->get_screen_shots($id,$limit,$start);	
		$data['total_rows']=$this->screen_shot_model->get_total_rows($id);	
		$data['page']='cms/screen';
		$data['title'] = "ScreenShots";
		
		/* Check pagination */
		$config = array();
		$config['base_url'] = base_url("cms/screenshot/$id/$limit");
		$config['total_rows'] = $data['total_rows'];
		$config['per_page'] = $limit; 
		$config['uri_segment'] = 5;
		$config['full_tag_open'] = '<div id="pagination" class="pagination pull-right"><ul>';
		$config['full_tag_close'] = '</ul></div><!--pagination-->';
		$config['first_link'] = '&laquo; First';
		$config['first_tag_open'] = '<li class="prev page">';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = 'Last &raquo;';
		$config['last_tag_open'] = '<li class="next page">';
		$config['last_tag_close'] = '</li>';
		$config['next_link'] = 'Next &rarr;';
		$config['next_tag_open'] = '<li class="next page">'; 
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = '&larr; Previous';
		$config['prev_tag_open'] = '<li class="prev page">';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li class="page">';
		$config['num_tag_close'] = '</li>';
		//$config['anchor_class'] = 'class="pageno" ';
		//$ajax_pagination_config['show_count'] = false;
		$this->pagination->initialize($config);
		$data['pagination']= $this->pagination->create_links();
		/* check pagination ended */
		
		$this->load->view('template',$data);
	}

	

	public function detail($id)
	{
		$data['screen_shot']=$this->screen_shot_model->get_screen_shot_id($id);
		
		$data['page']='cms/detail';
		$data['title'] = "Detail";
		$this->load->view('template',$data);
	}
	
	function add() 
	{
		$data['title'] = "Add reviews";
		$data['page']='cms/add_screen_shots';
		
		$fields=array
		(
			'id'			=>'',
			'name' 			=>'',
			'url'			=>'',
			'hour'			=>'',
			'frequency'		=>''
		);
		
		$data['fields']=$fields;
		$data['post_controller']='cms/screenshot/add_site';
		$this->load->view('template',$data);
	}
	
	private function addhttp($url) {
	    if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
	        $url = "http://" . $url;
	    }
	    return $url;
	}
	
	function add_site() 
	{
		$this->form_validation->set_rules('title', 'Title', 'trim|required');
		$this->form_validation->set_rules('url', 'Site Url', 'trim|required');
		
		if($this->form_validation->run() == FALSE) 
		{
			echo "validation error";
			$this->add();
		} 
		else 
		{
			
			$datetime = array($_POST['start'], $_POST['end'], $_POST['recurring']);
			
			$datetime = array();
			if(isset($_POST['start']) && !empty($_POST['start'])){
				
				foreach($this->input->post('start') as $key=>$val){
					
					$datetime[] = array(
						  'start' 		=> $val
						, 'end' 		=> $_POST['end'][$key]
						, 'recurring' 	=> $_POST['recurring'][$key]
					);
					
				}
				
			}
			
			$data = array(
				
				'site_id'	=>$this->input->post('site_id'),
				'title'		=>$this->input->post('title'),
				'url'		=>$this->addhttp($this->input->post('url')),
				'width'		=>($this->input->post('width')!="")?$this->input->post('width'):0,
				'height'	=>($this->input->post('height')!="")?$this->input->post('height'):0,
				'datetime' 	=> $datetime
			);
			
			
			$this->screen_shot_model->add_target_site($data);
			$this->session->set_flashdata('msg','New site added successfully');
			redirect('/cms/target_screen','refresh');
		}
	}
	function update($id) 
	{
		$data['title'] = "Update Target Site";
		$data['page']='cms/add_screen_shots';
		
		$fields=$this->screen_shot_model->get_reviews_by_id($id);
		$data['fields']=$fields;
		$data['post_controller']='cms/reviews/update_reviews';
		$this->load->view('template',$data);
	}
	
	function update_reviews() 
	{
		$this->form_validation->set_rules('title_en', 'reviews Title', 'trim|required');
		$this->form_validation->set_rules('content_en', 'Content', 'trim|required');
		$id=$this->input->post('reviews_id');
		
		if($this->form_validation->run() == FALSE) 
		{
			$this->update($id);
		} 
		else 
		{
			$data = array
			(
				'id'				=>$id,
				'title_en'			=>$this->input->post("title_en"),
				'content_en'		=>$this->input->post('content_en')
			);
			
			// if multi lang is required then...
			if($this->config->item('multi_lang'))
			{
				$this->form_validation->set_rules('title_ur', 'Arabic reviews Title', 'trim|required');
				$data['title_ur'] = $this->input->post('title_ur');
				$this->form_validation->set_rules('content_ur', 'Arabic Content', 'trim|required');
				$data['content_ur'] = $this->input->post('content_ur');
			}
			$this->reviews_model->update_reviews($data);
			$this->session->set_flashdata('msg','reviews contents has been updated.');
			redirect('/cms/reviews/','refresh');
		}
	}
	function delete($id, $site_id='')
	{
		$this->screen_shot_model->delete_site($id);
		$this->session->set_flashdata('msg','Site deleted successfully');
		redirect('/cms/screenshot/index/'.$site_id,'refresh');
	}

	function trigger(){
		$this->screen_shot_model->screenshot();
	}
	function test(){
	    	
	   echo date('Y:m:d h:i:s a'); 
        

	}
	
	
	 
	
}


<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Target_screen extends MY_Controller
{
	public $data;
	
	function __construct() 
	{
		parent::__construct();
		$this->load->model('cms/screen_shot_model');
		$this->load->helper('text');
		
		$this->load->library('Common_lib');
		$this->data['recc_des'][0] = "One time";
		$this->data['recc_des'][1] = "Repeat Daily";
		$this->data['recc_des'][2] = "Repeat Weekly";
	}
	
	function index()
	{
		$limit = (isset($_GET['limit'])? (int)$_GET['limit']: ADMIN_DEFAULT_ROWS);
		$offset = isset($_GET['page']) && (int)$_GET['page']!=0 ? $_GET['page']:1;
		$search = isset($_GET['search'])? $_GET['search']:'';
		
		$offset = ($offset-1) * $limit;
		$shots = 0;
		
		$result = $this->screen_shot_model->get_target_screen($limit,$offset ,NULL, $this->data['recc_des'],$search);
		$data['target_screen'] = $result['result'];
		
		$data['page']='cms/target_screen';
		$data['title'] = "Web Sites";
		
		$count = $data['total_rows'] = $result['total']; //total
		
		$pagination_url = "cms/target_screen/index?search=$search";
		$data['pagination'] = $this->common_lib->pagination($pagination_url, $count , $limit);
		
		$this->load->view('template',$data);
	}

	public function preview(){

		if(!isset($_GET['url'])	|| $_GET['url'] == "") {
			redirect(''); die;
		}
		$url = $data['url_phantom'] = urldecode($_GET['url']);
		$url = escapeshellarg($url);
		
		$data['url'] = $url;
		$data['height'] = (isset($_GET['height']) && $_GET['height']>0)?$_GET['height']:0;
		
		$data['preview'] = true;
		
		$target = $this->screen_shot_model->record($data);
		
		redirect(base_url("/phantom/cache/".$target));
	
	}

	public function detail($id)
	{
		$data['screen_shot']=$this->screen_shot_model->get_screen_shot_id($id);	
		$data['page']='cms/detail';
		$data['title'] = "Detail";
		$this->load->view('template',$data);
	}
	
	function add($id=NULL) 
	{
		$data['title'] = "Target Site";
		$data['page']='cms/add_screen_shots';
		
		$data['recc_des'] = $this->data['recc_des'];
		if($id){
			$site = $this->screen_shot_model->get_target_screen(1, 0, $id, $this->data['recc_des']);
			$data['site'] = (!empty($site['result'][0])) ? $site['result'][0]: array();
			
		}
		
		$data['start'] = date('m/d/Y ').$this->blockMinutesRound(date('h:i')).date(' a');
		$data['end'] = date('m/d/Y');
		
		
		$data['post_controller']='cms/screenshot/add_site';
		$this->load->view('template',$data);
	}
	
	function blockMinutesRound($hour, $minutes = '5', $format = "H:i") {
		$minutes = $minutes+5; 
	   $seconds = strtotime($hour);
	   $rounded = round($seconds / ($minutes * 60)) * ($minutes * 60);
	   return date($format, $rounded);
	}
	
	function add_site() 
	{
		$this->form_validation->set_rules('name', 'Title', 'trim|required');
		$this->form_validation->set_rules('url', 'Site Url', 'trim|required');
		$this->form_validation->set_rules('frequency', 'Frequency', 'trim|required');
		$this->form_validation->set_rules('hour', 'Hour', 'trim|required');
		//echo "<pre>";print_r($_POST);die;
		
		if($this->form_validation->run() == FALSE) 
		{
			$this->add();
		} 
		else 
		{
			$data = array
			(
				'name'			=>$this->input->post("name"),
				'url'			=>$this->input->post('url'),
				'frequency'		=>$this->input->post("frequency"),
				'hour'			=>$this->input->post('hour')
			);
			
			
			$this->screen_shot_model->add_target_site($data);
			$this->session->set_flashdata('msg','reviews contents has been added.');
			redirect('/cms/target_screen/','refresh');
		}
	}
	function update($id) 
	{
		$data['title'] = "Update reviews";
		$data['page']='cms/add_screen_shots';
		
		$fields=$this->screen_shot_model->get_screen_shot_target_id($id);
		$data['fields']=$fields;
		$data['post_controller']='cms/target_screen/update_site';
		$this->load->view('template',$data);
	}
	
	function update_site() 
	{
		$this->form_validation->set_rules('name', 'Title', 'trim|required');
		$this->form_validation->set_rules('url', 'Site Url', 'trim|required');
		$this->form_validation->set_rules('frequency', 'Frequency', 'trim|required');
		$this->form_validation->set_rules('hour', 'Hour', 'trim|required');
		$id=$this->input->post('id');
		
		if($this->form_validation->run() == FALSE) 
		{
			$this->update($id);
		} 
		else 
		{
			$data = array
			(
				'id'				=>$id,
				'name'			=>$this->input->post("name"),
				'url'			=>$this->input->post('url'),
				'frequency'		=>$this->input->post("frequency"),
				'hour'			=>$this->input->post('hour')
			);
			
			
			$this->screen_shot_model->update_target_screen($data);
			$this->session->set_flashdata('msg','contents has been updated.');
			redirect('/cms/target_screen/','refresh');
		}
	}
	function delete($id)
	{
		$this->screen_shot_model->delete_target_screen($id);
		$this->session->set_flashdata('msg','Site deleted successfully');
		redirect('/cms/target_screen/','refresh');
	}

}


<?php

class Validation{
	
	public function __construct()
	{
		$this->ci =& get_instance();
		$this->ci->load->library('tank_auth');
		$this->ci->load->database();
		$this->ci->load->model('validation/validation_model');
		
		if($this->ci->tank_auth->is_logged_in()==FALSE)
		{
			redirect('/auth/index','refresh');
			exit();
		}
	}
	public function getUser()
	{
		if($this->ci->router->fetch_class()=='welcome')
		{
			$this->ci->validation_model->get_type_id(); 	
			return array('type_id' =>$this->ci->validation_model->get_type_id());
		}
		else 
		{	
	
		if(!$this->ci->validation_model->is_access_allowed($this->ci->validation_model->get_type_id(),$this->ci->router->fetch_class()))
			{
				redirect('welcome/index','refresh');
				exit();
			}	
			else 
			{
				return array(
					'id'			=>$this->ci->tank_auth->get_user_id(),
					'login'			=>TRUE,
					'store_id'		=>$this->ci->validation_model->get_store_id(),
					'type_id'		=>$this->ci->validation_model->get_type_id()
				); 
			}
		}	
		
		
	}
	
	function get_type_id()
	{
		return $this->ci->validation_model->get_type_id();
	}
}
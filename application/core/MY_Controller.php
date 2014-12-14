<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

abstract class MY_Controller extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if ($this->router->fetch_method()=='trigger'){
			return true;
		}
		
		if (!$this->tank_auth->is_logged_in()) 
		{
			redirect('/auth/login/', 'refresh');
		}
		else 
		{
			if(is_access_allowed()==FALSE)
			{
				//echo "echo your not allowed to see this page";die;
				//redirect('/dashboard','refresh');
				show_404();
				die;
			}
			else 
			{
				// go with normal execution 
			}
		}
		
		
	}
		
} 
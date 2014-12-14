<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
if(! function_exists('is_access_allowed'))
{
	function is_access_allowed()
	{
		$ci =& get_instance();
		$ci->load->database();
		if($ci->session->userdata['group_id'])
		{
			$group=$ci->session->userdata['group_id'];
			$class_name=$ci->router->directory.$ci->router->fetch_class();
			$query=$ci->db->query("SELECT * FROM privileges WHERE (group_id=$group or group_id= 0) 
									and active=1 and controller='$class_name'");
			
			if($query->num_rows()==1)
			{
				return TRUE;
			}
			else
			{
				return FALSE; 
			}
		}
		
	}	
}


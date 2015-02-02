<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Validation_model extends CI_Model
{
	public function get_store_id()
	{
		$query=$this->db->select('store_id')
				 ->from('users')
				 ->where('id',$this->session->userdata('user_id'))
				 ->get();
		if($query->num_rows()==1)
		{
			$data=$query->row();
			return $data->store_id;
		}
		else return NULL;
	}
	public function get_type_id()
	{
		$query=$this->db->select('type_id')
				 ->from('users')
				 ->where('id',$this->session->userdata('user_id'))
				 ->get();
		if($query->num_rows()==1)
		{
			$data=$query->row();
			return $data->type_id;
		}
		else return NULL;
	}
	
	function is_access_allowed($type_id,$name)
	{
		$query=$this->db->select('*')
					->from('rights')
					->where('type_id',$type_id)
					->where('can_access',$name)
					->get();
		if($query->num_rows()==1)
		{
			return TRUE;
		}
		else {
			return FALSE; 
		}
	}
}

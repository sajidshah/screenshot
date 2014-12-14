<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Screen_shots_model extends CI_Model
{
	
	public function get_screen_shots()
	{
		$this->db->select('*');
		$this->db->from('screen_shots');
		$query=$this->db->get();
		
		if($query->num_rows() > 0 )
		{
			return	$query->result_array();
		} 
		else 
		{
			return  NULL;
		}
			
	}
	public function get_category($id)
	{
		$this->db->select('*');
		$this->db->from('categories');
		$this->db->where('id',(int)$id);
		$query=$this->db->get();
		if($query->num_rows()==1) return $query->row_array();
		else return NULL;
	}
	
	public function add_category($data)
	{
		$this->db->insert('categories',$data);
		return $this->db->insert_id();
	}
	
	public function update_category($data)
	{
		$this->db->where('id',$data['id']);	
		$this->db->update('categories', $data);
	}
	
	public function delete_category($id)
	{
		
		
		
	
			
		$this->db->where('id',(int)$id);
		$this->db->delete('categories');
	}
	
	
	
}

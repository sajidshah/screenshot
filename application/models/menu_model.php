<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Menu_model extends CI_Model
{
	private $table_name='privileges';	
	
	public function get_menu()
	{
		$this->db->select('*');
		$this->db->from($this->table_name);
		$this->db->where('parent_id',(int)0);
		$this->db->where('active',1);
		$this->db->order_by('order','asc');
		$query=$this->db->get();
		if($query->num_rows() > 0 ) return $query->result();
		else return NULL;
		
		/*$query=$this->db->get($this->table_name);
		if($query->num_rows() > 0 ) return $query->result();
		else return NULL;*/
	}
	
	function get_sub_menu($id)
	{
		$this->db->select('*');
		$this->db->from($this->table_name);
		$this->db->where('parent_id',(int)$id);
		$this->db->where('active',1);
		$this->db->order_by('order','asc');
		$query=$this->db->get();
		if($query->num_rows() > 0 ) return $query->result();
		else return NULL;
	}
	
	function get_link_id($id)
	{
		$this->db->select('*');
		$this->db->from($this->table_name);
		$this->db->where('parent_id',(int)$id);
		$query=$this->db->get();
		if($query->num_rows()>0){ return $id;}
		else return NULL;
	}
}

<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Screen_shot_model extends CI_Model
{
	public function get_screen_shots($id,$limit,$start)
	{
		$this->db->select('*');
		$this->db->from('screen_shots');
		
		if($id > 0) $this->db->where('site_id', $id);
				
		$query=$this->db->get();
		
		if($query->num_rows() > 0 ) return $query->result();
		else return NULL;
	}
	public function get_target_screen($limit,$offset, $id=NULL, $rec_desc=array(), $search = NULL){
		
		$this->db->start_cache();
		
			$this->db->select('*');
			if($id) $this->db->where('id', $id);
			if($search) $this->db->like('title', $search);
			$this->db->from('target_screen');
			
		$this->db->stop_cache();
			
			//get total
			$data['total'] = $this->db->get()->num_rows();
			
			//get result
			$query=$this->db->get('', ($limit>0)?$limit:NULL, ($offset>0)?$offset:NULL);
			
		$this->db->flush_cache();
		
		$data['result'] = $query->result_array();
		
		foreach($query->result_array() as $key=>$val){
			
			$alarm = $this->getAlarm($val['id'], $rec_desc);
			
			$data['result'][$key]['frequency'] = $alarm['frequency'];
			$data['result'][$key]['freq_arr'] = $alarm['freq_arr'];
		}
		
		
		return $data;
		
	}
	public function getAlarm($site_id, $rec_desc){
		
		$data = array(); $freq = $alarm = "";
		
		$alarm = $this->db->select('*')->where('site_id', $site_id)->get('alarm')->result_array();
		if(!empty($alarm)){
				
			foreach($alarm as $a_key => $a_val):
						
				$freq .= "Start: ".date('m/d/Y g:i A', strtotime($a_val['start'])) ." - ";
				$freq .= "End: ".date('m/d/Y', strtotime($a_val['end']));
				$freq .= " - Repeating: ";
				
				//if($a_val['recurring']==1) $freq .= "Repeat Daily";
				//else if($a_val['recurring']==2) $freq .= "Repeat Weekly";
				//else $freq .= "None";
				
				$freq .= $rec_desc[$a_val['recurring']];
				 
				$freq .= "<br>";
				
			endforeach;
			
			$data['frequency'] = $freq;
			$data['freq_arr'] = $alarm;
			
			return $data; 
		}
		
	}
	public function get_total_rows($id = 0)
	{
		$this->db->select('*');
		$this->db->from('screen_shots');
		if($id > 0) $this->db->where('site_id', $id);
		$query=$this->db->get();
		if($query->num_rows()>0) return $query->num_rows();
		else return NULL;
	}
	public function get_target_screen_total_rows(){
		$this->db->select('*');
		$this->db->from('target_screen');
		$query=$this->db->get();
		if($query->num_rows()>0) return $query->num_rows();
		else return NULL;
	}
	public function update_status($id, $data)
	{
		$this->db->where('id',$id);	
		$this->db->update('screen_shots', $data);
	}
	public function update_reply($id, $data)
	{
		$this->db->where('id',$id);	
		$this->db->update('screen_shots', $data);
	}  
	public function get_screen_shot_id($id)
	{
		$this->db->select('*');
		$this->db->from('screen_shots');
		$this->db->where('id',(int)$id);
		$query=$this->db->get();
		
		if($query->num_rows()==1) return $query->row_array();
		else return NULL;
	}
	public function get_screen_shot_target_id($id)
	{
		$this->db->select('*');
		$this->db->from('target_screen');
		$this->db->where('id',(int)$id);
		$query=$this->db->get();
		if($query->num_rows()==1) return $query->row_array();
		else return NULL;
	}
	
	public function add_target_site($data) 
	{
	    
	    $site = $data;
		unset($site['datetime']);
		
		if($data['site_id'] >0 ){
			
			unset($site['site_id']);
			
			$result = $this->db->where('id',$data['site_id'])->update('target_screen', $site);
			$site_id = $data['site_id'];
		}
		else{
			
			unset($site['site_id']);
			$this->db->insert('target_screen', $site);
			$site_id = $this->db->insert_id();
		}
		
		if(!empty($data['datetime'])){
			
			$this->db->where('site_id', $site_id)->delete('alarm');
			foreach($data['datetime'] as $row){
				
				$row['site_id'] = $site_id;
				$row['start'] = $this->getTimeStamp($row['start']);
				$row['end'] = $this->getTimeStamp($row['end'], false); //false returns date only
				
				$this->db->insert('alarm', $row);
			}
		}
		
		
		return true;
		
	}
	
	protected function getTimeStamp($dateTime, $time=TRUE){
			
		if($time):
			$startTime = explode(' ', $dateTime);
			$time  = date("H:i:s", strtotime($startTime[1]." ".$startTime[2]));
			
			$chunks = explode('/',$startTime[0]);
			$date = $chunks[2]."-".$chunks[0]."-".$chunks[1];
			$timestamp = $date ." ". $time;
		else:
			
			$chunks = explode('/',$dateTime);
			$date = $chunks[2]."-".$chunks[0]."-".$chunks[1];
			$timestamp = $date ." ". $time;
			
		endif;
		
		return $timestamp;
	}
	
	public function update_reviews($data) 
	{
		$this->db->where('id',$data['id']);	
		$this->db->update('screen_shots', $data);
	}
	public function update_target_screen($data)
	{
		$this->db->where('id',$data['id']);	
		$this->db->update('target_screen', $data);
	}
	public function delete_target_screen($id)
	{
		$this->db->where('id',(int)$id);	
		$this->db->delete('target_screen');
	}
	
	function screenshot(){
		
		$curr_date = date('Y-m-d');
		$query ="SELECT alarm.*, target_screen.url, target_screen.width, target_screen.height, target_screen.mature_link  

					FROM `alarm`
					
					left join target_screen 
					ON alarm.site_id = target_screen.id
					
					where 
					 
					start >= '$curr_date' OR end >= '$curr_date'";
		$result = $this->db->query($query)->result_array();
		
		
		$curr_dtime = date('Y-m-d H:i');
		foreach($result as $row){
				
			//if no recurring
			if($row['recurring'] == 0){
				$start = date('Y-m-d H:i', strtotime($row['start']));
				$curr =  date('Y-m-d H:i', strtotime($curr_dtime));
				
				if($start == $curr) {
					$this->trigger($row);
				}
			}
			//daily repeat...
			else if($row['recurring'] == 1){
				$start = date('H:i', strtotime($row['start']));
				$curr =  date('H:i', strtotime($curr_dtime));
				if($start == $curr) {
					$this->trigger($row);
				}
			}
			//if weekly
			else if($row['recurring'] == 2){
				
				$start = date('D H:i', strtotime($row['start']));
				$curr =  date('D H:i', strtotime($curr_dtime));
				
				if($start == $curr) {
					$this->trigger($row);
				}
			}
		}
	}
	private function trigger($row){
		
		$image = $this->record($row);
		$data = array(
		   'site_id' => $row['site_id'] ,
		   'url' => $row['url'] ,
		   'image' => $image,
		   'timing' => date('Y-m-d H:i:s')
		);
		
		if($image) $this->db->insert('screen_shots', $data);
		
	}
	public function record($data){
		
		$url = $data['url'];
		
		if(isset($data['preview'])){
			
			return $pht_img = $this->phantom($data);
			die;
		}
		
		$name = 'img_'. str_ireplace("==", "", base64_encode(time())).".jpg";
		
		
		if($data['mature_link'] == 1) $ssh = 'DISPLAY=:2 sudo java  -Dwebdriver.chrome.driver=/usr/lib/chromium-browser/chromedriver -jar /screencapture/ScreenCapture.jar '. $url;
		else  $ssh = 'DISPLAY=:2 sudo java  -Dwebdriver.chrome.driver=/usr/lib/chromium-browser/chromedriver -jar /screencapture/ScreenCapture.without.click.jar '. $url;
		
		
		shell_exec($ssh);
		
		$image = "/var/www/screenshot.jpg";
		$target = "/var/www/admin/images/".$name;
		
		if(isset($data['height']) && $data['height']>0){
			
			$pht_img = $this->phantom($data);
		
			$img1 = $image; //jar image
			$img2 = $pht_img_path = FCPATH .'phantom/cache/'.$pht_img; //phantom image
			$img3 = $target; //merged image
			
			
		}
		
		copy($image, $target);
		
		if(isset($data['height']) && $data['height']>0){
		
			$merger = "composite ". $img1." ".$img2." ".$img3;
			$escaped_command = escapeshellcmd($merger);
	    	exec($escaped_command);
			
		}
		
		
		return $name;
	}
	
	public function phantom($data){
	    
		$url = 'http://104.131.163.49/phantom/shot.php?url='.str_replace('\'', '', $data['url']).'&w=1200&h='.$data['height'];
		return $html = file_get_contents($url);
	    
	}
	public function delete_site($id){
		
		$this->db->where('id',(int)$id);	
		return $this->db->delete('screen_shots');
		
	}
}

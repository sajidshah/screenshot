<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Myupload
{
	function image_upload($args)//$newName, $thumbName, $imagePath, $thumbPath)
	{
		//print_r($args);die;	
		$CI =& get_instance();
		$CI->load->library('upload');
		$CI->load->library('image_lib');
		
		if(array_key_exists('path',$args))
			$config['upload_path'] = $args['path'];
		else
			$config['upload_path'] = 'uploads';	// Default path for uploading images 
		
		if(array_key_exists('image',$args))
			$image=$args['image'];
		else
			$image='userfile';	// Default image name to be uploaded
			 
		if(array_key_exists('width',$args))
			$target_width= $args['width'];
		else
			$target_width=900;	
		
		if(array_key_exists('height',$args))
			$target_height=$args['height'];
		else
			$target_height= 600;	
		
		
		$config['file_name']=$args['newName'];
		
		if(array_key_exists('allowed_types',$args))
			$config['allowed_types']= $args['allowed_types'];
		else
			$config['allowed_types'] = 'gif|jpg|png|jpeg|jpe';
		
		
		$config['max_size']	= '0'; // No limit 
		$config['max_width']= '0'; // No limit
		$config['max_height']= '0';// No limit
		$config['overwrite']  = TRUE; // TRUE | False
		$CI->upload->initialize($config);
		
		if (!$CI->upload->do_upload($image))  // $args['image']
		{
			$error = array('error' => $CI->upload->display_errors());
			$CI->session->set_flashdata('error',$CI->upload->display_errors());
			return FALSE;
			exit();
		}
		
		// if file type is jpg,png,gif 
		if(array_key_exists('allowed_types',$args) && $args['allowed_types']=='gif|jpg|png|jpeg|jpe')
		{
			$filename=$CI->upload->upload_path.$CI->upload->file_name;
			$response=$this->resizeImageToDimensions($filename,$target_width,$target_height);			
		}
		
		
		if($args['thumb']==TRUE) // if image thumb is required 
		{
			$image_data=$CI->upload->data();
			$config['source_image']=$image_data['full_path'];
			$config['maintain_ratio']=FALSE;
			$config['create_thumb']=TRUE;
				
			if(array_key_exists('t_path',$args))
				$config['new_image']  = $args['t_path'];
			else
				$config['new_image']  = 'uploads/thumb';	
			
			if(array_key_exists('t_width',$args))
				$config['width']  = $args['t_width'];
			else
				$config['width']  = 267;	
				
			if(array_key_exists('t_height',$args))
				$config['height']  = $args['t_height'];
			else
				$config['height']  = 380;	
				
			$CI->image_lib->initialize($config);
			$CI->image_lib->resize();
			$CI->image_lib->clear();
		}
		return TRUE;
	}

	function resizeImageToDimensions($filename, $target_width, $target_height)
	{
	   	$CI =& get_instance();
		$CI->load->library('upload');
		$CI->load->library('image_lib');
	    list($width, $height) = getimagesize($filename);
	    $current_ratio = $width/$height;
	    $target_ratio = $target_width/$target_height;
	    $config['source_image'] = $filename;
	
	    if ($current_ratio > $target_ratio)
	    {
	        //resize first to height, maintain ratio
	        $config['height'] = $target_height;
	        $config['width'] = $target_height * $current_ratio;
	        $CI->image_lib->initialize($config);
	
	        if (!$CI->image_lib->resize())
	            return array('success'=>false, 'error'=>"There was an error while resizing this image");
	
	        //then crop off width
	        $config['width'] = $target_width;
	        $config['maintain_ratio'] = false;
	        $CI->image_lib->initialize($config);
	
	        /*if ($CI->image_lib->crop())
	            return array('success'=>true);
	        else
	            return array('success'=>false, 'error'=>"There was an error while cropping this image");
			 * 
			 */
	    }
	    else if ($current_ratio < $target_ratio)
	    {
	        //resize first to width, maintain ratio
	        $config['width'] = $target_width;
	        $config['height'] = $target_width / $current_ratio;
	        $CI->image_lib->initialize($config);
	
	        if (!$CI->image_lib->resize())
	            return array('success'=>false, 'error'=>"There was an error while resizing this image");
	
	        //then crop off height
	        $config['height'] = $target_height;
	        $config['maintain_ratio'] = false;
	        $CI->image_lib->initialize($config);
	
	        /*
	        if ($CI->image_lib->crop())
	            return array('success'=>true);
	        else
	            return array('success'=>false, 'error'=>"There was an error while cropping this image");
			 * 
			 */
	    }
	    else 
	    {
	        $config['width'] = $target_width;
	        $config['height'] = $target_height;
	        $CI->image_lib->initialize($config);
	
	        if ($CI->image_lib->resize())
	            return array('success'=>true);
	        else
	            return array('success'=>false, 'error'=>"There was an error while resizing this image");
	   }
	}

}

<?php
$login = array(
	'name'	=> 'login',
	'id'	=> 'login',
	'value' => set_value('login'),
	'maxlength'	=> 80,
	'size'	=> 30,
);
if ($this->config->item('use_username', 'tank_auth')) {
	$login_label = 'Email or login';
} else {
	$login_label = 'Email';
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $this->config->item('website_name','tank_auth');?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Bootstrap -->
		<link href="<?php echo base_url();?>css/bootstrap.css" rel="stylesheet" media="screen">
		<link href="<?php echo base_url();?>css/auth.css" rel="stylesheet" media="screen"> 
		<link href="<?php echo base_url();?>css/font-awesome.css" rel="stylesheet">
		<link href="<?php echo base_url();?>css/bootstrap-responsive.css" rel="stylesheet">
	</head>
	<body>
		<div class="navbar navbar-inverse navbar-fixed-top">
  			<div class="navbar-inner">
   				<button type="button" class="btn btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
    			</button>
    			<div class="nav-collapse collapse pull-left span12">
      				<ul class="nav">
        				<li><a href="<?php echo $this->config->item('website_url','tank_auth');?>" id="nav-links" target="_blank"><i class="icon-share-alt icon-white"></i><span>Main Website</span></a></li>
        				<?php if ($this->config->item('allow_registration', 'tank_auth')) { ?>  
        					<li><a href="<?php echo site_url('/auth/register/');?>" id="nav-links"><i class="icon-plus icon-white"></i><span>Register</span></a></li>
        				<?php }?>
      				</ul>
    			</div>
  			</div>
		</div>
		<div class="row-fluid">&nbsp;</div>
		<div class="row-fluid">&nbsp;</div>
		<div class="row-fluid">&nbsp;</div>
		<div class="row-fluid">
			<div class="span4 offset4"><div style="text-align:center;"><img src="<?php echo base_url();?>/images/logo.png" alt="Logo" title="Logo"></div></div>
		</div>
		<div class="row-fluid">&nbsp;</div>
		<div class="row-fluid">
			<div class="span4 offset4">
			   <?php echo form_open($this->uri->uri_string(),'class="form-signin"'); ?>
					<?php echo form_label($login_label, $login['id']); ?>
					<?php echo form_input($login); ?>
					<div style="color: red; margin: 5px auto;"><?php echo form_error($login['name']); ?><?php echo isset($errors[$login['name']])?$errors[$login['name']]:''; ?></div>
					<div style="margin: 5px auto;" class="text text-success"><?php if($this->session->flashdata('msg')) echo $this->session->flashdata('msg'); ?></div>
					<?php echo form_submit('reset', 'Get a new password','class="btn btn-primary"'); ?>
					<?php echo anchor('auth/login','Back to login','class="btn btn-primary"');?>
				<?php echo form_close(); ?>
			<div class="navbar navbar-inverse navbar-fixed-bottom">
				<div class="navbar-inner">
			    	<div class="container-fluid">
			        	<ul class="nav pull-left">
			            	<li><a href="">Copyright&copy; 2013. All rights reserved.</a></li>
			            </ul>
			            <ul class="nav pull-right">
							<li><a href="http://www.iThinq.net" target="_blank"><span style="color:#fff;">Powered By:</span> iThinq innovating solutions</a></li>
			            </ul>
			        </div>
			  	</div>
			</div>
		<script src="http://code.jquery.com/jquery.js"></script> 
		<script src="<?php echo base_url();?>js/bootstrap.js"></script>
	</body>
</html>




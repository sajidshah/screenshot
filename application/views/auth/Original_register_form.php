<?php
if ($use_username) {
	$username = array(
		'name'	=> 'username',
		'id'	=> 'username',
		'value' => set_value('username'),
		'maxlength'	=> $this->config->item('username_max_length', 'tank_auth'),
		'size'	=> 30,
	);
}
$email = array(
	'name'	=> 'email',
	'id'	=> 'email',
	'value'	=> set_value('email'),
	'maxlength'	=> 80,
	'size'	=> 30,
);
$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'value' => set_value('password'),
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size'	=> 30,
);
$confirm_password = array(
	'name'	=> 'confirm_password',
	'id'	=> 'confirm_password',
	'value' => set_value('confirm_password'),
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size'	=> 30,
);
$captcha = array(
	'name'	=> 'captcha',
	'id'	=> 'captcha',
	'maxlength'	=> 8,
);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Deans Techno. ICT Services Home & Abroad.</title>
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
        				<li><a href="#" id="nav-links"><i class="icon-share-alt icon-white"></i><span>Main Website</span></a></li>
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
					<?php if ($use_username) { ?>
	
						<?php echo form_label('Username', $username['id']); ?>
						<?php echo form_input($username); ?>
						<div style="color: red;"><?php echo form_error($username['name']); ?><?php echo isset($errors[$username['name']])?$errors[$username['name']]:''; ?></div>
					
					<?php } ?>
					
						<?php echo form_label('Email Address', $email['id']); ?>
						<?php echo form_input($email); ?>
						<div style="color: red;"><?php echo form_error($email['name']); ?><?php echo isset($errors[$email['name']])?$errors[$email['name']]:''; ?></div>
					
					
						<?php echo form_label('Password', $password['id']); ?>
						<?php echo form_password($password); ?>
						<div style="color: red;"><?php echo form_error($password['name']); ?></div>
					
					
						<?php echo form_label('Confirm Password', $confirm_password['id']); ?>
						<?php echo form_password($confirm_password); ?>
						<div style="color: red;"><?php echo form_error($confirm_password['name']); ?></div>
					
				
						<?php if ($captcha_registration) {
							if ($use_recaptcha) { ?>
					
							<div id="recaptcha_image"></div>
						
						
							<a href="javascript:Recaptcha.reload()">Get another CAPTCHA</a>
							<div class="recaptcha_only_if_image"><a href="javascript:Recaptcha.switch_type('audio')">Get an audio CAPTCHA</a></div>
							<div class="recaptcha_only_if_audio"><a href="javascript:Recaptcha.switch_type('image')">Get an image CAPTCHA</a></div>
						
					
					
						
							<div class="recaptcha_only_if_image">Enter the words above</div>
							<div class="recaptcha_only_if_audio">Enter the numbers you hear</div>
						
							<input type="text" id="recaptcha_response_field" name="recaptcha_response_field" />
							<div style="color: red;"><?php echo form_error('recaptcha_response_field'); ?></div>
							<?php echo $recaptcha_html; ?>
					
						<?php } else { ?>
							<p>Enter the code exactly as it appears:</p>
							<?php echo $captcha_html; ?>
							
							<?php echo form_label('Confirmation Code', $captcha['id']); ?>
							<?php echo form_input($captcha); ?>
							<div style="color: red;"><?php echo form_error($captcha['name']); ?></div>
					
						<?php }
					} ?>
				
				<?php echo form_submit('register', 'Register','class="btn btn-primary"'); ?>
			<?php echo form_close(); ?>
			<div class="navbar navbar-inverse navbar-fixed-bottom">
				<div class="navbar-inner">
			    	<div class="container-fluid">
			        	<ul class="nav pull-left">
			            	<li><a href="">Copyright&copy; 2013. All rights reserved.</a></li>
			            </ul>
			            <ul class="nav pull-right">
			            	<li><a href="#">Deans Techno</a></li>
			            </ul>
			        </div>
			  	</div>
			</div>
		<script src="http://code.jquery.com/jquery.js"></script> 
		<script src="<?php echo base_url();?>js/bootstrap.js"></script>
	</body>
</html>





	
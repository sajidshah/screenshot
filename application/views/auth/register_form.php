<?php
//echo "<pre>";print_r($employees);
if ($use_username) {
	$username = array(
		'name'	=> 'username',
		'id'	=> 'username',
		'value' => set_value('username'),
		'maxlength'	=> $this->config->item('username_max_length', 'tank_auth'),
		'size'	=> 30,
		'class'	=> 'span7 pull-left'
	);
}
$email = array(
	'name'	=> 'email',
	'id'	=> 'email',
	'value'	=> set_value('email'),
	'maxlength'	=> 80,
	'size'	=> 30,
	'class'	=> 'span7 pull-left'
);
$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'value' => set_value('password'),
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size'	=> 30,
	'class'	=> 'span7 pull-left'
);
$confirm_password = array(
	'name'	=> 'confirm_password',
	'id'	=> 'confirm_password',
	'value' => set_value('confirm_password'),
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size'	=> 30,
	'class'	=> 'span7 pull-left'
);

?>
<h1 id="main-heading"><?php echo $title?></h1>
<div class="row-fluid">
	<?php if($this->session->flashdata('msg')) { ?>
		<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert"><i class="icon icon-remove"></i></button>
				<?php echo $this->session->flashdata('msg'); ?>
		</div>
	<?php } ?>
</div>

<div class="row-fluid">
	<?php 
	if(sizeof($errors) > 0 ) { ?>
		<div class="alert alert-error">
			<button type="button" class="close" data-dismiss="alert"><i class="icon icon-remove"></i></button>
			<ul>
				<?php foreach($errors as $key=>$val){ ?>
				<li><?php echo $val;?></li>
				<?php } ?>
			</ul>
		</div>
	<?php } ?>
</div>

<div class="row-fluid">
	<div class="widget-box">
		<div class="widget-title">
			<span class="icon"><i class="icon icon-align-justify"></i></span>
			<h5><?php echo $title; ?></h5>
		</div>
		<div class="widget-content entry">
			<?php echo form_open($this->uri->uri_string(),'class="form-signin"'); ?>
			
			<!-- If username enable -->
			<?php if ($use_username) { ?>
				<div class="row-fluid control-group <?php if(form_error($username['name'])) echo "error"; ?>">
					<label class="control-label span3 pull-left" for="<?php echo $username['id'];?>">Username</label>	
					<div class="controls span9">
						<?php echo form_input($username); ?>
						<?php if(form_error($username['name'])) { ?>
							<span class="help-inline pull-right span5 margin-zero"><?php echo form_error($username['name']); ?></span>
						<?php } ?>
					</div>
				</div>
			<?php } ?>
			
			<!-- Email -->
			<div class="row-fluid control-group <?php if(form_error($email['name'])) echo "error"; ?>">
					<label class="control-label span3 pull-left" for="<?php echo $email['id'];?>">Email Address</label>	
					<div class="controls span9">
						<?php echo form_input($email); ?>
						<?php if(form_error($email['name'])) { ?>
							<span class="help-inline pull-right span5 margin-zero"><?php echo form_error($email['name']); ?></span>
						<?php } ?>
					</div>
			</div>
			
			<!-- Passward -->
			<div class="row-fluid control-group <?php if(form_error($password['name'])) echo "error"; ?>">
					<label class="control-label span3 pull-left" for="<?php echo $password['id'];?>">Password</label>	
					<div class="controls span9">
						<?php echo form_password($password); ?>
						<?php if(form_error($password['name'])) { ?>
							<span class="help-inline pull-right span5 margin-zero"><?php echo form_error($password['name']); ?></span>
						<?php } ?>
					</div>
			</div>
			
			<!-- Confirm Password -->
			<div class="row-fluid control-group <?php if(form_error($confirm_password['name'])) echo "error"; ?>">
					<label class="control-label span3 pull-left" for="<?php echo $confirm_password['id'];?>">Confirm Password</label>	
					<div class="controls span9">
						<?php echo form_password($confirm_password); ?>
						<?php if(form_error($confirm_password['name'])) { ?>
							<span class="help-inline pull-right span5 margin-zero"><?php echo form_error($confirm_password['name']); ?></span>
						<?php } ?>
					</div>
			</div>
			<div class="row-fluid well well-small">
					<div class="span9 offset3">
						<?php echo form_submit('register', 'Register', 'class="btn btn-success btn-large pull-right"'); ?>
					</div>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>

			
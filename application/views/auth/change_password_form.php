<?php
$old_password = array(
	'name'	=> 'old_password',
	'id'	=> 'old_password',
	'value' => set_value('old_password'),
	'size' 	=> 30,
	'class'	=> 'form-control'
);
$new_password = array(
	'name'	=> 'new_password',
	'id'	=> 'new_password',
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size'	=> 30,
	'class'	=> 'form-control'
);
$confirm_new_password = array(
	'name'	=> 'confirm_new_password',
	'id'	=> 'confirm_new_password',
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size' 	=> 30,
	'class'	=> 'form-control'
);
?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Change Password</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
	<?php if($this->session->flashdata('msg')) {?>
		<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert"><i class="fa fa-times"></i></button>
			<?php echo $this->session->flashdata('msg');?>
		</div>
	<?php }?>
</div>
<!-- /.row -->
<div class="row-fluid">
	<?php 
	if(sizeof($errors) > 0 ) { ?>
		<div class="alert alert-error">
			<button type="button" class="close" data-dismiss="alert"><i class="fa fa-times"></i></button>
			<ul>
				<?php foreach($errors as $key=>$val){ ?>
				<li><?php echo $val;?></li>
				<?php } ?>
			</ul>
		</div>
	<?php } ?>
</div>
<!-- /.row -->
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<span><i class="fa fa-fw fa-align-justify"></i></span><span><?php echo $title;?></span>
				
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<?php echo form_open($this->uri->uri_string(),'class="form-horizontal" role="form"'); ?>
				<?php //echo form_open($post_controller,'class="form-horizontal" role="form"'); ?>
					<div class="form-group  <?php if(form_error('old_password')) echo "has-error"; ?>">
						<label for="old_password" class="col-sm-3 control-label">Old Password</label>
						<div class="col-sm-9">
						  <?php echo form_password($old_password); ?>
						  <?php if(form_error('old_password')) { ?>
							<span class="help-inline"><?php echo form_error($old_password['name']); ?><?php echo isset($errors[$old_password['name']])?$errors[$old_password['name']]:''; ?></span>
						  <?php } ?>
						</div>
					</div>
					
					<div class="form-group <?php if(form_error('new_password')) echo "has-error"; ?>">
						<label for="new_password" class="control-label col-sm-3">New Password</label>
						<div class="col-sm-9">
							<?php echo form_password($new_password); ?>
							<?php if(form_error('new_password')) { ?>
									<span class="help-inline"><?php echo form_error($new_password['name']); ?><?php echo isset($errors[$new_password['name']])?$errors[$new_password['name']]:''; ?></span>
							<?php } ?>
						</div>
					</div>
					
					<div class="form-group <?php if(form_error('confirm_new_password')) echo "has-error"; ?>">
						<label for="confirm_new_password" class="control-label col-sm-3">Confirm New Password</label>
						<div class="col-sm-9">
							<?php echo form_password($confirm_new_password); ?>
							<?php if(form_error('confirm_new_password')) { ?>
									<span class="help-inline"><?php echo form_error($confirm_new_password['name']); ?><?php echo isset($errors[$confirm_new_password['name']])?$errors[$confirm_new_password['name']]:''; ?></span>
							<?php } ?>
						</div>
					</div>
					<div class="row well well-small">
						<div class="span9 offset3">
							<?php echo form_submit('change', 'Change Password', 'class="btn btn-success btn-large pull-right"'); ?>
							
						</div>
					</div>
				<?php //echo form_hidden('page_id', $fields['id']); ?>
				<?php form_close();?>
			
			</div>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->

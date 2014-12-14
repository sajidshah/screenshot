<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><?php echo $title;?></h1>
	</div>
	<!-- /.col-lg-12 -->
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<span><i class="fa fa-fw fa-folder-open-o"></i></span><span><?php echo $title;?></span>
				
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body nopadding">
			<?php if($screen_shot!=NULL) {?>
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover" id="dataTables-example">
						<tbody>
						
							<tr>
								<th width="25%">Url</th>
								<td><?php echo $screen_shot['url'];?></td>
							</tr>
							<tr>
								<th width="25%">Screen Shot</th>
								<td><a href="<?php echo base_url("images/".$screen_shot['image']);?>" target="_blank"><img height="300" src="<?php echo base_url("images/".$screen_shot['image']);?>"/></a></td>
							</tr>
							<tr>
								<th width="25%">Time</th>
								<td><?php echo date('M j Y g:i A', strtotime($screen_shot['timing']));?></td>
							</tr>
								
								
					
						</tbody>
					</table>
					
				</div>
				<?php } else echo '<div class="alert alert-info"><strong>Oh snap!</strong> No data found.</div>';?>
				<!-- /.table-responsive -->	
			</div>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->

<!-- modal for details -->

<div class="modal fade" id="detail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Detail</h4>
      </div>
      <div class="modal-body" style="overflow:hidden">
        <div class="col-lg-4 col-sm-4">
        	<img class="img-responsive" src="<?php echo base_url('uploads/screen_shots/thumb/img.jpg'); ?>">
        </div>
        <div class="col-lg-4 col-sm-4">
        	<p>url : abc.com</p>
        	<p>time  5:00</p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Ok</button> -->
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><?php echo $title;?></h1>
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
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				
					<form class="form-inline" method="get" action="<?php echo site_url();?>cms/target_screen/index">
						<span><i class="fa fa-fw fa-folder-open-o"></i></span><span><?php echo $title;?></span><span class="badge badge-inverse rows" style="margin-right: 20px;"><?php echo $total_rows; ?></span>
						<!--<input type="hidden" name="page" value="<?php echo (isset($_GET['page']) ? $_GET['page'] : ''); ?>">
						<input type="text" name="search" value="<?php echo (isset($_GET['search']) ? $_GET['search'] : ''); ?>" placeholder="search" class="form-control">
						
						<input type="submit" value="search" class="btn btn-primary">
						-->
						<a  href="<?php echo site_url('cms/target_screen/add')?>" class="pull-right fa btn btn-add btn-inverse" data-toggle="tooltip" data-placement="bottom" title="Add Page"><i class="fa-plus"></i></a>
					</form>
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body nopadding">
			<?php if($target_screen!=NULL) {?>
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover" id="dataTables-example">
						<thead>
							<th width="20%">Title</th>
							<th width="20%">URL</th>
							<th width="40%">Screenshots</th>
						
							<th width="10%">Size (px)</th>
							<!--<th width="10%">Edit</th>-->
							<th width="10%">Delete</th>
						</thead>
						<tbody>
							<?php foreach($target_screen as $row) { ?>
							<tr>
								<td><a href="<?php echo site_url("cms/screenshot/index/".$row['id']); ?>" ><?php echo $row['title'];?></a></td>
								<td><?php echo $row['url'];?></td>
								<!-- <td><?php echo strip_tags(word_limiter($row->content_en, 15));?></td> -->
								<td><?php echo $row['frequency'];?></td>
								<td>
									<?php echo "Width: ".$row['width'];?>
									<?php echo "<br>Height: ".$row['height'];?>
								</td>
								<!--<td>
									<a class="btn btn-info" href="<?php echo site_url("cms/target_screen/update/$row->id") ?>"> Edit</a> 
								</td>-->
								<td style="font-size: 20px;">
									<a href="<?php echo site_url("cms/target_screen/add/".$row['id']) ?>"> <i class="glyphicon glyphicon-edit"></i> </a>
									&nbsp;
									<a href="<?php echo site_url("cms/target_screen/delete/".$row['id']) ?>" onclick="return confirm('Are you sure you want to delete this Page?')"><i class="glyphicon glyphicon-trash"></i> </a>
									
								</td>
							</tr>
						<?php } ?>
						</tbody>
					</table>
					<!--<div class="row">
						<div class="col-sm-6">
							<div class="dataTables_info" id="dataTables-example_info" role="alert" aria-live="polite" aria-relevant="all">
								Total Record Found :<strong><?php echo $total_rows; ?></strong>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="dataTables_paginate paging_simple_numbers" id="dataTables-example_paginate">
								<?php echo $pagination;?>
							</div>
						</div>
					</div> -->
				</div>
				<?php } else echo '<div class="alert alert-info">Please wait while Capturalize collects your screenshot. Check back in a moment.</div>';?>
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
<script>
$(function () {
	$('#dataTables-example').dataTable({
         "columnDefs": [
            {
                "targets": [2], "orderable": false
            },
            {
                "targets": [ 3 ], "orderable": false
            },
            {
                "targets": [ 4 ], "orderable": false
            }
        ]
    });
});
</script>

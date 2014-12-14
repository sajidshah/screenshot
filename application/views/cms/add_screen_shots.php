<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Target Site</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			
			<!-- /.panel-heading -->
			<div class="panel-body">
				<?php echo form_open($post_controller,'class="form-horizontal" role="form" enctype="multipart/form-data"'); ?>
					
					<input type="hidden" name="site_id" value="<?php echo (isset($site['id']))?$site['id']:0; ?>">
					
					<div class="form-group  <?php if(form_error('url')) echo "has-error"; ?>">
						<label for="url" class="col-sm-2 control-label">Title</label>
						<div class="col-sm-10">
						  
						  <input name="title" id="title" type="text" class="form-control" required="required" value="<?php echo (isset($site['title']))?$site['title']:''; ?>">
						  
						  <?php if(form_error('url')) { ?>
							<span class="help-inline"><?php echo form_error('url'); ?></span>
						  <?php } ?>
						</div>
					</div>
					
					<!-- date and time -->
					<div class="form-group">
		            	<label for="datetime" class="col-sm-2 control-label">Date &amp; Time (PST)</label>
		            	<!-- time -->	
		                <div class='input-group date col-sm-10' id='datetimepicker1'>
		                    <input type='text' value="<?php echo $start; ?>" placeholder="Date and Time" class="form-control selector" />
		                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
		                </div>
				    </div>
					
					<div class="form-group  <?php if(form_error('url')) echo "has-error"; ?>">
						<label for="url" class="col-sm-2 control-label">Url</label>
						<div class="col-sm-10">
						  
						  <input name="url" id="url" type="text" class="form-control" required="required" value="<?php echo (isset($site['url']))?$site['url']:''; ?>">
						  
						  <?php if(form_error('url')) { ?>
							<span class="help-inline"><?php echo form_error('url'); ?></span>
						  <?php } ?>
						</div>
					</div>
					
					<div class="form-group">    
		                <label for="repeating" class="col-sm-2 control-label">Repeating</label>
		                <div class='input-group date col-sm-10'>
		                    <select name="" class="form-control recurring">
		                    	<option value=""><?php echo $recc_des[0]; ?></option>
		                    	<option value="1"><?php echo $recc_des[1]; ?></option>
		                    	<option value="2"><?php echo $recc_des[2]; ?></option>
		                    </select>
		                </div>
		                
				        
				    </div>
				    
				    <div class="form-group">
		            	<label for="end-date" class="col-sm-2 control-label">End Date</label>
				        <div class='input-group date col-sm-8' id='datetimepicker10'>
		                    <input value="<?php echo $end; ?>" type='text' class="endDate form-control" placeholder="End Date" />
		                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
		                    </span>
		                </div>
		                
		                <div class='input-group date col-sm-2'>
		                	<input type="button" class="btn btn-primary addTime" value=" Add ">
		                </div>
		                
		                <script type="text/javascript">
				            $(function () {
				                $('#datetimepicker1').datetimepicker();
				                
					            $('#datetimepicker10').datetimepicker({
					            	pickTime: false
					            });
					            
					            $('#datetimepicker1').data("DateTimePicker").setMinDate(new Date("<?php echo date('M d, Y'); ?>"));
					            
					            $("#datetimepicker1").on("dp.change",function (e) {
					               $('#datetimepicker10').data("DateTimePicker").setMinDate(e.date);
					            });
					            $("#datetimepicker10").on("dp.change",function (e) {
					               $('#datetimepicker1').data("DateTimePicker").setMaxDate(e.date);
					            });
					            
				            });
				        </script>
		                
		            </div>
				    
				    <div class="form-group  <?php if(form_error('url')) echo "has-error"; ?>">
						<label class="col-sm-2 control-label">Width</label>
						<div class="col-sm-3">
							<input type="text" name="width" id="width" class="form-control" value="<?php echo (isset($site['width']))?$site['width']:''; ?>" placeholder="Optional">
						</div>
						<label class="col-sm-1 control-label">Height</label>
						<div class="col-sm-3">
							<input type="text" name="height" id="height" class="form-control" value="<?php echo (isset($site['height']))?$site['height']:''; ?>" placeholder="Optional">
						</div>
						<div class="input-group date col-sm-2">
		                	<input type="button" class="btn btn-primary preview" value=" Preview ">
		                </div>
					</div>
                    
				    
				    <table class="table datetime">
				    	<tr>
				    		
				    		<th>Date &amp; Time</th>
				    		<th>End Date</th>
				    		<th>Repeating</th>
				    		<th>&nbsp;</th>
				    	</tr>
				    	<?php if(isset($site['freq_arr']) && !empty($site['freq_arr'])):
				    		foreach($site['freq_arr'] as $row): 
				    			
								$start = date('m/d/Y g:i A', strtotime($row['start']));
								$end = date('m/d/Y', strtotime($row['end']));
								$recc = $row['recurring'];
				    		?>
				    		
				    			<tr>
				    				<td><?php echo $start; ?></td>
				    				<td><?php echo $end; ?></td>
				    				<td><?php echo $recc_des[$recc]; ?>
				    					
				    					<input type="hidden" name="start[]" value="<?php echo $start; ?>">
				    					<input type="hidden" name="end[]" value="<?php echo $end; ?>">
				    					<input type="hidden" name="recurring[]" value="<?php echo $recc; ?>">
				    				</td>
				    				<td>
				    					<a class="removeTr"> <i class="glyphicon glyphicon-remove"></i> Remove</a>
				    				</td>
				    			</tr>
				    		
				    		<?php 
				    		endforeach; 
				    	endif; ?>
				    </table>
					
					
			</div>
			<!-- /.panel-body -->
		</div>
			<div class="col-sm-12">
				<div class="span9 offset3">
					<?php echo form_submit('submit', 'Submit', 'class="btn btn-success btn-large pull-right"'); ?>
				</div>
			</div>
			
			<?php form_close();?>
		<!-- /.panel -->
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
		

<!-- include summernote js-->
	<script src="<?php echo base_url();?>assets/js/summernote.min.js"></script>
	<script>
		$(document).ready(function() {
		  $('.summernote').summernote({
			  height: 200
			});
			
			
			//preview link
			
			$('.preview').click(function(){
				
				url = $('#url').val();
				//width = $('#width').val();
				height = $('#height').val();
				
				post_url = "<?php echo site_url();?>cms/target_screen/preview/?url="+encodeURIComponent(url)+'&height='+height;
				
				window.open(post_url, '_blank'); 
				return false;     
				
				
			});
			
			$('.addTime').click(function(){
				
				dtime = $('.selector').val();
				if(dtime == "") return false;
				row ="";
				
				selVal = $('.recurring').val();
				
				row += "<tr>";
					
					row += "<td>";
						row += dtime;
					row += "</td>";
					
					row += "<td>";
						row += $('.endDate').val();
					row += "</td>";
					
					row += "<td>";
						
						if(selVal == 1) row += "<?php echo $recc_des[1]; ?>";
						else if(selVal == 2) row += "<?php echo $recc_des[2]; ?>";
						else row += "<?php echo $recc_des[0]; ?>";
						
						//row += $('.recurring').val();
						row += "<input type='hidden' name='start[]' value='"+dtime+"'>";
						row += "<input type='hidden' name='end[]' value='"+$('.endDate').val()+"'>";
						row += "<input type='hidden' name='recurring[]' value='"+selVal+"'>";
						
					row += "</td>";
					
					
					row += "<td>";
						row += "<a class='removeTr'> <i class='glyphicon glyphicon-remove'></i> Remove</a>";
					row += "</td>";
				row += "</tr>";
				
				$('table.datetime').append(row);
				$('.selector').val(''); $('.endDate').val('')
				
			});
			
			$( "table.datetime " ).on( "click", 'a.removeTr', function() {
				$(this).parents('tr').remove();
				return false;
			});
		});
		
	</script>
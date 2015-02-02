<ul class="nav" id="side-menu">
	<?php foreach ($this->Menu_model->get_menu() as $key => $item) { ?>
		<?php if ($this->session->userdata('group_id') && $item->group_id == $this->session->userdata('group_id') || $item->group_id == '0'){ ?>
        	<?php if ($this->tank_auth->is_logged_in()) { ?>
        		<?php $item_id=$this->Menu_model->get_link_id($item->id); ?>
			<!--main menu for id 66 that is screenshot will be not shown -->
				<?php if($item->id != 66){ ?>
				<?php if($item->id!=$item_id){ ?>
					<li>
						<a <?php if($item->controller=='dashboard') echo 'class="active"';?> href="<?php echo site_url($item->controller .'/'. $item->view);?>" title="<?php echo $item->title;?>"><i class="<?php echo $item->icon;?>"></i> <span><?php echo $item->title;?></span></a>
						
					</li>					
				<?php } ?>
				<?php if($sub_links=$this->Menu_model->get_sub_menu($item->id)){ ?>
					<li>
					<a href="#" data-toggle="collapse" data-target="#<?php echo url_title($item->title);?>-sub-nav" title="<?php echo $item->title;?>"><i class="<?php echo $item->icon;?>"></i><span><?php echo " " . $item->title;?></span><span class="fa arrow"></span></a>
					 	<ul id="<?php echo url_title($item->title);?>-sub-nav" class="nav nav-second-level">
						 	<?php foreach($sub_links as $sub) { ?>
						    <li>
						        <a href="<?php echo site_url($sub->controller .'/'. $sub->view);?>" title="<?php echo $sub->title;?>">
						            <i class="<?php echo $sub->icon;?>"></i>
						            <span> <?php echo $sub->title;?></span>
						        </a>
						    </li>
						    <?php } ?>
					 	</ul>
				 	</li>
				<?php } ?>
				<?php } ?> <!-- closing for main menu for id 66 -->
	  		<?php } ?>
	  	<?php } ?>
	<?php }?>
</ul>

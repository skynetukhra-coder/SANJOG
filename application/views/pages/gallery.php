<div class="row">
	<div class="col-md-9 col-sm-8 col-md-push-3 col-sm-push-4">
		<div class="right-panel">
			<div class="breadcrumb">
				<?php echo $this->lang->line('pic_vdo_glry'); ?> &raquo; <?php echo $this->lang->line('photo_glry'); ?></div>
			<div>
				<h1 class="title"><?php echo $this->lang->line('photo_glry'); ?></h1>
				<div class="gallery">
					<ul class="nav nav-tabs">
						<li class="active blue-dark-bg"><a data-toggle="tab" href="#tab1"><?php echo $this->lang->line('agae'); ?></a></li>
						<li class="blue-dark-bg"><a data-toggle="tab" href="#tab2"><?php echo $this->lang->line('pr_ag_ssa'); ?></a></li>
						<li class="blue-dark-bg"><a data-toggle="tab" href="#tab3"><?php echo $this->lang->line('age_rsa'); ?></a></li>
					</ul>
					<div class="tab-content">
						<div id="tab1" class="tab-pane fade in active">
							<div class="row">
							<?php
								if(!empty($gallery_agae)){
									foreach($gallery_agae as $file){?>
										<div class="col-sm-6">
											<div class="pic">
                                              <img alt="" src="<?php echo base_url().'galleryIMG/medium/'.$file['image'] ?>" style="width:100%; height:100%;"/>
                                              <div class="pic-title"><?php echo $file['title'] ?></div>
                                            </div>
										</div>
											  
								<?php	}
								}?>
							</div>
						</div>
						<div id="tab2" class="tab-pane fade">
							<div class="row">
							<?php
								if(!empty($gallery_aggssa)){
									foreach($gallery_aggssa as $file){?>
										<div class="col-sm-6">
											<div class="pic">
                                               <img alt="" src="<?php echo base_url().'galleryIMG/medium/'.$file['image'] ?>" style="width:100%; height:100%;"/>
                                              <div class="pic-title"><?php echo $file['title'] ?></div>
                                            </div>
										</div>
											  
								<?php	}
								}?>
							</div>
						</div>
						<div id="tab3" class="tab-pane fade">
							<div class="row">
							<?php
								if(!empty($gallery_agersa)){
									foreach($gallery_agersa as $file){?>
										<div class="col-sm-6">
											<div class="pic">
                                              <img alt="" src="<?php echo base_url().'galleryIMG/medium/'.$file['image'] ?>" style="width:100%; height:100%;"/>
                                              <div class="pic-title"><?php echo $file['title'] ?></div>
                                            </div>
										</div>
											  
								<?php	}
								}?>
							</div>
						</div>   
					 </div>  
				</div>
			</div>
		</div>
	</div>
	
	<div class="col-md-3 col-sm-4  col-md-pull-9 col-sm-pull-8">
		<div class="left-panel">
	  <?php $this->load->view('layout/left_panel');?>
	   </div>
	</div>
</div>
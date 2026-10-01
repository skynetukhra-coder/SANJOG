<div class="row">
	<link rel="stylesheet" href="<?php echo base_url()?>assets/css/unite-gallery.css" type="text/css" />	
	<div class="col-md-9 col-sm-8 col-md-push-3 col-sm-push-4">
		<div class="right-panel">
			<div class="breadcrumb">
				<a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; Video Gallery</div>
			<div>
				<h1 class="title">Video Gallery</h1>
				<div class="page-details">
						<?php
						if(!empty($videos)){
							foreach($videos as $file){
								//$ext = pathinfo($file, PATHINFO_EXTENSION);
								//echo $ext.'<br>';
								echo '<video width="320" height="240" controls>
										  <source src="'.base_url().'/userfiles/files/videos/'.$file.'" type="video/mp4">
										  <source src="'.base_url().'/userfiles/files/videos/'.$file.'" type="video/ogg">
										  Your browser does not support the video tag.
										</video>';
							}
						}?>
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
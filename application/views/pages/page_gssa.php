<div class="row">
	
	<div class="col-md-9 col-sm-8 col-md-push-3 col-sm-push-4">
		<div class="right-panel">
			<div class="breadcrumb">
				<a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_g_ssa'); ?></a> &raquo; 
				<?php
				if(!empty($breadcrumb)){
					foreach($breadcrumb as $bread){
						echo $bread.' &raquo; ';
					}
				}
				?>
				<?php echo $row['page_title']?></div>
			<div>
				<h1 class="title"><?php echo $row['page_title']?></h1>
				<div class="page-details"><?php echo $row['page_desc']?></div>
			</div>
		</div>
	</div>
	
	<div class="col-md-3 col-sm-4  col-md-pull-9 col-sm-pull-8">
		<div class="left-panel">
	  <?php $this->load->view('layout/left_panel');?>
	   </div>
	</div>
</div>
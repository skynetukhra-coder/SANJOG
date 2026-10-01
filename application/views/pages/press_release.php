<div class="row">
	<link rel="stylesheet" href="<?php echo base_url()?>assets/css/unite-gallery.css" type="text/css" />	
	<div class="col-md-9 col-sm-8 col-md-push-3 col-sm-push-4">
		<div class="right-panel">
			<div class="breadcrumb">
				<?php echo $this->lang->line('mda_rles'); ?> &raquo; <?php echo $this->lang->line('prs_rles'); ?>
			</div>
			<div>
				<h1 class="title"><?php echo $this->lang->line('prs_rles'); ?></h1>
				<div class="page-details">
					<div class="row text-center">
						<div class="col-sm-4"><div class="pension-case dark div-anchor" onclick="linkTOPage('<?php echo AGAE_BASE_URL ?>page/press-release')"> <?php echo $this->lang->line('press_realease_for'); ?>  <br /> <?php echo $this->lang->line('agae'); ?>  </div></div>
						<div class="col-sm-4"><div class="pension-case saffron-bg div-anchor" onclick="linkTOPage('<?php echo AGGSSA_BASE_URL ?>page/press-release')"> <?php echo $this->lang->line('press_realease_for'); ?>  <br />  <?php echo $this->lang->line('pr_ag_ssa'); ?>  </div></div>
						<div class="col-sm-4"><div class="pension-case blue-dark-bg div-anchor" onclick="linkTOPage('<?php echo AGERSA_BASE_URL ?>page/press-release')"> <?php echo $this->lang->line('press_realease_for'); ?>  <br />  <?php echo $this->lang->line('age_rsa'); ?>  </div></div>
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
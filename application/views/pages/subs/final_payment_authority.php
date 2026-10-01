<style>
th,td{line-height:15px; padding:5px}
</style>
<div class="row">
	<div class="col-md-3 col-sm-4">
		<div class="left-panel">
			<?php $this->load->view('layout/subscribers_left_panel',$header);?>
		</div>
	</div>
	<div class="col-md-9 col-sm-8">
		<div class="right-panel">
			<div class="breadcrumb"><a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('subscriber'); ?> &raquo; <?php echo $this->lang->line('missing_debit_credit')?>											
			</div>
			<div class="msg_cont">
				<div class="success">
					<?php if(isset($success) && !empty($success)){
							echo '<div class="msg">'.$success.'</div>';
						  }else if($this->session->flashdata('success')){
							echo '<div class="msg">'.$this->session->flashdata('success').'</div>';
						  }
					 ?>
				</div>
				<div class="err">
					<?php if(isset($error) && !empty($error)){
							echo '<div class="msg">'.$error.'</div>';
						  }else if($this->session->flashdata('error')){
							echo '<div class="msg">'.$this->session->flashdata('error').'</div>';
						  }
					 ?>
				</div>
			</div>
			<div class="login-box">
				<h4><?php echo $this->lang->line('final_payment_authority')?></h4>
				<hr />
				<table class="table1" border="1" style="width:100%">
					<thead>
						<tr style="text-align:center">
							<th class="text-center">Description</th>
							<th class="text-center"><?php echo $this->lang->line('download')?></th>
						</tr>
					</thead>
					<tbody>
								<tr>
									<td>Final Payment Authority </td>
									<td class="text-center">
									<?php
										if(!empty($results)){
											echo '<a href="'.SITE_BASE_URL.'subs/final_payment_authority_pdf" target="_blank" style="font-weight:900">'.'&nbsp;<img src="'.SITE_BASE_URL.'assets/images/PDF.png" style="max-height:30px;"/></a>';
										}else{
											echo '<span style="color:red">'.'No Authority'.'</span>';
										}
									?>
									</td>
								</tr>
					</tbody>
				</table>
<!--
				<p></p>
				<p></p>
				<?php
					if(!empty($results)){
						// echo '<a href="'.SITE_BASE_URL.'subs/final_payment_authority_pdf" target="_blank" style="font-weight:900">'.$this->lang->line('download_final_payment_authority').'&nbsp;<img src="'.SITE_BASE_URL.'assets/images/PDF.png" style="max-height:30px;"/></a>';
					}else{
						// echo '<span style="color:red">'.$this->lang->line('no_final_payment_authority').'</span>';
					}
				?>
-->				
			</div>
		</div>
	</div>
</div>
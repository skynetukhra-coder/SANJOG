<style>
.table1 th,td{line-height:15px; padding:5px}
</style>
<div class="row">
	<div class="col-md-3 col-sm-4">
		<div class="left-panel">
			<?php $this->load->view('layout/subscribers_left_panel',$header);?>
		</div>
	</div>
	<div class="col-md-9 col-sm-8">
		<div class="right-panel">
			<div class="breadcrumb"><a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('subscriber'); ?> &raquo; <?php echo $this->lang->line('gpf_ac_statement'); ?>										
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
				<h4>
				<?php 
				if(count($subs_details) > 1){
					echo sprintf($this->lang->line('accoument_statment_for_last_multi_yr'),count($subs_details));
				}else{
					echo $this->lang->line('accoument_statment_for_last_y');
				}?>
				</h4>
							
			
				<form method="get">
						<div class="filter-form1">
							<div class="form-group row">
								<div class="col-sm-4">
									<label class="name-label">Select Financial Closing Year :</label>
									<select name="year" class="form-control" required>
										<option value="">-- <?php echo $this->lang->line('select_year'); ?> --</option>
										<?php
										for($i = date('Y')+1; $i >= 1980; $i--){
											echo '<option value="'.$i.'" '.($this->input->get('year',true) == $i ? 'selected': '').' >'.$i.'</option>';
										}?>
									</select>
								</div>
								<div class="col-sm-4">
									<input type="submit" class="submit-btn" value="<?php echo $this->lang->line('search'); ?>" />
								</div>
								<div class="col-sm-4">
									<input type="button" class="submit-btn" onclick="window.location.href='<?php echo base_url()?>subs/account_statement'" value="<?php echo $this->lang->line('clear'); ?>" />
								</div>
							</div>
						</div>
					</form>

				<hr />
				<div class="form-group row">
				<table class="table1" border="1" style="width:100%">
					<thead>
						<tr style="text-align:center">
							<th class="text-center"><?php echo $this->lang->line('name')?></th>
							<th class="text-center"><?php echo $this->lang->line('fin_yr_end_on')?></th>
							<th class="text-center"><?php echo $this->lang->line('download')?></th>
						</tr>
					</thead>
					<tbody>
						<?php
						if(!empty($subs_details)){
							foreach($subs_details as $sub){
							?>
								<tr>
									<td>Account statement for the year <?php echo (date('Y',strtotime($sub['fyear'])) - 1).' - '.date('Y',strtotime($sub['fyear'])) ?></td>
									<td class="text-center"><?php echo get_date($sub['fyear']) ?></td>
									<td class="text-center"><a href="<?php echo SITE_BASE_URL?>subs/save_download?fyear=<?php echo date('Y-m-d',strtotime($sub['fyear']))?>" target="_blank"><img src="<?php echo SITE_BASE_URL?>assets/images/PDF.png" style="max-height:40px;"/></a></td>
								</tr>
						<?php
							}
						}else{ ?> 
							<tr>
								<td colspan="3" style="font-size:12px"><?php echo $this->lang->line('no_data_found')?></td>
							</tr>
							<?php
							 }?>					
					</tbody>
				</table>
				</div>
<!-- non-tax / tax division start-->

				<?php
				if(!empty($tax_details)){
				?>
				<div class="form-group row">
					<label class="name-label">1. Non Taxable / Taxable Amount:</label>
					<table class="table1" border="1" style="width:100%">
						<thead>
							<tr style="text-align:center">
								<th class="text-center">Type</th>
								<th class="text-center">Opening Balance</th>
								<th class="text-center">Deposit</th>
								<th class="text-center">Withdrawal</th>
								<th class="text-center">Interest</th>
								<th class="text-center">Closing Balance</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if(!empty($tax_details)){
								foreach($tax_details as $taxnontax){
								?>
									<tr>
										<td class="text-center">Non Taxable Portion</td>
										<td class="text-center"><?php echo $taxnontax['ob_nt'] ?></td>
										<td class="text-center"><?php echo $taxnontax['dep_nt'] ?></td>
										<td class="text-center"><?php echo $taxnontax['with_nt'] ?></td>
										<td class="text-center"><?php echo $taxnontax['int_nt'] ?></td>
										<td class="text-center"><?php echo $taxnontax['cb_nt'] ?></td>
									</tr>
									<tr>
										<td class="text-center">Taxable Portion</td>
										<td class="text-center"><?php echo $taxnontax['ob_t'] ?></td>
										<td class="text-center"><?php echo $taxnontax['dep_t'] ?></td>
										<td class="text-center"><?php echo $taxnontax['with_t'] ?></td>
										<td class="text-center"><?php echo $taxnontax['int_t'] ?> <span>*</span></td>
										<td class="text-center"><?php echo $taxnontax['cb_t'] ?></td>
									</tr>
									<tr>
										<td class="text-center">Total Amount</td>
										<td class="text-center"><?php echo $taxnontax['tot_ob'] ?></td>
										<td class="text-center"><?php echo $taxnontax['tot_dep'] ?></td>
										<td class="text-center"><?php echo $taxnontax['tot_with'] ?></td>
										<td class="text-center"><?php echo $taxnontax['tot_int'] ?></td>
										<td class="text-center"><?php echo $taxnontax['tot_cb'] ?></td>
									</tr>
									<tr>
										<td colspan="6" style="font-size:12px"> Rupees in Words: <?php echo $taxnontax['tot_cb_in_wrd'] ?></td>
									</tr>
							<?php
								}
							}else{ ?> 
								<tr>
									<td colspan="6" style="font-size:12px"><?php echo $this->lang->line('no_data_found')?></td>
								</tr>
								<?php
								 }?>					
						</tbody>
					</table>
				</div>
				<div class="form-group row">
					<label class="name-label">2. Unauthorised Amount :</label>
					<table class="table1" border="1" style="width:100%">
						<thead>
							<tr style="text-align:center">
								<th class="text-center">Type </th>
								<th class="text-center">Opening Balance</th>
								<th class="text-center">Deposit</th>
								<th class="text-center">Closing Balance</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if(!empty($tax_details)){
								foreach($tax_details as $taxnontax){
								?>
									<tr>
										<td class="text-center">Unauthorised Subscription</td>
										<td class="text-center"><?php echo $taxnontax['ua_ob'] ?></td>
										<td class="text-center"><?php echo $taxnontax['ua_dep'] ?></td>
										<td class="text-center"><?php echo $taxnontax['ua_cb'] ?></td>
									</tr>
									<tr>
										<td colspan="4" style="font-size:12px">Rupees in Words :<?php echo $taxnontax['ua_cb_in_wrd'] ?></td>
									</tr>
								
							<?php
								}
							}else{ ?> 
								<tr>
									<td colspan="4" style="font-size:12px"><?php echo $this->lang->line('no_data_found')?></td>
								</tr>
								<?php
								 }?>					
						</tbody>
					</table>
				</div>
				<div>
					<div class="form-group row"><span style="font-size:13px; ">* Interest on Taxable Subscription only</span></div>
					<div class="col-md-6 col-sm-12:" style = "text-align:center; float: right"><button type="button" class="btn-primary btn-xm" onclick="goPrint('<?php echo $taxnontax['fyear'] ?>')" style="padding-top: 5px">Download Non-tax and Tax component</button></div>
				</div>
				<?php
				 }?>
			 
<!-- non-tax / tax division end-->	 
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="<?php echo SITE_BASE_URL?>assets/js/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('.datepicker').datepicker({dateFormat:'dd-mm-yy'});
});

function goPrint(id, type) {
    if (id != undefined) {
        window.location.href = '<?php echo SITE_BASE_URL ?>subs/tax_nontax_download/' + id;
    }
}

</script>
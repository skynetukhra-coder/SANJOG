<?php
$red_id = isset($sl_data['red_id']) ? $sl_data['red_id'] : '0';
?>
<div class="row">
	<div class="col-md-3 col-sm-4">
		<div class="left-panel">
			<?php $this->load->view('layout/emp_left_panel',$header);?>
		</div>
	</div>
	<div class="col-md-9 col-sm-8">
		<div class="right-panel">
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('employee'); ?> &raquo; Consumable / Software</div>		
			<div class="login-box">
			<h4><strong><?php echo $this->lang->line('leave_for_recommendati'); ?>Issue Consumable</strong></h4>
			<div class="row"> 
				
			</div>
			<div class="row"> 
				<div class="col-md-3 col-sm-12" style = " float: right; text-align:center; font-size: 14px">
					&nbsp;
				</div>
			</div>
				<div class="application-formwrap">
					<form method="post">
						<div class="row">
							<div class="col-sm-12">
								<table class="table1" border="1" style="width:100%">
									<thead>
										<tr style="text-align:center">
											<th style="text-align:center; width:40%;"><strong>Description</strong></th>
											<th style="text-align:center; width:60%;"><strong>Information</strong></th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td class="col_1">Record Serial No</td>
											<td class="col_2"><input type="text" id="red_id" name="red_id" value="<?php echo (int)$red_id +1;?>" class="form-control" readonly></td>
										</tr>
										<tr>
											<td class="col_1">Issued Date</td>
											<td class="col_2"><input type="text" id="iss_dt" name="iss_dt" value="<?php echo date('d-m-Y') ?>" class="form-control datepicker" required></td>
										</tr>
										<tr>
											<td class="col_1">Section</td>
											<td class="col_2">
												<select id="sec_nm" name="sec_nm" class = "form-control" required>
													<option value="">--Select--</option>
													<?php
													if(isset($section_list) && !empty($section_list)){
														foreach($section_list as $sections){
															echo '<option value="'.$sections['section'].'">'.$sections['section'].'</option>';
														}
													}
													?>
												</select>
											</td>
										</tr>
										<tr>
											<td class="col_1">Select Item Issued</td>
											<td class="col_2">
											<div class="control-group" title ="Click the Radio button against the authotity to whom you want to send the applicaiton.">
												<div class="controls">
												  <div class="filter-area">
													<div class="filter-row">
													</div> 
												  </div>
												  <div class="epmloyees-list" style="width:100%; max-height: 125px; overflow: auto;">
														 <?php
														  foreach($consitems as $items){
															   echo '<div class="item-row"><input  type="checkbox" name="item_id['.$items['item_id'].']" value="'.$items['item_desc'].'" />&nbsp; '.$items['item_desc'].' [ '.$items['item_id'].' ]</div>';
														  }?>
												  </div>
												</div>
											</div>
											</td>
										</tr>
										<tr>
											<td class="col_1">Quantity Issued</td>
											<td class="col_2"><input type="text" id="iss_qty" name="iss_qty" value="" class="form-control" placeholder = "0" required></td>
										</tr>
										<tr>
											<td class="col_1">Remarks</td>
											<td class="col_2"><input type="text" id="remk" name="remk" value="" class="form-control" ></td>
										</tr>
								</table>
							</div>
							<div>&nbsp;	</div>
							<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
							<div class="col-sm-12">
								<div class="btn-wrap">
									<div class="row">
										<div class="col-sm-6 col-xs-6">
											<input type="button" class="btn btn-success" onclick="myCanl();" value="Cancel" />
										</div>
										<div class="col-sm-6 col-xs-6">
											<input id="submit_btn" type="submit" class="btn btn-primary" value="Submit" />
										</div>
									</div>
								</div>
							</div>
							<?php 
							if(isset($application) && !empty($application)){?>
							<div class="col-sm-12">
								<div class="btn-wrap">
									<div class="row">
										<div class="col-sm-6"> <strong>** Last applied on: <?php echo get_datepicker_date($application['applied_on']);?></strong> </div>
									</div>
								</div>
							</div>
							<?php
							}?>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="<?php echo SITE_BASE_URL?>assets/js/jquery.min.js"></script>
<script>
function show_hide_submit(){
	if($('#i_agree').is(':checked')){
		$('#submit_btn').prop('disabled',false);
	}else{
		$('#submit_btn').prop('disabled',true);
	}
}
function ConsDetail() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/emdbg_cons/';
}

function myCanl() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/emdbg_issue/';
}
function warningApp(){
	
	alert("NOTICE:-\n\n** Add members of the your family as recorded in Service Book. ");
				
}
</script>
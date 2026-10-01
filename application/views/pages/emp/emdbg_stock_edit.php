<?php
$recd_id = isset($records['recd_id']) ? $records['recd_id'] : '';
$recpt_dt = isset($records['recpt_dt']) ? $records['recpt_dt'] : '';
$po_no = isset($records['po_no']) ? $records['po_no'] : '';
$po_dt = isset($records['po_dt']) ? $records['po_dt'] : '';
$vend_nm = isset($records['vend_nm']) ? $records['vend_nm'] : '';
$item_id = isset($records['item_id']) ? $records['item_id'] : '';
$item_desc = isset($records['item_desc']) ? $records['item_desc'] : '';
$stk_qty = isset($records['stk_qty']) ? $records['stk_qty'] : '';
$remk = isset($records['remk']) ? $records['remk'] : '';
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
			<h4><strong><?php echo $this->lang->line('leave_for_recommendati'); ?>Receipt Consumable</strong></h4>
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
								<table class="table1" border="1" style="width:100%;">
									<thead>
										<tr style="text-align:center">
											<th style="text-align:center; width:40%;"><strong>Description</strong></th>
											<th style="text-align:center; width:60%;"><strong>Information</strong></th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td class="col_1">Record Serial No</td>
											<td class="col_2"><input type="text" id="recd_id" name="recd_id" value="<?php echo $records['recd_id'] ?>" class="form-control" readonly></td>
										</tr>
										<tr>
											<td class="col_1">Purchase Order No</td>
											<td class="col_2"><input type="text" id="po_no" name="po_no" value="<?php echo $records['po_no'] ?>" class="form-control" required></td>
										</tr>
										<tr>
											<td class="col_1">Purchase Order Date</td>
											<td class="col_2"><input type="text" id="po_dt" name="po_dt" value="<?php echo $records['po_dt'] ?>" class="form-control datepicker" required></td>
										</tr>
										<tr>
											<td class="col_1">Supplier Name</td>
											<td class="col_2">
												<select  id="vend_nm" name="vend_nm" class="form-control" required >
													<option value="">--- Select Vendor ---</option>
													<?php
														if(isset($vendors)){
															foreach($vendors as $vendor){
																echo '<option value="'.$vendor['vendor_nm'].'">'.$vendor['vendor_nm'].'</option>';
															}
														}
													?>
												</select>
											</td>
										</tr>
										<tr>
											<td class="col_1">Select Item Received</td>
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
															   echo '<div class="item-row"><input type="checkbox" name="item_id['.$items['item_id'].']" value="'.$items['item_desc'].'" />&nbsp; '.$items['item_desc'].' [ '.$items['item_id'].' ]</div>';
														  }?>
												  </div>
												</div>
											</div>
											</td>
										</tr>
										<tr>
											<td class="col_1">Quantity Purchased</td>
											<td class="col_2"><input type="text" id="stk_qty" name="stk_qty" value="<?php echo $records['stk_qty'] ?>" class="form-control" placeholder = "0" required></td>
										</tr>
										<tr>
											<td class="col_1">Receipt Date</td>
											<td class="col_2"><input type="text" id="recpt_dt" name="recpt_dt" value="<?php echo $records['recpt_dt'] ?>" class="form-control datepicker" required></td>
										</tr>
										<tr>
											<td class="col_1">Remarks</td>
											<td class="col_2"><input type="text" id="remk" name="remk" value="<?php echo $records['remk'] ?>" class="form-control" ></td>
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
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/emdbg_stock/';
}
function warningApp(){
	
	alert("NOTICE:-\n\n** Add members of the your family as recorded in Service Book. ");
				
}
</script>
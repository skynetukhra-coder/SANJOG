<?php
$item_id = isset($sl_data['item_id']) ? $sl_data['item_id'] : '0';
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
			<h4><strong><?php echo $this->lang->line('leave_for_recommendati'); ?>New Software Item</strong></h4>
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
											<td class="col_1">Item Serial No</td>
											<td class="col_2"><input type="text" id="item_id" name="item_id" value="<?php echo $item_id +1;?>" class="form-control" readonly></td>
										</tr>
										<tr>
											<td class="col_1">Item Type</td>
											<td class="col_2"><input type="text" id="item_for" name="item_for" value="SOFTWARE" class="form-control" readonly></td>	
										</tr>
										<tr>
											<td class="col_1">Description</td>
											<td class="col_2"><input type="text" id="item_desc" name="item_desc" value="" class="form-control" ></td>
										</tr>
										<tr>
											<td class="col_1">Item Catetory</td>
											<td class="col_2">
												<select id="item_cat" name="item_cat" class = "form-control" >
													<option data-value="0" value="" >--- select ---</option>
													<option data-value="1" value="ANTIVIRUS" >ANTIVIRUS</option>
													<option data-value="2" value="DATABASE" >DATABASE</option>
													<option data-value="3" value="DEVELOPER" >DEVELOPER</option>
													<option data-value="4" value="DRIVER" >DRIVER</option>
													<option data-value="5" value="HINDI" >HINDI</option>
													<option data-value="6" value="MS OFFICE" >MS OFFICE</option>
													<option data-value="7" value="PACKAGE" >PACKAGE</option>
													<option data-value="8" value="OS" >OS</option>
													<option data-value="9" value="OTHER" >OTHER</option>	
												</select>
											</td>
										</tr>
										<tr>
											<td class="col_1">Make / Product</td>
											<td class="col_2"><input type="text" id="item_make" name="item_make" value="" class="form-control" ></td>
										</tr>
										<tr>
											<td class="col_1">Location / Box No / Cabinet No</td>
											<td class="col_2"><input type="text" id="item_box" name="item_box" value="" class="form-control" ></td>
										</tr>
										<tr>
											<td class="col_1">CD / DVD</td>
											<td class="col_2">	
												<select id="media_type" name="media_type" class = "form-control" >
													<option data-value="0" value="AMC" >---- Select ----</option>
													<option data-value="1" value="CD" >CD</option>
													<option data-value="2" value="DVD" >DVD</option>
													<option data-value="2" value="CD-DVD" >CD-DVD</option>														
												</select>
											</td>
										</tr>
										<tr>
											<td class="col_1">No of Media</td>
											<td class="col_2"><input type="text" id="no_media" name="no_media" value="" class="form-control" ></td>
										</tr>
										<tr>
											<td class="col_1">CD/DVD No</td>
											<td class="col_2"><input type="text" id="cd_dvd_no" name="cd_dvd_no" value="" class="form-control" ></td>
										</tr>
										<tr>
											<td class="col_1">No of License</td>
											<td class="col_2"><input type="text" id="no_license" name="no_license" value="" class="form-control" ></td>
										</tr><tr>
											<td class="col_1">Cost of License</td>
											<td class="col_2"><input type="text" id="cost" name="cost" value="" class="form-control" ></td>
										</tr>
										<tr>
											<td class="col_1">Purchase Date</td>
											<td class="col_2"><input type="text" id="pur_dt" name="pur_dt" value="" class="form-control datepicker" ></td>
										</tr>
										<tr>
											<td class="col_1">Stock / Balance</td>
											<td class="col_2"><input type="text" id="stk_bal" name="stk_bal" value="" class="form-control datepicker" ></td>
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
function SoftDetail() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/emdbg_soft/';
}

function myCanl() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/emdbg_soft/';
}
function warningApp(){
	
	alert("NOTICE:-\n\n** Add members of the your family as recorded in Service Book. ");
				
}
</script>
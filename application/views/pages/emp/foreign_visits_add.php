<div class="row">
	<div class="col-md-3 col-sm-4">
		<div class="left-panel">
			<?php $this->load->view('layout/emp_left_panel',$header);?>
		</div>
	</div>
	<div class="col-md-9 col-sm-8">
		<div class="right-panel">
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('employee'); ?> &raquo; <?php echo $this->lang->line('my_application'); ?> </div>
			
			<div class="login-box">
				<div class="application-formwrap">
					<form method="post">
						<div class="row">
							<div class="col-sm-12">
								<div class="sub-heading" style="text-align:center"> OFFICE OF THE PR. ACCOUNTANT GENERAL (A&E) , WEST BENGAL<br />
									Treasury Buildings, 2 Government Place (West), Kolkata 70000-1</div>
							</div>
							<div class="col-sm-12">
								<div class="top-box">
									<div class="row">
										<label class="name" style="text-align:center; color: #db1504 " >MEMBER OF FAMILY</span></label>
									</div>								
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-7 col-sm-6">
										<label class="name">Name of Employee:<span class="star"></span></label>
										<input id="" name="emp_name" value="<?php echo $profile['empname'] ?>" type="text" class="form-control" readonly>
										<input id="" type = "hidden" name="empid" value="<?php echo $profile['empid'] ?>" type="text" class="form-control" readonly>
									</div>
									<div class="col-md-5 col-sm-6 name-mrgbtm">
										<label class="name">Designation :<span class="star"></span></label>
										<input id = "emp_desig" name="emp_desig" type="text" value="<?php echo $profile['desig'] ?>" class="form-control" readonly>
									</div>
								</div>
							</div>
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
											<td class="col_1">Name of Country</td>
											<td class="col_2"><input type="text" id="f_country" name="f_country" value="" class="form-control" ></td>
										</tr>
										<tr>
											<td class="col_1">Visit From</td>
											<td class="col_2"><input type="text" id="visit_fm" name="visit_fm" value="" class="form-control datepicker" ></td>
										</tr>
										<tr>
											<td class="col_1">Visit To</td>
											<td class="col_2"><input type="text" id="visit_to" name="visit_to" value="" class="form-control datepicker" ></td>
										</tr>
										<tr>
											<td class="col_1">Purpose of Visit</td>
											<td class="col_2"><input type="text" id="visit_purpose" name="visit_purpose" value="" class="form-control" ></td>
										</tr>
										<tr>
											<td class="col_1">Estimated Expenditure (Travel, board/lodging visa, misc. etc.)</td>
											<td class="col_2"><input type="text" id="est_expnd" name="est_expnd" value="" class="form-control" ></td>
										</tr>
										<tr>
											<td class="col_1">Source of Fund </td>
											<td class="col_2"><input type="text" id="source_fnd" name="source_fnd" value="" class="form-control"  ></td>
										</tr>
										<tr>
											<td class="col_1">Remarks </td>
											<td class="col_2"><input type="text" id="emp_rmk" name="emp_rmk" value="" class="form-control"  ></td>
										</tr>
								</table>
							</div>
							<div>&nbsp;	</div>
							<div class="col-sm-12">
								<div class="row">
									<div class="col-md-6 col-sm-7 col-xs-7">
										<div class="form-group"> 
											<?php echo $cap['image'];?>
											<button type="button" style="width:40px;height:40px" onclick="reload_captcha()" title="Re-Generate"><i class="fa fa-refresh" style="font-size:20px" aria-hidden="true"></i></button>
										</div>
									</div>
									<div class="col-md-6 col-sm-5 col-xs-5">
										<div class="form-group">
											<input onclick = "" type="text" name="c_image" class="form-control" placeholder="<?php echo $this->lang->line('write_image_code'); ?>" autocomplete="off" required >
										</div>
									</div>
								</div>
							</div>							
							<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
							<div class="col-sm-12">
								<input id="i_agree" type="checkbox" name="agree" onclick="show_hide_submit()" required/>&nbsp;&nbsp;I declare that the statement submitted is true to my knowledge.<br /><br />
							</div>
							<div class="col-sm-12">
								<div class="row">
									<div class="col-sm-6">
										<strong>Place: Kolkata </strong>
										<input id="decl_place" name="decl_place" type="hidden" value="Kolkata" />
									</div>
									<div class="col-sm-6">
										<strong>Date: <?php echo  date("d-m-Y");?> </strong>
										<input id="decl_date" name="decl_date" type="hidden" value="<?php echo  date("d-m-Y");?>" />
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="btn-wrap">
									<div class="row">
										<div class="col-sm-6 col-xs-6">
											<input type="button" class="btn btn-success" onclick="myCanl();" value="Cancel" />
										</div>
										<div class="col-sm-6 col-xs-6">
											<input id="submit_btn" type="submit" class="btn btn-primary" value="Submit" disabled />
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
$(document).ready(function(){
	$('.datepicker').datepicker({dateFormat:'dd-mm-yy'});

});

function show_hide_submit(){
	if($('#i_agree').is(':checked')){
		$('#submit_btn').prop('disabled',false);
	}else{
		$('#submit_btn').prop('disabled',true);
	}
}
function warningApp(){
	
	alert("NOTICE:-\n\n** Add members of the your family as recorded in Service Book. ");
				
}
function myCanl() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/foreign_visits/';
}
</script>
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
					<div class="new-cont medium whats-new">
						<ul class="nav nav-tabs " style="background-color: ">
							<li ><a data-toggle="tab" href="#tab" onclick="SelfForm()" >Asset Declaration for Self</a></li>
							<li class="active" ><a data-toggle="tab" href="#tab1" onclick="DeptForm()" >Asset Declaration for Dependent</a></li>
						</ul>
					</div>
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
										<label class="name" style="text-align:center; color: #db1504" >FORM -1 (DEPENDENT)</span></label>
									</div>								
								</div>
							</div>
							<div class="col-sm-12">
								<div class="top-box">
									<div class="row">
										<label class="name" style="text-align:center; color: blue" >STATEMENT OF IMMOVABLE PROPERTY MADE OUT OF THE FUNDS (INCLUDING SHRIDHAN, GIFT, INHERITANCE ETC.)<br> OF THE DEPENDENTS FOR THE YEAR <?php echo  date("Y")-1;?> AS ON (31-12-<?php echo  date("Y")-1;?>)</br></span></label>		
<!--									<label class="name" style="text-align:center; color: blue" >STATEMENT OF IMMOVABLE PROPERTY MADE OUT OF THE FUNDS (INCLUDING SHRIDHAN, GIFT, INHERITANCE ETC.) OF THE DEPENDENTS </span></label>	-->
									</div>								
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-7 col-sm-6">
										<label class="name">Name of Officer (in full)<span class="star">*</span></label>
										<input id="trg_pname" name="trg_pname" value="<?php echo $profile['empname'] ?>" type="text" class="form-control" readonly>
										<input id="empid" name="empid" value="<?php echo $profile['empid'] ?>" type="hidden" class="form-control" >
										<input id="mobile_no" name="mobile_no" value="<?php echo $profile['mbno'] ?>" type="hidden" class="form-control" >
										<input id="emp_name" name="emp_name" value="<?php echo $profile['empname'] ?>" type="hidden" class="form-control" >
										<input id="decl_for" name="decl_for" value="Dependent" type="hidden" class="form-control" >
									</div>
									<div class="col-md-5 col-sm-6 name-mrgbtm">
										<label class="name">Present Post held<span class="star">*</span></label>
										<input id = "emp_desig" name="emp_desig" type="text" value="<?php echo $profile['desig'] ?>" class="form-control" readonly>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">	
									<div class="col-md-6 col-sm-12">
										<div class="row ">
											<div class="col-sm-6 name-mrgbtm">
												<label class="name">Service to which belongs</label>
												<input id = "service_belg" name="service_belg" value="IA&AD" type="text" class="form-control" readonly>
											</div>
											<div class="col-sm-6 name-mrgbtm">
												<label class="name">Present Pay</label>
												<input id = "b_pay" name="b_pay" value="<?php echo $profile['basic_pay'] ?>" type="text" class="form-control" readonly>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="row">
											<div class="col-md-6 col-sm-6 name-mrgbtm">
												<label class="name">Statement Year</label>
<!--											<input id = "pst_year" name="pst_year" value="<?php echo  date("Y")-1;?>" type="text" class="form-control " requiired readonly>		-->
												<select name="pst_year" class="form-control" required>
													<option value="">-- <?php echo $this->lang->line('select_year'); ?> --</option>
													<?php
													for($i = date('Y')-1; $i >= 2018; $i--){
														echo '<option value="'.$i.'" '.($this->input->get('pst_year',true) == $i ? 'selected': '').' >'.$i.'</option>';
													}?>
												</select>

<!--
												<select id="pst_year" name="pst_year" class="form-control" required  >
													<option data-value="0" value=""> ---- Select Date----</option>
													<option data-value="1" value="2019" >2019</option>
													<option data-value="2" value="2018" >2018</option>
												</select>
-->
											</div>
											<div class="col-md-6 col-sm-6">
												<label class="name">Statement as on <span class="star">*</span></label>
											<input id = "pst_as_on" name="pst_as_on" value="31-12-<?php echo  date("Y")-1;?>" type="text" class="form-control " requiired readonly>			
<!--											<select id="pst_as_on" name="pst_as_on" class="form-control" required  >
													<option data-value="0" value=""> ---- Select Date----</option>
													<option data-value="1" value="2019-12-31" > 31-12-2019</option>
													<option data-value="2" value="2018-12-31" > 31-12-2018</option>
												</select>
-->
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group">
									<label class="name">  Property Details: </label>
								</div>
							</div>
							<div class="col-sm-12">
                              <div class="table-responsive">
								<table width="100%" border="1" bordercolor="#7399be" class="tbl table-responsive">
									<thead>
										<tr>
											<td style = "background-color: #857a7d">Name of District,Sub-division, Taluk & Villlage in which property is situated:</td>
											<td style = "background-color: #857a7d">Name & Details of property, Housing Lands and Other Buildings:</td>
											<td style = "background-color: #857a7d"># Present Value (Approx):<br><i style="color:red">(in Rs)</br></i></td>
											<td style = "background-color: #857a7d">If not in own name, state in whose name held and his/ her relationship to the Govt. Servant:</td>
											<td style = "background-color: #857a7d">How accquired,whether by purchase, ## Lease, Mortgage, Gift, Inheritance or otherwise with date of aquisition & with details of person from whom acquired:</td>
											<td style = "background-color: #857a7d">Annual Income from property:<br><i style="color:red">(in Rs)</br></i></td>
											<td style = "background-color: #857a7d">Remarks</td>
										</tr>
									</thead>
									<tbody>
										<tr height = "45px">
											<td width = "18%"><textarea type = "text" name="proty_location_1" class="form-control" required ></textarea></td>
											<td width = "18%"><textarea type="text" name="proty_detail_1" class="form-control " required></textarea></td>
											<td width = "10%"><input type="text" name="prsnt_value_1" class="form-control" placeholder = '0' required></td>
											<td width = "15%"><textarea type="text" name="proty_owner_1" class="form-control" required></textarea></td>
											<td width = "15%"><textarea type="text" name="mode_acquin_1" class="form-control" required></textarea></td>
											<td width = "10%"><input type="text" name="income_proty_1" class="form-control" placeholder = '0' required></td>
											<td width = "9%"><textarea type="text" name="remark_1" class="form-control" ></textarea></td>
										</tr>
										<tr id="more_exam_above">
											<td colspan="7" style="text-align:center"><button type="button" class="btn btn-sm" onclick="addMoreExam()" style="width:auto; padding:5px; font-size:10px"> + Add More</button></td>
										</tr>
									</tbody>
								</table>
                              </div>
							</div>
							<div class="col-sm-12" >
								<div class="form-group " style = "background-color: #ffdd99" >
								<label class="name" style = "font-size: 12px"> # In case where it is not possible to assess the value accurately the approximate value in relation to present condition may be indicated.<br>
													## Include short term lease also.</br>
								</label>
								</div>
							</div>
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
											<input onclick = "InformationCheck()" type="text" name="c_image" class="form-control" placeholder="<?php echo $this->lang->line('write_image_code'); ?>" autocomplete="off" required >
										</div>
									</div>
								</div>
							</div>							
							<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
							<div class="col-sm-12">
								<input id="i_agree" type="checkbox" name="agree" onclick="warningApp();show_hide_submit();" required/>&nbsp;&nbsp;I declare that the statement submitted is true to my knowledge.<br /><br />
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
											<input type="button" class="btn btn-success" onclick="window.location.reload();" value="Reset" />
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
function exm_index(){
	var data_val = $('#exm_nm option:selected').attr('data-value');
	if(data_val == 14){
		$('#other_exam_name_input').prop('required',true);
		$('#other_exam_name').show();
	}else{
		$('#other_exam_name_input').prop('required',false);
		$('#other_exam_name').hide();
	}
	if(data_val >= 1 && data_val <= 3){
		$('#index_no').prop('readonly',false);
	}else{
		$('#index_no').val('').prop('readonly',true);
	}
}
var cur_index = 1;
function addMoreExam(){
	var indx = cur_index++;
	var htm = '<tr height = "45px">';
	htm +='<td width = "18%"><textarea type="text" name="proty_location_'+cur_index+'"  class="form-control"></textarea></td>';
	htm +='<td width = "18%"><textarea type="text" name="proty_detail_'+cur_index+'"  class="form-control"></textarea></td>';
	htm +='<td width = "10%"><input type="text" name="prsnt_value_'+cur_index+'" class="form-control"></td>';
	htm +='<td width = "15%"><textarea type="text" name="proty_owner_'+cur_index+'" class="form-control"></textarea></td>';
	htm +='<td width = "15%"><textarea type="text" name="mode_acquin_'+cur_index+'" class="form-control"></textarea></td>';
	htm +='<td width = "10%"><input type="text" name="income_proty_'+cur_index+'" class="form-control"></td>';
	htm +='<td width = "9%"><textarea type="text" name="remark_'+cur_index+'" class="form-control"></textarea></td>';
	htm +='</tr>';
	$('#more_exam_above').before(htm);
	if(indx >= 5){
		$('#more_exam_above').remove();
	}
}
function show_hide_submit(){
	if($('#i_agree').is(':checked')){
		$('#submit_btn').prop('disabled',false);
	}else{
		$('#submit_btn').prop('disabled',true);
	}
}
function warningApp(){
	
	alert("NOTICE:-\n\n ** Property Statement for both Self and Dependent should be sumitted.\n\n** Write 'NIL' in Property Details, if you have no property to mention. \n\n** Add row to mention multiple properties. \n\n** Property Statement for a year can not be edited or resubmitted. ");
				
}
function SelfForm() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/property_st_self/';
}
function DeptForm() {
    //if (id != undefined) {
		window.location.href = '<?php echo SITE_BASE_URL ?>emp/property_st_dependent/';
    //}
}
</script>
<?php
$pappl_id = isset($records['pappl_id']) ? $records['pappl_id'] : '';
$psl_no = isset($records['psl_no']) ? $records['psl_no'] : '';
$pappli_yr = isset($records['pappli_yr']) ? $records['pappli_yr'] : '';
$empid = isset($records['empid']) ? $records['empid'] : '';
$name = isset($records['name']) ? $records['name'] : '';
$desig = isset($records['desig']) ? $records['desig'] : '';
$mbno = isset($records['mbno']) ? $records['mbno'] : '';
$emp_section = isset($records['emp_section']) ? $records['emp_section'] : '';
$group_nm = isset($records['group_nm']) ? $records['group_nm'] : '';
$office_nm = isset($records['office_nm']) ? $records['office_nm'] : '';
$emp_type = isset($records['emp_type']) ? $records['emp_type'] : '';
$basic_pay = isset($records['basic_pay']) ? $records['basic_pay'] : '';
$id_card_no = isset($records['id_card_no']) ? $records['id_card_no'] : '';
$doj = isset($records['doj']) ? $records['doj'] : '';
$passport_no = isset($records['passport_no']) ? $records['passport_no'] : '';
$pexpiry_dt = isset($records['pexpiry_dt']) ? $records['pexpiry_dt'] : '';
$reason_pp = isset($records['reason_pp']) ? $records['reason_pp'] : '';
$period_visit = isset($records['period_visit']) ? $records['period_visit'] : '';
$visit_dt = isset($records['visit_dt']) ? $records['visit_dt'] : '';
$visit_addr = isset($records['visit_addr']) ? $records['visit_addr'] : '';
$days_leave = isset($records['days_leave']) ? $records['days_leave'] : '';
$leave_from = isset($records['leave_from']) ? $records['leave_from'] : '';
$leave_to = isset($records['leave_to']) ? $records['leave_to'] : '';
$cash_doc = isset($records['cash_doc']) ? $records['cash_doc'] : '';
$discipl_action = isset($records['discipl_action']) ? $records['discipl_action'] : '';
$pre_visit = isset($records['pre_visit']) ? $records['pre_visit'] : '';
$pass_ren_visa = isset($records['pass_ren_visa']) ? $records['pass_ren_visa'] : '';
$source_fund = isset($records['source_fund']) ? $records['source_fund'] : '';

$attachment = isset($records['attachment']) ? $records['attachment'] : '';
$appli_date = isset($records['appli_date']) ? $records['appli_date'] : '';
$reccomendation = isset($records['reccomendation']) ? $records['reccomendation'] : '';
$dealing_remrk = isset($records['dealing_remrk']) ? $records['dealing_remrk'] : '';
$draft_attachment = isset($records['draft_attachment']) ? $records['draft_attachment'] : '';
$aao_name = isset($records['aao_name']) ? $records['aao_name'] : '';
$aao_desig = isset($records['aao_desig']) ? $records['aao_desig'] : '';
$aao_remrk = isset($members['aao_remrk']) ? $members['aao_remrk'] : '';
$aao_dt = isset($members['aao_dt']) ? $members['aao_dt'] : '';
$sao_name = isset($records['sao_name']) ? $records['sao_name'] : '';
$sao_desig = isset($records['sao_desig']) ? $records['sao_desig'] : '';
$sao_remrk = isset($members['sao_remrk']) ? $members['sao_remrk'] : '';
$sao_dt = isset($members['sao_dt']) ? $members['sao_dt'] : '';
$dag_name = isset($records['dag_name']) ? $records['dag_name'] : '';
$dag_desig = isset($records['dag_desig']) ? $records['dag_desig'] : '';
$dag_remrk = isset($members['dag_remrk']) ? $members['dag_remrk'] : '';
$dag_dt = isset($members['dag_dt']) ? $members['dag_dt'] : '';
$pag_name = isset($records['pag_name']) ? $records['pag_name'] : '';
$pag_desig = isset($records['pag_desig']) ? $records['pag_desig'] : '';
$pag_remrk = isset($members['pag_remrk']) ? $members['pag_remrk'] : '';
$pag_dt = isset($members['pag_dt']) ? $members['pag_dt'] : '';
$appli_status = isset($records['appli_status']) ? $records['appli_status'] : '';
$update_dt = isset($records['update_dt']) ? $records['update_dt'] : '';
$upload_dt = isset($records['upload_dt']) ? $records['upload_dt'] : '';
$currently_with = isset($records['currently_with']) ? $records['currently_with'] : '';

?>

<div class="row">
	<div class="col-md-3 col-sm-4">
		<div class="left-panel">
			<?php $this->load->view('layout/emp_left_panel',$header);?>
		</div>
	</div>
	<div class="col-md-9 col-sm-8">
		<div class="right-panel">
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('employee'); ?> &raquo; <?php echo $this->lang->line('my_application'); ?> </div>
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
			<div class="form-group row">
				<div class="col-sm-12" style = "text-align: right">
					<!-- Trigger/Open The Modal -->
					<button  id="myBtn" class="btn btn-warning"> INSTRUCTIONS</button>
				</div>
			</div>
			<div class="login-box">
					
				<div class="application-formwrap">
					<form method="post" onmouseover ="disabledField(); AvailByCheck(); FieldsReadOnly();"enctype="multipart/form-data" >
						<?php
								if(!empty($leave_balance)){
									$s1=0;
									foreach($leave_balance as $balance){											
											$s1=$balance['leave_cb']; 
									}
								}else{
									$s1=0;
								}?>
						<div class="row">
							<div class="col-sm-12">
								<div class="sub-heading" style="text-align:center"> OFFICE OF THE PR. ACCOUNTANT GENERAL (A&E) , WEST BENGAL<br />
									Treasury Buildings, 2 Government Place (West), Kolkata 70000-1</div>
							</div>
						<div class="col-sm-12">
							<div class="top-box">
							<label class="name" style="text-align:center"> <font color="#1E0BA9"><b>Application seeking ‘NO OBJECTION CERTIFICATE/IDENTITY CERTIFICATE’ for obtaining VISA/PASSPORT/REISSUE OF PASSPORT</b></font></span></label>
								<div class="row">
									<div id="other_exam_name" class="row" style="display:none;">
										<div class="col-md-8 col-sm-6">
											<div class="form-group">
											
											</div>
										</div>
									</div>
								</div>
							</div>
						<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-8 col-sm-6">
										<label class="name">Full Name<span class="star"></span></label>
										<input id="name" name="name" value="<?php echo $name ?>" type="text" class="form-control" readonly>
										<input id="empid" name="empid" value="<?php echo $empid ?>" type="hidden" class="form-control" readonly>
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Designation<span class="star"></span></label>
										<input id="desig" name="desig" type="text" value="<?php echo $desig ?>" class="form-control" readonly>
									</div>
									
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-8 col-sm-6">
										<label class="name">Office Name <span class="star"></span></label>
										<input id="office_nm" name="office_nm" value="<?php echo $office_nm ?>" type="text" class="form-control" readonly>
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Mobile Number</label>
										<input id="mbno" name="mbno" type="text" value="<?php echo $mbno ?>" class="form-control"  required readonly>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-6 col-sm-12">
										<div class="row">
											<div class="col-md-6 col-sm-6">
												<label class="name">Basic Pay<span class="star"></span></label>
												<input id="basic_pay" name="basic_pay" type="text"  value="<?php echo $basic_pay ?>" class="form-control"  readonly >
											</div>
											<div class="col-md-6 col-sm-6 name-mrgbtm">
												<label class="name">Section Name</label>
												<input id="emp_section" name="emp_section"  type="text" value="<?php echo $emp_section ?>" class="form-control"  required readonly>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="row apl-mrgbtm">
											<div class="col-sm-6">
												<label class="name">Group Name</label>
												<input id="group_nm" name="group_nm"  type="text" value="<?php echo $group_nm ?>" class="form-control" required readonly>
											</div>
											<div class="col-md-6 col-sm-6 name-mrgbtm">
												<label class="name">Identity Card No</label>
												<input id="id_card_no" name="id_card_no"  type="text" value="<?php echo $id_card_no ?>" class="form-control"  required readonly>
											</div>
										</div>
									</div>
								</div>
							</div>	
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-4 col-sm-4">
										<label class="name">Date of appointment (in this office)<span class="star"></span></label>
										<input id="doj" name="doj" type="text"  value="<?php echo get_datepicker_date($doj) ?>" class="form-control" readonly >
									</div>
									<div class="col-md-4 col-sm-4 name-mrgbtm">
										<label class="name">Type of Service<span class="star"></span></label>
											<input id="emp_type" name="emp_type" type="text"  value="<?php echo $emp_type ?>" class="form-control" readonly >
									</div>
									<div class="col-md-4 col-sm-4">
										<label class="name">Passport / Visa</label>
										<input id="pass_ren_visa" name="pass_ren_visa"  type="text" value="<?php echo $pass_ren_visa ?>" class="form-control" readonly>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-8 col-sm-8">
										<label class="name">Reasons for which he / she intends to obtain Passport / Visa</label>
										<input id="reason_pp" name="reason_pp"  type="text" value="<?php echo $reason_pp ?>" class="form-control" readonly>
									</div>
									<div class="col-md-4 col-sm-4">
										<label class="name">Source of Fund</label>
										<input id="source_fund" name="source_fund"  type="text" value="<?php echo $source_fund ?>" class="form-control" readonly>
									</div>
								</div>
							</div>	
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-6 col-sm-12">
										<div class="row">
											<div class="col-sm-6">
												<label class="name">Probable stay abroad  </label>
												<input id="period_visit" name="period_visit"  type="text" value="<?php echo $period_visit ?>" class="form-control" readonly>
											</div>
											<div class="col-md-6 col-sm-6">
												<label class="name">Date of Visit<span class="star"></span></label>
												<input id="visit_dt" name="visit_dt" type="text"  value="<?php echo get_datepicker_date($visit_dt) ?>" class="form-control" readonly >
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="row apl-mrgbtm">
											<div class="col-sm-6 name-mrgbtm">
												<label class="name">Passport No</label>
												<input id="passport_no" name="passport_no" type="text" value="<?php echo $passport_no ?>" class="form-control" readonly >
											</div>
											<div class="col-md-6 col-sm-6">
												<label class="name">Date of Expiry<span class="star"></span></label>
												<input id="pexpiry_dt" name="pexpiry_dt" type="text"  value="<?php echo get_datepicker_date($pexpiry_dt) ?>" class="form-control" readonly >
											</div>
										</div>
									</div>
								</div>
							</div>	
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-6 col-sm-12">
										<div class="row">
											<div class="col-sm-6 name-mrgbtm">
												<label class="name">Period of Leave (in Days)</label>
												<input id="days_leave" name="days_leave" type="text" value="<?php echo $days_leave ?>" class="form-control" readonly >
											</div>
											<div class="col-md-6 col-sm-6">
												<label class="name">Leave From<span class="star"></span></label>
												<input id="leave_from" name="leave_from" type="text"  value="<?php echo get_datepicker_date($leave_from) ?>" class="form-control" readonly >
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="row apl-mrgbtm">
											<div class="col-md-6 col-sm-6">
												<label class="name">Leave Upto<span class="star"></span></label>
												<input id="leave_to" name="leave_to" type="text"  value="<?php echo get_datepicker_date($leave_to) ?>" class="form-control" readonly >
											</div>
											<div class="col-sm-6 name-mrgbtm">
												<label class="name">Previously Visited?</label>
												<input id="pre_visit" name="pre_visit" type="text"  value="<?php echo $pre_visit ?>" class="form-control " readonly >
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Handle Cash/Secret documents ?</label>
										<input id="cash_doc" name="cash_doc" type="text"  value="<?php echo $cash_doc ?>" class="form-control " readonly >
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Pending disciplinary ?</label>
										<input id="discipl_action" name="discipl_action" type="text"  value="<?php echo $discipl_action ?>" class="form-control " readonly >
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name"> View visit records</label>
										<button id="" type="button" class="btn-success" onclick ="myVisit()">View</button>
									</div>
								</div>
							</div>
							
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-sm-12">
										<label class="name">Address of Stay</label>
										<input id="visit_addr" name="visit_addr" type="text"  value="<?php echo $visit_addr ?>" class="form-control " readonly >
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-sm-12">
										<label class="name">Applied for minor(s) for Passport / VISA</label>
										<table class="table1" border="1" style="width:100%">
										<thead>
											<tr style="text-align:center">
												<th style="text-align:center">Sl No</th>
												<th style="text-align:center">Name</th>
												<th style="text-align:center">Date of Birth</th>
												<th style="text-align:center">Place of Birth</th>
											</tr>
										</thead>
										<tbody>
											<?php
												if(!empty($minors_rec)){
													$sl = intval($this->input->get('per_page',true)) + 1;
													foreach($minors_rec as $record){
													//	 ?>
														<tr>
															<td><?php echo $sl++ ?></td>
															<td><?php echo $record['minor_name'] ?></td>
															<td><?php echo $record['minor_dob'] ?></td>
															<td><?php echo $record['minor_pbrith'] ?></td>
															
														</tr>
												<?php	}
												}else{
													echo '<tr><td colspan="9">No records found!</td></tr>';
												}
											?>
										</tbody>
									</table>
									</div>
								</div>
							</div>
							<div class="col-sm-12"title ="Borwse to upload supporting docuemnts.">
								<div class="form-group row">
									<div class="col-md-12 col-sm-12">
										<label class="control-label">View supporting documents.</span></label>
										<input id="attachment" type="file" name="attachment" class="span12 m-wrap" onchange="previewImage(this,'up_file_display')" style="display:none"/>
									<button type="button" class="" onclick="browse()"><i class="icon-arrow-up icon-white"></i>||</button><span id="up_file_display"><?php if($attachment != ''){echo '&nbsp;<a href="'.base_url().'files/agae/results/'.$attachment.'" target="_blank">'.$attachment.'</a>';}?></span>
									</div>
								</div>
							</div>
							
							<div class="col-sm-12">
								<div class="btn-wrap">
									<div class="row">
										
									</div>
								</div>
							</div>
<!-- checking -->
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-12 col-sm-12">
										<label class="name">Remarks of Dealinng Staff </label>
										<textarea id="dealing_remrk" type = "text" name="dealing_remrk" align="center" rows="4" cols="114" readonly ><?php echo $records['dealing_remrk'] ?></textarea >
									</div>
								</div>
							</div>	
							<div class="col-sm-12"title ="Borwse to upload supporting docuemnts.">
								<div class="form-group row">
									<div class="col-md-12 col-sm-12">
										<label class="control-label">View Draft Certificate.</span></label>
										<input id="" type="" name="draft_attachment" class="span12 m-wrap" style="display:none"/>
									<button type="button" class="" ><i class="icon-arrow-up icon-white"></i>||</button><span id=""><?php echo '&nbsp;<a href="'.base_url().'files/agae/results/'.$records['draft_attachment'].'" target="_blank">'.$records['draft_attachment'].'</a>';?></span>
									</div>
								</div>
							</div>
<!-- AAO -->							
							<div class="col-sm-12">
								<div class="btn-wrap">
								</div>
							</div>
							
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-12 col-sm-12">
										<label class="name">Remark of AAO, if any</label>
										<textarea id="aao_remrk" type = "text" name="aao_remrk" align="center" rows="4" cols="114" readonly ><?php echo $records['aao_remrk'] ?></textarea >
									</div>
								</div>
							</div>															
<!-- SAO -->							
							<div class="col-sm-12">
								<div class="btn-wrap">
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-12 col-sm-12">
										<label class="name">Remark of Sr. AO, if any</label>
										<textarea id="sao_remrk" type = "text" name="sao_remrk" align="center" rows="4" cols="114" readonly ><?php echo $records['sao_remrk'] ?></textarea >
									</div>
								</div>
							</div>					
<!-- DAG -->							
							<div class="col-sm-12">
								<div class="btn-wrap">
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-12 col-sm-12">
										<label class="name">Remark of Dy. AG, if any</label>
										<textarea id="dag_remrk" type = "text" name="dag_remrk" align="center" rows="4" cols="114" readonly ><?php echo $records['dag_remrk'] ?></textarea >
									</div>
								</div>
							</div>					
<!-- PAG -->							
							<div class="col-sm-12">
								<div class="btn-wrap">
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-4 col-sm-4 name-mrgbtm">
										<label class="name">Application Status </span></label>
										<select id="appli_status" name="appli_status" class="form-control" required>
											<option value=""> ---- Select ----</option>
											<option data-value="1" value="Permitted"  <?=$records['appli_status']=='Permitted' ? 'selected="selected"': '' ;?>>Permitted</option>
											<option data-value="2" value="Not Permitted"  <?=$records['appli_status']=='Not Permitted' ? 'selected="selected"': '' ;?>>Not Permitted </option>
											<option data-value="3" value="Rejected"  <?=$records['appli_status']=='Rejected' ? 'selected="selected"': '' ;?>>Rejected </option>
											<option data-value="4" value="Withheld"  <?=$records['appli_status']=='Withheld' ? 'selected="selected"': '' ;?> >Withheld </option>
										</select>
									</div>
									<div class="col-md-8 col-sm-8">
										<label class="name">Remarks, if any</label>
										<textarea id="pag_remrk" type = "text" name="pag_remrk" align="center" rows="2" cols="75" ><?php echo $records['pag_remrk'] ?></textarea >
									</div>
								</div>
							</div>
														
							<div class="col-sm-12">
								<div class="btn-wrap">
									<div class="row">
									</div>
								</div>
							</div>
							
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-4 col-sm-12 apl-mrgbtm">
										<label class="name"></label>
										<div class="row">
											<div class="col-sm-2 col-xs-2" style="text-align:center">
												<label class="name1">Name</label>
											</div>
											<div class="col-sm-10  col-xs-6">
												<input name="pag_name" type="text" value="<?php echo $profile['empname'] ?>" class="form-control"  readonly>											
											</div>
										</div>			
									</div>
									<div class="col-md-8 col-sm-12 apl-mrgbtm">
										<label class="name"></label>
										<div class="row">
											<div class="col-sm-2 col-xs-2" style="text-align:center">
												<label class="name1">Designation</label>
											</div>
											<div class="col-sm-5  col-xs-4">
												<input name="pag_desig" type="text" value="<?php echo $profile['desig'] ?>" class="form-control"  readonly>											
											</div>
											<div class="col-sm-2  col-xs-2" style="text-align:center">
												<label class="name1 text-right">DATE</label>
											</div>
											<div class="col-sm-3  col-xs-4">
												<input name="pag_dt" type="text" value="<?php echo date("d-m-Y"); ?>" class="form-control"  readonly>
											</div>								
										</div>			
									</div>
								</div>
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
										<div class="col-md-6 col-sm-7 col-xs-7">
											<div class="form-group"> 
												<?php echo $cap['image'];?>
												<button type="button" style="width:40px;height:40px" onclick="reload_captcha()" title="Re-Generate"><i class="fa fa-refresh" style="font-size:20px" aria-hidden="true"></i></button>
											</div>
										</div>
										<div class="col-md-6 col-sm-5 col-xs-5">
											<div class="form-group">
												<input  type="text" name="c_image" class="form-control" placeholder="<?php echo $this->lang->line('write_image_code'); ?>" autocomplete="off" required >
											</div>
										</div>
									</div>
								</div>
							</div>
								<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
							<div class="col-sm-12">
								<div class="btn-wrap">
									<div class="row">
										<div class="col-sm-6 col-xs-6">
											<input type="button" class="btn btn-success" onclick="window.location.reload();" value="Reset" />
										</div>
										<div class="col-sm-6 col-xs-6">
											<input id="submit_btn" type="submit" class="btn btn-primary" value="Submit" />
										</div>
									</div>
								</div>
							</div>
						</div>
						</div>	
					</form>	
				</div>
			</div>
		</div>
	</div>
</div>


<!-- The Modal -->
<div id="myModal" class="modal-small">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h2>Instructions</h2>
    </div>
    <div class="modal-body">
      <p>1. Check whether all your inforamation is updated before applying leave. </p>
      <p>2. Fill up the Form carefully.</p>
    </div>
    <div class="modal-footer">
      <h3>Thanks</h3>
    </div>
  </div>

</div>

<script type="text/javascript" src="<?php echo SITE_BASE_URL?>assets/js/jquery.min.js"></script>
<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>


<script type="text/javascript">
$(document).ready(function(){
	$('.datepicker').datepicker({dateFormat:'dd-mm-yy',minDate:'today'});

});
function show_hide_submit(){
	if($('#i_agree').is(':checked')){
		$('#submit_btn').prop('disabled',false);
	}else{
		$('#submit_btn').prop('disabled',true);
	}
}

function previewImage(file_obj,container_id){
	 if (file_obj.files && file_obj.files[0]) {
		var url = file_obj.value;
		var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
		var filename =  url.substring(url.lastIndexOf('/') + 1);
		filename =  filename.substring(filename.lastIndexOf('\\') + 1);
		if( ext == 'pdf'){
      $('#'+container_id).html('<em>&nbsp;&nbsp;' + filename + '</em>');
    }else{
      $('#attachment').val(''); 
      $('#'+container_id).html('');      
      alert('file type not supported! Supported file types is .pdf');
    }
	}
}
function filterEmployeeByDesignation(desig){
  desig = desig.toLowerCase();
   $('.emp-row').each(function(i){
      if(desig != 'all'){
        $(this).css('display','none');
        if($(this).attr('data-designation') == desig){
          $(this).css('display','block');
        }
      }else{
        $(this).css('display','block');
      }
    });
   checkUncheckAll();
}

function checkSelectedOnly(){
  let isChecked = $('#selected-only').is(':checked');
  $('.emp-row').each(function(i){
    if(isChecked){
      if(!$(this).find('input').prop('checked')){
        $(this).css('display','none');
      }
    }else{
      $(this).css('display','block');
    }
  });
}

function checkUncheckAll(){
  var desig = $('#filter-designation').val().toLowerCase();
  let isChecked = $('#all-checked').is(':checked');
  $('.emp-row').each(function(i){
    $(this).find('input').prop('checked',false);
    if(isChecked){
      if(desig != 'all'){
        if($(this).attr('data-designation') == desig){
          $(this).find('input').prop('checked',true);
        }
      }else{
        $(this).find('input').prop('checked',true);
      }
    }    
  });
}
function selectcheckbox(id){
	for ( var i =1; i<=4;i++)
	{
		document.getElementById(i).checked = false;
	}
	document.getElementById(id).checked = true;	
}

function browse(){
	$('#attachment').click();
}

function MyAlert(){
//	var myText = "Instructions\n\n** Update your inforamation before applying leave.\n\** Select the type of leave that you want to apply.\n\** Click on the Select button.\n\** Check whether the balance is showing under Balance.\n\** Enter 'No of Days' in numerical value i.e. 1, 2, 3 etc. \n\** For Commuted Leave, enter no of days multiplyig by 2. \n\** For example, Enter 20 no of days of  Half Pay Leave for 10 Days Commuted Leave. \n\** Select the Designation of the Leave Sanctioning Authority.\n\** Click the Radio button against the Authoity.\n\** Write the Capta and Submit the leave.";
    myText ='Please Read Intructions before applying leave.'
	alert (myText);
}
function AppForm() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/application_passport/';
}
function myVisit() {
    //if (id != undefined) {
		window.location.href = '<?php echo SITE_BASE_URL ?>emp/foreign_visit_records/';
    //}
}
</script>

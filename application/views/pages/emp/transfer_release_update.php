<?php
$emp_id = isset($row['emp_id']) ? $row['emp_id'] : '';
$emp_name = isset($row['emp_name']) ? $row['emp_name'] : '';
$emp_desig = isset($row['emp_desig']) ? $row['emp_desig'] : '';
$trans_from_grp = isset($row['trans_from_grp']) ? $row['trans_from_grp'] : '';
$trans_from_sec = isset($row['trans_from_sec']) ? $row['trans_from_sec'] : '';
$trans_to_grp = isset($row['trans_to_grp']) ? $row['trans_to_grp'] : '';
$trans_to_sec = isset($row['trans_to_sec']) ? $row['trans_to_sec'] : '';
$trans_order_no = isset($row['trans_order_no']) ? $row['trans_order_no'] : '';
$trans_order_dt = isset($row['trans_order_dt']) ? $row['trans_order_dt'] : '';
$trans_note = isset($row['trans_note']) ? $row['trans_note'] : '';
$order_issue_date = isset($row['order_issue_date']) ? $row['order_issue_date'] : '';
$trans_release_dt = isset($row['trans_release_dt']) ? $row['trans_release_dt'] : '';
$release_autho_remark = isset($row['release_autho_remark']) ? $row['release_autho_remark'] : '';
$release_autho_rek_dt = isset($row['release_autho_rek_dt']) ? $row['release_autho_rek_dt'] : '';
$release_autho_nm = isset($row['release_autho_nm']) ? $row['release_autho_nm'] : '';
$release_autho_desig = isset($row['release_autho_desig']) ? $row['release_autho_desig'] : '';
$release_autho_pan = isset($row['release_autho_pan']) ? $row['release_autho_pan'] : '';

?>
<div class="row">
	<div class="col-md-3 col-sm-4">
		<div class="left-panel">
			<?php $this->load->view('layout/emp_left_panel',$header);?>
		</div>
	</div>
	<div class="col-md-9 col-sm-8">
		<div class="right-panel">
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('employee'); ?> &raquo; <?php echo $this->lang->line('leave_for_sanction'); ?> </div>
			
			<div class="login-box">
				<div class="application-formwrap">
					<form method="post" >
						<div class="row">
							<div class="col-sm-12">
								<div class="sub-heading" style="text-align:center"> OFFICE OF THE PR. ACCOUNTANT GENERAL (A&E) , WEST BENGAL<br />
									Treasury Buildings, 2 Government Place (West), Kolkata 70000-1</div>
							</div>
						<div class="col-sm-12">
							<div class="top-box">
							<label class="name" align="center"> <font color="#1E0BA9"><b> TRANSFER </b></font></span></label>
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
									<div class="col-md-3 col-sm-6 name-mrgbtm">
										<label class="name">Employee PAN<span class="star">*</span></label>
										<input type="text" name = "emp_id" value="<?php echo $row['emp_id'] ?>" class="form-control"  readonly>
									</div>
									<div class="col-md-5 col-sm-6">
										<label class="name">Employee Name<span class="star">*</span></label>
										<input value="<?php echo $row['emp_name'] ?>" type="text" class="form-control"  readonly>
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Designation<span class="star">*</span></label>
										<input type="text" value="<?php echo $row['emp_desig'] ?>" class="form-control"  readonly>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-6 col-sm-12">
										<div class="row">
											<div class="col-md-6 col-sm-6">
												<label class="name">From Group<span class="star"></span></label>
												<input type="text"  value="<?php echo $row['trans_from_grp'] ?>" class="form-control"  readonly >
											</div>
											<div class="col-md-6 col-sm-6 name-mrgbtm">
												<label class="name">Section </label>
												<input type="text" value="<?php echo $row['trans_from_sec'] ?>" class="form-control"  readonly>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="row apl-mrgbtm">
											<div class="col-sm-6">
												<label class="name">To Group </label>
												<input type="text" value="<?php echo $row['trans_to_grp'] ?>"class="form-control " readonly>
											</div>
											<div class="col-sm-6 name-mrgbtm">
												<label class="name">Section</label>
												<input type="text" value="<?php echo $row['trans_to_sec'] ?>" class="form-control"  readonly>
											</div>
										</div>
									</div>
								</div>
							</div>	
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-4 col-sm-12">
										<label class="name">Order No</label>
										<input type="text" value="<?php echo $row['trans_order_no'] ?>" class="form-control"  readonly>
									</div>
									<div class="col-md-4 col-sm-12">
										<label class="name">Order Date</label>
										<input type="text" value="<?php echo get_datepicker_date($row['trans_order_dt']) ?>" class="form-control"  readonly>
									</div>
									<div class="col-md-4 col-sm-12">
										<label class="name">Allotment Date</label>
										<input type="text" value="<?php echo get_datepicker_date($row['order_issue_date']) ?>" class="form-control"  readonly>
									</div>
								</div>
							</div>				
							<div class="col-sm-12" >
								<div class="form-group row">
									<div class="col-md-12 col-sm-12">
										<label class="name">Transfer Note</label>
											<textarea id="reasons" type = "text" name="reasons" align="center" rows="3" cols="110" readonly ><?php echo $row['trans_note'] ?></textarea >
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-3 col-sm-6 name-mrgbtm">
										<label class="name">Released On <span class="star">*</span></label>
										<input <?php echo empty($row['trans_release_dt']) ?'':'' ?> name="trans_release_dt" type="text" value="<?php echo  get_datepicker_date($row['trans_release_dt']) ?>" class="form-control datepicker" >
									</div>
									<div class="col-md-3 col-sm-6 name-mrgbtm">
										<label class="name">Status <span class="star">*</span></label>
										<select id ="status" onchange = "MyAlert()" name="status" class="form-control" >
												<option  value=""> ---- Select----</option>
												<option  value="Released" >Released </option>
												<option  value="Retained" >Retained </option>
												<option  value="Pending"  >Pending </option>
										</select>
									</div>
									<div class="col-md-3 col-sm-6 name-mrgbtm">
										<label class="name">Joined On <span class="star">*</span></label>
										<input <?php echo empty($row['trans_join_dt']) ?'':'' ?> name="trans_join_dt" type="text" value="Release pending" class="form-control datepicker" readonly>
									</div>
									<div class="col-md-3 col-sm-6 name-mrgbtm">
										<label class="name">Date <span class="star">*</span></label>
										<input <?php echo empty($row['release_autho_rek_dt']) ?'':'' ?> name="release_autho_rek_dt" type="text" value="<?php echo  date("d-m-Y");?>" class="form-control " readonly>
									</div>
								</div>
							</div> 
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-12 col-sm-12">
										<label class="name"> Remark of the Authority<span class="star">*</span></label>
										<input  <?php echo empty($row['release_autho_remark']) ?'':'readonly' ?> name="release_autho_remark" type="text" value="<?php echo $row['release_autho_remark'] ?>" class="form-control" >
									</div>
								</div>
							</div> 
							<div class="col-sm-12">
								<div class="form-group row btn-wrap">
									<div class="col-md-4 col-sm-12">
										<label class="name">Name</label>
										<input name="release_autho_nm" type="text" value="<?php echo $release_autho_nm ?>" class="form-control"  readonly>											
									</div>
									<div class="col-md-8 col-sm-12 apl-mrgbtm">
										<label class="name">.</label>
										<div class="row">
											<div class="col-sm-2 col-xs-2" style="text-align:center">
												<label class="name1">Designation</label>
											</div>
											<div class="col-sm-4  col-xs-4">
												<input name="release_autho_desig" type="text" value="<?php echo $release_autho_desig ?>" class="form-control"  readonly>											
											</div>
											<div class="col-sm-2  col-xs-2" style="text-align:center">
												<label class="name1 text-right">PAN</label>
											</div>
											<div class="col-sm-4  col-xs-4">
												<input name="release_autho_pan" type="text" value="<?php echo $release_autho_pan ?>" class="form-control"  readonly>											
											</div>								
										</div>			
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
												<input type="text" name="c_image" class="form-control" placeholder="<?php echo $this->lang->line('write_image_code'); ?>" autocomplete="off" required >
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
											<input id="submit_btn" type="submit" class="btn btn-primary" value="Submit"  />
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

<script type="text/javascript" src="<?php echo SITE_BASE_URL?>assets/js/jquery.min.js"></script>
<script type="text/javascript">

$(document).ready(function(){
	$('.datepicker').datepicker({dateFormat:'dd-mm-yy'});
});

</script>

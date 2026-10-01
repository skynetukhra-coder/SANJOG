<?php
$ddo_rec_id = isset($records['ddo_rec_id']) ? $records['ddo_rec_id'] : '';
$ddo_cd = isset($records['ddo_cd']) ? $records['ddo_cd'] : '';
$drec_year = isset($records['drec_year']) ? $records['drec_year'] : '';
$drec_month = isset($records['drec_month']) ? $records['drec_month'] : '';
$drec_type = isset($records['drec_type']) ? $records['drec_type'] : '';
$doc_desc = isset($records['doc_desc']) ? $records['doc_desc'] : '';
$sub_name = isset($records['sub_name']) ? $records['sub_name'] : '';
$sub_ifms_id = isset($records['sub_ifms_id']) ? $records['sub_ifms_id'] : '';
$sub_series = isset($records['sub_series']) ? $records['sub_series'] : '';
$sub_ac_code = isset($records['sub_ac_code']) ? $records['sub_ac_code'] : '';
$sub_mbno = isset($records['sub_mbno']) ? $records['sub_mbno'] : '';
$ddo_attachment = isset($records['ddo_attachment']) ? $records['ddo_attachment'] : '';

$tr_nm = isset($profile['tr_nm']) ? $profile['tr_nm'] : '';
$ddo_official_name = isset($profile['ddo_official_name']) ? $profile['ddo_official_name'] : '';
$ddo_official_desig = isset($profile['ddo_official_desig']) ? $profile['ddo_official_desig'] : '';
$ddo_official_contact = isset($profile['ddo_official_contact']) ? $profile['ddo_official_contact'] : '';

?>

<div class="row">
	<div class="col-md-3 col-sm-4">
		<div class="left-panel">
			<?php $this->load->view('layout/ddo_left_panel',$header);?>
		</div>
	</div>
	<div class="col-md-9 col-sm-8">
		<div class="right-panel">
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('ddo'); ?> &raquo;  <?php echo $this->lang->line('try_repo'); ?> Application Upload </div>
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
				<div class="application-formwrap">
					<form method="post" enctype="multipart/form-data">
						<div class="row">
							<div class="col-sm-12">
								<div class="sub-heading" style="text-align:center"> OFFICE OF THE PR. ACCOUNTANT GENERAL (A&E) , WEST BENGAL<br />
									Treasury Buildings, 2 Government Place (West), Kolkata-700001</div>
							</div>
						<div class="col-sm-12">
							<div class="top-box">
							<label class="name" align=center>Submission of Document for Subscriber.</span></label>
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
										<div class="col-md-5 col-sm-12">
											<label class="name">Subscriber's Name:</label>
												<input id="sub_name"  name="sub_name"  value ="" class="form-control" placeholder = "Subscriber's Name"/>
										</div>
										<div class="col-md-3 col-sm-12">
											<label class="name">Type:</label>
												<select class="form-control" name="drec_type" required>
														<option value="">-----Select---</option>
														<option value="GPF No Allotment" >New GPF No Allotment</option>
														<option value="Nomination" >Nomination Application</option>
														<option value="Missing Credit" >Adjustment of Missing Credit.</option>
														<option value="Missing Debit" >Adjustment of Missing Debit.</option>
												 </select>
										</div>
										<div class="col-md-2 col-sm-12">
											<label class="name">Year:</label>
												<select name="drec_year" class="form-control" required>
														<option value="">---<?php echo $this->lang->line('select_yea'); ?>Select---</option>
														<?php
														for($i = date('Y'); $i >= 2019; $i--){
															echo '<option value="'.$i.'" '.($this->input->get('drec_year',true) == $i ? 'selected': '').' >'.$i.'</option>';
														}?>
												</select>
										</div>
										<div class="col-md-2 col-sm-12">
											<label class="name"> Month: </label>
												<select class="form-control" name="drec_month" required>
														<option value="">----Select----</option>
														<option value="January" >January</option>
														<option value="February" >February</option>
														<option value="March"  >March</option>
														<option value="April"  >April</option>
														<option value="May"  >May</option>
														<option value="June" >June</option>
														<option value="July" >July</option>
														<option value="August"  >August</option>
														<option value="September"  >September</option>
														<option value="October"  >October</option>
														<option value="November" >November</option>
														<option value="December" >December</option>
												  </select>
										</div>
									</div>
								</div>
								<div class="col-sm-12">
									<div class="form-group row">
										<div class="col-md-6 col-sm-12 ">
											<div class="row">
												<div class="col-sm-6  col-xs-4">
													<label class="name">Subscriber's Series</label>
													<select class="form-control" id="series_code" name="sub_series">
														<option value="">----<?php echo $this->lang->line('choose_series_cod'); ?>Select----</option>
														<?php
															if(isset($series_codes)){
																foreach($series_codes as $code){
																	echo '<option value="'.$code['series'].'">'.$code['series'].'</option>';
																}
															}
														?>
													</select>
												</div>
												<div class="col-sm-6  col-xs-4">
													<label class="name ">Subscriber's GPF A/c No</label>
													<input id="sub_ac_code"  name="sub_ac_code"  value ="" class="form-control" placeholder = "9999  [Number only]" />
												</div>
											</div>
										</div>	
										<div class="col-md-6 col-sm-12 ">
											<div class="row">
												<div class="col-sm-6  col-xs-4">
													<label class="name">Subscriber's Employee ID</label>
													<input id="sub_ifms_id"  name="sub_ifms_id"  value ="" class="form-control" placeholder = "IFMS Employee ID"/>
												</div>
												<div class="col-sm-6  col-xs-4">
													<label class="name ">Subscriber's Mobile No</label>
													<input id="sub_mbno"  name="sub_mbno"  value ="" class="form-control" placeholder = "Mobile No" />
												</div>
											</div>
										</div>	
									</div>
								</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-sm-12">
										<label class="name ">Remark: </label>
										<textarea id="rule_display" name = "doc_desc" type = "text" style = "background-color: #fff; align :left" rows="2" cols="107" > </textarea >
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-10 col-sm-12">
										<label class="control-label">Upload Document(.pdf) duly signed by DDO / HOD <i style="color:red">[Please upload single pdf]</i></label>
										<input id="attachment" type="file" name="ddo_attachment" class="span12 m-wrap" onchange="previewImage(this,'up_file_display')" style="display:none"/>
										<button type="button" class="" onclick="browse()"><i class="icon-arrow-up icon-white"></i> Browse</button><span id="up_file_display"><?php if($ddo_attachment != ''){echo '&nbsp;<a href="'.base_url().'files/agae/department/'.$ddo_attachment.'" target="_blank">'.$ddo_attachment.'</a>';}?></span>
									</div>
								</div>
							</div>
							
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-4 col-sm-12">
										<label class="name">Name</label>
										<input id="try_official_name" name="ddo_official_name" value="<?php echo $profile['user_name'] ?>"type="text" class="form-control" readonly >	
									</div>
									<div class="col-md-8 col-sm-12 apl-mrgbtm">
										<div class="row">
											<div class="col-sm-4  col-xs-4">
												<label class="name">Designation</label>
												<input id="try_official_desig" name="ddo_official_desig" value="<?php echo $profile['user_desig'] ?>" type="text" class="form-control" readonly >
											</div>
											<div class="col-sm-4  col-xs-4">
												<label class="name ">Contact No</label>
												<input id="try_official_contact" name="ddo_official_contact" value="<?php echo $profile['mb_no'] ?>"type="text" class="form-control" readonly >
											</div>
											<div class="col-sm-4  col-xs-4">
											<label class="name "> Submission Date</label>
												<input id="upload_dt" name="upload_dt" type="text" value= "<?php echo  date("d-m-Y");?>" class="form-control " readonly>
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

<script type="text/javascript">
$(document).ready(function(){
	$('.datepicker').datepicker({dateFormat:'dd-mm-yy',minDate:'today'});
});

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
function browse(){
	$('#attachment').click();
}
function show_hide_submit(){
	if($('#1').is(':checked')){
		$('#submit_btn').prop('disabled',false);
		$('#dept_remark').prop('disabled',true);
	}else{
		$('#submit_btn').prop('disabled',true);
	}
}
function show_hide_submit2(){
	if($('#2').is(':checked')){
		$('#submit_btn').prop('disabled',false);
		$('#dept_remark').prop('disabled',false);
	}else{
		$('#submit_btn').prop('disabled',true);
	}
}
function selectcheckbox(id){
	for ( var i =1; i<=2;i++)
	{
		document.getElementById(i).checked = false;
	}
	document.getElementById(id).checked = true;	
}


function DisplayRule(){
	
	var RuleFor = document.getElementById('report_desc').value;

	rule1_info ='Rule 4.167(4) & (5) of West Bengal Treasury Rules '
	rule2_info ='Rule 4.193(1) of West Bengal Treasury Rules';
	rule3_info ='Rule 4.193(1)] of West Bengal Treasury Rules';
	rule4_info ='Rule 6.34 of West Bengal Treasury Rules read with Finance Department (Audit Branch) Memo no. 2684-F(Y) dt. 06/04/2011 and Rule 6.08(5) of West Bengal Treasury Rules read with Finance Department (Audit Branch) Memo no. 2684-F(Y) dt. 06/04/2011.';

	if (RuleFor == 'Death of Pensioner and Commencement of Family Pension'  ){
			document.getElementById('rule_display').value = rule1_info;
		}else{
			if (RuleFor == 'Failure to draw Pension'){ 
			document.getElementById('rule_display').value = rule2_info;
			}else{
				if(RuleFor == 'Lapse Deposit Statement'){
					document.getElementById('rule_display').value = rule3_info;
				}else{
					if(RuleFor == 'Reconciliation of PD Accounts/Local Fund /PF Deposit'){
						document.getElementById('rule_display').value = rule4_info;
					}else{
						document.getElementById('rule_display').value = '';
					}		
				}
			}
		}
}

</script>

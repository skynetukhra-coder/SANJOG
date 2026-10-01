<?php
$report_id = isset($records['report_id']) ? $records['report_id'] : '';
$tr_cd = isset($records['tr_cd']) ? $records['tr_cd'] : '';
$report_year = isset($records['report_year']) ? $records['report_year'] : '';
$report_month = isset($records['report_month']) ? $records['report_month'] : '';
$report_type = isset($records['report_type']) ? $records['report_type'] : '';
$report_desc = isset($records['report_desc']) ? $records['report_desc'] : '';
$try_attachment = isset($records['try_attachment']) ? $records['try_attachment'] : '';
$report_due_date = isset($records['report_due_date']) ? $records['report_due_date'] : '';
$action_status = isset($records['action_status']) ? $records['action_status'] : '';

$tr_nm = isset($profile['tr_nm']) ? $profile['tr_nm'] : '';
$try_official_name = isset($profile['try_official_name']) ? $profile['try_official_name'] : '';
$try_official_desig = isset($profile['try_official_desig']) ? $profile['try_official_desig'] : '';
$try_official_contact = isset($profile['try_official_contact']) ? $profile['try_official_contact'] : '';

?>

<div class="row">
	<div class="col-md-3 col-sm-4">
		<div class="left-panel">
			<?php $this->load->view('layout/treasury_left_panel',$header);?>
		</div>
	</div>
	<div class="col-md-9 col-sm-8">
		<div class="right-panel">
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('treasury'); ?> &raquo;  <?php echo $this->lang->line('try_reports'); ?> </div>
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
							<label class="name" align=center>Submission of Report to Pr. Accountant General (A&E), WB.</span></label>
								<div class="row">
									<div id="other_exam_name" class="row" style="display:none;">
										<div class="col-md-8 col-sm-6">
											<div class="form-group">
											
											</div>
										</div>
									</div>
								</div>
							</div>
						<div class="form-group row">
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-4 col-sm-12">
										<label class="name">Treasury</label>
											<input id="tr_nm" name="tr_nm" value="<?php echo $profile['tr_nm'] ?>" type="text" class="form-control" readonly >
<!--											<select id="tr_nm" name="tr_nm" class="form-control" required>
												<option value=""> -- Select Treasury --</option>
												<?php 
/*												if(isset($treasury_list) && !empty($treasury_list)){
													foreach($treasury_list as $treasury){
														echo '<option value="'.$treasury['tr_nm'].'">'.$treasury['tr_nm'].'</option>';
													}
												}
*/												?>
											</select>	
-->											
									</div>
									<div class="col-md-8 col-sm-12 apl-mrgbtm">
										<div class="row">
											<div class="col-sm-6  col-xs-4">
												<label class="name">Year</label>
												<select name="report_year" class="form-control" required>
													<option value="">-- <?php echo $this->lang->line('select_year'); ?> --</option>
													<?php
													for($i = date('Y'); $i >= 2019; $i--){
														echo '<option value="'.$i.'" '.($this->input->get('dyear',true) == $i ? 'selected': '').' >'.$i.'</option>';
													}?>
												</select>
											</div>
											<div class="col-sm-6  col-xs-4">
												<label class="name ">Month</label>
												<select class="form-control" name="report_month" required>
													<option value="">-----Select Month----</option>
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
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-4 col-sm-12">
										<label class="name">Report Type</label>
											<select class="form-control" name="report_type" required>
													<option value="">-----Select Report Type----</option>
													<option value="Monthly" >Monthly</option>
													<option value="Quaterly" >Quaterly</option>
													<option value="Half Yearly"  >Half Yearly</option>
													<option value="Annual"  >Annual</option>
													<option value="Biannual"  >Biannual</option>
											  </select>
									</div>
									<div class="col-md-8 col-sm-12 apl-mrgbtm">
										<div class="row">
											<div class="col-sm-6  col-xs-4">
												<label class="name" >Report on</label>
													<select id ="report_desc" class="form-control" name="report_desc" onchange = "DisplayRule();" required>
														<option value="">-----Select Report on----</option>
														<option value="Death of Pensioner and Commencement of Family Pension" >Death of Pensioner and Commencement of Family Pension</option>
														<option value="Failure to draw Pension"  >Failure to draw Pension</option>
														<option value="Lapse Deposit Statement"  >Lapse Deposit Statement</option>
														<option value="Reconciliation of PD Accounts/Local Fund /PF Deposit"  >Reconciliation of PD Accounts/Local Fund /PF Deposit</option>
												  </select>
											</div>
											<div class="col-sm-6  col-xs-4">
												<label class="name ">Period ending on</label>
												<input  name ="report_due_date" value="<?php echo set_value('report_due_date',$report_due_date)?>" class="form-control datepicker"  >
											</div>
											
										</div>
									</div>	
								</div>
							</div>
							<div class="col-sm-12  col-xs-12" style="width:100%; max-height: 200px; overflow: auto;">
								<label class="name ">Rule provision</label>
								<textarea id="rule_display" type = "text" style = "background-color: #b3ffb3; align :left" rows="2" cols="110" readonly > </textarea >
							</div>
							<div>&nbsp;</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-8 col-sm-8">
										<label class="control-label">Upload Report(.pdf)<i style="color:red">[Please upload single pdf]</i></label>
										<input id="attachment" type="file" name="try_attachment" class="span12 m-wrap" onchange="previewImage(this,'up_file_display')" style="display:none"/>
										<button type="button" class="" onclick="browse()"><i class="icon-arrow-up icon-white"></i> Browse</button><span id="up_file_display"><?php if($try_attachment != ''){echo '&nbsp;<a href="'.base_url().'files/agae/department/'.$try_attachment.'" target="_blank">'.$try_attachment.'</a>';}?></span>
									</div>
								</div>
							</div>
							
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-4 col-sm-12">
										<label class="name">Name</label>
										<input id="try_official_name" name="try_official_name" value="<?php echo $profile['user_name'] ?>"type="text" class="form-control" readonly >	
									</div>
									<div class="col-md-8 col-sm-12 apl-mrgbtm">
										<div class="row">
											<div class="col-sm-4  col-xs-4">
												<label class="name">Designation</label>
												<input id="try_official_desig" name="try_official_desig" value="<?php echo $profile['user_desig'] ?>" type="text" class="form-control" readonly >
											</div>
											<div class="col-sm-4  col-xs-4">
												<label class="name ">Contact No</label>
												<input id="try_official_contact" name="try_official_contact" value="<?php echo $profile['mb_no'] ?>"type="text" class="form-control" readonly >
											</div>
											<div class="col-sm-4  col-xs-4">
											<label class="name "> Submission Date</label>
												<input id="try_date" name="try_date" type="text" value= "<?php echo  date("d-m-Y");?>" class="form-control " readonly>
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

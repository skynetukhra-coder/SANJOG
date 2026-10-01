<div class="row">
	<div class="col-md-3 col-sm-4">
		<div class="left-panel">
			<?php $this->load->view('layout/emp_dacadre_left_panel',$header);?>
		</div>
	</div>
	<div class="col-md-9 col-sm-8">
		<div class="right-panel">
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('employee'); ?> &raquo; <?php echo $this->lang->line('my_training'); ?> </div>
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
					<form method="post">
						<div class="row">
							<div class="col-sm-12">
								<div class="sub-heading" style="text-align:center"> OFFICE OF THE PR. ACCOUNTANT GENERAL (A&E) , WEST BENGAL<br />
									Treasury Buildings, 2 Government Place (West), Kolkata 70000-1</div>
							</div>
							
							<div class="col-sm-12">
								<div class="top-box">
									<div class="row">
										<label class="name" style="text-align:center; color: blue" >TRAINING  FEEDBACK  FORM</span></label>
									</div>								
								</div>
							</div>
							
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-8 col-sm-6">
										<label class="name">Full Name (as per Service Book)<span class="star">*</span></label>
										<input id="trg_pname" name="trg_pname" value="<?php echo $details['name'] ?>" type="text" class="form-control" readonly>
										<input id="empid" name="empid" value="<?php echo $details['empid'] ?>" type="hidden" class="form-control" >
										<input id="training_id" name="training_id" value="<?php echo $details['training_id'] ?>" type="hidden" class="form-control" >
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Designation<span class="star">*</span></label>
										<input id = "trg_pdesig" name="trg_pdesig" type="text" value="<?php echo $details['desig'] ?>" class="form-control" required readonly>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">	
									<div class="col-md-6 col-sm-12">
										<div class="row ">
											<div class="col-sm-6 name-mrgbtm">
												<label class="name">Section</label>
												<input id = "emp_section" name="emp_section" value="<?php echo $details['emp_section'] ?>" type="text" class="form-control" readonly>
											</div>
											<div class="col-sm-6 name-mrgbtm">
												<label class="name">Group</label>
												<input id = "group_nm" name="group_nm" value="<?php echo $details['group_nm'] ?>" type="text" class="form-control" readonly>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="row">
											<div class="col-md-6 col-sm-6">
												<label class="name">E-mail ID<span class="star">*</span></label>
												<input id = "email" name="email" value="<?php echo $profile['nicmail'] ?>" type="text" class="form-control" readonly>
											</div>
											<div class="col-md-6 col-sm-6 name-mrgbtm">
												<label class="name">Mobile No</label>
												<input id = "mobile_no" name="mobile_no" value="<?php echo $profile['mbno'] ?>" type="text" class="form-control" readonly>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-sm-12">
										<label class="name">1. Whether have you benefited from the Course?</label>
										<label class="radio-inline"><input name="trg_benifit" type="radio" value="Yes" />Yes</label>
										<label class="radio-inline"><input name="trg_benifit" type="radio" value="No" />No</label>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group">
									<label class="name">2. Was the course too short/too long/of the right duration?</label>
									<label class="radio-inline">
									<input name="trg_duration" value="Too short" type="radio">
									Too short</label>
									<label class="radio-inline">
									<input name="trg_duration" value="Too long" type="radio">
									Too long</label>
									<label class="radio-inline">
									<input name="trg_duration" value="Just right" type="radio">
									Just right</label>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-sm-12">
										<label class="name">3. Would you like any modification in the course module? If yes, what modification do you suggest?</label>
										<input name="trg_modification" value="" type="text" class="form-control">
									</div>
									
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-sm-12">
										<label class="name">4. Do you feel that the lecturers/instructors generally adopted a participative approach?</label>
										<label class="radio-inline"><input name="faculty_approach" type="radio" value="Yes" />Yes</label>
										<label class="radio-inline"><input name="faculty_approach" type="radio" value="No" />No</label>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-sm-12">
										<label class="name">5. Do you think that the coverage of topic was adequate? </label>
										<label class="radio-inline"><input name="topic_coverage" type="radio" value="Yes" />Yes</label>
										<label class="radio-inline"><input name="topic_coverage" type="radio" value="No" />No</label>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-sm-12">
										<label class="name">6. Did the lecturers/instructors resort to practical/concrete examples and problem solving exercise during sessions? </label>
										<label class="radio-inline"><input name="example" type="radio" value="Yes" />Yes</label>
										<label class="radio-inline"><input name="example" type="radio" value="No" />No</label>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group">
									<label class="name">7. Rating of the members of the faculty: </label>
								</div>
							</div>
							<div class="col-sm-12">
                              <div class="table-responsive">
								<table width="100%" border="1" bordercolor="#7399be" class="tbl table-responsive">
									<thead>
										<tr>
											<td>Name Lecturer</td>
											<td>Lecture Date <br><i style="color:red">(dd-mm-yyyy)</br></i></td>
											<td>Below Average</td>
											<td>Average</td>
											<td>Good</td>
											<td>Very Good</td>
											<td>Excellent</td>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><input id = "faculty_1" type="text" name="faculty_1" class="form-control" onclick = "MyAlert()"></td>
											<td><input id = "date_1" type="text" name="date_1" class="form-control datepicker"></td>
											<td><input id = "below_1" type="checkbox" name="below_1" class="form-control" ></td>
											<td><input id = "average_1" type="checkbox" name="average_1" class="form-control"></td>
											<td><input id = "good_1" type="checkbox" name="good_1" class="form-control"></td>
											<td><input id = "verygood_1" type="checkbox" name="verygood_1	" class="form-control"></td>
											<td><input id = "excellent_1" type="checkbox" name="excellent_1" class="form-control" checked></td>
										</tr>
										<tr>
											<td><input id = "" type="text" name="faculty_2" class="form-control"></td>
											<td><input id = "" type="text" name="date_2" class="form-control datepicker"></td>
											<td><input id = "" type="checkbox" name="below_2" class="form-control"></td>
											<td><input id = "" type="checkbox" name="average_2" class="form-control"></td>
											<td><input id = "" type="checkbox" name="good_2" class="form-control"></td>
											<td><input id = "" type="checkbox" name="verygood_2" class="form-control"></td>
											<td><input id = "" type="checkbox" name="excellent_2" class="form-control"></td>
										</tr>
										<tr>
											<td><input type="text" name="faculty_3" class="form-control  "></td>
											<td><input type="text" name="date_3" class="form-control datepicker"></td>
											<td><input type="checkbox" name="below_3" class="form-control"></td>
											<td><input type="checkbox" name="average_3" class="form-control"></td>
											<td><input type="checkbox" name="good_3" class="form-control"></td>
											<td><input type="checkbox" name="verygood_3	" class="form-control"></td>
											<td><input type="checkbox" name="excellent_3" class="form-control"></td>
										</tr>
										<tr>
											<td><input type="text" name="faculty_4" class="form-control"></td>
											<td><input type="text" name="date_4" class="form-control datepicker"></td>
											<td><input type="checkbox" name="below_4" class="form-control"></td>
											<td><input type="checkbox" name="average_4" class="form-control"></td>
											<td><input type="checkbox" name="good_4" class="form-control"></td>
											<td><input type="checkbox" name="verygood_4" class="form-control"></td>
											<td><input type="checkbox" name="excellent_4" class="form-control"></td>
										</tr>
										<tr>
											<td><input type="text" name="faculty_5" class="form-control  "></td>
											<td><input type="text" name="date_5" class="form-control datepicker"></td>
											<td><input type="checkbox" name="below_5" class="form-control"></td>
											<td><input type="checkbox" name="average_5" class="form-control"></td>
											<td><input type="checkbox" name="good_5" class="form-control"></td>
											<td><input type="checkbox" name="verygood_5	" class="form-control"></td>
											<td><input type="checkbox" name="excellent_5" class="form-control"></td>
										</tr>
										<tr>
											<td><input type="text" name="faculty_6" class="form-control"></td>
											<td><input type="text" name="date_6" class="form-control datepicker"></td>
											<td><input type="checkbox" name="below_6" class="form-control"></td>
											<td><input type="checkbox" name="average_6" class="form-control"></td>
											<td><input type="checkbox" name="good_6" class="form-control"></td>
											<td><input type="checkbox" name="verygood_6" class="form-control"></td>
											<td><input type="checkbox" name="excellent_6" class="form-control"></td>
										</tr>
										<tr id="more_exam_above">
											<td colspan="7" style="text-align:center"><button type="button" class="btn btn-sm" onclick="addMoreExam()" style="width:auto; padding:5px; font-size:10px"> + Add More</button></td>
										</tr>
									</tbody>
								</table>
                              </div>
							</div>
							<div class="col-sm-12">
								<div class="form-group">
									<label class="name">8. Any previous training on the same topic attended by you? </label>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-6 col-sm-12">
										<label class="name">Mention Location  of Training </label>
										<input name="pre_location" type="text" class="form-control">
									</div>
									<div class="col-md-6 col-sm-12 apl-mrgbtm">
										<label class="name">Period of Training</label>
										<div class="row">
											<div class="col-sm-2 col-xs-2">
												<label class="name1">From</label>
											</div>
											<div class="col-sm-4 col-xs-4">
												<input name="pre_trg_from" type="text" class="form-control datepicker">
											</div>
											<div class="col-sm-2 col-xs-2">
												<label class="name1 text-center">To</label>
											</div>
											<div class="col-sm-4 col-xs-4">
												<input name="pre_trg_to" type="text" class="form-control datepicker">
											</div>
										</div>
									</div>
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
											<input onclick = "InformationCheck();" type="text" name="c_image" class="form-control" placeholder="<?php echo $this->lang->line('write_image_code'); ?>" autocomplete="off" required >
										</div>
									</div>
								</div>
							</div>							
							<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
							<div class="col-sm-12">
								<input id="i_agree" type="checkbox" name="agree" onclick="show_hide_submit()" required/><span style="color:red">&nbsp;&nbsp;I agree that grade of my choice against the each facculty has been checked properly.</span><br/><br />
							</div>
							<div class="col-sm-12">
								<div class="row">
									<div class="col-sm-6">
										<strong>Date: <?php echo  date("d-m-Y");?> </strong>
										<input id="feedback_date" name="feedback_date" type="hidden" value="<?php echo  date("d-m-Y");?>" />
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
var cur_index = 2;
function addMoreExam(){
	var indx = cur_index++;
	var htm = '<tr>';
	htm +='<td><input name="faculty_'+cur_index+'" type="text" class="form-control"></td>';
	htm +='<td><input name="date_'+cur_index+'" type="text" class="form-control datepicker"></td>';
	htm +='<td><input type="checkbox" name="below_'+cur_index+'" type="text" class="form-control"></td>';
	htm +='<td><input type="checkbox" name="average_'+cur_index+'" type="text" class="form-control"></td>';
	htm +='<td><input type="checkbox" name="good_'+cur_index+'" type="text" class="form-control"></td>';
	htm +='<td><input type="checkbox" name="verygood_'+cur_index+'" type="text" class="form-control"></td>';
	htm +='<td><input type="checkbox" name="excellent_'+cur_index+'" type="text" class="form-control"></td>';
	htm +='</tr>';
	$('#more_exam_above').before(htm);
	if(indx >= 9){
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
function MyAlert(){
	var myText = "Instructions\n\n** One option of the grades (i.e. Below Average, Average, Good, Very Good or Excellent) for the Faculty must be clicked on.\n\n ** Select grade for each faculty. \n\n** To change your option, Click again on the box already selected (for example) to deselect it and give your choice.";
    alert (myText);
}

function InformationCheck(){
	var faculty = document.getElementById('faculty_1').value;
	var below = document.getElementById('below_1').value;
	var average = document.getElementById('average_1').value;
	var good = document.getElementById('good_1').value;
	var verygood = document.getElementById('verygood_1').value;
	var excellent = document.getElementById('excellent_1').value;
	
	if(faculty !== ''){ 
	alert("** Thanks for awarding grade to the facculty.\n\n** Please check all other informations and submit.");
/*	
		if(below == ''){
			if(average == ''){
				if(good == ''){
					if(verygood == ''){
						if(excellent == ''){
							alert("** You must award faculty's  grade by clicking on any one box below tbe options (i.e. Below Average, Average, Good, Very Good or Excellent).");
					}else{
						alert("** Thanks for selecting facculty's grade as Excellent");
					}
					}else{
						alert("** Thanks for selecting facculty's grade as Very Good");
					}
				}else{
					alert("** Thanks for selecting facculty's grade as Good");
				}
			}else{
				alert("** Thanks for selecting facculty's grade as Average");
			}
		}else{
			alert("** Thanks for selecting facculty's grade as Below Average");
		}
*/
	}else{
		alert("** Please enter Name of Lecturer and give your feedback.");
	}
}

</script>
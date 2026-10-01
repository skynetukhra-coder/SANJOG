<style>
td{text-align: ;
width: 50%";
}
</style>

<div class="row">
	<div class="col-md-3 col-sm-4">
		<div class="left-panel">
			<?php $this->load->view('layout/emp_left_panel',$header);?>
		</div>
	</div>
	<div class="col-md-9 col-sm-8">
		<div class="right-panel">
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('employee'); ?> &raquo; Utilities</div>
			<div class="login-box">
				<div class="new-cont medium whats-new">
					<ul class="nav nav-tabs " style="background-color: ">
						<li class="active"><a data-toggle="tab" href="#tab" onclick="myPension()" >Pension</a></li>
						<li><a data-toggle="tab" href="#tab1" onclick="retGratuity()" >Gratuity</a></li>
						<li><a data-toggle="tab" href="#tab2" onclick="commuValue()" >Commutation</a></li>
						<li><a data-toggle="tab" href="#tab3" onclick="enCash()" >Leave Encashment</a></li>
					</ul>
				</div>
			<div>&nbsp;</div>
			 <form id="ret_form" method="post" >
				<h4><strong><?php echo $this->lang->line('circular_office_orde'); ?>Pensionary Benifit on Retirement </strong>
				<span >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
				</h4>
				<hr class = "rounded">
<!--
				<div>
					<span><button type="button" class="btn-warning btn-lg" onclick="myPension()">Pension</button></span>
					<span><button type="button" class="btn-warning btn-lg" onclick="retGratuity()">Gratuity</button></span>
					<span><button type="button" class="btn-warning btn-lg" onclick="commuValue()">Commutation</button></span>
					<span><button type="button" class="btn-warning btn-lg" onclick="enCash()">Leave Encashment</button></span>
				</div>
-->
					<table border="1" style="width:100%">
						<thead>
							<tr style="text-align:center">
								<th style="text-align:center"><strong>Description</strong></th>
								<th style="text-align:center; width:57%"><strong>Information</strong></th>
							</tr>
						</thead>
						<tbody>
							<tr>						
								<?php
								if($profile['da_cadare']){?>
								<td class="col_1">DA Cadre ID</td>
									<td class="col_2">
								</td><input type="text" id="empid" name="empid" value="<?php echo isset($profile['empid']) ? $profile['empid']: ''?>" class="form-control" readonly>
							</tr>
								<?php
								}else{?>
							<tr>
								<td class="col_1">Employee PAN</td>
								<td class="col_2"><input type="text" id="empid" name="empid" value="<?php echo isset($profile['empid']) ? $profile['empid']: ''?>" class="form-control" readonly></td>
							</tr>
								<?php
								}?>
							<tr>
								<td class="col_1">Employee Name</td>
								<td class="col_2"><input type="text" id="empname" name="empname" value="<?php echo isset($profile['empname']) ? $profile['empname']: ''?>" class="form-control" readonly></td>
							</tr>
							<tr>
								<td class="col_1">Date of Birth</td>
								<td class="col_2"><input type="text" id="dob" name="dob" value="<?php echo isset($profile['dob']) ? get_datepicker_date($profile['dob']): ''?>" class="form-control" readonly></td>
							</tr>
							<tr>
								<td class="col_1">Date of Retirement</td>
								<td class="col_2"><input type="text" id="dor" name="dor" value="<?php echo isset($profile['dor']) ? get_datepicker_date($profile['dor']): ''?>" class="form-control" readonly></td>
							</tr>
							<tr>
								<td class="col_1">Net Qualifying Service</td>
								<td class="col_2" ><span style = "display : block; height: 35px; padding-top: 8px;">
									<span></span>
									<span>
										<select id = "year" name="year" class="" >
											<option value="">--Year--</option>
												<?php
												for($i = 1; $i <= 50; $i++){
													echo '<option value="'.$i.'" '.($this->input->get('year',true) == $i ? 'selected': '').' >'.$i.'</option>';
												}?>
										</select>
									</span>
									<span>||</span>
									<span >
										<select id = "month" name="month">
											<option value="0" selected="">--Month--</option>
											<option value="1">1</option>   
											<option value="2">2</option>  
											<option value="3">3</option>   
											<option value="4">4</option>  
											<option value="5">5</option> 
											<option value="6">6</option>  
											<option value="7">7</option>
											<option value="8">8</option>
											<option value="9">9</option>  
											<option value="10">10</option>   
											<option value="11">11</option>    
											<option value="12">12</option>
										</select>
									</span>
									</span>
								</td>
							</tr>
							<tr>
								<td class="col_1">Retirement Type</td>
								<td class="col_2"><span style = "display : block; height: 35px; padding-top: 8px;">&nbsp;
									<select id = "r_type" name="r_type">
										<option value="s" selected="">Superannuation</option>
										<option value="v">Voluntary</option>
									</select></span>
								</td>
							</tr>
							<tr>
								<td class="col_1">Basic Pay</td>
								<td class="col_2"><input type="text" id="basic_pay" name="basic_pay" onClick="this.setSelectionRange(0, this.value.length)" value="<?php echo isset($profile['basic_pay']) ? $profile['basic_pay']: ''?>" class="form-control" ></td>
		<!--					<td class="col_2" ><input type="text" id="number1" name="number1" onClick="this.setSelectionRange(0, this.value.length)" value="0" class="form-control" ></td>			-->
							</tr>
							<tr>
								<td class="col_1">Percentage of Commutation (Maximum 40%)</td>
								<td class="col_2"><input type="text" id="commut" name="commut" onClick="this.setSelectionRange(0, this.value.length)" value="0" class="form-control" ></td>
							</tr>
							<tr>
								<td class="col_1">Percentage of DA Relief (Now 50%)</td>
								<td class="col_2" ><input type="text" id="da" name="da" onClick="this.setSelectionRange(0, this.value.length)" value="0" class="form-control" ></td>
							</tr>
							<tr>
								<td class="col_1">Percentage of Disability</td>
								<td class="col_2" ><input type="text" id="disa" name="disa" onClick="this.setSelectionRange(0, this.value.length)" value="0" class="form-control" ></td>
							</tr>
							<tr>
								<td class="col_1"><strong>Pension on Retirement + Dearness Relief</strong></td>
								<td class="col_2" align = "center" ><span style = "display : block; height: 45px; padding-top: 3px">
									<strong><span id="screen1"></span></strong> + <strong><span id="das1" class="form-contr"></span></strong> = <strong><span id="t1" class="form-contr"></span></strong>
								</span></td>
							</tr>
							<tr>
								<td class="col_1"><strong>Pension after Commuttion + Dearness Relief</strong></td>
								<td class="col_2" align = "center" ><span style = "display : block; height: 45px; padding-top: 3px">
									<strong><span id="screen2" ></span></strong> + <strong><span id="das2" class="form-contr"></span></strong> = <strong><span id="t2" class="form-contr"></span></strong>
								</span></td>
							</tr>
							<tr>
								<td class="col_1"><strong>Family Pension + Dearness Relief</strong></td>
								<td class="col_2" align = "center" ><span style = "display : block; height: 45px; padding-top: 3px">
									<strong><span id="screen3" ></span></strong> + <strong><span id="das3" class="form-contr"></span></strong> = <strong><span id="t3" class="form-contr"></span></strong>
								</span></td>
							</tr>
							<tr>
								<td class="col_1"><strong>Enhanced Family Pension + Dearness Relief</strong></td>
								<td class="col_2" align = "center" ><span style = "display : block; height: 45px; padding-top: 3px">
									<strong><span id="screen4" ></span></strong> + <strong><span id="das4" class="form-contr"></span></strong> = <strong><span id="t4" class="form-contr"></span></strong>
								</span></td>
							</tr>
							<tr>
								<td class="col_1"><strong>Disability Pension + Dearness Relief</strong></td>
								<td class="col_2" align = "center" ><span style = "display : block; height: 45px; padding-top: 3px">
									<strong><span id="screen5" ></span></strong> + <strong><span id="das5" class="form-contr"></span></strong> = <strong><span id="t5" class="form-contr"></span></strong>
								</span></td>
							</tr>
						</tbody>
					</table>
					<div>&nbsp;</div>
					<div>
						<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
					</div>
					<div align = "center" >
						<button type="button" class="btn-lg btn-success" onclick="Retn()"> CLOSE </button>
						<button type="button" class="btn-lg btn-primary" onclick="submit1()" style = "padding-left: 3px; padding-right: 3px;">CALCULATE</button>
						<button class="btn-lg btn-info" onclick="window.location.reload();" >RESET</button> 
					</div>
				</form>	
			  </div>
			</div>
		</div>
</div>

<script type="text/javascript" src="<?php echo SITE_BASE_URL?>assets/js/jquery.min.js"></script>
<script>

function myPension() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/retirement_pension/';
}

function retGratuity() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/retirement_gratuity/';
}

function commuValue() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/retirement_commutation/';
}

function enCash() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/encashment_leave/';
}

function Retn() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/information/';
}
</script>

<script>
$( document ).ready(function() {

});

function submit1(){
	 
	 var year =  document.getElementById("year").value;
	 var month =  document.getElementById("month").value;
	 var r_type =  document.getElementById("r_type").value;
	 var basic_pay =  document.getElementById("basic_pay").value;
	 var da =  document.getElementById("da").value;
	 var commut =  document.getElementById("commut").value;
	 var disa =  document.getElementById("disa").value;
	  if(basic_pay !== '' &&  month !== '' && da !== ''){ 		
				var gyear = parseInt(year);
				var gmonth = parseInt(month);	
				// Calculating QS
				var tmonth = gyear * 12 + gmonth;
				var sixp = (tmonth - (tmonth % 6)) / 6;
				var rmonth = tmonth % 6;
				var qsp = 0;
				
				if (rmonth >= 5){						
					qsp = sixp + 1;
				}else{
					qsp = sixp;
				}
		}
		
		s1 = parseInt(basic_pay)/2;
		// Minimum and Maximum pension
		if (s1 < 3500) 
				s1=3500;
		else if (s1 > 45000) 
				s1=45000;
		// *Maximum of 10 years QS for Superannuation and 20 years for Voluntary Retirement		
		if (qsp >= 40){
			s1 = s1;
		}
		else if (qsp >= 20 && r_type == "s"){
			s1 = s1;
		} 
		else {
			 s1 = 0;
		     alert("No Pension.");
		}
	// Commutation and other pensions
	 if(commut <= 40){ 
		if(basic_pay !== ''){ 			
				var dr = (s1*parseInt(da))/100;	
				var t1 = s1 + dr ;
				document.getElementById("screen1").innerHTML=s1.toFixed(2);
				document.getElementById("das1").innerHTML=dr.toFixed(2);
				document.getElementById("t1").innerHTML=t1.toFixed(2);
				var s2 = s1-(s1*parseInt(commut))/100; 	//pension after commutation
				var t2 = s2 + dr;
				document.getElementById("screen2").innerHTML=s2.toFixed(2);
				document.getElementById("das2").innerHTML=dr.toFixed(2);
				document.getElementById("t2").innerHTML=t2.toFixed(2);
				var s3 = s2*0.3; 					// normal rate of family pensin
				var t3 = s3 + dr;
				document.getElementById("screen3").innerHTML=s3.toFixed(2);
				document.getElementById("das3").innerHTML=dr.toFixed(2);
				document.getElementById("t3").innerHTML=t3.toFixed(2);
				var efp = 0;						// Enhanced rate of family pension
				var efp1 = s1;   					//50% of the last pay drawn
				var efp2 = 2*s3; 		  			// twice the rate of normal family pension
				if (efp1<efp2){						
					efp=efp1;
				}else{
					efp=efp2;
				}
				
				var s4 = efp; 
				var t4 = s4 + dr;
				document.getElementById("screen4").innerHTML=s4.toFixed(2);
				document.getElementById("das4").innerHTML=dr.toFixed(2);
				document.getElementById("t4").innerHTML=t4.toFixed(2);
				
//				var disa = parseInt(disa);			//disability pension
				if (disa >= 76){
					var s5 = s3;
				}
				else if (disa >= 50){
					var s5 = s3*0.75;
				} 
				else if (disa >= 1){
					var s5 = s3*0.5;
				} 
				else {
					 var s5 = 0;
				}
				
				var t5 = s5 + dr;
				document.getElementById("screen5").innerHTML=s5.toFixed(2);
				document.getElementById("das5").innerHTML=dr.toFixed(2);
				document.getElementById("t5").innerHTML=t5.toFixed(2);
			}else{
				alert("** Enter Information " );
			}
	}else{
			alert("** Maximum commutation is 40% " );
	}
	
	
}
</script>
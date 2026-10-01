<?php
$da_cadare = isset($profile['da_cadare']) ? $profile['da_cadare'] : '1';
?>

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
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('employee'); ?> &raquo; Utilities </div>
			<div class="login-box">
				<div class="new-cont medium whats-new">
					<ul class="nav nav-tabs " style="background-color: ">
						<li ><a data-toggle="tab" href="#tab" onclick="myPension()" >Pension</a></li>
						<li><a data-toggle="tab" href="#tab1" onclick="retGratuity()" >Gratuity</a></li>
						<li class="active" ><a data-toggle="tab" href="#tab2" onclick="commuValue()" >Commutation</a></li>
						<li><a data-toggle="tab" href="#tab3" onclick="enCash()" >Leave Encashment</a></li>
					</ul>
				</div>
				
			<div>&nbsp;</div>
			 <form id="ret_form" method="post" >
				<h4><strong><?php echo $this->lang->line('circular_office_orde'); ?> Commutation Value</strong><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</span></h4>
					<hr class = "rounded">
					<table border="1" style="width:100%">
						<thead>
							<tr style="text-align:center">
								<th style="text-align:center"><strong>Description</strong></th>
								<th style="text-align:center; width: 45%"><strong>Information</strong></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="col_1">Employee PAN</td>
								<td class="col_2"><input type="text" id="empid" name="empid" value="<?php echo isset($profile['empid']) ? $profile['empid']: ''?>" class="form-control" readonly></td>
							</tr>
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
								<td class="col_1">Age on Next Birth Day on Superannuation</td>
								<td class="col_2" ><input type="text" id="age" name="age" onclick = "MessAlt();" onClick="this.setSelectionRange(0, this.value.length)" value="<?php echo isset($profile['age']) ? $profile['age']: '0'?>" class="form-control" ></td>
							</tr>
							<tr>
								<td class="col_1">Commutation Factor:<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<button type="submit" class="">Find Factor</button> (In case of change of age)</span></td>
								<td class="col_2" ><input type="text" id="factor" name="factor" value="<?php echo isset($comm['factor']) ? $comm['factor']: '0'?>" class="form-control" readonly>
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
								<td class="col_1"><strong>Commuted Part of Pension </strong></td>
								<td class="col_2" align = "center" ><span style = "display : block; height: 35px; padding-top: 7px">
									<strong><span id="screen2" class="form-contr"></span></strong>
								</span></td>
							</tr>
							<tr>
								<td class="col_1"><strong>Comutation Value </strong></td>
								<td class="col_2" align = "center" ><span style = "display : block; height: 35px; padding-top: 7px">
									<strong><span id="screen1" class="form-contr"></span></strong>
								</span></td>
							</tr>
						</tbody>
					</table>
					<div>&nbsp;</div>
					<div>
						<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
					</div>
					<div align = "center" >
						<button type="button" class="btn-lg btn-success" onclick="Retn()"> BACK </button>
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

function MessAlt() {
  alert(" Click on 'Find Factor' to change Commucation Factor for the age. " );
}

function Retn() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/retirement_pension/';
}

function submit1(){
	 var basic_pay =  document.getElementById("basic_pay").value;
	 var factor =  document.getElementById("factor").value;
	 var commut =  document.getElementById("commut").value;
	 if(commut <= 40){ 
		if(basic_pay !== ''){ 
				var s2 = ((parseInt(basic_pay)/2)*(parseInt(commut)/100));
				document.getElementById("screen2").innerHTML=s2.toFixed(2);
				var s1 = ((parseInt(basic_pay)/2)*(parseInt(commut)/100))*12*parseFloat(factor); 
				document.getElementById("screen1").innerHTML=s1.toFixed(2);
			}else{
				alert("** Basic Pay is required " );
			}
	 }else{
		 alert("** Maximum commutation is 40% " );
	 }
  }
</script>
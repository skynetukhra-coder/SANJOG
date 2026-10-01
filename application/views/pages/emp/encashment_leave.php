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
						<li><a data-toggle="tab" href="#tab2" onclick="commuValue()" >Commutation</a></li>
						<li class="active"><a data-toggle="tab" href="#tab3" onclick="enCash()" >Leave Encashment</a></li>
					</ul>
				</div>
				<div>&nbsp;</div>
				<h4><strong><?php echo $this->lang->line('circular_office_orde'); ?> Leave Encashment</strong><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</span></h4>	
				<hr class = "rounded">
					<table border="1" style="width:100%">
						<thead>
							<tr style="text-align:center">
								<th style="text-align:center"><strong>Description</strong></th>
								<th style="text-align:center; width: 50%;"><strong>Information</strong></th>
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
								<td class="col_1">Basic Pay</td>
								<td class="col_2"><input type="text" id="number1" name="number1" onClick="this.setSelectionRange(0, this.value.length)" value="<?php echo isset($profile['basic_pay']) ? $profile['basic_pay']: ''?>" class="form-control" ></td>
		<!--					<td class="col_2" ><input type="text" id="number1" name="number1" onClick="this.setSelectionRange(0, this.value.length)" value="0" class="form-control" ></td>			-->
							</tr>
							<tr>
								<td class="col_1">No of Days for Encashment</td>
								<td class="col_2" ><input type="text" id="number2" name="number2" onClick="this.setSelectionRange(0, this.value.length)" value="0" class="form-control" ></td>
							</tr>
							<tr>
								<td class="col_1">Percentage of DA (Now 50%)</td>
								<td class="col_2" ><input type="text" id="number3" name="number3" onClick="this.setSelectionRange(0, this.value.length)" value="0" class="form-control" ></td>
							</tr>
							<tr>
								<td class="col_1"><strong>Encashment on Basic</strong></td>
								<td class="col_2" align = "center" ><span style = "display : block; height: 35px; padding-top: 7px">
									<strong><span id="screen1" class="form-contr"></span></strong>
								</span></td>
							</tr>
							<tr>
								<td class="col_1"><strong>Dearness Allowance </strong></td>
								<td class="col_2" align = "center" ><span style = "display : block; height: 35px; padding-top: 7px">
									<strong><span id="screen2" class="form-contr"></span></strong>
								</span></td>
							</tr>
							<tr>
								<td class="col_1"><strong>Total Encashment</strong></td>
								<td class="col_2" align = "center" ><span style = "display : block; height: 35px; padding-top: 7px">
									<strong><span id="screen3" class="form-contr"></span></strong>
								</span></td>
							</tr>
						</tbody>
					</table>
					<div align = "center" >&nbsp;</div>
					<div align = "center" >
						<button type="button" class="btn-lg btn-success" onclick="Retn()"> BACK </button>
						<button type="button" class="btn-lg btn-primary" onclick="submit1()" style = "padding-left: 3px; padding-right: 3px;">CALCULATE</button>
						<button class="btn-lg btn-info" onclick="window.location.reload();" >RESET</button> 
					</div>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script>
 
function Retn() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/retirement_pension/';
}

function submit1(){
	 var number1 =  document.getElementById("number1").value;
	 var number2 =  document.getElementById("number2").value;
	 var number3 =  document.getElementById("number3").value;
		if(number1 !== ''){ 
				var s1 = (parseInt(number1)*parseInt(number2))/30; 
				document.getElementById("screen1").innerHTML=s1.toFixed(0);
				var s2 = s1*(parseInt(number3)/100);  
				document.getElementById("screen2").innerHTML=s2.toFixed(0);
				var s3 = s1 + s2 ;
				document.getElementById("screen3").innerHTML=s3.toFixed(0);
				
			}else{
				alert("** Basic Pay is required " );
			}
  }
</script>
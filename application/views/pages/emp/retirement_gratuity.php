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
						<li ><a data-toggle="tab" href="#tab" onclick="myPension()" >Pension</a></li>
						<li class="active"><a data-toggle="tab" href="#tab1" onclick="retGratuity()" >Gratuity</a></li>
						<li><a data-toggle="tab" href="#tab2" onclick="commuValue()" >Commutation</a></li>
						<li><a data-toggle="tab" href="#tab3" onclick="enCash()" >Leave Encashment</a></li>
					</ul>
				</div>
				<div>&nbsp;</div>
				<h4><strong><?php echo $this->lang->line('circular_office_orde'); ?> Retirement Gratuity</strong><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</span></h4>
				<hr class = "rounded">
					<table border="1" style="width:100%">
						<thead>
							<tr style="text-align:center">
								<th style="text-align:center"><strong>Description</strong></th>
								<th style="text-align:center; width: 55%;"><strong>Information</strong></th>
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
								<td class="col_1">Type of Gratuity</td>
								<td class="col_2">
									<select type="text" id="grty_type" name="grty_type" class="form-control" required>
										<option value="R" selected="">Retirement Gratuity</option>
										<option value="D">Death Gratuity</option>
										<option value="S">Service Gratuity</option>
									</select>
								</td>
							</tr>
							<tr>
								<td class="col_1">Basic Pay</td>
								<td class="col_2"><input type="text" id="basic_pay" name="basic_pay" onClick="this.setSelectionRange(0, this.value.length)" value="<?php echo isset($profile['basic_pay']) ? $profile['basic_pay']: ''?>" class="form-control" ></td>
							</tr>
<!--						<tr>
								<td class="col_1">Total Basic Pay plus DA  received for the last 10 months</td>
								<td class="col_2" ><input type="text" id="ten_basic" name="ten_basic" onClick="this.setSelectionRange(0, this.value.length)" value="0" class="form-control" ></td>			
							</tr>
-->							<tr>
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
											<option value="0" selected="">-- Month--</option>
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
								<td class="col_1">Percentage of DA (Now 50%)</td>
								<td class="col_2" ><input type="text" id="da" name="da" onClick="this.setSelectionRange(0, this.value.length)" value="0" class="form-control" ></td>
							</tr>
							<tr>
								<td class="col_1"><strong>Gratuity Amount</strong></td>
								<td class="col_2" align = "center" ><span style = "display : block; height: 35px; padding-top: 7px">
									<strong><span id="screen1" class="form-contr"></span></strong>
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

<script>
$( document ).ready(function() {

});

function Retn() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/retirement_pension/';
}

function submit1(){
	 var basic_pay =  document.getElementById("basic_pay").value;
	 var year =  document.getElementById("year").value;
	 var month =  document.getElementById("month").value;
	 var da =  document.getElementById("da").value;
	 var grty_type =  document.getElementById("grty_type").value;
	 
	 
		if(month !== '' && da !== ''){ 
				var gyear = parseInt(year);
				var gmonth = parseInt(month);	

				var tmonth = gyear * 12 + gmonth;
				var sixp = (tmonth - (tmonth % 6)) / 6;
				var rmonth = tmonth % 6;
				var qsp = 0;
				
				if (rmonth >= 3){						
					qsp = sixp + 1;
				}else{
					qsp = sixp;
				}
			
				var MixGtyAmt = 0;
				var grtyAmt = 0;
				var emoumnt = parseInt(basic_pay)+ (parseInt(basic_pay)*parseInt(da))/100;
				
				if (!(qsp)){
					alert("Qualifying Service required.");
				}
				
				if ((!((qsp >= 5) && (qsp < 10))) && (grty_type == "S")){
					alert("Qualifying Service Years must be greater than or  equal to 5 years and Less than 10 years for Service Gratuity.");
				}
/*				
//***********  IF Statement

				if (grty_type == "R"){						//Retirement Gratuity			
					grtyAmt = emoumnt / 4 * qsp;
				} 
				
				if (grty_type == "S"){						//Service Gratuity			
					if ((qsp >= 10) &&  (qsp < 20)){
						grtyAmt = emoumnt / 2 * qsp;
					}
				}
				
				if (grty_type == "D"){						///Death Gratuity			
					if (qsp >= 40) {
						grtyAmt = emoumnt / 2 * qsp;
					}else if (qsp >= 22){
						grtyAmt = emoumnt *20;
					}else if (qsp >= 10){
						grtyAmt = emoumnt *12;
					}else if (qsp >= 2){
						grtyAmt = emoumnt *6;
					}else {
						grtyAmt = emoumnt *2;
					} 
				}	
*/
			
//***********  Switch Statement				

			switch (grty_type)
				 {	
					case 'R':  								 //Retirement Gratuity
						grtyAmt = (emoumnt/4) * qsp ;
						break;
					case 'S' :   							 // Service Gratuity		
						if ((qsp >= 10) &&  (qsp < 20))
							grtyAmt = (emoumnt/2) * qsp ;	
						break;
					case 'D':  								 //Death Gratuity
						if (qsp < 2)
							grtyAmt = emoumnt * 2 ;
						else if ((qsp >=2) &&  (qsp < 10))
							grtyAmt = emoumnt * 6 ;
						else if ((qsp >= 10) &&  (qsp < 22))
							grtyAmt = emoumnt * 12 ;
						else if ((qsp >= 22) &&  (qsp < 40))
							grtyAmt = emoumnt * 20 ;
						else  // >= 20
							grtyAmt = (emoumnt/2) * qsp ;			
						break;
							
				 }						
	
				// max limit of 2000000
				if (grtyAmt >= 2000000){						
					grtyAmt = 2000000;
				}else{
					grtyAmt=grtyAmt;
				}
				
				if (isNaN(grtyAmt)) {
					grtyAmt=0;
				}else{
				   grtyAmt=grtyAmt;
				}

				document.getElementById("screen1").innerHTML=grtyAmt.toFixed(2);
		}else{
				alert("** Basic Pay, Dearness Allowance & Qualifying Service required " );
		}	
			
  }
</script>
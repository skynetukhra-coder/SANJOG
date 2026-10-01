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
				<h4><strong><?php echo $this->lang->line('circular_office_orde'); ?> Calculate APAR Grade for</strong><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</span><span> 
		<!--		<button class="btn-primary btn-xm" onclick="myFunction()"> For MTS</button> 
		
<option data-value="0" value=""> ----Select Calculator----</option>		
		-->
					<select id="staff" name="staff" onchange = "FieldsReadOnly();" class="" required>
						<option data-value="1" value="no">Other Than MTS </option>	
						<option data-value="2" value="yes"> MTS</option>				
					</select>
				</span></h4>
				<hr />
					
					<table border="1" style="width:100%">
						<thead>
							<tr style="text-align:center">
								<th style="text-align:center"><strong> Description</strong></th>
								<th style="text-align:center"><strong> Point Awarded (Scale 1-10)</strong></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="col_1">(I) Accomplishment of planned work / wrok allotted as per subject allotted</td>
								<td class="col_2" ><input type="text" id="number1" name="number1" onClick="this.setSelectionRange(0, this.value.length)" value="0" class="form-control" ></td>
							</tr>
							<tr>
								<td class="col_1">(II) Quality Output</td>
								<td class="col_2" ><input type="text" id="number2" name="number2" onClick="this.select();" value="0" class="form-control" ></td>
							</tr>
							<tr>
								<td class="col_1">(III) Analytical ability</td>
								<td class="col_2" ><input type="text" id="number3" name="number3" onClick="this.select();" value="0" class="form-control" ></td>
							</tr>
							<tr>
								<td class="col_1">(IV) Accomplishment of exceptional work / unforseen taks performed</td>
								<td class="col_2" ><input type="text" id="number4" name="number4" onClick="this.select();" value="0" class="form-control" ></td>
							</tr>
							<tr>
								<td class="col_1"><strong>OVER ALL GRADING ON WORK OUTPUT</strong></td>
								<td class="col_2" align = "center" ><span style = "display : block; height: 35px; padding-top: 7px">
									<strong><span id="screen1" class="form-contr"></span></strong>
								</span></td>
							</tr>
							<tr>
								<td class="col_1">(I) Attitude to work</td>
								<td class="col_2" ><input type="text" id="number5" name="number5" onClick="this.select();" value="0" class="form-control" ></td>
							</tr>
							<tr>
								<td class="col_1">(II) Sense of responsibility</td>
								<td class="col_2" ><input type="text" id="number6" name="number6" onClick="this.select();" value="0" class="form-control" ></td>
							</tr>
							<tr>
								<td class="col_1">(III) Maintenance of Discipline</td>
								<td class="col_2"><input type="text" id="number7" name="number7" onClick="this.select();" value="0" class="form-control" ></td>
							</tr>
							<tr>
								<td class="col_1">(IV) Communication Skills </td>
								<td class="col_2" ><input type="text" id="number8" name="number8" onClick="this.select();" value="0" class="form-control" ></td>
							</tr>
							<tr>
								<td class="col_1">(V) Leadership qualities</td>
								<td class="col_2"><input type="text" id="number9" name="number9" onClick="this.select();" value="0" class="form-control" ></td>
							</tr>
							<tr>
								<td class="col_1">(VI) Capacity to work in team sprit</td>
								<td class="col_2" ><input type="text" id="number10" name="number10" onClick="this.select();"value="0" class="form-control" ></td>
							</tr>
							<tr>
								<td class="col_1">(VII) Capacity to adhere to time schedule</td>
								<td class="col_2" ><input type="text" id="number11" name="number11" onClick="this.select();" value="0" class="form-control" ></td>
							</tr>
							<tr>
								<td class="col_1">(VIII) Inter- personal relations</td>
								<td class="col_2" ><input type="text" id="number12" name="number12" onClick="this.select();" value="0" class="form-control" ></td>
							</tr>
							<tr>
								<td class="col_1">(IX) Overall bearing and personality</td>
								<td class="col_2" ><input type="text" id="number13" name="number13" onClick="this.select();" value="0" class="form-control" ></td>
							</tr>
							<tr>
								<td class="col_1"><strong>OVER ALL GRADING ON PERSONAL ATTRIBUTES</strong></td>
								<td class="col_2" align = "center" ><span style = "display : block; height: 35px; padding-top: 7px">
									<strong><span id="screen2" class=""></span></strong>
								</span></td>
							</tr>
							<tr>
								<td class="col_1">(I) Knowledge of Rules and Regulation and ability to apply them</td>
								<td class="col_2" ><input type="text" id="number14" name="number14" onClick="this.select();" value="0" class="form-control" ></td>
							</tr>
							<tr>
								<td class="col_1">(II) Strategic planning ability</td>
								<td class="col_2" ><input type="text" id="number15" name="number15" onClick="this.select();" value="0" class="form-control" ></td>
							</tr>
							<tr>
								<td class="col_1">(III) Decision making ability </td>
								<td class="col_2" ><input type="text" id="number16" name="number16" onClick="this.select();" value="0" class="form-control" ></td>
							</tr>
							<tr>
								<td class="col_1">(IV) Coordination ability </td>
								<td class="col_2" ><input type="text" id="number17" name="number17" onClick="this.select();" value="0" class="form-control" ></td>
							</tr>
							<tr>
								<td class="col_1">(V) Ability to motivate and develop subordinates </td>
								<td class="col_2" ><input type="text" id="number18" name="number18" onClick="this.select();" value="0" class="form-control" ></td>
							</tr>
							<tr>
								<td class="col_1">(VI) Initiative</td>
								<td class="col_2" ><input type="text" id="number19" name="number19" onClick="this.select();" value="0" class="form-control" ></td>
							</tr>
							<tr>
								<td class="col_1"><strong>OVER ALL GRADING ON FUNCTIONAL COMPETENCY</strong></td>
								<td class="col_2" align = "center" ><span style = "display : block; height: 35px; padding-top: 7px">
								<strong><span id="screen3" class="form-contr"></span></strong>
								</span></td>
							</tr>
							<tr>
								<td class="col_1"><strong>OVERALL NUMERICAL GRADING</strong></td>
								<td class="col_2" align = "center" ><span style = "display : block; height: 35px; padding-top: 7px">
								<strong><span id="screen4" class="form-contr"></span></strong>
								</span></td>
							</tr>
						</tbody>
					</table>
					<div align = "center" >&nbsp;<div>
					<div align = "center" >
						<button class="btn-success btn-lg" onclick="window.location.reload();" >RESET</button>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
						<button type="button" class="btn-lg btn-primary" onclick="submit1()">CALCULATE</button>
					</div>
				</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?php echo SITE_BASE_URL?>assets/js/jquery.min.js"></script>
<script>

function FieldsReadOnly(){
	var staff =  document.getElementById("staff").value;
	if(staff == 'yes'){
//		document.getElementById("number1").readOnly = true;
//		document.getElementById("number2").readOnly = true;
	}else{
		document.getElementById("number1").readOnly = false;
		document.getElementById("number2").readOnly = false;
	}
}
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script>
$( document ).ready(function() {

});
function submit1(){
	 var staff =  document.getElementById("staff").value;
		if(staff !== ''){ 
			if(staff == 'no'){ 
				var a =  document.getElementById("number1").value;
				var b =  document.getElementById("number2").value;
				var c =  document.getElementById("number3").value;
				var d =  document.getElementById("number4").value;
				var e =  document.getElementById("number5").value;
				var f =  document.getElementById("number6").value;
				var g =  document.getElementById("number7").value;
				var h =  document.getElementById("number8").value;
				var i =  document.getElementById("number9").value;
				var j =  document.getElementById("number10").value;
				var k =  document.getElementById("number11").value;
				var l =  document.getElementById("number12").value;
				var m =  document.getElementById("number13").value;
				var n =  document.getElementById("number14").value;
				var o =  document.getElementById("number15").value;
				var p =  document.getElementById("number16").value;
				var q =  document.getElementById("number17").value;
				var r =  document.getElementById("number18").value;
				var s =  document.getElementById("number19").value;
				var s1 = ((((parseFloat(a) + parseFloat(b) + parseFloat(c) + parseFloat(d))/4)*0.4)*100)/100; 
				document.getElementById("screen1").innerHTML=s1.toFixed(2);
				var s2 = ((((parseFloat(e) + parseFloat(f) + parseFloat(g) + parseFloat(h) + parseFloat(i) + parseFloat(j) + parseFloat(k) + parseFloat(l) + parseFloat(m))/9)*0.3)*100)/100; 
				document.getElementById("screen2").innerHTML=s2.toFixed(2);
				var s3 = ((((parseFloat(n) + parseFloat(o) + parseFloat(p) + parseFloat(q)+ parseFloat(r)+ parseFloat(s))/6)*0.3)*100)/100;
				document.getElementById("screen3").innerHTML=s3.toFixed(2);
				var s4 = s1 + s2 + s3; 
				document.getElementById("screen4").innerHTML=s4.toFixed(2);
			}else{
				alert("** Grading can not be calculated for MTS now. It will be updated shortly' " );
/*				
				var a =  document.getElementById("number1").value;
				var b =  document.getElementById("number2").value;
				var c =  document.getElementById("number3").value;
				var d =  document.getElementById("number4").value;
				var e =  document.getElementById("number5").value;
				var f =  document.getElementById("number6").value;
				var g =  document.getElementById("number7").value;
				var h =  document.getElementById("number8").value;
				var i =  document.getElementById("number9").value;
				var j =  document.getElementById("number10").value;
				var k =  document.getElementById("number11").value;
				var l =  document.getElementById("number12").value;
				var m =  document.getElementById("number13").value;
				var n =  document.getElementById("number14").value;
				var o =  document.getElementById("number15").value;
				var p =  document.getElementById("number16").value;
				var q =  document.getElementById("number17").value;
				var s1 = ((((parseFloat(a) + parseFloat(b) + parseFloat(c) + parseFloat(d))/4)*0.4)*100)/100; 
				document.getElementById("screen1").innerHTML=s1.toFixed(2);
				var s2 = ((((parseFloat(e) + parseFloat(f) + parseFloat(g) + parseFloat(h) + parseFloat(i) + parseFloat(j) + parseFloat(k) + parseFloat(l))/8)*0.3)*100)/100; 
				document.getElementById("screen2").innerHTML=s2.toFixed(2);
				var s3 = ((((parseFloat(n) + parseFloat(o) + parseFloat(p) + parseFloat(q))/4)*0.3)*100)/100;
				document.getElementById("screen3").innerHTML=s3.toFixed(2);
				var s4 = (s1 + s2 + s3)*2; 
				document.getElementById("screen4").innerHTML=s4.toFixed(2);
*/
			}
		}else{
		alert("** Select Calculator for the staff 'MTS' or 'Staff other than MTS' " );
		}
  }
</script>
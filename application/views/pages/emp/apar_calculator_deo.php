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
						<li><a data-toggle="tab" href="#tab" onclick="aparOther()" >Other Staff</a></li>
						<li class="active"><a data-toggle="tab" href="#tab1" onclick="aparDEO()" >DEO</a></li>
						<li><a data-toggle="tab" href="#tab2" onclick="aparMTS()" >MTS</a></li>
					</ul>
				</div>	
				<div align = "center" >&nbsp;<div>
					<table border="1" style="width:100%">
						<thead>
							<tr style="text-align:center">
								<th style="text-align:center"><strong> Description</strong></th>
								<th style="text-align:center"><strong> Point Awarded (Scale 1-10)</strong></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="col_1">(I) Proficiency in typing (both speed and accuracy)</td>
								<td class="col_2" ><input type="text" id="number1" name="number1" onClick="this.setSelectionRange(0, this.value.length)" value="0" class="form-control" ></td>
							</tr>
							<tr>
								<td class="col_1">(II) Proficiency in the work assigned</td>
								<td class="col_2" ><input type="text" id="number2" name="number2" onClick="this.select();" value="0" class="form-control" ></td>
							</tr>
							<tr>
								<td class="col_1">(III) Promptness in Disposal of work</td>
								<td class="col_2" ><input type="text" id="number3" name="number3" onClick="this.select();" value="0" class="form-control" ></td>
							</tr>
							<tr>
								<td class="col_1"><strong>OVERALL GRADING ON WORK OUTPUT</strong></td>
								<td class="col_2" align = "center" ><span style = "display : block; height: 35px; padding-top: 7px">
									<strong><span id="screen1" class="form-contr"></span></strong>
								</span></td>
							</tr>
							<tr>
								<td class="col_1">(I) Attitude to work</td>
								<td class="col_2" ><input type="text" id="number4" name="number4" onClick="this.select();" value="0" class="form-control" ></td>
							</tr>
							<tr>
								<td class="col_1">(II) Sense of responsibility</td>
								<td class="col_2" ><input type="text" id="number5" name="number5" onClick="this.select();" value="0" class="form-control" ></td>
							</tr>
							<tr>
								<td class="col_1">(III) Maintenance of Discipline</td>
								<td class="col_2"><input type="text" id="number6" name="number6" onClick="this.select();" value="0" class="form-control" ></td>
							</tr>
							<tr>
								<td class="col_1">(IV) Communication Skills </td>
								<td class="col_2" ><input type="text" id="number7" name="number7" onClick="this.select();" value="0" class="form-control" ></td>
							</tr>
							<tr>
								<td class="col_1">(V) Capacity to work in team sprit</td>
								<td class="col_2" ><input type="text" id="number8" name="number8" onClick="this.select();"value="0" class="form-control" ></td>
							</tr>
							<tr>
								<td class="col_1">(VI) Capacity to adhere to time schedule</td>
								<td class="col_2" ><input type="text" id="number9" name="number9" onClick="this.select();" value="0" class="form-control" ></td>
							</tr>
							<tr>
								<td class="col_1">(VII) Inter- personal relations</td>
								<td class="col_2" ><input type="text" id="number10" name="number10" onClick="this.select();" value="0" class="form-control" ></td>
							</tr>
							<tr>
								<td class="col_1">(VIII) Overall bearing and personality</td>
								<td class="col_2" ><input type="text" id="number11" name="number11" onClick="this.select();" value="0" class="form-control" ></td>
							</tr>
							<tr>
								<td class="col_1"><strong>OVERALL GRADING ON PERSONAL ATTRIBUTES</strong></td>
								<td class="col_2" align = "center" ><span style = "display : block; height: 35px; padding-top: 7px">
									<strong><span id="screen2" class=""></span></strong>
								</span></td>
							</tr>
							<tr>
								<td class="col_1">(I) Standard of maintenance of diaries and other registers and returns</td>
								<td class="col_2" ><input type="text" id="number12" name="number12" onClick="this.select();" value="0" class="form-control" ></td>
							</tr>
							<tr>
								<td class="col_1">(II) Promptness in closing and submission of registers and returns</td>
								<td class="col_2" ><input type="text" id="number13" name="number13" onClick="this.select();" value="0" class="form-control" ></td>
							</tr>
							<tr>
								<td class="col_1">(III) General intelligence , keeness and interest to learn </td>
								<td class="col_2" ><input type="text" id="number14" name="number14" onClick="this.select();" value="0" class="form-control" ></td>
							</tr>
							<tr>
								<td class="col_1">(IV) Initiative </td>
								<td class="col_2" ><input type="text" id="number15" name="number15" onClick="this.select();" value="0" class="form-control" ></td>
							</tr>
							<tr>
								<td class="col_1"><strong>OVERALL GRADING ON FUNCTIONAL COMPETENCY</strong></td>
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
					<div align = "center" >&nbsp;</div>
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
$( document ).ready(function() {

});
function aparOther() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/apar_calculator/';
}

function aparDEO() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/apar_calculator_deo/';
}

function aparMTS() {
 // window.location.href = '<?php echo SITE_BASE_URL ?>emp/apar_calculator_mts/';
 alert("This calculator is not available.");
 window.location.href = '<?php echo SITE_BASE_URL ?>emp/apar_calculator/';
}

function submit1(){
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
	var s1 = ((((parseFloat(a) + parseFloat(b) + parseFloat(c))/3)*0.4)*100)/100; 
		var r1 = Math.round(s1*100)/100;
		document.getElementById("screen1").innerHTML=r1.toFixed(2);
	var s2 = ((((parseFloat(d) + parseFloat(e) + parseFloat(f) + parseFloat(g) + parseFloat(h) + parseFloat(i) + parseFloat(j) + parseFloat(k))/8)*0.3)*100)/100; 
		var r2 = Math.round(s2*100)/100;
		document.getElementById("screen2").innerHTML=r2.toFixed(2);
	var s3 = ((((parseFloat(l) + parseFloat(m) + parseFloat(n) + parseFloat(o))/4)*0.3)*100)/100;
		var r3 = Math.round(s3*100)/100; 
		document.getElementById("screen3").innerHTML=r3.toFixed(2);
	var s4 = r1 + r2 + r3;
		document.getElementById("screen4").innerHTML=s4.toFixed(2);
  }
</script>
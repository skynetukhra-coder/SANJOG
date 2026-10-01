<style>
input[type="radio"], input[type="checkbox"]{
	margin:0;
}
</style>
<?php
$feed_date = isset($row['feed_date']) ? $row['feed_date'] : date('d-m-Y');
$name = isset($row['name']) ? $row['name'] : '';
$mobile = isset($row['mobile']) ? $row['mobile'] : '';
$email = isset($row['email']) ? $row['email'] : '';
$office = isset($row['office']) ? $row['office'] : '';
$visit_for = isset($row['visit_for']) ? $row['visit_for'] : '';
$gpf_no = isset($row['gpf_no']) ? $row['gpf_no'] : '';
$ppo_no_file_id_application_no = isset($row['ppo_no_file_id_application_no']) ? $row['ppo_no_file_id_application_no'] : '';
$details = isset($row['details']) ? $row['details'] : '';
$eoffice_rpt_no = isset($row['eoffice_rpt_no']) ? $row['eoffice_rpt_no'] : '';
$eoffice_file_no = isset($row['eoffice_file_no']) ? $row['eoffice_file_no'] : '';
$eoffice_rpt_dt = isset($row['eoffice_rpt_dt']) ? $row['eoffice_rpt_dt'] : '';
$section = isset($row['section']) ? $row['section'] : '';
$charge = isset($row['charge']) ? $row['charge'] : '';
$pagsec_no = isset($row['pagsec_no']) ? $row['pagsec_no'] : '';
$pagsec_dt = isset($row['pagsec_dt']) ? $row['pagsec_dt'] : '';
$dagsec_no = isset($row['dagsec_no']) ? $row['dagsec_no'] : '';
$dagsec_dt = isset($row['dagsec_dt']) ? $row['dagsec_dt'] : '';

$Date = date('d-m-Y');
?>

<div class="row-fluid">
  <div class="block">
    <div class="navbar navbar-inner block-header">
      <div align = "center" class="muted"><?php echo $this->uri->segment(4) > 0 ? 'Edit' : 'Add' ?> Grievance Record</div>
    </div>
    <div class="block-content collapse in">
      <div class="span12">
        <form id="form_sample_1" method="post" class="form-horizontal">
			<fieldset>
		  		<div align = "center" class="col-sm-12">
					<table class="table" border="1" style="width:80%">
						<thead>
							<tr style="text-align:center">
								<th style="text-align:center; width:20%;"><strong>Description</strong></th>
								<th style="text-align:center; width:30%;"><strong>Information</strong></th>
								<th style="text-align:center; width:20%;"><strong>Description</strong></th>
								<th style="text-align:center; width:30%;"><strong>Information</strong></th>
							</tr>
						</thead>
							<tbody>
									<tr>
										<td class="col_1" >Grievance Date</td>
										<td class="col_2"><input style = "width: 95%;padding: 4px 4px;" type="text" id="feed_date" name="feed_date" value="<?php echo get_datepicker_date($feed_date) ?>" class="form-control datepicker" required></td>
										<td class="col_1">Name</td>
										<td class="col_2"><input style = "width: 95%;padding: 4px 4px;" type="text" id="name" name="name" value="<?php echo $name ?>" class="form-control" required ></td>
									</tr>
									<tr>
										<td class="col_1">Visit For </td>
										<td class="col_2">
											<select style = "width: 95%;" id="visit_for" name="visit_for" onchange="filterSectionsByGroup(this.value);" class="form-control" required>
												<option data-value="0" value="">--Select--</option>
												<option data-value="1" value="General"> General</option>
												<option data-value="2" value="Administrative"> Administrative</option>
												<option data-value="3" value="Accounts"> Accounts</option>
												<option data-value="4" value="Provident Fund"> Provident Fund</option>
												<option data-value="5" value="Pension"> Pension</option>
											</select>
										</td>
										<td class="col_1">Mobile No</td>
										<td class="col_2"><input style = "width: 95%;padding: 4px 4px;" type="text" id="mobile" name="mobile" value="<?php echo $mobile ?>" class="form-control" ></td>
									</tr>
									<tr>
										<td class="col_1">Office Name</td>
										<td class="col_2"><input style = "width: 95%;padding: 4px 4px;" type="text" id="office" name="office" value="<?php echo $office ?>" class="form-control" ></td>
										<td class="col_1">Email ID</td>
										<td class="col_2"><input style = "width: 95%;padding: 4px 4px;" type="text" id="email" name="email" value="<?php echo $email ?>" class="form-control" ></td>
									</tr>
									<tr>
										<td class="col_1">GPF No</td>
										<td class="col_2"><input style = "width: 95%;padding: 4px 4px;" type="text" id="gpf_no" name="gpf_no" value="<?php echo $gpf_no ?>" class="form-control" ></td>
										<td class="col_1">E-Office File No</td>
										<td class="col_2"><input style = "width: 95%;padding: 4px 4px;" type="text" id="eoffice_file_no" name="eoffice_file_no" value="<?php echo $eoffice_file_no ?>" class="form-control" required ></td>
									</tr>
									<tr>
										<td class="col_1">Pension Application No / File ID</td>
										<td class="col_2"><input style = "width: 95%;padding: 4px 4px;" type="text" id="ppo_no_file_id_application_no" name="ppo_no_file_id_application_no" value="<?php echo $ppo_no_file_id_application_no ?>" class="form-control" ></td>
										<td class="col_1">E-Office Receipt No</td>
										<td class="col_2"><input style = "width: 95%;padding: 4px 4px;" type="text" id="eoffice_rpt_no" name="eoffice_rpt_no" value="<?php echo $eoffice_rpt_no ?>" class="form-control" required ></td>
									</tr>
									<tr>
										<td class="col_1">Category</td>
										<td class="col_2">
											<select style = "width: 95%;" id="griv_cat" name="griv_cat" onchange = "DueDate();" class="form-control" required>
												<option data-value="0" value="">--Select--</option>
												<option data-value="1" value="a">General Grivance</option>
												<option data-value="2" value="b">Administrative Grivance</option>
												<option data-value="3" value="c">Original Pension Case </option>
												<option data-value="4" value="d">Revision Pension Case</option>
												<option data-value="5" value="e">GPF Final Payment Case</option>
												<option data-value="6" value="f">Grivance On Accounts</option>
												<option data-value="7" value="g">Others</option>
											</select>
										</td>
										<td class="col_1">E-Office Receipt Date </td>
										<td class="col_2"><input style = "width: 95%;padding: 4px 4px;" type="text" id="eoffice_rpt_dt" name="eoffice_rpt_dt" value="<?php echo get_datepicker_date($eoffice_rpt_dt)?>" class="form-control datepicker" required></td>
									</tr>
									<tr>
										<td class="col_1">Section concerned</td>
										<td class="col_2">
											<select id="section" name="section" class = "form-control" >
												<option value="">--Select--</option>
												<?php
												if(isset($section_list) && !empty($section_list)){
													foreach($section_list as $sections){
														echo '<option value="'.$sections['section'].'">'.$sections['section'].'</option>';
													}
												}
												?>
											</select>
										</td>
										<td class="col_1">Charge / Seat</td>
										<td class="col_2"><input style = "width: 95%;padding: 4px 4px;" type="text" id="charge" name="charge" value="<?php echo $charge ?>" class="form-control "  ></td>
									</tr>
									<tr>
										<td class="col_1">Pr. AG's Sect No</td>
										<td class="col_2"><input style = "width: 95%;padding: 4px 4px;" type="text" id="pagsec_no" name="pagsec_no" value="<?php echo $pagsec_no ?>" class="form-control" ></td>
										<td class="col_1">Pr. AG's Sect Date</td>
										<td class="col_2"><input style = "width: 95%;padding: 4px 4px;" type="text" id="pagsec_dt" name="pagsec_dt" value="<?php echo $pagsec_dt ?>" class="form-control datepicker"  ></td>
									</tr>
									<tr>
										<td class="col_1">DAG's Sect No</td>
										<td class="col_2"><input style = "width: 95%;padding: 4px 4px;" type="text" id="dagsec_no" name="dagsec_no" value="<?php echo $dagsec_no ?>" class="form-control" ></td>
										<td class="col_1">DAG's Sect Date</td>
										<td class="col_2"><input style = "width: 95%;padding: 4px 4px;" type="text" id="dagsec_dt" name="dagsec_dt" value="<?php echo $dagsec_dt ?>" class="form-control datepicker"  ></td>
									</tr>
									<tr>
										<td class="col_1">Description</td>
										<td class="col_2"><textarea style = "width: 95%;padding: 4px 4px;" id="details" type = "text" name="details" align="center" rows="4" cols="50" required ><?php echo $details ?></textarea ></td>									
										<td class="col_1">Due Date</td>
										<td class="col_2"><input style = "width: 95%;padding: 4px 4px;" type="text" id="due_date" name="due_date" value="<?php echo date('d-m-Y', strtotime($Date. ' + 7 days')) ?>" class="form-control" readonly ></td>									
									</tr>
							</tbody>
					</table>
					<div>
						<button type="submit" class="btn btn-primary"><?php echo $this->uri->segment(4) > 0 ? 'Update' : 'Submit' ?></button>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<button type="button" class="btn btn-success" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>grievance/feedback_griev'">Cancel</button>
					</div>
				</div>
				<div>
					<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
				</div>
				<div>&nbsp;</div>
				<div>&nbsp;</div>
          </fieldset>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function(){
	$('.datepicker').datepicker({dateFormat:'dd-mm-yy'});
	var d = new Date();
//	document.getElementById('due_date').value = d;
});
function browse(){
	$('#attachment').click();
}
function previewImage(file_obj,container_id){
	 if (file_obj.files && file_obj.files[0]) {
		var url = file_obj.value;
		var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
		var filename =  url.substring(url.lastIndexOf('/') + 1);
		filename =  filename.substring(filename.lastIndexOf('\\') + 1);
		if(ext == 'jpg' || ext == 'jpeg' || ext == 'png'){
			var reader = new FileReader();
			reader.onload = function(e){
				$('#' + container_id).html('<img src="" style="max-height:150px; max-width:150px; margin:5px; border:1px solid gray;">');
				$('#' + container_id + ' img').attr('src', e.target.result);
			};
			reader.readAsDataURL(file_obj.files[0]);
		}else{
			$('#'+container_id).html('<em>&nbsp;&nbsp;' + filename + '</em>');
		}
	}
}

function DueDate(){
	var griv_cat = document.getElementById('griv_cat').value;
	var vdate = new Date();
		 vy = vdate.getFullYear(); 
		 vm = ''+(vdate.getMonth()+1);
		 vd = ''+vdate.getDate();

		if (vm.length < 2){
			vm ='0' + vm;
		}
		if (vd.length < 2){
			vd ='0'+ vd;
		}
		
		var to_day = vd+"-"+vm+"-"+vy;
		
			y = vdate.getFullYear();
			m = ''+(vdate.getMonth());
			
		if (griv_cat == 'a' ){
			d = ''+(vdate.getDate()+10);
		}
//		else{
//			document.getElementById('due_date').value = to_day;		
//		}
		if (griv_cat == 'b' ){
			d = ''+(vdate.getDate()+15);
		}
		if (griv_cat == 'c' ){
			d = ''+(vdate.getDate()+20);
		}
		if (griv_cat == 'd' ){
			d = ''+(vdate.getDate()+25);
		}
		if (griv_cat == 'e' ){
			d = ''+(vdate.getDate()+30);
		}
		if (griv_cat == 'f' ){
			d = ''+(vdate.getDate()+40);
		}
		if (griv_cat == 'g' ){
			d = ''+(vdate.getDate()+45);
		}
		
		var date_due = new Date(y,m,d);
		 dt_y = date_due.getFullYear(); 
		 dt_m = ''+(date_due.getMonth()+1);
		 dt_d = ''+date_due.getDate();
		 if (dt_m.length < 2){
				dt_m ='0' + dt_m;
			}
		if (dt_d.length < 2){
			dt_d ='0'+ dt_d;
		}	
		var due_dt = dt_d+"-"+dt_m+"-"+dt_y;
			document.getElementById('due_date').value = due_dt;
		
}


</script>
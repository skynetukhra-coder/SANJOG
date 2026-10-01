<style>
.table1 td{text-align:center;
	font-size:13px;
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
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('employee'); ?> &raquo; <?php echo $this->lang->line('leave_for_recommendati'); ?> EMDs and BGs</div>
			<div class="login-box">
				<h4><strong><?php echo $this->lang->line('leave_for_recommendati'); ?>Hardware Inventory</strong></h4>
				<div class="col-md-4 col-sm-12" style = " float: right; text-align:center; font-size: 14px">
					<button type="button" class="btn-warning btn-xm" onclick="HWInv()" style="padding-top: 5px">Inventory</button>
					<button type="button" class="btn-primary btn-xm" onclick="EmdbgAdd()" style="padding-top: 5px">Add Comp</button>
					<button type="button" class="btn-success btn-xm" onclick="EmdbgReg()" style="padding-top: 5px">Out Entry</button>
				</div>
				<hr />
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
					<form method="get">
							<div class="filter-form1">
									<div class="form-group row">
										<div class="col-sm-4">
											 <label class="name-label">Purchase From :</label>
											<input type="text" id="date_from" name="date_from" value="<?php echo $this->input->get('date_from',true)?>" class="form-control" placeholder = "dd-mm-yyyy"/>
										</div>
										<div class="col-sm-4">
											 <label class="name-label">Purchase To :</label>
											<input type="text" id="date_to" name="date_to" value="<?php echo $this->input->get('date_to',true)?>" class="form-control" placeholder = "dd-mm-yyyy"/>
										</div>
										<div class="col-sm-4">
										 <label class="name-label">Type :</label>
										    <select  id="type" name="type" class="form-control" >
												<option data-value="0" value=""> ---- Select Type----</option>
												<option data-value="1" value="LAPTOP" >LAPTOP</option>
												<option data-value="2" value="DESKTOP" >DESKTOP</option>
												<option data-value="3" value="MONITOR" >MONITOR</option>
												<option data-value="4" value="PRINTER" >PRINTER</option>
												<option data-value="5" value="PROJECTOR" >PROJECTOR</option>
												<option data-value="6" value="SCANNER" >SCANNER</option>
												<option data-value="7" value="SERVER" >SERVER</option>
												<option data-value="7" value="UPS" >UPS</option>
											</select>
										</div>
										<div class="col-sm-4">
										 <label class="name-label">Search :</label>
										  <input type="text" id="search" name="search" value="<?php echo $this->input->get('search',true)?>" class="form-control" Placeholder ="Machine No ..." />
										</div>
										<div class="col-sm-4">
										 <label class="name-label">Section :</label>
											<select  id="placed" name="placed" class="form-control" onchange = "SelectVnd()">
												<option value="">--- Select Section ---</option>
												<?php
													if(isset($locations)){
														foreach($locations as $location){
															echo '<option value="'.$location['placed'].'">'.$location['placed'].'</option>';
														}
													}
													
												?>
											</select>
										</div>
										<div class="col-sm-2"><input type="submit" class="submit-btn" value="<?php echo $this->lang->line('search'); ?>" /></div>
										<div class="col-sm-2"><input type="button" onclick = "PrintGo('<?php $this->input->get('vendor', true) ?>')" class="submit-btn btn-success" value="Print" style = "padding-left: 0px"/></div>
									</div>
								</div>
						</form>
					<table class="table1" border="1" style="width:100%">
						<thead>
							<tr style="text-align:center">
								<th style="text-align:center">SL No</th>
								<th style="text-align:center">Type / Sub-Type</th>
								<th style="text-align:center">Cagetory / Make</th>
								<th style="text-align:center">Unique ID/ Online ID</th>
								<th style="text-align:center">Purchase Dt</th>
								<th style="text-align:center">Specifications</th>
								<th style="text-align:center">Status</th>
								<th style="text-align:center">Location</th>
								<th style="text-align:center">Issue Dt</th>
<!--								<th style="text-align:center">Action</th>		-->
							</tr>
						</thead>
						<tbody>
							<?php
								if(!empty($results)){
									$sl = intval($this->input->get('per_page',true)) + 1;
									foreach($results as $record){
							?>
										<tr>
                                    <td><?php echo $sl++ ?></td>
                                    <td>Type: <?php echo $record['type'] ?><br>Sub-type: <?php echo $record['sub_type'] ?></br></td>
									<td>Categaroy: <?php echo $record['categaroy'] ?><br>Make: <?php echo $record['make'] ?></br></td>
                                    <td><?php echo $record['office_code'] ?><br><?php echo $record['unique_id_no'] ?></br><br>Online ID: <?php echo $record['id'] ?></br></td>
									<td><?php echo get_datepicker_date($record['date_of_purchase'])?></td>
                                    <td>processor: <?php echo $record['processor'] ?><br>RAM: <?php echo $record['ram'] ?><br>HDD: <?php echo $record['hdd'] ?></br></td>
									<td>Working: <?php echo $record['working']?><br>AMC: <?php echo $record['amc']?></br></td>
									<td>Group: <?php echo $record['purpose'] ?><br>Type: <?php echo $record['sec_store'] ?><br>Section: <?php echo $record['placed'] ?></br></td>
                                    <td><?php echo get_datepicker_date($record['date_of_issue'])?></td>
<!--
									<td><button class="btn btn-mini btn-primary"
                                            onclick="goEdit('<?php echo $record['hwitem_id'] ?>')"><i
                                            class="icon-pencil icon-white"></i>Update</button></td>
                                </tr>
-->
								<?php	}
								}else{
									echo '<tr><td colspan="9">No records found!</td></tr>';
								}
							?>
						</tbody>
					</table>
			</div>
			<div class="pagination"><?php echo $this->pagination->create_links();?></div>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?php echo SITE_BASE_URL?>assets/js/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('.datepicker').datepicker({dateFormat:'dd-mm-yy'});
});
function goEdit(id, type) {
    if (id != undefined) {
        window.location.href = '<?php echo SITE_BASE_URL ?>emp/hardware_ser_edit/' + id;
    }
}
function EmdbgAdd() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/hardware_compl_add/';
}
function EmdbgReg() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/hardware_out_add/';
}
function PrintGo(vnd, type) {
  var vnd = document.getElementById("vendor").value;
  if (vnd > 0) {
	window.location.href = '<?php echo SITE_BASE_URL ?>emp/hardware_pdf/' + vnd;
  }else{
	alert ('Vendor not selected');
	window.location.href = '<?php echo SITE_BASE_URL ?>emp/hardware_ser/';
  }
}

/*
 function edit_btn(leave_st,edit) 
{
    if (leave_st.value == "draft") 
    {
        document.getElementById("edit").disabled = false;		
    }
    else 
    {       
		document.getElementById("edit").disabled = true;
    }	
*/	
	
</script>
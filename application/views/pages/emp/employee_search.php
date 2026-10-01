<style>
.table1 td{
	text-align:left;
	font-size:11px;
}
</style>
<?php 
$empid = isset($emp_data['empid']) ? $emp_data['empid']: '1';
$level_pay = isset($emp_data['level_pay']) ? $emp_data['level_pay']: '1';
$desig = isset($emp_data['desig']) ? $emp_data['desig']: '1';
$section = isset($emp_data['section']) ? $emp_data['section']: '1';
?>
<div class="row">
	<div class="col-md-3 col-sm-4">
		<div class="left-panel">
			<?php $this->load->view('layout/emp_left_panel',$header);?>
		</div>
	</div>
	<div class="col-md-9 col-sm-8">
		<div class="right-panel">
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('employee'); ?> &raquo; <?php echo $this->lang->line('circular_office_'); ?> Search Employee</div>
			<div class="login-box">
				<div>
					<div class="col-md-4 col-sm-12" align= "right" style="padding-top: 15px; float: right">
						<button type="button" class="btn-primary btn-xm" onclick="myFunction()" style="padding-top: 5px"> BACK </button>
					</div>
				</div>
				<div class="new-cont medium whats-new">
						<ul class="nav nav-tabs " style="background-color: ">
							<li class="active" ><a data-toggle="tab" href="#tab" onclick="allEmp()" >Employees</a></li>
							<li><a data-toggle="tab" href="#tab1" onclick="mySearch()" >Sections</a></li>
						</ul>
				</div>
				<div>&nbsp;</div>
				<h4><strong><?php echo $this->lang->line('circular_of'); ?>  </strong></h4>
						<form method="get">
							<div class="filter-form1">
									<div class="form-group row">
										<div class="col-sm-8">
										 <label class="name-label"><?php echo $this->lang->line('search'); ?> :</label>
										  <input type="text" id="" name="search" value="<?php echo $this->input->get('search',true)?>" class="form-control" placeholder="Name / Designation / Resgistered Mobile No / NIC email ID / Section">
										</div>
										
										<div class="col-sm-4"><input type="submit" class="submit-btn" value="<?php echo $this->lang->line('search'); ?>" /></div>
									</div>
								</div>
						</form>
					
					<table class="table1" border="1" style="width:100%">
						<thead>
							<tr style="text-align:center">
								<th style="text-align:center">Sl No</th>
								<th style="text-align:center">Picture</th>
								<th style="text-align:center">Name / PAN No</th>
								<th style="text-align:center">Designation</th>
								<th style="text-align:center">Section</th>
								<th style="text-align:center">Contact Details</th>
								
							</tr>
						</thead>
						<tbody>
							<?php
							if(!empty($results)){?>		
										<?php
										$sl = intval($this->input->get('per_page',true)) + 1;
											foreach($results as $row){?>
												<tr>
													<td><?php echo $sl++ ?></td>
													<td>
														<span>
															<?php if($row['picture']!==''){ ?>
																<span><img width="80" height="80" src="https://agwb.cag.gov.in/files/agae/picture/<?php echo $row['picture']?>" alt=""></span>
																<?php }else{ 
																		if($row['gender']=='MALE'){ ?>
																			<span><img width="80" height="80" src="<?php echo SITE_BASE_URL?>assets/images/dummy-profile-pic-male.jpg" alt=""></span>
																		<?php }else{ ?>
																			<span><img width="80" height="80" src="<?php echo SITE_BASE_URL?>assets/images/dummy-female.png" alt=""></span>
																		<?php } 
																} ?>
														</span>
													</td>
													<td style = "text-align: center"><?php echo $row['empname']?><?php //echo $row['empid']?></td>
													<td><?php echo $row['desig'] ?></td>
													<td><?php echo $row['section'] ?></td>
													<td><?php if ($row['desig'] == "PR. ACCOUNTANT GENERAL" || $row['desig'] == "ACCOUNTANT GENERAL"  || $row['desig'] == "SR.DY. ACCOUNTANT GENERAL" || $row['desig'] == "DY. ACCOUNTANT GENERAL"){ echo '' ; } else{echo $row['mbno'];} ?>
													
													<br><?php echo $row['nicmail'] ?></br><br> <?php echo $row['email'] ?></br></td>
													
												</tr>
										<?php		
											}
										?>
							<?php
							}else{?>
							<tr>
								<td colspan="6">No data found!</td>
							</tr>
						<?php
							}?>
							</tbody>
					</table>
			</div>
			<div class="pagination"><?php echo $this->pagination->create_links();?></div>
		</div>
	</div>
</div>

<script type="text/javascript" src="<?php echo SITE_BASE_URL?>assets/js/jquery.min.js"></script>
<script>
$(document).ready(function(){
	$('.datepicker').datepicker({dateFormat:'dd-mm-yy'});
});
function allEmp() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/employee_search/';
}
function mySearch() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/hierarchy_search_emp/';
}
function mySections(id, type) {
    if (id != undefined) {
		window.location.href = '<?php echo SITE_BASE_URL ?>emp/hierarchy_bo_sections/' + id;
    }
}
function myFunction() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/notice_board/';
}
</script>
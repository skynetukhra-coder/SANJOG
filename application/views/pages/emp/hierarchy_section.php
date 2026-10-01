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
							<li><a data-toggle="tab" href="#tab" onclick="myBO()" >Branch Officer</a></li>
							<li><a data-toggle="tab" href="#tab1" onclick="myAAO()" >Section Incharge</a></li>
							<li class="active"><a data-toggle="tab" href="#tab2" onclick="mySECTION()" >Sectional Staff</a></li>
							<li><a data-toggle="tab" href="#tab1" onclick="mySearch()" >&nbsp;&nbsp;&nbsp;   Search   &nbsp;&nbsp;&nbsp;</a></li>
						</ul>
					</div>
				<div>&nbsp;</div>
			<h4><strong><?php echo $this->lang->line('circular_office_orde'); ?> Sectional Staff </strong>
				<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
				</h4>
				<hr class = "rounded"/>
					
					<table class="table1" border="1" style="width:100%">
						<thead>
							<tr style="text-align:center">
								<th style="text-align:center">Sl No</th>
								<th style="text-align:center">Picture</th>
								<th style="text-align:center">Name</th>
								<th style="text-align:center">Desig</th>
								<th style="text-align:center">Contact Details</th>
								<th style="text-align:center">Charge</th>
							</tr>
						</thead>
						<tbody>
							<?php
								if(!empty($staff)){
									$sl = intval($this->input->get('per_page',true)) + 1;
									
									foreach($staff as $row){
										?>
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
													<td style = "text-align: center"><?php echo $row['empname']?></td>
													<td><?php echo $row['desig'] ?></td>
													<td><?php echo $row['mbno'] ?><br><?php echo $row['nicmail'] ?> </br><br> <?php echo $row['email'] ?></br></td>
													<td style = "text-align: center">
													<button id ="charge" class="btn-mini btn-success" 
													onclick="myChrge('<?php echo $row['empid'] ?>')" style="display:inline-block; padding:2px; margin:2px; width:auto"><i 
													class="icon-pencil icon-white"></i>View</button>
													</td>
											</tr>
								<?php	}
								}else{
									echo '<tr><td colspan="6">No records found!</td></tr>';
								}
							?>
						</tbody>
					</table>
					<div>&nbsp;</div>
					<div>
						<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
					</div>
			  </div>
			</div>
		</div>
</div>

<script type="text/javascript" src="<?php echo SITE_BASE_URL?>assets/js/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('.datepicker').datepicker({dateFormat:'dd-mm-yy'});
});
function myBO() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/hierarchy/';
}

function myAAO() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/hierarchy_incharge/';
}

function mySECTION() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/hierarchy_section/';
}
function mySearch() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/hierarchy_search_all/';
}
function myChrge(id, type) {
    if (id != undefined) {
		window.location.href = '<?php echo SITE_BASE_URL ?>emp/employee_charge_details/' + id;
    }
}

</script>



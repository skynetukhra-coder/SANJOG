<style>
.table1 td{
	text-align:left;
	font-size:11px;
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
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('employee'); ?> &raquo; <?php echo $this->lang->line('circular_office_'); ?> Search Employee</div>
			<div class="login-box">
				<h4><strong><?php echo $this->lang->line('circular_office_orde'); ?> View Charge Allotment</strong>
				<hr/>
						<form method="get">
							<div class="filter-form1">
									<div class="form-group row">
										<div class="col-sm-8">
										 <label class="name-label"><?php echo $this->lang->line('search'); ?> :</label>
										  <input type="text" id="" name="search" value="<?php echo $this->input->get('search',true)?>" class="form-control" placeholder="Search by Name ; Search by PAN for section list">
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
								<th style="text-align:center">Section [Charge]</th>
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
													<td style = "text-align: center"><?php echo $row['empname']?><br><?php echo $row['empid']?><br></td>
													<td><?php echo $row['desig'] ?></td>
													<td> <?php
													if(!empty($emp_sections)){
														foreach($emp_sections as $sec){
														 echo $sec['section_desc'].' [ '.  $sec['charge_type'].'] <br>' ;
														}
													}?>
													
													</td>
													<td><?php echo $row['mbno'] ?><br><?php echo $row['nicmail'] ?> </br></br></td>
													
												</tr>
										<?php		
											}
										?>
							<?php
							}else{?>
							<tr>
								<td colspan="6">Search for Employee's charge</td>
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


</script>
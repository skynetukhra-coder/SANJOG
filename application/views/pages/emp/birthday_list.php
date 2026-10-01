<style>
.table1 td{
	text-align:left;
	font-size:11px;
}
</style>
<?php
$d = new DateTime(); 
//echo get_datepicker_date($d->format('Y-m-t' ));

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
			<div class="login-box">
					<div>
						<div class="col-md-4 col-sm-12" align= "right" style="padding-top: 15px; float: right">
							<button type="button" class="btn-primary btn-xm" onclick="myFunction()" style="padding-top: 5px"> BACK </button>
							<?php if(!empty($check_sms)){ ?>	
								<img width="30px" height="30px" style="padding-bottom: 5px" title="SMS SENT" src="<?php echo base_url()?>assets/images/ok_mark.png" alt=""  />
							<?php }else{
								if($empid == 'AUMPB6168Q' || $empid == 'ASPPG2056D' || $empid == 'CJAPM2653Q' || $empid == 'ASGPG7501A'){ ?>	
								<button type="button" class="btn-warning btn-xm" onclick="SendSMS()" style="padding-top: 5px"> Send SMS</button>
							<?php }
							} ?>	
						</div>
					</div>
					<div align = "center" style ="background-color:  ; font-weight: bold; font-size: 20px; letter-spacing:6px; color: #fff" >&nbsp;</div>							
					<div class = "row " >
				<h4><strong><?php echo $this->lang->line('circular_office_orde'); ?> </strong></h4>
				<hr/>
					<div style="width:100%; height:150px;">
						<img width="100%" height="150" src="<?php echo base_url()?>assets/images/notice_header.jpg" alt="not_loaded.png">
					</div>	
					<div align = "center" style ="background-color:  #275e93; font-weight: bold; font-size: 3px; letter-spacing:3px; color: #fff" >&nbsp;</div>
					<div style="width:100%; height:300px;">
						<img width="100%" height="300" src="<?php echo base_url()?>assets/images/happy-birthday.jpg" alt="not_loaded.png">
					</div>	
					<div align = "center" style ="background-color:  #275e93; font-weight: bold; font-size: 22px; letter-spacing:1.5px; color: #fff" >Birth Day on <?php echo ($d->format('d-M')); ?>.</div>  
					<table class="table1" border="1" style="width:100%">
						<thead>
							<tr style="text-align:center">
								<th style="text-align:center">Sl No</th>
								<th style="text-align:center">Picture</th>
								<th style="text-align:center">Name </th>
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
													<td style = "text-align: center"><?php echo $row['empname']?></td>
													<td><?php echo $row['desig'] ?></td>
													<td><?php echo $row['section'] ?></td>
													<td><?php echo $row['mbno'] ?><br> <?php //echo $row['email'] ?></br></td>
													
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

<script>
function myFunction() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/notice_board/';
}
function SendSMS() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/BirthDaySMS/';
}
</script>
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
			<div class="login-box">
					<div>
						<div class="col-md-1 col-sm-12" align= "center" style="padding-top: 15px; float: right">
							<button type="button" class="btn-primary btn-xm" onclick="myFunction()" style="padding-top: 5px"> BACK </button>
						</div>
					</div>
					<div align = "center" style ="background-color:  ; font-weight: bold; font-size: 20px; letter-spacing:6px; color: #fff" >&nbsp;</div>							
					<div class = "row " >
				<h4><strong><?php echo $this->lang->line('circular_office_orde'); ?></strong></h4>
				<hr/>
					<div style="width:100%; height:150px;">
						<img width="100%" height="150" src="<?php echo base_url()?>assets/images/notice_header.jpg" alt="not_loaded.png">
					</div>	
					<div align = "center" style ="background-color:  #275e93; font-weight: bold; font-size: 3px; letter-spacing:3px; color: #fff" >&nbsp;</div>
					<div style="width:100%; height:300px;">
						<img width="100%" height="300" src="<?php echo base_url()?>assets/images/promotion.jpg" alt="not_loaded.png">
					</div>	
					<div align = "center" style ="background-color:  #275e93; font-weight: bold; font-size: 22px; letter-spacing:1.5px; color: #fff" >Transfer (In last one months)</div>  
					<table class="table1" border="1" style="width:100%">
						<thead>
							<tr style="text-align:center">
								<th style="text-align:center">Sl No</th>
								<th style="text-align:center">Picture</th>
								<th style="text-align:center">Name </th>
								<th style="text-align:center">Transfer To</th>
								<th style="text-align:center">Transfer From </th>
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
													<td style = "text-align: center" ><?php echo $row['empname']?></td>
													<td style = "text-align: center" ><?php echo $row['section'] ?><br> Order Date: <?php echo get_datepicker_date($row['trans_order_dt']) ?></br> </td>
													<td style = "text-align: center"><?php echo $row['trans_from'] ?></td>
													<td><?php //echo $row['mbno'] ?><?php echo $row['nicmail'] ?><br> <?php echo $row['email'] ?></br></td>
													
												</tr>
										<?php		
											}
										?>
							<?php
							}else{?>
							<tr>
								<td colspan="6">No new transfer during the last one months!</td>
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
</script>
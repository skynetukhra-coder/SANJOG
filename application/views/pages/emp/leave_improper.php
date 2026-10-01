<style>
.table1 td{text-align:center}
</style>
<div class="row">
	<div class="col-md-3 col-sm-4">
		<div class="left-panel">
			<?php $this->load->view('layout/emp_left_panel',$header);?>
		</div>
	</div>
	<div class="col-md-9 col-sm-8">
		<div class="right-panel">
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('employee'); ?> &raquo;<?php echo $this->lang->line('my_documents'); ?> </div>
			<div class="muted pull-left" style = "color: #513c96; font-size:18px;">
			<marquee direction="left"  onMouseOver="this.stop()" onMouseOut="this.start()">
			If your Leave Recommending Authority, in cases where it is required, or Leave Sanctioning Authority is blank, you have not selected Leave Recommending Authority or Leave Sanctioning Authority properly. Edit the leave and select the Radio Button against your Leave Recommending Authority or Leave Sanctioning Authority. Check all other information and submit it. Updating of information in "My Information" page is important before application of leave !!! 
			</marquee>
		</div>
			<div class="login-box">
				<h4><strong><?php echo $this->lang->line('my_docum'); ?>List of Leaves required Re-submission</strong></h4>
				<hr />


					<table class="table1" border="1" style="width:100%">
						<thead>
							<tr style="text-align:center">
								<th style="text-align:center">Sl No</th>
								<th style="text-align:center">Application_Date</th>
								<th style="text-align:center">Leave Type</th>
								<th style="text-align:center">Leave Period / No of Days</th>
								<th style="text-align:center">Recommending Authority</th>
								<th style="text-align:center">Sanctioning Authority</th>
								<th style="text-align:center">Status</th>
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
													<td><?php echo get_datepicker_date($row['application_dt'])?></td>
													<td><?php echo $row['leave_type'] ?></td>
													<td><?php echo get_datepicker_date($row['leave_from']) ?> - <?php echo get_datepicker_date($row['leave_to']) ?><br>[ <?php echo $row['leave_day_no'] ?> Days ]</br></td>
													<td><?php echo $row['recom_autho'] ?><br><?php echo $row['recom_autho_desig'] ?></br></td>
													<td><?php echo $row['sanction_autho'] ?><br><?php echo $row['sanction_autho_desig'] ?></td>
													<td><?php echo $row['leave_status'] ?></td>
												</tr>
										<?php		
											}
										?>
							<?php
							}else{?>
							<tr>
								<td colspan="7">No data found!</td>
							</tr>
						<?php
							}?>
							</tbody>
					</table>
			</div>
		</div>
	</div>
</div>

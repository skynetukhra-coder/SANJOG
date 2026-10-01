<style>
.table1 th{text-align:center;
}
.table1 td{text-align:center;
}
button{ background-color:#6FF88E; text-align: center; font-size:14px;}
button:hover{ background-color: #48BBF9; }
</style>

<div class="row">
	<div class="col-md-3 col-sm-4">
		<div class="left-panel">
			<?php $this->load->view('layout/treasury_left_panel',$header);?>
		</div>
	</div>
	<div class="col-md-9 col-sm-8">
		<div class="right-panel">
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('treasury'); ?>&raquo; <?php echo $this->lang->line('status_it_paras'); ?> </div>
			<div class="login-box">
				<h4><strong><?php echo $this->lang->line('status_it_paras'); ?></strong></h4>
				<hr/>
						<form method="get">
							<div class="filter-form1">
									<div class="form-group row">
										<div class="col-sm-3">
											 <label class="name-label"><?php echo $this->lang->line('month'); ?> :</label>
											<select class="form-control" name="para_month" >
												<option value="">-----Select Month----</option>
												<option value="1" >January</option>
												<option value="2" >February</option>
												<option value="3"  >March</option>
												<option value="4"  >April</option>
												<option value="5"  >May</option>
												<option value="6" >June</option>
												<option value="7" >July</option>
												<option value="8"  >August</option>
												<option value="9"  >September</option>
												<option value="10"  >October</option>
												<option value="11" >November</option>
												<option value="12" >December</option>
												<option value="13" >Supply A/c</option>
											  </select>
										</div>
										<div class="col-sm-3">
											<label class="name-label"><?php echo $this->lang->line('year'); ?>:</label>
											<select name="para_year" class="form-control" >
													<option value="">-- <?php echo $this->lang->line('select_year'); ?> --</option>
													<?php
													for($i = date('Y'); $i >= 2019; $i--){
														echo '<option value="'.$i.'" '.($this->input->get('para_year',true) == $i ? 'selected': '').' >'.$i.'</option>';
													}?>
											</select>
										</div>
										<div class="col-sm-3">
											<label class="name-label"><?php echo $this->lang->line('yea'); ?>Status:</label>
											<select name="para_status" class="form-control" >
												<option value="">-----Select Status----</option>
												<option value="Pending" >Pending</option>
												<option value="Settled" >Settled</option>
											</select>
										</div>
										<div class="col-sm-3"><input type="submit" class="submit-btn" value="<?php echo $this->lang->line('search'); ?>" /></div>
									</div>
								</div>
						</form>
					
					<table class="table1" border="1" style="width:100%">
						<thead>
							<tr style="text-align:center" >
								<th style="text-align:center">Sl No</th>
								<th style="text-align:center">Year</th>
								<th style="text-align:center">Period</th>
								<th style="text-align:center">Para No</th>
								<th style="text-align:center">Description</th>
								<th style="text-align:center">Try.Ref No</th>
								<th style="text-align:center">Try.Ref Date</th>
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
													<td><?php echo $sl++ ?>
													</td><td><?php echo $row['para_month'] ?> / <?php echo $row['para_year'] ?> </td>
													</td><td><?php echo $row['ir_period'] ?></td>
													<td><?php echo $row['para_no'] ?></td>
													<td><?php echo $row['para_desc'] ?></td>
													<td><?php echo $row['try_ref_no'] ?></td>
													<td><?php echo get_datepicker_date($row['try_ref_date']) ?></td>
													<td><?php echo $row['para_status'] ?></td>
												</tr>
										<?php		
											}
										?>
							<?php
							}else{?>
							<tr>
								<td colspan="8">No Outstanding Para found!</td>
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


<script type="text/javascript">
$(document).ready(function(){
	$('.datepicker').datepicker({dateFormat:'dd-mm-yy'});
});

function goUpload(id, type) {
    if (id != undefined) {
        window.location.href = '<?php echo SITE_BASE_URL ?>treasury/correction_slip_misclassification/' + id;
    }
}
function goView(id, type) {
    if (id != undefined) {
        window.location.href = '<?php echo SITE_BASE_URL ?>treasury/correction_slip_misclassification_view/' + id;
    }
}	
</script>

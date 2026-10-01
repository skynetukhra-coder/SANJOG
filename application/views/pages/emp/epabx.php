<style>
.table1 td{text-align:center;
		    height: 35px;
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
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('employee'); ?> &raquo; <?php echo $this->lang->line('office_document'); ?> </div>
			<div class="login-box">
				<h4><strong><?php echo $this->lang->line('circular_office_orde'); ?> Extension Numbers</strong></h4>
				<div>
					<div class="col-md-4 col-sm-12" align= "right" style="padding-top: 0px; float: right">
						<button type="button" class="btn-primary btn-xm" onclick="myFunction()" style="padding-top: 5px"> BACK </button>
					</div>
				</div>
				<hr/>
						<form method="get">
							<div class="filter-form1">
									<div class="form-group row">
										<div class="col-sm-8">
										 <label class="name-label"><?php echo $this->lang->line('search'); ?> :</label>
										  <input type="text" id="" name="search" value="<?php echo $this->input->get('search',true)?>" class="form-control" placeholder="Group / Section / Officer's Name / Extension"/>
										</div>
										
										<div class="col-sm-4"><input type="submit" class="submit-btn" value="<?php echo $this->lang->line('search'); ?>" /></div>
									</div>
								</div>
						</form>
					
					<table class="table1" border="1" style="width:100%">
						<thead>
							<tr style="text-align:center">
								<th style="text-align:center">Sl No</th>
								<th style="text-align:center">Group</th>
								<th style="text-align:center">Section</th>
								<th style="text-align:center">Officer</th>
								<th style="text-align:center">Extension</th>
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
													<td><?php echo $row['group_nm']?></td>
													<td><?php echo $row['section'] ?></td>
													<td><?php echo $row['emp_name'] ?></td>
													<td><?php echo $row['extension_no'] ?></td>
												</tr>
										<?php		
											}
										?>
							<?php
							}else{?>
							<tr>
								<td colspan="5">No data found!</td>
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
$(document).ready(function(){
	$('.datepicker').datepicker({dateFormat:'dd-mm-yy'});
});

function myFunction() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/notice_board/';
}
</script>
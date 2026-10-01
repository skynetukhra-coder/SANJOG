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
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('employee'); ?> &raquo; <?php echo $this->lang->line('my_documents'); ?> </div>
			<div class="login-box">

					<div class="new-cont medium whats-new">
						<ul class="nav nav-tabs " style="background-color: ">
							<li class="active"><a data-toggle="tab" href="#tab" onclick="myCharge()" >Branch Officer</a></li>
							<li><a data-toggle="tab" href="#tab1" onclick="mySearch()" >&nbsp;&nbsp;&nbsp;   Search   &nbsp;&nbsp;&nbsp;</a></li>
						</ul>
					</div>
					<div>&nbsp;</div>
				<h4><strong><?php echo $this->lang->line('my_ser'); ?> My Charges </strong></h4>
				<hr />
					<table class="table1" border="1" style="width:100%">
						<thead>
							<tr style="text-align:center">
								<th style="text-align:center">Sl No</th>
								<th style="text-align:center">Branch</th>
								<th style="text-align:center">Sections</th>
								<th style="text-align:center">Staffs</th>
							</tr>
						</thead>
						<tbody>
							<?php
								if(!empty($office_orders)){
									$sl = 1;
									foreach($office_orders as $row){?>
										<tr>
											<td><?php echo $sl++ ?></td>
											<td><?php echo $row['branch_desc'] ?></td>
											<td style = "text-align: center">
												<button id ="charge" class="btn-mini btn-success" 
												onclick="mySections('<?php echo $row['branch_indx'] ?>')" style="display:inline-block; padding:2px; margin:2px; width:auto"><i 
												class="icon-pencil icon-white"></i>View</button>
											</td>
											<td style = "text-align: center">
												<button id ="incharge" class="btn-mini btn-primary" 
													onclick="myAAO('<?php echo $row['branch_indx'] ?>')" style="display:inline-block; padding:2px; margin:2px; width:auto"><i 
													class="icon-pencil icon-white"></i>In-charges</button>
												<button id ="charge" class="btn-mini btn-success" 
													onclick="myStaff('<?php echo $row['branch_indx'] ?>')" style="display:inline-block; padding:2px; margin:2px; width:auto"><i 
													class="icon-pencil icon-white"></i>Staffs</button>
											</td>
										</tr>
								<?php	}
								}else{
									echo '<tr><td colspan="5">No documents found!</td></tr>';
								}
							?>
						</tbody>
					</table>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="<?php echo SITE_BASE_URL?>assets/js/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('.datepicker').datepicker({dateFormat:'dd-mm-yy'});
});
function myAAO(id, type) {
    if (id != undefined) {
		window.location.href = '<?php echo SITE_BASE_URL ?>emp/hierarchy_bo_incharges/' + id;
    }
}
function myStaff(id, type) {
    if (id != undefined) {
		window.location.href = '<?php echo SITE_BASE_URL ?>emp/hierarchy_bo_staffs/' + id;
    }
}
function mySections(id, type) {
    if (id != undefined) {
		window.location.href = '<?php echo SITE_BASE_URL ?>emp/hierarchy_bo_sections/' + id;
    }
}
function myCharge() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/hierarchy_bo/';
}
function mySearch() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/hierarchy_search/';
}
</script>
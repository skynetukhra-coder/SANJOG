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
<!--
					<div class="new-cont medium whats-new">
						<ul class="nav nav-tabs " style="background-color: ">
							<li class="active"><a data-toggle="tab" href="#tab" onclick="myCharge()" >My Charges</a></li>
							<li><a data-toggle="tab" href="#tab1" onclick="mySearch()" >&nbsp;&nbsp;&nbsp;   Search   &nbsp;&nbsp;&nbsp;</a></li>
						</ul>
					</div>
-->
				<div>&nbsp;
				<h4><strong><?php echo $this->lang->line('my_ser'); ?>1. Primary Charge </strong></h4>
				<hr />
					<table class="table1" border="1" style="width:100%">
						<thead>
							<tr style="text-align:center">
								<th style="text-align:center; width: 20%">Sl No</th>
								<th style="text-align:center">Section</th>
							</tr>
						</thead>
						<tbody>
							<?php
								if(!empty($ocharge)){
									$sl = 1;
									foreach($ocharge as $row){?>
										<tr>
											<td><?php echo $sl++ ?></td>
											<td style="text-align: left"><?php echo $row['section'] ?></td>
										</tr>
								<?php	}
								}else{
									echo '<tr><td colspan="2">No documents found!</td></tr>';
								}
							?>
						</tbody>
					</table>
				</div>
				<div>&nbsp;</div>
				<div>&nbsp;
				<h4><strong><?php echo $this->lang->line('my_ser'); ?>2. Link Charge </strong></h4>
				<hr />
					<table class="table1" border="1" style="width:100%">
						<thead>
							<tr style="text-align:center">
								<th style="text-align:center; width: 20%">Sl No</th>
								<th style="text-align:center">Section</th>
							</tr>
						</thead>
						<tbody>
							<?php
								if(!empty($lcharge)){
									$sl = 1;
									foreach($lcharge as $row){?>
										<tr>
											<td><?php echo $sl++ ?></td>
											<td style="text-align: left"><?php echo $row['section'] ?></td>
										</tr>
								<?php	}
								}else{
									echo '<tr><td colspan="2">No documents found!</td></tr>';
								}
							?>
						</tbody>
					</table>
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

function myCharge() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/hierarchy_bo/';
}
function mySearch() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/hierarchy_search/';
}
</script>
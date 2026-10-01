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
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('employee'); ?> &raquo; <?php echo $this->lang->line('my_documents'); ?> &raquo; Orders </div>
			<div class="login-box">
					<div class="new-cont medium whats-new">
						<ul class="nav nav-tabs " style="background-color: ">
							<li><a data-toggle="tab" href="#tab" onclick="myOrder()" >Office Order</a></li>
							<li><a data-toggle="tab" href="#tab1" onclick="myTrainingAll()" >Trainings</a></li>
							<li><a data-toggle="tab" href="#tab2" onclick="myTrainingOrder()" >Training Order</a></li>
							<li><a data-toggle="tab" href="#tab3" onclick="myFacultyOrder()" >Faculty Order</a></li>
							<li class="active" ><a data-toggle="tab4" href="#tab3" onclick="myTransfer()" >Transfer Order</a></li>
							<li><a data-toggle="tab" href="#tab5" onclick="myTryInsOrder()" >Try. Inspection Order</a></li>
						</ul>
					</div>
				<div>&nbsp;</div>
				<h4><strong><?php echo $this->lang->line('my_gpf_stat'); ?>My Transfer Order</strong></h4>
				<hr />
					<table class="table1" border="1" style="width:100%">
						<thead>
							<tr style="text-align:center">
								<th style="text-align:center">Sl No</th>
								<th style="text-align:center">Order No & Date</th>
								<th style="text-align:center">From</th>
								<th style="text-align:center">To</th> 
								<th style="text-align:center">Release/ Joining Date</th> 
								<th style="text-align:center">Status</th> 
								<th style="text-align:center">Order</th>
							</tr>
						</thead>
						<tbody>
							<?php
								if(!empty($results)){
									$sl = 1;
									foreach($results as $order){?>
										<tr>
											<td><?php echo $sl++ ?></td>
											<td><?php echo $order['trans_order_no'] ?><br><?php echo get_datepicker_date($order['trans_order_dt']) ?></br></td>
											<td><?php echo $order['trans_from_sec'] ?><br><?php echo $order['trans_from_grp'] ?></br></td>	
											<td><?php echo $order['trans_to_sec'] ?><br><?php echo $order['trans_to_grp'] ?></br></td>	
											<td><?php echo $order['trans_release_dt'] ?><br><?php echo $order['trans_join_dt'] ?></br></td>											
											<td><?php echo $order['status'] ?></td>												
											<td class="text-center" onclick="goPrint('<?php echo $order['trans_ord_id'] ?>')"> <img src="<?php echo SITE_BASE_URL?>assets/images/PDF.png" style="max-height:40px;"/></a></td>
										</tr>
								<?php	}
								}else{
									echo '<tr><td colspan="7">No documents found!</td></tr>';
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

function goPrint(id, type) {
    if (id != undefined) {
        window.location.href = '<?php echo SITE_BASE_URL ?>emp/transfer_order_download/' + id;  // training_order_print
    }
}
</script>

<script>
$(document).ready(function(){
	$('.datepicker').datepicker({dateFormat:'dd-mm-yy'});
});
function myOrder() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/documents/';
}
function myTrainingAll() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/training_details_all/';
}
function myTrainingOrder() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/training_details/';
}
function myFacultyOrder(id, type) {
   window.location.href = '<?php echo SITE_BASE_URL ?>emp/faculty_details/';
}
function myTransfer(id, type) {
   window.location.href = '<?php echo SITE_BASE_URL ?>emp/transfer_order/';
}
function myTryInsOrder(id, type) {
   window.location.href = '<?php echo SITE_BASE_URL ?>emp/treasury_insp_details/';
}
</script>

<style>
.table1 td{text-align:center;
	font-size:13px;
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
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('employee'); ?> &raquo; <?php echo $this->lang->line('leave_for_recommendati'); ?> Examination appliication</div>
			<div class="login-box">
					<div class="new-cont medium whats-new">
						<ul class="nav nav-tabs " style="background-color: ">
							<li class="active" ><a data-toggle="tab" href="#tab" onclick="TranRel()" >Release on Transfer</a></li>
							<li><a data-toggle="tab" href="#tab1" onclick="TranJoin()" >Joining on Transfer</a></li>
						</ul>
					</div>
					<div>&nbsp;</div>
				<h4><strong><?php echo $this->lang->line('leave_for_recommendati'); ?>Release on Transfer</strong></h4>
				<hr />
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
					<table class="table1" border="1" style="width:100%">
						<thead>
							<tr style="text-align:center">
								<th style="text-align:center">Sl No</th>
								<th style="text-align:center">Name & Desig.</th>
								<th style="text-align:center">Order No & Date</th>
								<th style="text-align:center">From</th>
								<th style="text-align:center">To</th>    
								<th style="text-align:center">Status</th> 
								<th style="text-align:center">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
								if(!empty($office_orders)){
									$sl = intval($this->input->get('per_page',true)) + 1;
									$s2=0;
									
									foreach($office_orders as $order){
										?>
										<tr>
											<td><?php echo $sl++ ?></td>
											<td><?php echo $order['emp_name'] ?> ,<br><?php echo $order['emp_desig'] ?></br></td>
											<td><?php echo $order['trans_order_no'] ?><br><?php echo get_datepicker_date($order['trans_order_dt']) ?></br></td>
											<td><?php echo $order['trans_from_sec'] ?><br><?php echo $order['trans_from_grp'] ?></br></td>	
											<td><?php echo $order['trans_to_sec'] ?>
												<br><?php echo $order['trans_to_grp'] ?></br>
											</td>	
											<td><?php echo $order['status'] ?></td>												
											<td>
												<button id ="view" class="btn-mini btn-success" 
												onclick="goUpdate('<?php echo $order['sec_tnsf_id'] ?>')" ><i 
												class="icon-pencil icon-white"></i> Update</button>
											</td>
										</tr>
								<?php	}
								}else{
									echo '<tr><td colspan="8">No records found!</td></tr>';
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

function goUpdate(id, type) {
    if (id != undefined) {
        window.location.href = '<?php echo SITE_BASE_URL ?>emp/transfer_release_update/' + id;
    }
}
	
</script>

<script>
$(document).ready(function(){
	$('.datepicker').datepicker({dateFormat:'dd-mm-yy'});
});

function TranRel() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/transfer_release/';
}
function TranJoin() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/transfer_joining/';
}
</script>
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
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo;  <?php echo $this->lang->line('treasury'); ?> &raquo;  <?php echo $this->lang->line('accounts_correction'); ?> </div>
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
				<h4><strong><?php echo $this->lang->line('ob_suspense'); ?>Accounts Correction proposed by O/o the Pr. Accountant General (A&E), West Bengal</strong></h4>
				<hr/>
						<form method="get">
							<div class="filter-form1">
									<div class="form-group row">
										<div class="col-sm-4">
											 <label class="name-label"><?php echo $this->lang->line('month'); ?> :</label>
											<select class="form-control" name="tr_mn" >
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
										<div class="col-sm-4">
											<label class="name-label"><?php echo $this->lang->line('year'); ?>:</label>
											<select id="yr_ta" name="yr_ta" class="form-control" >
												<option value=""> -- Select Fin Year--</option>
												<?php
												if(isset($fin_yr_list) && !empty($fin_yr_list)){
													foreach($fin_yr_list as $yr_list){
														echo '<option value="'.$yr_list['yr_ta'].'">'.$yr_list['yr_ta'].'</option>';
													}
												}
												?>
											</select>
										</div>
										<div class="col-sm-4"><input type="submit" class="submit-btn" value="<?php echo $this->lang->line('search'); ?>" /></div>
									</div>
								</div>
						</form>
					
					<table class="table1" border="1" style="width:100%">
						<thead>
							<tr style="text-align:center" >
								<th style="text-align:center">Sl No</th>
								<th style="text-align:center">Year</th>
								<th style="text-align:center">Month</th>
								<th style="text-align:center">LOP/ CAC</th>
								<th style="text-align:center">Voucher/ Challan</th>
								<th style="text-align:center">Gross</th>
								<th style="text-align:center">Classification</th>
								<th style="text-align:center">Action</th>
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
													</td><td><?php echo $row['yr_ta'] ?></td>
													</td><td><?php echo $row['tr_mn'] ?></td>
													<td><?php echo $row['lop_cac'] ?></td>
													<td><?php echo $row['tv_tc_no'] ?></td>
													<td><?php echo $row['amt_paid'] ?></td>
													<td><?php echo $row['mjh_cd'] ?>-<?php echo $row['smjh_cd'] ?>-<?php echo $row['mih_cd'] ?>-<?php echo $row['sbh_cd'] ?>-<?php echo $row['dtlh_cd'] ?>-<?php echo $row['sdtlh_cd'] ?>-<?php echo $row['cv_cd'] ?></td>
													</td>
													<td>
														<?php
														if($row['action_status'] == 'Pending'){?>
														<button id ="Upload"
														onclick="goUpload('<?php echo $row['mc_rec_id'] ?>')" style="display:inline-block; padding:5px; margin:2px; width:auto" >
														<i class="icon-pencil icon-white"></i>Receive</button>
														<?php }
														else{ ?>
														<button id ="view" class="btn btn-mini btn-warning"
														onclick="goView('<?php echo $row['mc_rec_id'] ?>')" style="display:inline-block; padding:5px; margin:2px; width:auto" >
														<i class="icon-pencil icon-white"></i>View</button>
														<?php }?>
													</td>
												</tr>
										<?php		
											}
										?>
							<?php
							}else{?>
							<tr>
								<td colspan="9">No data found!</td>
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

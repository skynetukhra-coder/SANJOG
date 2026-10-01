<?php
$alot_cons_amt = isset($alot_cons['alot_cons_amt']) ? $alot_cons['alot_cons_amt'] : '0';
$cons_amt = isset($cons['cons_amt']) ? $cons['cons_amt'] : '0';
$alot_amc_amt = isset($alot_amc['alot_amc_amt']) ? $alot_amc['alot_amc_amt'] : '0';
$amc_amt = isset($amc['amc_amt']) ? $amc['amc_amt'] : '0';
$alot_hw_amt = isset($alot_hware['alot_hw_amt']) ? $alot_hware['alot_hw_amt'] : '0';
$hw_amt = isset($hware['hw_amt']) ? $hware['hw_amt'] : '0';
$alot_sw_amt = isset($alot_sware['alot_sw_amt']) ? $alot_sware['alot_sw_amt'] : '0';
$sw_amt = isset($sware['sw_amt']) ? $sware['sw_amt'] : '0';
$alot_oth_amt = isset($alot_other['alot_oth_amt']) ? $alot_other['alot_oth_amt'] : '0';
$oth_amt = isset($other['oth_amt']) ? $other['oth_amt'] : '0';
$alot_sms_amt = isset($alot_sms['alot_sms_amt']) ? $alot_sms['alot_sms_amt'] : '0';
$sms_amt = isset($sms['sms_amt']) ? $sms['sms_amt'] : '0';
$alot_ict_amt = isset($alot_ict['alot_ict_amt']) ? $alot_ict['alot_ict_amt'] : '0';
$ict_amt = isset($ict['ict_amt']) ? $ict['ict_amt'] : '0';
$alot_oios_amt = isset($alot_oios['alot_oios_amt']) ? $alot_oios['alot_oios_amt'] : '0';
$oios_amt = isset($oios['oios_amt']) ? $oios['oios_amt'] : '0';
$alot_furni_amt = isset($alot_furni['alot_furni_amt']) ? $alot_furni['alot_furni_amt'] : '0';
$furni_amt = isset($furni['furni_amt']) ? $furni['furni_amt'] : '0';
$alot_machi_amt = isset($alot_machi['alot_machi_amt']) ? $alot_machi['alot_machi_amt'] : '0';
$machi_amt = isset($machi['machi_amt']) ? $machi['machi_amt'] : '0';

?>
<style>
.table1 td{text-align:center;
	font-size:13px;
	width: 10%;
	
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
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('employee'); ?> &raquo; <?php echo $this->lang->line('leave_for_recommendati'); ?> Budget</div>
			<div class="login-box">
				<h4><strong><?php echo $this->lang->line('leave_for_recommendati'); ?> Budget Allotment</strong></h4>
				<div class="col-md-4 col-sm-12" style = " float: right; text-align:center; font-size: 14px">
					<button type="button" class="btn-warning btn-xm" onclick="BudgetDet()" style="padding-top: 5px">Invoice Details</button>
				</div>
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
					<form method="get">
							<div class="filter-form1">
									<div class="form-group row">

										<div class="col-sm-4">
										 <label class="name-label">Fin Year :</label>
										 <select  id="fin_year" name="fin_year" class="form-control" required>
												<option value="">--- Select ---</option>
												<?php
													if(isset($years)){
														foreach($years as $year){
															echo '<option value="'.$year['fin_year'].'">'.$year['fin_year'].'</option>';
														}
													}
												?>
											</select>
										</div>
										<div class="col-sm-3"><input type="submit" class="submit-btn" value="<?php echo $this->lang->line('search'); ?>" /></div>
										<div class="col-sm-2"/>
											<input type="button" class="submit-btn btn-success" onclick="goPrint()" value="Print" />
										</div>
										<div class="col-sm-2">
											<input type="button" class="submit-btn btn-warning" onclick="window.location.href='<?php echo base_url()?>emp/emdbg_budget_rept'" value="<?php echo $this->lang->line('clear'); ?>" />
										</div>
									</div>
								</div>
						</form>
					<table class="table1" border="1" style="width:100%">
						<thead>
							<tr style="text-align:center">
								<th style="text-align:center">*</th>
								<th style="text-align:center">Consumables</th>
								<th style="text-align:center">AMC</th>
								<th style="text-align:center">Hardware</th>
								<th style="text-align:center">Software</th>
								<th style="text-align:center">Others</th>
								<th style="text-align:center">SMS</th>
								<th style="text-align:center">ICT</th>
								<th style="text-align:center">OIOS</th>
								<th style="text-align:center">Furniture</th>
								<th style="text-align:center">Machinary</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Allotment</td>
								<td><?php echo $alot_cons_amt; ?></td>
								<td><?php echo $alot_amc_amt;  ?></td>
								<td><?php echo $alot_hw_amt;  ?></td>
								<td><?php echo $alot_sw_amt;  ?></td>
								<td><?php echo $alot_oth_amt; ?></td>
								<td><?php echo $alot_sms_amt; ?></td>
								<td><?php echo $alot_ict_amt; ?></td>
								<td><?php echo $alot_oios_amt;  ?></td>
								<td><?php echo $alot_furni_amt;  ?></td>
								<td><?php echo $alot_machi_amt;  ?></td>
							</tr>
							<tr>
								<td>Expenditure</td>
								<td><?php echo $cons_amt; ?></td>
								<td><?php echo $amc_amt;  ?></td>
								<td><?php echo $hw_amt;  ?></td>
								<td><?php echo $sw_amt;  ?></td>
								<td><?php echo $oth_amt; ?></td>
								<td><?php echo $sms_amt; ?></td>
								<td><?php echo $ict_amt; ?></td>
								<td><?php echo $oios_amt;  ?></td>
								<td><?php echo $furni_amt;  ?></td>
								<td><?php echo $machi_amt;  ?></td>
							</tr>
							<tr>
								<td> Balance</td>
								<td><?php echo ($alot_cons_amt - $cons_amt); ?></td>
								<td><?php echo ($alot_amc_amt - $amc_amt); ?></td>
								<td><?php echo ($alot_hw_amt - $hw_amt); ?></td>
								<td><?php echo ($alot_sw_amt - $sw_amt); ?></td>
								<td><?php echo ($alot_oth_amt - $oth_amt); ?></td>
								<td><?php echo ($alot_sms_amt - $sms_amt); ?></td>
								<td><?php echo ($alot_ict_amt - $ict_amt); ?></td>
								<td><?php echo ($alot_oios_amt - $oios_amt); ?></td>
								<td><?php echo ($alot_furni_amt - $furni_amt); ?></td>
								<td><?php echo ($alot_machi_amt - $machi_amt); ?></td>
							</tr>
						</tbody>
					</table>
			</div>
			<div class="pagination"><?php echo $this->pagination->create_links();?></div>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?php echo SITE_BASE_URL?>assets/js/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('.datepicker').datepicker({dateFormat:'dd-mm-yy'});
});
function goPrint(fin_year, type) {
	var fyr = document.getElementById("fin_year").value;
      window.location.href = '<?php echo SITE_BASE_URL ?>emp/emdbg_budget_pdf/' + fyr;
}
function BudgetDet() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/emdbg_proc_bill/';
}

	
</script>
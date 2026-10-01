<style>
.table1 tr{text-align:center;
   font-size:11px;
}
.table1 d{text-align:center;
   font-size:11px;
}
.table1 th{text-align:center;
   font-size:11px;
}
button{ background-color:#6FF88E; text-align: center; font-size:10px;}
button:hover{ background-color: #48BBF9; }
</style>
<div class="row">
	<div class="col-md-3 col-sm-4">
		<div class="left-panel">
			<?php $this->load->view('layout/department_left_panel',$header);?>
		</div>
	</div>
	<div class="col-md-9 col-sm-8">
		<div class="right-panel">
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('department')?>  &raquo; <?php echo $this->lang->line('gia_uc'); ?> </div>
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
				<h4><strong><?php echo $this->lang->line('gia_uc'); ?></strong></h4>
					
					<form method="get">
							<div class="filter-form1">
									<div class="form-group row">
										
										<div class="col-sm-2">
											<label class="name-label"><?php echo $this->lang->line('year'); ?>:</label>
											<select id="fin_yr" name="fin_yr" class="form-control" >
												<option value="">---- Year ----</option>
												<?php
												if(isset($fin_yr_list) && !empty($fin_yr_list)){
													foreach($fin_yr_list as $yr_list){
														echo '<option value="'.$yr_list['fin_yr'].'">'.$yr_list['fin_yr'].'</option>';
													}
												}
												?>
											</select>
										
										</div>
										<div class="col-sm-3">
											<label class="name-label"><?php echo $this->lang->line('month'); ?> :</label>
											<select class="form-control" name="tr_mn" >
												<option value="">----- Month ----</option>
												<option value="1" >January</option>
												<option value="2" >February</option>
												<option value="3" >March</option>
												<option value="4" >April</option>
												<option value="5" >May</option>
												<option value="6" >June</option>
												<option value="7" >July</option>
												<option value="8" >August</option>
												<option value="9" >September</option>
												<option value="10" >October</option>
												<option value="11" >November</option>
												<option value="12" >December</option>
												<option value="13" >March Supplimentary</option>
											  </select>
										</div>
										<div class="col-sm-3">
											 <label class="name-label"><?php echo $this->lang->line('ddo'); ?> Code :</label>
											<input type="text" id="ddo" name="ddo" value="<?php echo $this->input->get('ddo',true)?>" class="form-control"/>
										</div>
										<div class="col-sm-2">
										 <label class="name-label"><?php echo $this->lang->line('descriptio'); ?>TV TC No :</label>
										  <input type="text" id="tv_tc_no" name="tv_tc_no" value="<?php echo $this->input->get('tv_tc_no',true)?>" class="form-control"/>
										</div>
										
										<div class="col-sm-2"><input type="submit" class="submit-btn" value="<?php echo $this->lang->line('search'); ?>" /></div>
									</div>
								</div>
						</form>
					<table class="table1" border="1" style="width:100% font-size:12px">
						<thead>
							<tr style="text-align:center ">
								<th >Sl no.</th>
								<th >Fin Year</th>
								<th >TR month</th>
								<th >Grant</th>
								<th >TR Code</th>
								<th >DDO Code</th>
								<th >Classification</th>
								<th >TV TC No</th>
								<th >GIA Amt</th>
								<th >Bal Amt</th>
								<th >Utilised</th>
								<th >UC Ref</th>
								<th >Ref Date</th>
								<th >To Bank</th>
								<th class="action">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
								if(!empty($results)){
									$sl = intval($this->input->get('per_page',true)) + 1;
									foreach($results as $row){?>
									  <tr>
										<td ><?php echo $sl++ ?></td>
										<td ><?php echo $row['fin_yr'] ?></td>
										<td ><?php echo $row['tr_mn'] ?></td>
										<td ><?php echo $row['grnt_cd'] ?></td>
										<td style="font-size:9px"><?php echo $row['tr_cd'] ?></td>
										<td style="font-size:9px"><?php echo $row['ddo'] ?></td>
										<td ><?php echo $row['mjh_cd'] ?>-<?php echo $row['smjh_cd'] ?>-<?php echo $row['mih_cd'] ?>-<?php echo $row['sbh_cd'] ?>-<?php echo $row['dtlh_cd'] ?>-<?php echo $row['sdtlh_cd'] ?></td>
										<td ><?php echo $row['tv_tc_no'] ?></td>
										<td ><?php echo $row['gia_amt'] ?></td>
										<td ><?php echo $row['bal_amt'] ?></td>
										<td ><?php echo $row['utilised_amt'] ?></td>
										<td ><?php echo $row['uc_ref_no'] ?></td>
										<td ><?php echo $row['uc_ref_date'] ?></td>
										<td ><?php echo $row['credit_to_bank'] ?></td>
										<td align="center">
											<?php
											if(strtolower($row['utilised_amt']) == ''|| $row['uc_ref_no'] == '' || $row['uc_ref_date'] == '' || $row['credit_to_bank'] == '' ){?>
												<button id ="edit" 
												onclick="goEdit('<?php echo $row['recd_id'] ?>')" style="display:inline-block; padding:5px; margin:2px; width:auto"><i 
												class="icon-pencil icon-white"></i> Update</button>
												&nbsp;
											<?php } else {?>
												<?php echo 'Updated' ?>		
											<?php }?>
											</td>
									  </tr>
								<?php	}
								}else{
									echo '<tr><td colspan="16">No documents found!</td></tr>';
								}
							?>
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
function goEdit(id, type) {
    if (id != undefined) {
        window.location.href = '<?php echo SITE_BASE_URL ?>department/department_gia_update/' + id;
    }
}
</script>

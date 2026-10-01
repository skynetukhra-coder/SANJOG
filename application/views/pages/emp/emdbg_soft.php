<style>
.table1 td{text-align:center;
	font-size:13px;
}
</style>
<?php 
$empid = isset($emp_data['empid']) ? $emp_data['empid']: '1';
$desig = isset($emp_data['desig']) ? $emp_data['desig']: '1';
$section = isset($emp_data['section']) ? $emp_data['section']: '1';
$rol_st = isset($emp_data['rol_st']) ? $emp_data['rol_st']: 'N';
?>
<div class="row">
	<div class="col-md-3 col-sm-4">
		<div class="left-panel">
			<?php $this->load->view('layout/emp_left_panel',$header);?>
		</div>
	</div>
	<div class="col-md-9 col-sm-8">
		<div class="right-panel">
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('employee'); ?> &raquo; <?php echo $this->lang->line('leave_for_recommendati'); ?> Consumable / Software</div>
			<div class="login-box">
				<h4><strong><?php echo $this->lang->line('leave_for_recommendati'); ?>Software Record</strong></h4>
				<div class="col-md-5 col-sm-12" style = " float: right; text-align:center; font-size: 14px">
					<button type="button" class="btn-success btn-xm" onclick="SoftAdd()" style="padding-top: 5px">Add New Software</button>
					<button type="button" class="btn-warning btn-xm" onclick="consRec()" style="padding-top: 5px">VIEW CONSUMABLE</button>
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
											<div class="col-sm-6">
											 <label class="name-label">Search :</label>
											  <input type="text" id="search" name="search" value="<?php echo $this->input->get('search',true)?>" class="form-control" Placeholder ="" />
											</div>
											<div class="col-sm-2"><input type="submit" class="submit-btn" value="<?php echo $this->lang->line('search'); ?>" /></div>
									</div>
								</div>
						</form>
					<table class="table1" border="1" style="width:100%">
						<thead>
							<tr style="text-align:center">
								<th style="text-align:center">Sl No</th>
								<th style="text-align:center">Item ID</th>
								<th style="text-align:center">Description</th>
								<th style="text-align:center">Item</th>
								<th style="text-align:center">Category / Make</th>
								<th style="text-align:center">Cabinet / Box No</th>
								<th style="text-align:center">License / Cost</th>
								<th style="text-align:center">Remark</th>
								<?php if($section == 'IT SUPPORT CELL' && $desig == 'ASSTT. ACCOUNTS OFFICER' && $rol_st == 'Y'){ ?>
								<th style="text-align:center">Stock</th>
								<th style="text-align:center">Action</th>
								<?php } ?>
							</tr>
						</thead>
						<tbody>
							<?php
								if(!empty($results)){
									$sl = intval($this->input->get('per_page',true)) + 1;
									foreach($results as $record){
							?>
										<tr>
											<td><?php echo $sl++ ?></td>
											<td><?php echo $record['item_id'] ?></td>
											<td><?php echo $record['item_desc'] ?></td>
											<td><?php echo $record['item_for'] ?></td>
											<td><?php echo $record['item_cat'] ?><br><?php echo $record['item_make'] ?></br></td>
											<td><?php echo $record['item_box'] ?>/<?php echo $record['cd_dvd_no'] ?>-<?php echo $record['media_type'] ?>(<?php echo $record['no_media'] ?>)</td>
											<td><?php echo $record['no_license'] ?><br><?php echo $record['cost'] ?>(<?php echo get_datepicker_date($record['pur_dt']) ?>)</br></td>
											<td style="font-size:11px"><?php echo $record['remk'] ?></td>
											<?php if($section == 'IT SUPPORT CELL' && $desig == 'ASSTT. ACCOUNTS OFFICER' && $rol_st == 'Y'){ ?>
											<td style="font-size:11px"><?php echo $record['stk_bal'] ?></td>
											<td>
												<button id ="edit" class="btn-mini btn-primary" 
												onclick="goEdit('<?php echo $record['itm_id'] ?>')" ><i 
													class="icon-pencil icon-white"></i> Update </button>
											</td>
											<?php } ?>
										</tr>
								<?php	}
								}else{
									echo '<tr><td colspan="8">No records found!</td></tr>';
								}
							?>
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
function goEdit(id, type) {
    if (id != undefined) {
        window.location.href = '<?php echo SITE_BASE_URL ?>emp/emdbg_soft_edit/' + id;
    }
}
function SoftAdd() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/emdbg_soft_add/';
}
function consRec() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/emdbg_cons/';
}
/*
 function edit_btn(leave_st,edit) 
{
    if (leave_st.value == "draft") 
    {
        document.getElementById("edit").disabled = false;		
    }
    else 
    {       
		document.getElementById("edit").disabled = true;
    }	
*/	
	
</script>
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
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('employee'); ?> &raquo; <?php echo $this->lang->line('leave_for_recommendati'); ?> Passport appliication</div>
			<div class="login-box">
				<h4><strong><?php echo $this->lang->line('leave_for_recommendati'); ?>Passport / VISA Application for NOC</strong></h4>
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
								<th style="text-align:center">Name</th>
								<th style="text-align:center">Desig</th>
								<th style="text-align:center">Description</th>
								<th style="text-align:center">Applied On</th>
								<th style="text-align:center">Attachment</th>
								<th style="text-align:center">Status</th>
								<th style="text-align:center">Action</th>
								<th style="text-align:center">Draft</th>
							</tr>
						</thead>
						<tbody>
							<?php
								if(!empty($office_orders)){
									$sl = intval($this->input->get('per_page',true)) + 1;
									$s2=0;
									
									foreach($office_orders as $record){
									//	 ?>
										<tr>
											<td><?php echo $sl++ ?></td>
											<td><?php echo $record['name'] ?></td>
											<td><?php echo $record['desig'] ?></td>
											<td><?php echo $record['reason_pp'] ?></td>
											<td><?php echo get_datepicker_date($record['appli_date']) ?></td>
											<td>
												<?php 
													if(trim($record['attachment']) != '')	{
														$attachments = explode(';',$record['attachment']);
														foreach($attachments as $filename){
															echo '<a target="_blank" href="'.base_url().'files/agae/results/'.$filename.'"><img src="'.SITE_BASE_URL.'assets/images/PDF.png" style="max-height:30px;"/></a> &nbsp;';
														}
														
													}
												?>
											</td>
											
											<td style="font-size:11px"><?php echo $record['appli_status'] ?><br><?php echo $record['dag_desig'] ?><br>(<?php echo get_datepicker_date($record['dag_dt']) ?>)</br></td>
											<td>
												<button id ="edit" class="btn-mini btn-primary" 
												onclick="goEdit('<?php echo $record['pappl_id'] ?>')" ><i 
													class="icon-pencil icon-white"></i> Action </button>
												<button id ="edit" class="btn-mini btn-warning" 
												onclick="goPrint('<?php echo $record['pappl_id'] ?>')" ><i 
													class="icon-pencil icon-white"></i>&nbsp;View&nbsp;</button>
											</td>
											<td>
												<?php 
													if(trim($record['draft_attachment']) != '')	{
														$drafts = explode(';',$record['draft_attachment']);
														foreach($drafts as $filename){
															echo '<a target="_blank" href="'.base_url().'files/agae/results/'.$filename.'"><img src="'.SITE_BASE_URL.'assets/images/PDF.png" style="max-height:30px;"/></a> &nbsp;';
														}
														
													}
												?>
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
function goEdit(id, type) {
    if (id != undefined) {
        window.location.href = '<?php echo SITE_BASE_URL ?>emp/application_passport_noc/' + id;
    }
}
function goPrint(id, type) {
    if (id != undefined) {
        window.location.href = '<?php echo SITE_BASE_URL ?>emp/application_passport_download/' + id;
    }
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
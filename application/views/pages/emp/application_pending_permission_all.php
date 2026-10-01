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
				<h4><strong><?php echo $this->lang->line('leave_for_recommendati'); ?>Examination Application for permission</strong></h4>
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
										 <label class="name-label">Application Status :</label>
										 <select name="appli_status" class="form-control">
										 	<option value="">---- Select ----</option>
											<option value="Recommended" <?php echo $this->input->get('appli_status') == 'Recommended' ? 'selected' : ''?> >Recommended</option>
											<option value="Under Varification" <?php echo $this->input->get('appli_status') == 'Under Varification' ? 'selected' : ''?> >Under Varification</option>
											<option value="Under Process" <?php echo $this->input->get('appli_status') == 'Under Process' ? 'selected' : ''?> >Under Process</option>
											<option value="Permitted" <?php echo $this->input->get('appli_status') == 'Permitted' ? 'selected' : ''?> >Permitted</option>
											<option value="Not Permitted" <?php echo $this->input->get('appli_status') == 'Not Permitted' ? 'selected' : ''?> >Not Permitted</option>
											<option value="Rejected" <?php echo $this->input->get('appli_status') == 'Rejected' ? 'selected' : ''?> >Rejected</option>
											<option value="Withheld" <?php echo $this->input->get('appli_status') == 'Withheld' ? 'selected' : ''?> >Withheld</option>
										 </select>
										</div>
										<div class="col-sm-4">
										 <label class="name-label">Search :</label>
										  <input type="text" id="search" name="search" value="<?php echo $this->input->get('search',true)?>" class="form-control" placeholder = "Name"/>
										</div>
										<div class="col-sm-4"><input type="submit" class="submit-btn" value="<?php echo $this->lang->line('search'); ?>" /></div>
									</div>
								</div>
						</form>
					<table class="table1" border="1" style="width:100%">
						<thead>
							<tr style="text-align:center">
								<th style="text-align:center">Sl No</th>
								<th style="text-align:center">Name</th>
								<th style="text-align:center">Desig</th>
								<th style="text-align:center">Examination</th>
								<th style="text-align:center">Applied On</th>
								<th style="text-align:center">Attachment</th>
								<th style="text-align:center">Status</th>
								<th style="text-align:center">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
								if(!empty($results)){
									$sl = intval($this->input->get('per_page',true)) + 1;
									$s2=0;
									
									foreach($results as $record){
									//	 ?>
										<tr>
											<td><?php echo $sl++ ?></td>
											<td><?php echo $record['name'] ?></td>
											<td><?php echo $record['desig'] ?></td>
											<td><?php echo $record['exam_name'] ?><br><?php echo $record['exam_appli_yr'] ?></br></td>
											<td><?php echo get_datepicker_date($record['appli_date']) ?></td>
											<td>
												<?php 
													if(trim($record['attachment']) != '')	{
														$attachments = explode(';',$record['attachment']);
														foreach($attachments as $filename){
															echo '<a target="_blank" href="'.base_url().'files/agae/results/'.$filename.'"><img src="'.SITE_BASE_URL.'assets/images/PDF.png" style="max-height:40px;"/></a> &nbsp;';
														}
														
													}
												?>
											</td>
											<td><?php echo $record['appli_status'] ?></td>
											<td>
											<button id ="edit" class="btn-mini btn-primary" 
											onclick="goEdit('<?php echo $record['exam_odr_id'] ?>')" ><i 
												class="icon-pencil icon-white"></i> Action </button>
											<button id ="edit" class="btn-mini btn-success" 
											onclick="goPrint('<?php echo $record['exam_odr_id'] ?>')" ><i 
												class="icon-pencil icon-white"></i> Pdf </button>
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
//        window.location.href = '<?php echo SITE_BASE_URL ?>emp/application_permission/' + id;
		var url = '<?php echo SITE_BASE_URL ?>emp/application_permission/' + id;
		window.open(url, "_blank");
    }
}
function goPrint(id, type) {
    if (id != undefined) {
//      window.location.href = '<?php echo SITE_BASE_URL ?>emp/application_exam_other_download/' + id;
		var url = '<?php echo SITE_BASE_URL ?>emp/application_exam_other_download/' + id;
		window.open(url, "_blank");
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
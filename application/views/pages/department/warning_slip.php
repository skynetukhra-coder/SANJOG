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
			<?php $this->load->view('layout/department_left_panel',$header);?>
		</div>
	</div>
	<div class="col-md-9 col-sm-8">
		<div class="right-panel">
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo;<?php echo $this->lang->line('department')?> &raquo; <?php echo $this->lang->line('warning'); ?> </div>
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
				<h4><strong><?php echo $this->lang->line('warning_document_dept'); ?></strong></h4>
				<hr />
					<form method="get">
							<div class="filter-form1">
									<div class="form-group row">
										<div class="col-sm-4">
											 <label class="name-label"><?php echo $this->lang->line('from_date'); ?> :</label>
											<input type="text" id="date_from" name="date_from" value="<?php echo $this->input->get('date_from',true)?>" class="form-control"/>
										</div>
										<div class="col-sm-4">
											 <label class="name-label"><?php echo $this->lang->line('to_date'); ?> :</label>
											<input type="text" id="date_to" name="date_to" value="<?php echo $this->input->get('date_to',true)?>" class="form-control"/>
										</div>
										<div class="col-sm-4">
										 <label class="name-label"><?php echo $this->lang->line('year'); ?> :</label>
											<select name="dyear" class="form-control" >
													<option value="">-- <?php echo $this->lang->line('select_year'); ?> --</option>
													<?php
													for($i = date('Y'); $i >= 2020; $i--){
														echo '<option value="'.$i.'" '.($this->input->get('dyear',true) == $i ? 'selected': '').' >'.$i.'</option>';
													}?>
											</select>
										</div>
										<div class="col-sm-8">
										 <label class="name-label"><?php echo $this->lang->line('description'); ?> :</label>
										  <input type="text" id="details" name="details" value="<?php echo $this->input->get('details',true)?>" class="form-control"/>
										</div>
										
										<div class="col-sm-4"><input type="submit" class="submit-btn" value="<?php echo $this->lang->line('search'); ?>" /></div>
									</div>
								</div>
						</form>
					<table class="table1" border="1" style="width:100%">
						<thead>
							<tr style="text-align:center">
								<th >Sl No</th>
								<th >Order Date</th>
								<th >Year</th>
								<th >Month</th>
								<th >Description</th>
								<th >AG Office's File</th>
								<th >Dept's File</th>
								<th >Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
								if(!empty($results)){
									$sl = 1;
									foreach($results as $documents){?>
										<tr>
											<td><?php echo $sl++ ?></td>
											<td><?php echo date('d-m-Y',strtotime($documents['order_date'])) ?></td>
											<td><?php echo $documents['dyear'] ?></td>
											<td><?php echo $documents['dmonth'] ?></td>
											<td><?php echo $documents['title'] ?></td>
											<td>
											<?php
												if(trim($documents['url_link']) != ''){
													echo '<a target="_blank" href="'.$documents['url_link'].'" target="_blank"><img src="'.SITE_BASE_URL.'assets/images/PDF.png" style="max-height:40px;"/></a><br/>';
												}
												else if(trim($documents['attachment']) != ''){
													echo '<a href="'.base_url().'files/agae/department/'.$documents['attachment'].'" target="_blank"><img src="'.SITE_BASE_URL.'assets/images/PDF.png" style="max-height:40px;"/></a>';
												}
											?>
											</td>
											<td ><?php 
													if(trim($documents['dept_attachment']) != '')	{
														$attachments = explode(';',$documents['dept_attachment']);
														foreach($attachments as $filename){
															echo '<a target="_blank" href="'.base_url().'files/agae/department/'.$filename.'"><img src="'.SITE_BASE_URL.'assets/images/PDF.png" style="max-height:40px;"/></a> &nbsp;';
														}
														
													}
												?>
											</td>
											<td align="center">
											<?php
											if(strtolower($documents['action_status']) == 'pending'){?>
												<button id ="edit" 
												onclick="goEdit('<?php echo $documents['file_id'] ?>')" style="display:inline-block; padding:5px; margin:2px; width:auto"><i 
												class="icon-pencil icon-white"></i> Action</button>
												&nbsp;
											<?php } else {?>
<!--											<button id ="edit" class="btn btn-mini btn-primary" 
												onclick="goJoining('<?php echo $documents['file_id'] ?>')" style="display:inline-block; padding:5px; margin:2px; width:auto"><i 
												class="icon-pencil icon-white"></i> Closed</button>
											&nbsp; 
-->											
											<?php echo $documents['action_status'] ?>	
											<?php }?>
											</td>
										</tr>
								<?php	}
								}else{
									echo '<tr><td colspan="8">No documents found!</td></tr>';
								}
							?>
						</tbody>
					</table>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function(){
	$('.datepicker').datepicker({dateFormat:'dd-mm-yy'});
});
function goEdit(id, type) {
    if (id != undefined) {
        window.location.href = '<?php echo SITE_BASE_URL ?>department/department_warning_slip/' + id;
    }
}
	
</script>

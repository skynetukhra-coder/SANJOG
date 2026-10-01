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
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('employee'); ?> &raquo; <?php echo $this->lang->line('kms_document'); ?> </div>
			<div class="login-box">
					<div class="new-cont medium whats-new">
						<ul class="nav nav-tabs " style="background-color: ">
							<li><a data-toggle="tab" href="#tab" onclick="AdmnOrder()" >Administrative Order</a></li>
							<li><a data-toggle="tab" href="#tab1" onclick="BookMan()" >Books and Manual</a></li>
							<li class="active" ><a data-toggle="tab" href="#tab2" onclick="TryMat()" >Training Material</a></li>
							<li><a data-toggle="tab" href="#tab3" onclick="myVideo()" >Training Videos</a></li>
							<li><a data-toggle="tab" href="#tab4" onclick="TryRept()" >Treasury Inspection Report</a></li>
						</ul>
					</div>
					<div>&nbsp;</div>
				<h4><strong><?php echo $this->lang->line('training_material'); ?></strong></h4>
				<hr/>
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
										 <label class="name-label"><?php echo $this->lang->line('all_wing'); ?> :</label>
										 <select name="wing" class="form-control">
										 	<option value=""><?php echo $this->lang->line('all_wing'); ?></option>
											<option value="administration" <?php echo $this->input->get('wing') == 'administration' ? 'selected' : ''?> ><?php echo $this->lang->line('administrator_wing'); ?></option>
											<option value="record" <?php echo $this->input->get('wing') == 'record' ? 'selected' : ''?> ><?php echo $this->lang->line('record_wing'); ?></option>
											<option value="accounts" <?php echo $this->input->get('wing') == 'accounts' ? 'selected' : ''?> ><?php echo $this->lang->line('accounts_wing'); ?></option>
											<option value="fund" <?php echo $this->input->get('wing') == 'fund' ? 'selected' : ''?> ><?php echo $this->lang->line('fund_wing'); ?></option>
											<option value="pension" <?php echo $this->input->get('wing') == 'pension' ? 'selected' : ''?> ><?php echo $this->lang->line('pension_wing'); ?></option>
											<option value="training" <?php echo $this->input->get('wing') == 'training' ? 'selected' : ''?> ><?php echo $this->lang->line('training_wing'); ?></option>
											<option value="da_cadre" <?php echo $this->input->get('wing') == 'da_cadre' ? 'selected' : ''?> ><?php echo $this->lang->line('da_cadre_wing'); ?></option>
										 </select>
										</div>
										<div class="col-sm-8">
										 <label class="name-label"><?php echo $this->lang->line('title'); ?> :</label>
										  <input type="text" id="" name="details" value="<?php echo $this->input->get('details',true)?>" class="form-control"/>
										</div>
										
										<div class="col-sm-4"><input type="submit" class="submit-btn" value="<?php echo $this->lang->line('search'); ?>" /></div>
									</div>
								</div>
						</form>
					
					<table class="table1"border="1" style="width:100%">
						<thead>
							<tr style="text-align:center">
								<th style="text-align:center">Sl No</th>
								<th style="text-align:center">Upload_Date</th>
								<th style="text-align:center">Wing</th>
								<th style="text-align:center">Description</th>
								<th style="text-align:center">Download</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if(!empty($results)){?>		
										<?php
										$sl = intval($this->input->get('per_page',true)) + 1;
											foreach($results as $row){?>
												<tr>
													<td><?php echo $sl++ ?></td>
													<td><?php echo date(DATE_FORMAT,strtotime($row['order_dt']))?></td>
													<td><?php echo ucwords($row['wing']) ?></td>
													<td><?php echo $row['details'] ?></td>
													<td class="text-center">
														<?php 
													if(trim($row['attachment']) != '')	{
														$attachments = explode(';',$row['attachment']);
														foreach($attachments as $filename){
															echo '<a target="_blank" href="'.base_url().'files/agae/circular_order/'.$filename.'"><img src="'.SITE_BASE_URL.'assets/images/download_img.png" style="max-height:40px;"/></a> &nbsp;';
														}
													}
														?>
													</td>
												</tr>
										<?php		
											}
										?>
							<?php
							}else{?>
							<tr>
								<td colspan="5">No data found!</td>
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

<script type="text/javascript" src="<?php echo SITE_BASE_URL?>assets/js/jquery.min.js"></script>
<script>
$(document).ready(function(){
	$('.datepicker').datepicker({dateFormat:'dd-mm-yy'});
});

function AdmnOrder() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/administrative_order/';
}
function BookMan() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/kms_document/';
}
function TryMat(id, type) {
   window.location.href = '<?php echo SITE_BASE_URL ?>emp/training_material/';
}
function myVideo(id, type) {
   window.location.href = '<?php echo SITE_BASE_URL ?>emp/training_video/';
}
function TryRept(id, type) {
   window.location.href = '<?php echo SITE_BASE_URL ?>emp/treasury_ir/';
}
</script>
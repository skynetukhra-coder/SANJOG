<style>
.table1 td{text-align:center}
</style>

<div class="row">
	<div class="col-md-3 col-sm-4">
		<div class="left-panel">
			<?php $this->load->view('layout/department_left_panel',$header);?>
		</div>
	</div>
	<div class="col-md-9 col-sm-8">
		<div class="right-panel">
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('department'); ?> &raquo; <?php echo $this->lang->line('orders'); ?> </div>
			<div class="login-box">
				<h4><strong><?php echo $this->lang->line('crclr_ofc_ordr'); ?> </strong></h4>
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
								<th style="text-align:center">Sl No</th>
								<th style="text-align:center">Order_Date</th>
								<th style="text-align:center">Title</th>
								<th style="text-align:center">Description</th>
								<th style="text-align:center">Attachment</th>
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
													<td><?php echo date(DATE_FORMAT,strtotime($row['order_date']))?></td>
													<td><?php echo $row['title'] ?></td>
													<td><?php echo $row['details'] ?></td>
													<td class="text-center">
														<?php
													if(trim($row['url_link']) != ''){
														echo '<a target="_blank" href="'.$row['url_link'].'" target="_blank"><img src="'.SITE_BASE_URL.'assets/images/PDF.png" style="max-height:40px;"/></a><br/>';
													}
													else if(trim($row['attachment']) != ''){
														echo '<a href="'.base_url().'files/agae/department/'.$row['attachment'].'" target="_blank"><img src="'.SITE_BASE_URL.'assets/images/PDF.png" style="max-height:40px;"/></a>';
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
<div class="row">
<style>
.col_1{font-weight:bold;}
</style>
	<div class="col-md-9 col-sm-8 col-md-push-3 col-sm-push-4">
		<div class="right-panel">
			<div class="breadcrumb"><a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('circular_office_order'); ?></div>
			<div>
				<h1 class="title"><?php echo $this->lang->line('circular_office_order');?></h1>
				<div class="page-details">
					<h3><?php echo $this->lang->line('search_circular_office_order');?>:</h3>
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
											<option value="accounts" <?php echo $this->input->get('wing') == 'accounts' ? 'selected' : ''?> ><?php echo $this->lang->line('accounts_wing'); ?></option>
											<option value="fund" <?php echo $this->input->get('wing') == 'fund' ? 'selected' : ''?> ><?php echo $this->lang->line('fund_wing'); ?></option>
											<option value="pension" <?php echo $this->input->get('wing') == 'pension' ? 'selected' : ''?> ><?php echo $this->lang->line('pension_wing'); ?></option>
											<option value="training" <?php echo $this->input->get('wing') == 'training' ? 'selected' : ''?> ><?php echo $this->lang->line('training_wing'); ?></option>
											<option value="da_cadre" <?php echo $this->input->get('wing') == 'da_cadre' ? 'selected' : ''?> ><?php echo $this->lang->line('da_cadre_wing'); ?></option>
										 </select>
										</div>
										<div class="col-sm-8">
										 <label class="name-label"><?php echo $this->lang->line('title'); ?> :</label>
										  <input type="text" id="" name="title" value="<?php echo $this->input->get('title',true)?>" class="form-control"/>
										</div>
										
										<div class="col-sm-4"><input type="submit" class="submit-btn" value="<?php echo $this->lang->line('search'); ?>" /></div>
									</div>
                            </div>
					</form>
					 	<table border="1" style="width:100%">
							<thead>
								<tr style="text-align:center">
									<th style="text-align:center"><?php echo $this->lang->line('sl_no'); ?></th>
									<th style="text-align:center"><?php echo $this->lang->line('title'); ?></th>
									<th style="text-align:center;"><?php echo $this->lang->line('wing'); ?></th>
									<th style="text-align:center;"><?php echo $this->lang->line('date'); ?></th>
									<th style="text-align:center;" ><?php echo $this->lang->line('download'); ?></th>
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
													<td><?php 
														if($language_id == 1){
															echo  $row['description'];
														} 
														elseif($language_id == 2){
															echo  $row['description_hindi'];
														}
														else{
															echo  $row['description_bengali'];
														}
													?></td>
													<td><?php echo ucwords($row['wing']) ?></td>
													<td><?php echo date(DATE_FORMAT,strtotime($row['date'])) ?></td>
													<td class="text-center">
														<?php
														$filename_or_url = '';
														if(trim($row['pdf_name']) != ''){
															$filename_or_url = base_url().'files/agae/circular_order/'.$row['pdf_name'];
														}else if(trim($row['url_link']) != ''){
															$filename_or_url = trim($row['url_link']);
														}
														?>
														<a href="<?php echo $filename_or_url ?>" target="_blank">															
															<img src="<?php echo SITE_BASE_URL?>assets/images/PDF.png" style="max-height:50px;"/>
														</a>
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
	<div class="col-md-3 col-sm-4  col-md-pull-9 col-sm-pull-8">
		<div class="left-panel">
			<?php $this->load->view('layout/left_panel');?>
		</div>
	</div>
</div>
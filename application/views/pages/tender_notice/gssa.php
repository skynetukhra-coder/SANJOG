<div class="row">
<style>
.col_1{font-weight:bold;}
</style>
	<div class="col-md-9 col-sm-8 col-md-push-3 col-sm-push-4">
		<div class="right-panel">
			<div class="breadcrumb"><a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_g_ssa'); ?></a> &raquo; Tender Notice</div>
			<div>
				<h1 class="title"><?php echo $this->lang->line('tender_notice'); ?></h1>
				<div class="page-details">
					<form method="get">
						<div class="filter-form1">
									<div class="form-group row">
										<div class="col-sm-2">
											 <label class="name-label">From Date :</label>
											<input type="text" id="date_from" name="date_from" value="<?php echo $this->input->get('date_from',true)?>" class="form-control"/>
										</div>
										<div class="col-sm-2">
											 <label class="name-label">To Date :</label>
											<input type="text" id="date_to" name="date_to" value="<?php echo $this->input->get('date_to',true)?>" class="form-control"/>
										</div>
										<div class="col-sm-6">
										 <label class="name-label">Title :</label>
										  <input type="text" id="" name="title" value="<?php echo $this->input->get('title',true)?>" class="form-control"/>
										</div>
										
										<div class="col-sm-2"><input type="submit" class="submit-btn" value="Search" /></div>
									</div>
                                </div>
					</form>
					 	<table border="1" style="width:100%">
							<thead>
								<tr style="text-align:center">
									<th style="text-align:center">Title</th>
									<th style="text-align:center;">Closing Date</th>
									<th style="text-align:center;" >Download</th>
								</tr>
							</thead>
							<tbody>
							<?php
							if(!empty($results)){?>
								
										<?php
											foreach($results as $row){?>
												<tr>
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
													<td><?php echo $row['closing_date'] != '' ? date(DATE_FORMAT,strtotime($row['closing_date'])) : '' ?></td>
													<td class="text-center">
													<?php
													if(trim($row['url_link']) != ''){
														echo '<a target="_blank" href="'.$row['url_link'].'" target="_blank"><img src="'.SITE_BASE_URL.'assets/images/PDF.png" style="max-height:50px;"/></a><br/>';
													}
													else if(trim($row['pdf_name']) != ''){
														echo '<a href="'.base_url().'files/gssa/'.$row['pdf_name'].'" target="_blank"><img src="'.SITE_BASE_URL.'assets/images/PDF.png" style="max-height:50px;"/></a>';
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
								<td colspan="4">No data found!</td>
							</tr>
						<?php
							}?>
							</tbody>
						</table>	
				</div>
				<?php echo $this->pagination->create_links();?>
			</div>
		</div>
	</div>
	<div class="col-md-3 col-sm-4  col-md-pull-9 col-sm-pull-8">
		<div class="left-panel">
			<?php $this->load->view('layout/left_panel');?>
		</div>
	</div>
</div>
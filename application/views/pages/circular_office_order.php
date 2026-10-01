<div class="row">
<style>
.col_1{font-weight:bold;}
</style>
	<div class="col-md-9 col-sm-8 col-md-push-3 col-sm-push-4">
		<div class="right-panel">
			<div class="breadcrumb"><a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; Circular / Office Order</div>
			<div>
				<h1 class="title">Circular / Office Order</h1>
				<div class="page-details">
					<h3>Search here to list out Circular / Office Order:</h3>
					<form method="get">
						<div class="filter-form1">
									<div class="form-group row">
										<div class="col-sm-4">
											 <label class="name-label">From Date :</label>
											<input type="text" id="date_from" name="date_from" value="<?php echo $this->input->get('date_from',true)?>" class="form-control"/>
										</div>
										<div class="col-sm-4">
											 <label class="name-label">To Date :</label>
											<input type="text" id="date_to" name="date_to" value="<?php echo $this->input->get('date_to',true)?>" class="form-control"/>
										</div>
										<div class="col-sm-4">
										 <label class="name-label">Wing :</label>
										 <select name="wing" class="form-control">
										 	<option value="">All Wing</option>
											<option value="administration" <?php echo $this->input->get('wing') == 'administration' ? 'selected' : ''?> >Administration Wing</option>
											<option value="accounts" <?php echo $this->input->get('wing') == 'accounts' ? 'selected' : ''?> >Accounts Wing</option>
											<option value="fund" <?php echo $this->input->get('wing') == 'fund' ? 'selected' : ''?> >Fund Wing</option>
											<option value="pension" <?php echo $this->input->get('wing') == 'pension' ? 'selected' : ''?> >Pension Wing</option>
											<option value="training" <?php echo $this->input->get('wing') == 'training' ? 'selected' : ''?> >Training Wing</option>
											<option value="da_cadre" <?php echo $this->input->get('wing') == 'da_cadre' ? 'selected' : ''?> >DA Cadre Wing</option>
										 </select>
										</div>
										<div class="col-sm-8">
										 <label class="name-label">Title :</label>
										  <input type="text" id="" name="title" value="<?php echo $this->input->get('title',true)?>" class="form-control"/>
										</div>
										
										<div class="col-sm-4"><input type="submit" class="submit-btn" value="Search" /></div>
									</div>
                                </div>
					</form>
					 	<table border="1" style="width:100%">
							<thead>
								<tr style="text-align:center">
									<th style="text-align:center">Title</th>
									<th style="text-align:center;">Wing</th>
									<th style="text-align:center;">Date</th>
									<th style="text-align:center;" >Download</th>
								</tr>
							</thead>
							<tbody>
							<?php
							if(!empty($results)){?>
								
										<?php
											foreach($results as $row){?>
												<tr>
													<td><?php echo $row['description'] ?></td>
													<td><?php echo ucfirst($row['wing']) ?></td>
													<td><?php echo date(DATE_FORMAT,strtotime($row['date'])) ?></td>
													<td class="text-center">	
														<?php
														$filename_or_url = '';
														if(trim($row['pdf_name']) != ''){
															$filename_or_url = base_url().'files/'.$row['pdf_name'];
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
								<td colspan="4">No data found!</td>
							</tr>
						<?php
							}?>
							</tbody>
						</table>	
				</div>
				<div class="paguination"><?php echo $this->pagination->create_links();?></div>
				
			</div>
		</div>
	</div>
	<div class="col-md-3 col-sm-4  col-md-pull-9 col-sm-pull-8">
		<div class="left-panel">
			<?php $this->load->view('layout/left_panel');?>
		</div>
	</div>
</div>
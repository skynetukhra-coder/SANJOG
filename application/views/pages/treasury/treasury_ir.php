<style>
.table1 td{text-align:center}
</style>
<div class="row">
	<div class="col-md-3 col-sm-4">
		<div class="left-panel">
			<?php $this->load->view('layout/treasury_left_panel',$header);?>
		</div>
	</div>
	<div class="col-md-9 col-sm-8">
		<div class="right-panel">
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('treasury'); ?> &raquo; <?php echo $this->lang->line('insp_reports'); ?> </div>
			<div class="login-box">
				<h4><strong><?php echo $this->lang->line('insp_reports'); ?></strong></h4>
				<hr />
					
					<form method="get">
							<div class="filter-form1">
									<div class="form-group row">
										<div class="col-sm-4">
											 <label class="name-label"><?php echo $this->lang->line('month'); ?> :</label>
											<select class="form-control" name="dmonth" >
												<option value="">-----Select Month----</option>
												<option value="January" >January</option>
												<option value="February" >February</option>
												<option value="March"  >March</option>
												<option value="April"  >April</option>
												<option value="May"  >May</option>
												<option value="June" >June</option>
												<option value="July" >July</option>
												<option value="August"  >August</option>
												<option value="September"  >September</option>
												<option value="October"  >October</option>
												<option value="November" >November</option>
												<option value="December" >December</option>
											  </select>
										</div>
										<div class="col-sm-4">
											<label class="name-label"><?php echo $this->lang->line('year'); ?>:</label>
											<select name="dyear" class="form-control" required>
													<option value="">-- <?php echo $this->lang->line('select_year'); ?> --</option>
													<?php
													for($i = date('Y'); $i >= 1988; $i--){
														echo '<option value="'.$i.'" '.($this->input->get('dyear',true) == $i ? 'selected': '').' >'.$i.'</option>';
													}?>
											</select>
										</div>
										<div class="col-sm-4"><input type="submit" class="submit-btn" value="<?php echo $this->lang->line('search'); ?>" /></div>
									</div>
								</div>
						</form>
					
					<table class="table1" border="1" style="width:100%">
						<thead>
							<tr style="text-align:center">
								<th style="text-align:center">Sl No</th>
								<th style="text-align:center">Inspection Year</th>
								<th style="text-align:center">Period under Inspection</th>
<!--							<th style="text-align:center">Description</th>		-->
								<th style="text-align:center">Attachment</th>
							</tr>
						</thead>
						<tbody>
							<?php
								if(!empty($results)){
									$sl = intval($this->input->get('per_page',true)) + 1;
									foreach($results as $documents){?>
										<tr>
											<td><?php echo $sl++ ?></td>
											<td><?php echo $documents['dmonth'] ?>  <?php echo $documents['dyear'] ?></td>
											<td><?php echo $documents['title'] ?></td>
<!--										<td><?php echo $documents['details'] ?></td>			-->
											<td>
												<?php 
													if(trim($documents['attachment']) != '')	{
														$attachments = explode(';',$documents['attachment']);
														foreach($attachments as $filename){
															echo '<a target="_blank" href="'.base_url().'files/agae/department/'.$filename.'"><img src="'.SITE_BASE_URL.'assets/images/PDF.png" style="max-height:40px;"/></a> &nbsp;';
														}
														
													}
												?>
											</td>
										</tr>
								<?php	}
								}else{
									echo '<tr><td colspan="4">No documents found!</td></tr>';
								}
							?>
						</tbody>
					</table>
			</div>
			<div class="pagination"><?php echo $this->pagination->create_links();?></div>
		</div>
	</div>
</div>

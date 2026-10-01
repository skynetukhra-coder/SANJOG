<style>
.table1 td{text-align:center}
</style>
<div class="row">
	<div class="col-md-3 col-sm-4">
		<div class="left-panel">
			<?php $this->load->view('layout/ddo_left_panel',$header);?>
		</div>
	</div>
	<div class="col-md-9 col-sm-8">
		<div class="right-panel">
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('ddo'); ?> &raquo;  <?php echo $this->lang->line('try_repor'); ?>All Nominations </div>
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
				<h4><strong>All Nominations Applications</strong></h4>
				<hr />
					<form method="get">
							<div class="filter-form1">
									<div class="form-group row">
										<div class="col-sm-3">
											<label class="name-label">GPF A/c No:</label>
											<input id=""  name="sub_ac_code"  value ="" class="form-control" placeholder = "9999  [Number only]" />
										</div>
										<div class="col-sm-3">
											<label class="name-label"><?php echo $this->lang->line('month'); ?> :</label>
											<select class="form-control" name="drec_month" >
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
										<div class="col-sm-3">
											<label class="name-label"><?php echo $this->lang->line('year'); ?>:</label>
											<select name="drec_year" class="form-control" required>
													<option value="">-- <?php echo $this->lang->line('select_year'); ?> --</option>
													<?php
													for($i = date('Y'); $i >= 2019; $i--){
														echo '<option value="'.$i.'" '.($this->input->get('drec_year',true) == $i ? 'selected': '').' >'.$i.'</option>';
													}?>
											</select>
										</div>
										<div class="col-sm-3"><input type="submit" class="submit-btn" value="<?php echo $this->lang->line('search'); ?>" /></div>
									</div>
								</div>
						</form>
					<table class="table1" border="1" style="width:100%">
						<thead>
							<tr style="text-align:center">
								<th style="text-align:center">Sl No</th>
								<th style="text-align:center">Submission Date</th>
								<th style="text-align:center">Year</th>
								<th style="text-align:center">GPF A/c No</th>
								<th style="text-align:center">Nature</th>
								<th style="text-align:center">Document</th>
								<th style="text-align:center">Status</th>
							</tr>
						</thead>
						<tbody>
							<?php
								if(!empty($results)){
									$sl = 1;
									foreach($results as $documents){?>
										<tr>
											<td><?php echo $sl++ ?></td>
											<td><?php echo date('d-m-Y',strtotime($documents['upload_dt'])) ?></td>
											<td><?php echo $documents['drec_month'] ?>, <?php echo $documents['drec_year'] ?></td>
											<td><?php echo $documents['sub_series'] ?> / WB/ <?php echo $documents['sub_ac_code'] ?></td>
											<td><?php echo $documents['drec_type'] ?></td>
											<td>
												<?php 
													if(trim($documents['ddo_attachment']) != '')	{
														$attachments = explode(';',$documents['ddo_attachment']);
														foreach($attachments as $filename){
															echo '<a target="_blank" href="'.base_url().'files/agae/department/'.$filename.'"><img src="'.SITE_BASE_URL.'assets/images/PDF.png" style="max-height:40px;"/></a> &nbsp;';
														}
														
													}
												?>
											</td>
											<td><?php echo $documents['drecd_status'] ?></td>
										</tr>
								<?php	}
								}else{
									echo '<tr><td colspan="7">No documents found!</td></tr>';
								}
							?>
						</tbody>
					</table>
			</div>
		</div>
	</div>
</div>

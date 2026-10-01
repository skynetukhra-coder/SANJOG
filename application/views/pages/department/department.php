<style>
td{text-align:center}
</style>
<div class="row">
	<div class="col-md-3 col-sm-4">
		<div class="left-panel">
			<?php $this->load->view('layout/emp_left_panel',$header);?>
		</div>
	</div>
	<div class="col-md-9 col-sm-8">
		<div class="right-panel">
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('department'); ?> &raquo; Department Documents </div>
			<div class="login-box">
				<h4><strong><?php echo $this->lang->line('department'); ?> Documents</strong></h4>
				<hr />
					<table border="1" style="width:100%">
						<thead>
							<tr style="text-align:center">
								<th style="text-align:center">Sl No</th>
								<th style="text-align:center">Upload Date</th>
								<th style="text-align:center">Title</th>
								<th style="text-align:center">Description</th>
								<th style="text-align:center">Attachment</th>
							</tr>
						</thead>
						<tbody>
							<?php
								if(!empty($office_document)){
									$sl = 1;
									foreach($office_document as $document){?>
										<tr>
											<td><?php echo $sl++ ?></td>
											<td><?php echo date('d-m-Y',strtotime($document['order_dt'])) ?></td>
											<td><?php echo $document['title'] ?></td>
											<td><?php echo $document['details'] ?></td>
											<td>
												<?php 
													if(trim($document['attachment']) != '')	{
														$attachments = explode(';',$document['attachment']);
														foreach($attachments as $filename){
															echo '<a target="_blank" href="'.base_url().'files/'.$filename.'"><img src="'.SITE_BASE_URL.'assets/images/PDF.png" style="max-height:50px;"/></a> &nbsp;';
														}
														
													}
												?>
											</td>
										</tr>
								<?php	}
								}else{
									echo '<tr><td colspan="5">No documents found!</td></tr>';
								}
							?>
						</tbody>
					</table>
			</div>
		</div>
	</div>
</div>

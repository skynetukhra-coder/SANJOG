<style>
td{text-align:center}
</style>
<div class="row">
	<div class="col-md-3 col-sm-4">
		<div class="left-panel">
			<?php $this->load->view('layout/emp_ersa_left_panel',$header);?>
		</div>
	</div>
	<div class="col-md-9 col-sm-8">
		<div class="right-panel">
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_e_rsa'); ?></a> &raquo; Employee &raquo; My Documents </div>
			<div class="login-box">
				<h4><strong>My Documents</strong></h4>
				<hr />
					<table border="1" style="width:100%">
						<thead>
							<tr style="text-align:center">
								<th style="text-align:center">Sl no</th>
								<th style="text-align:center">Order Date</th>
								<th style="text-align:center">Title</th>
								<th style="text-align:center">Description</th>
								<th style="text-align:center">Attachment</th>
							</tr>
						</thead>
						<tbody>
							<?php
								if(!empty($office_orders)){
									$sl = 1;
									foreach($office_orders as $order){?>
										<tr>
											<td><?php echo $sl++ ?></td>
											<td><?php echo $order['order_dt'] ?></td>
											<td><?php echo $order['title'] ?></td>
											<td><?php echo $order['details'] ?></td>
											<td>
												<?php 
													if(trim($order['attachment']) != '')	{
														$attachments = explode(';',$order['attachment']);
														foreach($attachments as $filename){
															echo '<a target="_blank" href="'.base_url().'files/ersa/'.$filename.'"><img src="'.SITE_BASE_URL.'assets/images/PDF.png" style="max-height:50px;"/></a> &nbsp;';
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

<div class="row">
	<div class="col-md-3 col-sm-4">
		<div class="left-panel">
			<?php $this->load->view('layout/emp_left_panel',$header);?>
		</div>
	</div>
	<div class="col-md-9 col-sm-8">
		<div class="right-panel">
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; Employee &raquo; Service Book </div>
			<div class="login-box">
				<h4><strong>My Service Book</strong></h4>
				<hr />

				<?php
					if($filename != ''){?>					
						<table border="1" style="width:100%">
							<thead>
								<tr style="text-align:center">
									<th style="text-align:center">Title</th>
									<th style="text-align:center">Attachment</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td style="text-align: center;">Service Book</td>
									<td style="text-align: center;">
										<a target="_blank" href="<?php echo base_url().'files/'.$filename ?>">
											<img src="<?php echo SITE_BASE_URL ?>assets/images/PDF.png" style="max-height:50px;"/>
										</a>
									</td>
								</tr>
							</tbody>
						</table>
					<?php 
						}else{
							echo '<br/><strong style="color:red">Service book is not available!</strong>';
						}
					?>
			</div>
		</div>
	</div>
</div>
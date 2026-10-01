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
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('employee'); ?> &raquo; <?php echo $this->lang->line('office_document'); ?> </div>
			<div class="login-box">
				<h4><strong><?php echo $this->lang->line('circular_office_orde'); ?>Gradation List</strong></h4>
				<div>
					<div class="col-md-4 col-sm-12" align= "right" style="padding-top: 0px; float: right">
						<button type="button" class="btn-primary btn-xm" onclick="myFunction()" style="padding-top: 5px"> BACK </button>
					</div>
				</div>	
				<hr/>
					<table class="table1" border="1" style="width:100%">
						<thead>
							<tr style="text-align:center">
								<th style="text-align:center">Sl No</th>
								<th style="text-align:center">Upload_Date</th>
								<th style="text-align:center">Title</th>
								<th style="text-align:center">Description</th>
								<th style="text-align:center">Attachment</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if(!empty($results)){?>		
										<?php
										$sl = 1;
											foreach($results as $row){?>
												<tr>
													<td><?php echo $sl++ ?></td>
													<td><?php echo date(DATE_FORMAT,strtotime($row['order_dt']))?></td>
													<td><?php echo $row['title'] ?></td>
													<td><?php echo $row['details'] ?></td>
													<td class="text-center">
														<?php 
													if(trim($row['attachment']) != '')	{
														$attachments = explode(';',$row['attachment']);
														foreach($attachments as $filename){
															echo '<a target="_blank" href="'.base_url().'files/'.$filename.'"><img src="'.SITE_BASE_URL.'assets/images/PDF.png" style="max-height:40px;"/></a> &nbsp;';
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

<script>
$(document).ready(function(){
	$('.datepicker').datepicker({dateFormat:'dd-mm-yy'});
});

function myFunction() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/notice_board/';
}
</script>
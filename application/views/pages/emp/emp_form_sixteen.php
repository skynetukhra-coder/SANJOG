<style>
.table1 th{text-align:center;
}
.table1 td{text-align:center;
}
</style>

<div class="row">
	<div class="col-md-3 col-sm-4">
		<div class="left-panel">
			<?php $this->load->view('layout/emp_left_panel',$header);?>
		</div>
	</div>
	<div class="col-md-9 col-sm-8">
		<div class="right-panel">
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('employee'); ?> &raquo; <?php echo $this->lang->line('my_documents'); ?> &raquo; Documemts</div>
			<div class="login-box">
					<div class="new-cont medium whats-new">
						<ul class="nav nav-tabs " style="background-color: ">
							<li><a data-toggle="tab" href="#tab" onclick="mySBook()" >Service Book</a></li>
							<li><a data-toggle="tab" href="#tab1" onclick="myApar()" >Aprisal Report</a></li>
							<li><a data-toggle="tab" href="#tab2" onclick="myProSt()" >Property Statement</a></li>
							<li><a data-toggle="tab" href="#tab3" onclick="myGpf()" >GPF Statement</a></li>
							<li class="active" ><a data-toggle="tab" href="#tab4" onclick="myFSixteen()" >Form-16</a></li>
						</ul>
					</div>
					<div>&nbsp;</div>
				
				<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px; flex-wrap: wrap; gap: 10px;">
					<h4 style="margin: 0;"><strong>My Form-16</strong></h4>
					<a href="<?php echo SITE_BASE_URL ?>emp/form-16" target="_blank" class="btn btn-warning" style="font-weight: bold; text-decoration: none; padding: 6px 12px; border-radius: 4px; display: inline-flex; align-items: center; gap: 5px;">
						FORM-16 FY-25-26 
						<span class="glyphicon glyphicon-new-window"></span>
					</a>
				</div>
				<hr style="margin-top: 5px;" />

				<table class = "table1" border="1" style="width:100%">
						<thead>
							<tr style="text-align:center">
								<th >Sl No</th>
								<th >Date</th>
								<th >Title</th>
								<th >Description</th>
								<th >Attachment</th>
							</tr>
						</thead>
						<tbody>
							<?php
								if(!empty($office_orders)){
									$sl = 1;
									foreach($office_orders as $order){?>
										<tr>
											<td><?php echo $sl++ ?></td>
											<td><?php echo get_datepicker_date($order['order_dt']) ?></td>
											<td><?php echo $order['title'] ?></td>
											<td><?php echo $order['details'] ?></td>
											<td>
												<?php 
													if(trim($order['attachment']) != '')	{
														$attachments = explode(';',$order['attachment']);
														foreach($attachments as $filename){
															echo '<a target="_blank" href="'.base_url().'files/agae/form_sixteen/'.$filename.'"><img src="'.SITE_BASE_URL.'assets/images/PDF.png" style="max-height:40px;"/></a> &nbsp;';
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
<script type="text/javascript" src="<?php echo SITE_BASE_URL?>assets/js/jquery.min.js"></script>
<script>
$(document).ready(function(){
	$('.datepicker').datepicker({dateFormat:'dd-mm-yy'});
});

function mySBook() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/service_book/';
}
function myApar() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/apar_booklet/';
}
function myProSt(id, type) {
   window.location.href = '<?php echo SITE_BASE_URL ?>emp/property_statement/';
}
function myGpf(id, type) {
   window.location.href = '<?php echo SITE_BASE_URL ?>emp/gpf_statement/';
}
function myFSixteen(id, type) {
   window.location.href = '<?php echo SITE_BASE_URL ?>emp/emp_form_sixteen/';
}
</script>
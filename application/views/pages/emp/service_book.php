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
							<li class="active" ><a data-toggle="tab" href="#tab" onclick="mySBook()" >Service Book</a></li>
							<li><a data-toggle="tab" href="#tab1" onclick="myApar()" >Aprisal Report</a></li>
							<li><a data-toggle="tab" href="#tab2" onclick="myProSt()" >Property Statement</a></li>
							<li><a data-toggle="tab" href="#tab3" onclick="myGpf()" >GPF Statement</a></li>
							<li><a data-toggle="tab" href="#tab4" onclick="myFSixteen()" >Form-16</a></li>
						</ul>
					</div>
					<div>&nbsp;</div>
				<h4><strong>My Service Book</strong></h4>
				<hr />
					<?php
							if(!empty($office_orders)){
									$sl = 1;
									foreach($office_orders as $order){?>
										<?php 
											if(trim($order['attachment']) != ''){
												$attachments = explode(';',$order['attachment']);
												foreach($attachments as $filename){
										?>
													<div style="width:100%; height:30px; font-size:18px;">Uploaded on <?php echo get_datepicker_date($order['update_dt']) ?></div>
													<!------------Reader Display---------->		
													<div style="width:100%; height:700px;"> 
														<object data="https://agwb.cag.gov.in/files/agae/servicebook/<?php echo ($filename)?>" type="application/pdf" width="100%" height="100%"></object>
													</div>
										<?php
												}
											}
									}	
								}else{
									echo 'Service Book can not be displayed';
								}
						?>
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
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
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('employee'); ?> &raquo; <?php echo $this->lang->line('my_documents'); ?> &raquo; Documemts</div>
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
					<div class="new-cont medium whats-new">
						<ul class="nav nav-tabs " style="background-color: ">
							<li><a data-toggle="tab" href="#tab" onclick="mySBook()" >Service Book</a></li>
							<li><a data-toggle="tab" href="#tab1" onclick="myApar()" >Aprisal Report</a></li>
							<li class="active" ><a data-toggle="tab" href="#tab2" onclick="myProSt()" >Property Statement</a></li>
							<li><a data-toggle="tab" href="#tab3" onclick="myGpf()" >GPF Statement</a></li>
							<li><a data-toggle="tab" href="#tab4" onclick="myFSixteen()" >Form-16</a></li>
						</ul>
					</div>
					<div>&nbsp;</div>
				<h4><strong><?php echo $this->lang->line('my_traini'); ?>Property Statement</strong></h4>
				<hr />
				
				<form method="get">
						<div class="filter-form1">
							<div class="form-group row">
								<div class="col-sm-4">
									<label class="name-label">Declaration For :</label>
									<select name="decl_for" class="form-control" >
										<option value=""> -- Select for--</option>
										<option data-value="1" value="Self" <?php echo $this->input->get('decl_for') == 'Self' ? 'selected' : ''?> >Self</option>
										<option data-value="2" value="Dependent"<?php echo $this->input->get('decl_for') == 'Dependent' ? 'selected' : ''?> >Dependent</option>
										
									</select>
								</div>
								<div class="col-sm-4">
									<label class="name-label">Declaration Year :</label>
									<select name="pst_year" class="form-control" >
										<option value="">-- <?php echo $this->lang->line('select_year'); ?> --</option>
											<?php
											for($i = date('Y'); $i >= 2019; $i--){
											echo '<option value="'.$i.'" '.($this->input->get('pst_year',true) == $i ? 'selected': '').' >'.$i.'</option>';
											}?>
									</select>
								</div>
								<div class="col-sm-4">
									<input type="submit" class="submit-btn" value="<?php echo $this->lang->line('search'); ?>" />
								</div>
							</div>
						</div>
					</form>
				
				
					<table class="table1" border="1" style="width:100%">
						<thead>
							<tr style="text-align:center">
								<th style="text-align:center">Sl No</th>
								<th style="text-align:center">Name</th>
								<th style="text-align:center">Designation</th>
								<th style="text-align:center">Year</th>
								<th style="text-align:center">For</th>
								<th style="text-align:center">Date</th>
								<th style="text-align:center">View</th>
							</tr>
						</thead>
						<tbody>
							<?php
								if(!empty($results)){
									$sl = 1;
									foreach($results as $stats){
							 ?>
										<tr>
											<td><?php echo $sl++ ?></td>
											<td><?php echo $stats['emp_name']?></td>
											<td><?php echo $stats['emp_desig']?></td>
											<td><?php echo $stats['pst_year'] ?></td>
											<td><?php echo $stats['decl_for'] ?></td>
											<td><?php echo get_datepicker_date($stats['decl_date']) ?></td>
											<td class="text-center" onclick="goPrint('<?php echo $stats['pst_id'] ?>')"> <img src="<?php echo SITE_BASE_URL?>assets/images/PDF.png" style="max-height:40px;"/></a></td>
										
										</tr>
								<?php	}
								}else{
									echo '<tr><td colspan="7">No records found!</td></tr>';
								}
							?>
						</tbody>
					
					</table>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?php echo SITE_BASE_URL?>assets/js/jquery.min.js"></script>
<script type="text/javascript">
function goPrint(id, type) {
    if (id != undefined) {
        window.location.href = '<?php echo SITE_BASE_URL ?>emp/asset_declarations_pdf/' + id;  // training_order_print
    }
}
</script>

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
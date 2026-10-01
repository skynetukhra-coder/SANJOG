<div class="row">
<style>
.col_1{font-weight:bold;}
</style>
<!--	<div class="col-md-9 col-sm-8 col-md-push-3 col-sm-push-4">			-->
<div align= "center" >
		<div class="right-panel">
			<div class="breadcrumb" align= "left"><a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('status_for_GPF_final_payment_cases'); ?></div>
			<div>
				<h1 class="title"><?php echo $this->lang->line('status_for_GPF_final_payment_cases'); ?></h1>
				<div class="page-details">
					<h3><?php echo $this->lang->line('search_to_know_final_cse_status'); ?>:</h3>
					<form method="get">
						<div class="filter-form">
							<div class="form-group row">
								<div class="col-md-2 col-sm-4">
									<label class="name-label"><?php echo $this->lang->line('gpf_ac_no'); ?>:</label>
								</div>
								<div class="col-md-3 col-sm-8">
									<input id="gpf_ac_no" type="text" name="gpf_ac_no" class="form-control" value="<?php echo $this->input->get('gpf_ac_no',true) != '' ? $this->input->get('gpf_ac_no',true): 'AGR/WB/99999' ?>" placeholder="AGR/WB/59095">
								</div>
								<div>
									<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
								</div>
								<div class="col-md-offset-0 col-md-2 col-sm-offset-4 col-sm-8">
									<input type="submit" class="submit-btn" value="<?php echo $this->lang->line('submit'); ?>" />
								</div>
							</div>
						</div>
					</form>
					<?php
					 if($this->input->get()){
							if(!empty($row)){?>
								<table border="1" style="width:100%">
									<tbody>
										<tr><td class="col_1">Financial Year Ending On:</td><td class="col_2"><?php echo $row['f_year'] != '' ? date(DATE_FORMAT,strtotime($row['f_year'])) : '' ?></td></tr>										
										<tr><td class="col_1">GPF A/c Number:</td><td class="col_2"><?php echo $row['gpf_ac_no'] ?></td></tr>			
										<tr><td class="col_1">Name:</td><td class="col_2"><?php echo $row['subs_name'] ?></td></tr>	
										<tr><td class="col_1">Designation:</td><td class="col_2"><?php echo $row['designation'] ?></td></tr>	
										<tr><td class="col_1">Case Type:</td><td class="col_2"><?php echo $row['case_type'] ?></td></tr>	
										<tr><td class="col_1">Date of Receipt:</td><td class="col_2"><?php echo $row['dt_receipt'] != '' ? date(DATE_FORMAT,strtotime($row['dt_receipt'])) : '' ?></td></tr>	
										<tr><td class="col_1">Communication Letter No and Date:</td><td class="col_2"><?php echo $row['letter_no_date'] ?></td></tr>	
										<tr><td class="col_1">No & Date of the Intimation:</td><td class="col_2"><?php echo $row['dt_intimation'] ?></td></tr>	
										<?php
										if(strtolower($row['case_type']) == 'reference'){?>
										<tr><td class="col_1">Reason of Reference:</td><td class="col_2"><?php echo $row['reference'] ?></td></tr>
										<?php }else if(strtolower($row['case_type']) == 'authority'){?>
										<tr><td class="col_1">Authority to whom communicated:</td><td class="col_2"><?php echo $row['authority'] ?></td></tr>
										<?php } ?>	
									</tbody>
								</table>
						<?php
							}
						}?>
				</div>
			</div >
			<div>***************</div>
			<div class="form-group row">
				<div class="col-md-8 col-sm-8"><b>Click on <a href="https://agwb.cag.gov.in/subs/login" target="_blank" ><button class= "btn btn-success"> Login </button></a> to view GPF Statement, Currnet Balance etc. </b></div>
			</div>
		</div>
	</div>
<!--
	<div class="col-md-3 col-sm-4  col-md-pull-9 col-sm-pull-8">
		<div class="left-panel">
			<?php //$this->load->view('layout/left_panel');?>
		</div>
	</div>
-->
</div>
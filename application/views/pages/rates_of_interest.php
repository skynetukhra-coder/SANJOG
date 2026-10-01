<div class="row">
<!--	<div class="col-md-9 col-sm-8 col-md-push-3 col-sm-push-4">		-->
<div align= "center" >
		<div class="right-panel">
			<div class="breadcrumb" align= "left"><a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('rate_of_interest'); ?></div>
			<div>
				<h1 class="title"><?php echo $this->lang->line('interest_rate'); ?></h1>
				<div class="page-details">
					<h3><?php echo $this->lang->line('search_by_year'); ?>:</h3>
					<form method="get">
						<div class="filter-form1">
							<div class="form-group row">
								<div class="col-sm-6">
									<label class="name-label"><?php echo $this->lang->line('year'); ?>:</label>
									<select name="year" class="form-control" required>
										<option value="">-- <?php echo $this->lang->line('select_year'); ?> --</option>
										<?php
										for($i = date('Y'); $i >= 1967; $i--){
											echo '<option value="'.$i.'" '.($this->input->get('year',true) == $i ? 'selected': '').' >'.$i.'</option>';
										}?>
									</select>
								</div>
								<div class="col-sm-3">
									<input type="submit" class="submit-btn" value="<?php echo $this->lang->line('search'); ?>" />
								</div>
								<div class="col-sm-3">
									<input type="button" class="submit-btn" onclick="window.location.href='<?php echo base_url()?>agae/rates_of_interest'" value="<?php echo $this->lang->line('clear'); ?>" />
								</div>
							</div>
						</div>
					</form>
					<table border="1" style="width:100%">
						<thead>
							<tr style="text-align:center">
								<th style="text-align:center">Sl no.</th>
								<th style="text-align:center">From</th>
								<th style="text-align:center">To</th>
								<th style="text-align:center">Rate</th>
							</tr>
						</thead>
						<tbody>
							<?php
					if(!empty($results)){
						$sl = 1;
						foreach($results as $row){?>
							<tr>
								<td style="text-align:center"><?php echo $sl++ ?></td>
								<td style="text-align:center"><?php echo get_datepicker_date($row['intrst_from'])?></td>
								<td style="text-align:center"><?php echo get_datepicker_date($row['intrst_to'])?></td>
								<td style="text-align:center"><?php echo substr($row['intrst_rate'],0,4) ?></td>
							</tr>
							<?php
						}
					}else{/*?>
							<tr>
								<td colspan="4" style="font-size:12px"><?php echo $this->lang->line('no_data_found')?></td>
							</tr>
							<?php
					*/}?>
						</tbody>
					</table>
				</div>
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

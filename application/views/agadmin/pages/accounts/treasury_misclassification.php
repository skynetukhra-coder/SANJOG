<div class="row-fluid">
	<div class="span12" id="content">
		<div class="block" style="padding:3px 0; border-top:1px solid #ccc">
		<div class="block-content">
			<form method="get">
			  <div class="control-form">
				<label class="control-label">Search</label>
				<div class="controls">
				 <input type="text" name="search" value="<?php echo $this->input->get('search',true)?>" placeholder="Search ......."/>
				</div>
			  </div>
			  <div class="control-form">
			  	<label class="control-label">&nbsp;</label>
				<div class="controls">
					<input type="submit" value="Filter" />
				</div>
			  </div>
			  <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
			  <div class="clearfix"></div>
			 </form>
		</div>
	</div>
	<div class="row-fluid">
    <div class="span12" id="filter-content">
        <div class="block">
            <div class="block-content">
                <form method="post" action="<?php echo ADMIN_BASE_URL ?>accounts/treasury_misclassification_download">
					<div class="control-form" style="padding-right:40px;">
                        <label class="control-label">Treasury </label>
                        <div class="controls">
                            <select name="tr_cd" style="height:34px;">
								<option value=""> -- Select --</option>
								<?php
								if(isset($treasury_code) && !empty($treasury_code)){
									foreach($treasury_code as $codes){
										echo '<option value="'.$codes['tr_cd'].'">'.$codes['tr_cd'].'</option>';
									}
								}
								?>
							</select>
                        </div>
                    </div>
					<div class="control-form" style="padding-right:40px;">
                        <label class="control-label">Year </label>
                        <div class="controls">
                            <select name="yr_ta" style="height:34px;">
								<option value=""> -- Select --</option>
								<?php
								if(isset($fin_yr_list) && !empty($fin_yr_list)){
									foreach($fin_yr_list as $years){
										echo '<option value="'.$years['yr_ta'].'">'.$years['yr_ta'].'</option>';
									}
								}
								?>
							</select>
                        </div>
                    </div>
                    <div class="control-form" style="padding-right:40px;">
                        <label class="control-label">Month </label>
                        <div class="controls">
                            <select class="form-control" name="tr_mn" >
								<option value="">-----Select Month----</option>
								<option value="1" >January</option>
								<option value="2" >February</option>
								<option value="3"  >March</option>
								<option value="4"  >April</option>
								<option value="5"  >May</option>
								<option value="6" >June</option>
								<option value="7" >July</option>
								<option value="8"  >August</option>
								<option value="9"  >September</option>
								<option value="10"  >October</option>
								<option value="11" >November</option>
								<option value="12" >December</option>
								<option value="13" >Supply A/c</option>
							 </select>
                        </div>
                    </div>
                    <div class="control-form">
                        <label class="control-label">&nbsp;</label>
                        <div class="controls">
                            <input type="submit" value="Download Reports" />
                        </div>
                    </div>
                    <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                    <div class="clearfix"></div>
                </form>
            </div>
		  </div>
		</div>
	</div>
		<div class="block">
			<div class="navbar navbar-inner block-header">
				<div class="muted pull-left">List of Accounts Corrections</div>
				<div class="pull-right block-header-btn">
					<button class="btn btn-success" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>accounts/treasury_misclassification_upload'"><i class="icon-plus icon-white"></i> Upload Accounts Correction Records</button>
				</div>
			</div>
			<div class="block-content collapse in">
				<div class="span12">
                  <div class="table-scroll">
					<table class="table table-bordered" Style= "font-size:12px;">
						<thead>
							<tr>
								<th>Sl no.</th>
								<th>Upload Dt</th>
								<th>Try Code</th>
								<th>Fin Year</th>
								<th>Month</th>
								<th>Misclassification</th>
								<th>LOP / CAC</th>
								<th>TV / TV No</th>
								<th>Amount</th>
								<th>Classification</th>
								<th>LOP / CAC</th>
								<th>TV / TC No</th>
								<th>TV / TC Dt</th>
								<th>Amt Deducted /Added</th>
								<th>Amt LOP/CAC</th>
								<th>Amt Actul</th>
								<th>Name</th>
								<th>Desig</th>
								<th>Phone No</th>
								<th class="action">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
					if(count($results) > 0){
						$sl = intval($this->input->get('per_page',true)) + 1;
						foreach($results as $row){?>
							<tr>
								<td><?php echo $sl++ ?></td>
								<td><?php echo get_datepicker_date($row['upload_dt']) ?></td>
								<td><?php echo $row['tr_cd'] ?></td>
								<td><?php echo $row['yr_ta'] ?></td>
								<td><?php echo $row['tr_mn'] ?></td>
								<td><?php echo $row['mjh_cd'] ?>-<?php echo $row['smjh_cd'] ?>-<?php echo $row['mih_cd'] ?>-<?php echo $row['sbh_cd'] ?>-<?php echo $row['dtlh_cd'] ?>-<?php echo $row['sdtlh_cd'] ?>-<?php echo $row['cv_cd'] ?></td>
								<td><?php echo $row['lop_cac'] ?></td>
								<td><?php echo $row['tv_tc_no'] ?></td>
								<td><?php echo $row['amt_paid'] ?></td>
								<td><?php echo $row['mjh_cd_new'] ?>-<?php echo $row['smjh_cd_new'] ?>-<?php echo $row['mih_cd_new'] ?>-<?php echo $row['sbh_cd_new'] ?>-<?php echo $row['dtlh_cd_new'] ?>-<?php echo $row['sdtlh_cd_new'] ?>-<?php echo $row['cv_cd_new'] ?></td>
								<td><?php echo $row['try_lop_cac'] ?></td>
								<td><?php echo $row['try_tv_tc_no'] ?></td>
								<td><?php echo get_datepicker_date($row['try_date_tv_tc']) ?></td>
								<td><?php echo $row['try_amt_ded_add'] ?></td>
								<td><?php echo $row['try_lop_cac_amt'] ?></td>
								<td><?php echo $row['try_actual_amt'] ?></td>
								<td><?php echo $row['try_official_name'] ?></td>
								<td><?php echo $row['try_official_desig'] ?></td>
								<td><?php echo $row['try_official_contact'] ?></td>
								<td>
									<button class="btn btn-mini btn-primary" onclick="goEdit('<?php echo $row['mc_rec_id'] ?>')"><i class="icon-pencil icon-white"></i> Edit</button>
									<button class="btn btn-mini btn-danger" onclick="goDelete('<?php echo $row['mc_rec_id'] ?>')"><i class="icon-remove icon-white"></i> Delete</button>
								</td>
							</tr>
							<?php
						}
					}else{
						echo '<tr><td colspan="15">No data found!</td></tr>';
					}
				?>
						</tbody>
					</table>
                  </div>
				</div>
				<div class="pagination"><?php echo $this->pagination->create_links();?></div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
function goEdit(id,type){
	if(id != undefined){
		window.location.href = '<?php echo ADMIN_BASE_URL ?>accounts/treasury_misclassification_edit/'+id;
	}
}
function goDelete(id){
	if(id != undefined){
		var conf = confirm('Do you want to delete?');
		if(conf){
			window.location.href = '<?php echo ADMIN_BASE_URL ?>accounts/treasury_misclassification_delete/'+id;
		}
		
	}
}
</script>
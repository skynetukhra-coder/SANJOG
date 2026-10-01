<div class="row-fluid">
	<div class="span12" id="content">
		<div class="block" style="padding:10px 0; border-top:1px solid #ccc">
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
                <form method="post" action="<?php echo ADMIN_BASE_URL ?>accounts/treasury_outstandingparas_download">
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
                            <select name="para_year" style="height:34px;">
								<option value="">-- <?php echo $this->lang->line('select_year'); ?> --</option>
									<?php
										for($i = date('Y'); $i >= 2019; $i--){
										echo '<option value="'.$i.'" '.($this->input->get('para_year',true) == $i ? 'selected': '').' >'.$i.'</option>';
									}?>
							</select>
                        </div>
                    </div>
					<div class="control-form" style="padding-right:40px;">
                        <label class="control-label">Month </label>
                        <div class="controls">
                            <select class="form-control" name="para_month" >
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
				<div class="muted pull-left">List of Outstanding Paras</div>
				<div class="pull-right block-header-btn">
					<button class="btn btn-success" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>accounts/treasury_outstanding_para_upload'"><i class="icon-plus icon-white"></i> Upload Outstanding Paras</button>
				</div>
			</div>
			<div class="block-content collapse in">
				<div class="span12">
                  <div class="table-scroll">
					<table class="table table-bordered" Style= "font-size:12px;" >
						<thead>
							<tr>
								<th>Sl no.</th>
								<th>Upload Date</th>
								<th>Try Code</th>
								<th>Treasury</th>
								<th>Year</th>
								<th>Month</th>
								<th>Para No</th>
								<th>Description</th>
								<th>IR Ref</th>
								<th>Ref Date</th>
								<th>Try Ref</th>
								<th>Ref Date</th>
								<th>Remark</th>
								<th>Status</th>
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
								<td><?php echo $row['tr_nm'] ?></td>
								<td><?php echo $row['para_year'] ?></td>
								<td><?php echo $row['para_month'] ?></td>
								<td><?php echo $row['para_no'] ?></td>
								<td><?php echo $row['para_desc'] ?></td>
								<td><?php echo $row['ir_ref_no'] ?></td>
								<td><?php echo get_datepicker_date($row['ir_ref_date']) ?></td>
								<td><?php echo $row['try_ref_no'] ?></td>
								<td><?php echo get_datepicker_date($row['try_ref_date']) ?></td>
								<td><?php echo $row['try_ir_remark'] ?></td>
								<td><?php echo $row['para_status'] ?></td>
								<td>
									<button class="btn btn-mini btn-primary" onclick="goEdit('<?php echo $row['para_id'] ?>')"><i class="icon-pencil icon-white"></i> Edit</button>
									<button class="btn btn-mini btn-danger" onclick="goDelete('<?php //echo $row['report_id'] ?>')"><i class="icon-remove icon-white"></i> Delete</button>
								</td>
							</tr>
							<?php
						}
					}else{
						echo '<tr><td colspan="14">No data found!</td></tr>';
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
$(document).ready(function(){
	$('.datepicker').datepicker({dateFormat:'dd-mm-yy'});
});
function goEdit(id,type){
	if(id != undefined){
		window.location.href = '<?php echo ADMIN_BASE_URL ?>accounts/treasury_outsttanding_para_edit/'+id;
	}
}
function goDelete(id){
	if(id != undefined){
		var conf = confirm('Do you want to delete?');
		if(conf){
			window.location.href = '<?php echo ADMIN_BASE_URL ?>accounts/treasury_outsttanding_paras_delete/'+id;
		}
		
	}
}
</script>
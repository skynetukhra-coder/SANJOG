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
                <form method="post" action="<?php echo ADMIN_BASE_URL ?>accounts/treasury_reports_download">
                    <div class="control-form">
                        <label class="control-label">From </label>
                        <div class="controls">
                            <input type="text" name="date_from" data-required="1" class="datepicker" data-provide="datepicker" autocomplete="off" placeholder="DD-MM-YYYY" />
                        </div>
                    </div>
                    <div class="control-form">
                        <label class="control-label">To</label>
                        <div class="controls">
                            <input type="text" name="date_to"  data-required="1" class="datepicker" data-provide="datepicker" autocomplete="off" placeholder="DD-MM-YYYY" />
                        </div>
                    </div>
                    <div class="control-form" style="padding-right:40px;">
                        <label class="control-label">Report Type </label>
                        <div class="controls">
                            <select name="report_type" style="height:34px;">
								<option value=""> -- Select --</option>
								<?php
								if(isset($report_list) && !empty($report_list)){
									foreach($report_list as $reports){
										echo '<option value="'.$reports['report_type'].'">'.$reports['report_type'].'</option>';
									}
								}
								?>
							</select>
                        </div>
                    </div>
					<div class="control-form" style="padding-right:40px;">
                        <label class="control-label">Treasury </label>
                        <div class="controls">
                            <select name="tr_nm" style="height:34px;">
								<option value=""> -- Select --</option>
								<?php
								if(isset($treasury_list) && !empty($treasury_list)){
									foreach($treasury_list as $treasuries){
										echo '<option value="'.$treasuries['tr_nm'].'">'.$treasuries['tr_nm'].'</option>';
									}
								}
								?>
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
				<div class="muted pull-left">List of Treasury Reports</div>

			</div>
			<div class="block-content collapse in">
				<div class="span12">
                  <div class="table-scroll">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Sl no.</th>
								<th>Upload Date</th>
								<th>Year</th>
								<th>Month</th>
								<th>Report Type</th>
								<th>Description</th>
								<th>Due Date</th>
								<th>File</th>
								<th>Name</th>
								<th>Designation</th>
								<th>Contact No</th>
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
								<td><?php echo $row['report_year'] ?></td>
								<td><?php echo $row['report_month'] ?></td>
								<td><?php echo $row['report_type'] ?></td>
								<td><?php echo $row['report_desc'] ?></td>
								<td><?php echo get_datepicker_date($row['report_due_date']) ?></td>
								<td>
									<?php 
										if(trim($row['try_attachment']) != '')	{
											$try_attachment = explode(';',$row['try_attachment']);
											foreach($try_attachment as $filename){
												echo '<a target="_blank" href="'.base_url().'files/agae/department/'.$filename.'"><img src="'.SITE_BASE_URL.'assets/images/PDF.png" style="max-height:40px;"/></a> &nbsp;';
											}
										}
									?>
								</td>
								<td><?php echo $row['try_official_name'] ?></td>
								<td><?php echo $row['try_official_desig'] ?></td>
								<td><?php echo $row['try_official_contact'] ?></td>
								<td>
									<button class="btn btn-mini btn-primary" onclick="goEdit('<?php //echo $row['report_id'] ?>')"><i class="icon-pencil icon-white"></i> Edit</button>
									<button class="btn btn-mini btn-danger" onclick="goDelete('<?php //echo $row['report_id'] ?>')"><i class="icon-remove icon-white"></i> Delete</button>
								</td>
							</tr>
							<?php
						}
					}else{
						echo '<tr><td colspan="12">No data found!</td></tr>';
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
		window.location.href = '<?php echo ADMIN_BASE_URL ?>accounts/treasury_document_edit/'+id;
	}
}
function goDelete(id){
	if(id != undefined){
		var conf = confirm('Do you want to delete?');
		if(conf){
			window.location.href = '<?php echo ADMIN_BASE_URL ?>accounts/treasury_document_delete/'+id;
		}
		
	}
}
</script>
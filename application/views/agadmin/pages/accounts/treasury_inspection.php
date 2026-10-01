<div class="row-fluid">
		<div class="navbar navbar-inner block-header">
			<div class="muted pull-left" style = "color:red; font-size:14px;">***Search employee first before adding into Database.    ***To add PAN No of an existing employee without PAN, contact ITSC.    ***Deactivate employee immediately on transfer, voluntary retirement or death.</div>
		</div>
		<div class="block">
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
		<div class="block">
			<div class="navbar navbar-inner block-header">
                <div class="muted pull-left">List of Treasury Inspections</div>
<!--
				<div class="header-btn-wrap">
                    <button class="btn btn-success"
                    onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>accounts/treasury_inspection_upload'">
					<i class="icon-plus icon-white"></i> Add to Inspection Master</button>
                </div>
-->
				<div class="header-btn-wrap">
                    <button class="btn btn-success"
                    onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>accounts/treasury_inspection_new'">
					<i class="icon-plus icon-white"></i>Add New Inspection ID</button>
                </div>
            </div>
			<div class="block-content collapse in">
				<div class="span12">
                  <div class="table-scroll">
					
            <table class="table table-bordered" width="585" height="54">
              <thead> 
              <tr>
								<th>Sl no.</th>
								<th>Inspection ID</th>
								<th>Inspection Year</th>
								<th>Party No</th>
								<th>Treasury</th>
								<th>Inspection Period</th> 
								<th>Inspection During</th>
								<th>Inspected for(days)</th>
								<th>District</th>
								<th>IR No </th>
								<th>IR Issue Date </th>
								<th>No Paras </th>
								<th>TI Report</th>					
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
								<td><?php echo $row['try_insp_id'] ?></td>
								<td><?php echo $row['insp_month'] ?>, <?php echo $row['insp_year'] ?></td>	
								<td><?php echo $row['insp_party_no'] ?></td>
								<td><?php echo $row['tr_nm'] ?></td>
								<td><?php echo $row['period_under_insp'] ?></td>
								<td><?php echo $row['insp_from'] ?></b> to <?php echo $row['insp_to'] ?></td>
								<td><?php echo $row['insp_days'] ?></td>
								<td><?php echo $row['dist_nm'] ?></td>
								<td><?php echo $row['try_ir_no'] ?></td> 
								<td><?php echo get_datepicker_date($row['try_ir_date']) ?></td> 
								<td><?php echo $row['nos_ir_paras'] ?></td> 
								<td>
								<?php 
									if(trim($row['ir_file_link']) != '')	{
										$ir_file_link = explode(';',$row['ir_file_link']);
										foreach($ir_file_link as $filename){
											echo '<a target="_blank" href="'.base_url().'files/agae/department/'.$filename.'"><img src="'.SITE_BASE_URL.'assets/images/PDF.png" style="max-height:40px;"/></a> &nbsp;';
										}
										
									}
								?>
								</td>							
								<td style = "width : 13%">
									
									<button class="btn btn-mini btn-primary" onclick="goEdit('<?php echo $row['try_insp_id'] ?>')"><i class="icon-pencil icon-white"></i>Update &nbsp;</button>
									<button class="btn btn-mini btn-danger" onclick="goDelete('<?php //echo $row['try_insp_id'] ?>')"><i class="icon-remove icon-white"></i>Delete &nbsp;&nbsp;</button>
								</td>
							</tr>
							<?php
						}
					}else{
						echo '<tr><td colspan="11">No data found!</td></tr>';
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
	var conf = confirm('Update first and check correctness of master record before assignment. Is it correct?');
	if(conf){
		if(id != undefined){
			window.location.href = '<?php echo ADMIN_BASE_URL ?>accounts/treasury_inspection_assignment/'+id;
		}
	}
}

function goDelete(id){
	if(id != undefined){
		var conf = confirm('Do you want to delete?');
		if(conf){
			window.location.href = '<?php echo ADMIN_BASE_URL ?>accounts/treasury_inspection_delete/'+id;
		}
		
	}
}
</script>
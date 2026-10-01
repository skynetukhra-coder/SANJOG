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
		<div class="block">
			<div class="navbar navbar-inner block-header">
                <div class="muted pull-left">List of Branches</div>
<!--
				<div class="header-btn-wrap">
                    <button class="btn btn-success"
                    onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>administration/treasury_inspection_upload'">
					<i class="icon-plus icon-white"></i> Add to Inspection Master</button>
                </div>
-->
				<div class="header-btn-wrap">
                    <button class="btn btn-success"
                    onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>administration/section_branch_add'">
					<i class="icon-plus icon-white"></i>Add New</button>
                </div>
            </div>
			<div class="block-content collapse in">
				<div class="span12">
                  <div class="table-scroll">
					
            <table class="table table-bordered" width="585" height="54">
              <thead> 
              <tr>
								<th>Sl no.</th>
								<th>Branch ID [BO INDEX]</th>
								<th>Branch</th>
								<th>Group</th>
								<th>Incharge Name</th>
								<th class="action">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
					if(count($results) > 0){
						$sl = intval($this->input->get('per_page',true)) + 1;
						foreach($results as $row){?>
							<tr>
								<td style = "width : 10%" ><?php echo $sl++ ?></td>
								<td style = "width : 10%"><?php echo $row['sec_index'] ?>  [<?php echo $row['bo_index'] ?>]</td>
								<td style = "width : 29%"><?php echo $row['section'] ?></td>	
								<td style = "width : 15%"><?php echo $row['sec_br_group'] ?></td>
								<td style = "width : 24%"><?php echo $row['officer_nm'] ?></td>	
								<td style = "width : 12%">
									<button class="btn btn-mini btn-primary" onclick="goEdit('<?php echo $row['section_id'] ?>')"><i class="icon-pencil icon-white"></i> Edit &nbsp;</button>
									<button class="btn btn-mini btn-danger" onclick="goDelete('<?php //echo $row['section_id'] ?>')"><i class="icon-remove icon-white"></i>Delete </button>
									<button class="btn btn-mini btn-warning" onclick="goLink('<?php echo $row['section_id'] ?>')"><i class="icon-pencil icon-white"></i> Edit Link Charge &nbsp;&nbsp;</button>
								</td>
							</tr>
							<?php
						}
					}else{
						echo '<tr><td colspan="6">No data found!</td></tr>';
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
		window.location.href = '<?php echo ADMIN_BASE_URL ?>administration/section_branch_edit/'+id;
	}
}
function goLink(id,type){
	if(id != undefined){
		window.location.href = '<?php echo ADMIN_BASE_URL ?>administration/section_branch_link/'+id;
	}
}
function goDelete(id){
	if(id != undefined){
		var conf = confirm('Do you want to delete?');
		if(conf){
			window.location.href = '<?php echo ADMIN_BASE_URL ?>administration/treasury_inspection_delete/'+id;
		}
		
	}
}
</script>
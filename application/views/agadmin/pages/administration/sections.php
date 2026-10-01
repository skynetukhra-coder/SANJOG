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
                <div class="muted pull-left">List of Sections</div>
<!--
				<div class="header-btn-wrap">
                    <button class="btn btn-success"
                    onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>administration/treasury_inspection_upload'">
					<i class="icon-plus icon-white"></i> Add to Inspection Master</button>
                </div>
				<div class="header-btn-wrap">
                    <button class="btn btn-success"
                    onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>administration/section_add'">
					<i class="icon-plus icon-white"></i>Add New Section</button>
                </div>
-->
            </div>
			<div class="block-content collapse in">
				<div class="span12">
                  <div class="table-scroll">
					
            <table class="table table-bordered" width="585" height="54">
              <thead> 
              <tr>
								<th>Sl no.</th>
								<th>Section ID</th>
								<th>Section</th>
								<th>Branch Officer ID</th>
								<th>Link BO ID</th>
							</tr>
						</thead>
						<tbody>
							<?php
					if(count($results) > 0){
						$sl = intval($this->input->get('per_page',true)) + 1;
						foreach($results as $row){?>
							<tr>
								<td style = "width : 15%" ><?php echo $sl++ ?></td>
								<td style = "width : 15%"><?php echo $row['sec_index'] ?></td>
								<td><?php echo $row['section'] ?></td>
								<td><?php echo $row['bo_index'] ?></td>
								<td><?php echo $row['link_bo_index'] ?></td>
							</tr>
							<?php
						}
					}else{
						echo '<tr><td colspan="5">No data found!</td></tr>';
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
		window.location.href = '<?php echo ADMIN_BASE_URL ?>administration/section_edit/'+id;
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
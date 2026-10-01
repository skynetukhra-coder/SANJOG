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
			<<div class="navbar navbar-inner block-header">
                <div class="muted pull-left">List of Officers' Signatures</div>
<!--
				<div class="header-btn-wrap">
                    <button class="btn btn-success"
                    onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>gpf/treasury_inspection_upload'">
					<i class="icon-plus icon-white"></i> Add to Inspection Master</button>
                </div>
-->
				<div class="header-btn-wrap">
                    <button class="btn btn-success"
                    onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>gpf/signature_master_new'">
					<i class="icon-plus icon-white"></i>Add New Signature ID</button>
                </div>
            </div>
			<div class="block-content collapse in">
				<div class="span12">
                  <div class="table-scroll">
					
				<table class="table table-bordered" width="585" height="54">
						<thead> 
							<tr>
								<th>lD No.</th>
								<th>Desg Code</th>
								<th>Designation</th>
								<th>Series</th>
								<th>Year</th>
								<th>FY End Date</th>
								<th>Name(English)</th>
								<th>Name(Hindi)</th>
								<th>Signature Tag</th>
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
								<td><?php echo $row['desig_code'] ?></td>
								<td><?php echo $row['officer_desig'] ?></td>
								<td><?php echo $row['series'] ?></td>
								<td><?php echo Date('Y',strtotime($row['statement_year'])) ?></td>
								<td><?php echo get_datepicker_date($row['statement_year']) ?></td>
								<td><?php echo $row['officer_name'] ?></td>
								<td><?php echo $row['officer_name_hindi'] ?></td>
								<td>
								<?php
									if(trim($row['sign_tag']) != ''){
										$attachments = explode(';',$row['sign_tag']);
										foreach($attachments as $filename){
											echo '<a target="_blank" href="'.base_url().'files/agae/signature/'.$filename.'">'.$filename.'</a> &nbsp; &nbsp; &nbsp; &nbsp;';
										}
										
									}
								?>
								</td>							
								<td style = "width: 7%">
								<?php
									if(Date('Y',strtotime($row['statement_year'])) >= Date('Y') || Date('Y',strtotime($row['statement_year'])) == '1970'){
								?>
									<button class="btn btn-mini btn-primary" onclick="goEdit('<?php echo $row['sec_off_id'] ?>')"><i class="icon-pencil icon-white"></i> Update</button>
<!--								<button class="btn btn-mini btn-danger" onclick="goDelete('<?php //echo $row['tinsp_id'] ?>')"><i class="icon-remove icon-white"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Delete &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>		-->
								<?php
									}
								?>
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
		window.location.href = '<?php echo ADMIN_BASE_URL ?>gpf/signature_master_edit/'+id;
	}
}
function goDelete(id){
	if(id != undefined){
		var conf = confirm('Do you want to delete?');
		if(conf){
			window.location.href = '<?php echo ADMIN_BASE_URL ?>gpf/signature_master_delete/'+id;
		}
		
	}
}
</script>
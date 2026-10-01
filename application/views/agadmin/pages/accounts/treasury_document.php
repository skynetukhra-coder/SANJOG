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
				<div class="muted pull-left">List of Treasury Files</div>
				<div class="pull-right block-header-btn">
					<button class="btn btn-success" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>accounts/treasury_document_add'"><i class="icon-plus icon-white"></i> Add Files To Treasury Concerned</button>
				</div>
			</div>
			<div class="block-content collapse in">
				<div class="span12">
                  <div class="table-scroll">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Sl no.</th>
								<th>Order / Upload Date</th>
								<th>Try Code</th>
								<th>Year</th>
								<th>Type</th>
								<th>Title / Period</th>
								<th>Details</th>
								<th>Attachment</th>
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
								<td><?php echo get_datepicker_date($row['order_date']) ?></td>
								<td><?php echo $row['treasury_code'] ?></td>
								<td><?php echo $row['dmonth'] ?>  <?php echo $row['dyear'] ?></td>
								<td><?php echo $row['order_type'] ?></td>
								<td><?php echo $row['title'] ?></td>
								<td><?php echo $row['details'] ?></td>
								<td>
									<?php 
										if(trim($row['attachment']) != '')	{
											$attachments = explode(';',$row['attachment']);
											foreach($attachments as $filename){
												echo '<a target="_blank" href="'.base_url().'files/agae/department/'.$filename.'"><img src="'.SITE_BASE_URL.'assets/images/PDF.png" style="max-height:40px;"/></a> &nbsp;';
											}
										}
									?>
								</td>
								<td>
									<button class="btn btn-mini btn-primary" onclick="goEdit('<?php echo $row['file_id'] ?>')"><i class="icon-pencil icon-white"></i> Edit</button>
									<button class="btn btn-mini btn-danger" onclick="goDelete('<?php echo $row['file_id'] ?>')"><i class="icon-remove icon-white"></i> Delete</button>
								</td>
							</tr>
							<?php
						}
					}else{
						echo '<tr><td colspan="8">No data found!</td></tr>';
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
		var conf = confirm('Do not upload file once uploaded, unless you want to replace it. Do you want to continue?');
		if(conf){
			window.location.href = '<?php echo ADMIN_BASE_URL ?>accounts/treasury_document_edit/'+id;
		}
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
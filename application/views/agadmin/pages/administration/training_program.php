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
                <div class="muted pull-left">List of Training</div>
				<div class="header-btn-wrap">
                    <button class="btn btn-success"
                    onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>administration/training_master_upload'">
					<i class="icon-plus icon-white"></i> Add to Training Master</button>
                </div>
            </div>
			<div class="block-content collapse in">
				<div class="span12">
                  <div class="table-scroll">
					
            <table class="table table-bordered" width="585" height="54">
              <thead> 
              <tr>
								<th>Sl no.</th>
								<th>Year</th>
								<th>Order_Date</th>
								<th>Order</th>
								<th>Mode</th>
								<th>Type</th>
								<th>ID- Title</th>
								<th>Description</th>
								<th>Location</th>
								<th>Training_Period</th>
								<th>Training_Time</th>
<!--								<th>Attachment</th>					-->
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
								<td><?php echo $row['fin_year'] ?></td>	
								<td><?php echo date('d-m-Y',strtotime($row['order_date'])) ?></td>
								<td><?php echo $row['training_order'] ?></td>
								<td><?php echo $row['training_mode'] ?></td>								
								<td><?php echo $row['training_type'] ?></td>
								<td><b><?php echo $row['trang_id'] ?></b>--<?php echo $row['title'] ?></td>
								<td><?php echo $row['description'] ?></td>
								<td><?php echo $row['location'] ?></td>
								<td><?php echo date('d-m-Y',strtotime($row['training_from'])) ?> to <?php echo date('d-m-Y',strtotime($row['training_to'])) ?></td> 
								<td><?php echo $row['trg_time'] ?></td> 
<!--								<td>
								<?php 
									if(trim($row['attachment']) != '')	{
										$attachments = explode(';',$row['attachment']);
										foreach($attachments as $filename){
											echo '<a target="_blank" href="'.base_url().'files/'.$filename.'">'.$filename.'</a> &nbsp; &nbsp; &nbsp; &nbsp;';
										}
										
									}
								?>
								</td>
-->								
								<td>
									<button class="btn btn-mini btn-primary" onclick="goEdit('<?php echo $row['trang_id'] ?>')"><i class="icon-pencil icon-white"></i> Allot ( Trainees )</button><br></br>
									<button class="btn btn-mini btn-success" onclick="FgoEdit('<?php echo $row['trang_id'] ?>')"><i class="icon-pencil icon-white"></i> Assign (Faculty)</button><br></br>
									<button class="btn btn-mini btn-danger" onclick="goDelete('<?php //echo $row['trang_id'] ?>')"><i class="icon-remove icon-white"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Delete &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
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
	if(id != undefined){
		window.location.href = '<?php echo ADMIN_BASE_URL ?>administration/training_assignment/'+id;
	}
}
function FgoEdit(id,type){
	if(id != undefined){
		window.location.href = '<?php echo ADMIN_BASE_URL ?>administration/faculty_assignment/'+id;
	}
}
function goDelete(id){
	if(id != undefined){
		var conf = confirm('Do you want to delete?');
		if(conf){
			window.location.href = '<?php echo ADMIN_BASE_URL ?>admin/training_program_delete/'+id;
		}
		
	}
}
</script>
<div class="row-fluid">
	<div class="span12" id="content">
			<div class="row-fluid">
				<div class="navbar navbar-inner block-header">
					<div class="muted pull-left" style = "color:blue; font-size:18px;">
						<marquee direction="left"  onMouseOver="this.stop()" onMouseOut="this.start()">
						*** Upload One Circular / Office Order for once. An All Circular can be assigned to selected employee(s) also by editing the same as instructed below.  
						*** If the uploaded All Circular / Office Order  is not visible contact IT Support Cell before uploading the same again.  
						*** Please  upload pdf file of the All Circular / Office Order for one time only and use link for other purposes for better disk space management in the web-server.
						*** Edit the All Circular/ Office Order only if the pdf file is required to be replaced or other information is required to be updated.
						*** Please avoid multiple uploading of an All Circular / Office Order.
						</marquee>
					</div>
				</div>
			</div>
			<div class="navbar navbar-inner block-header">
				<div class="muted pull-left" style = "color:red; font-size:14px;">To send a copy of an All Circular (Common Order to all employees) to certain employee(s), (i) Add the same to "All Eemployee" first, (ii) Go to the "Employee Concerned" tab and (iii) Edit the same to assign it to the employee(s).</div>
			</div>
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
				<div class="muted pull-left">List of Order / Documents</div>
				<div class="pull-right block-header-btn">
					<button class="btn btn-success" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>admin_ii/document_order_add'"><i class="icon-plus icon-white"></i> Add Document to All Employee</button>
				</div>
			</div>
			<div class="block-content collapse in">
				<div class="span12">
                  <div class="table-scroll">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Sl no.</th>
								<th>Order Date</th>
								<th>Wing</th>
								<th>Title</th>
								<th>Description</th>
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
								<td><?php echo date('d-m-Y',strtotime($row['order_dt'])) ?></td>
								<td><?php echo $row['wing'] ?></td>
								<td><?php echo $row['title'] ?></td>
								<td><?php echo $row['details'] ?></td>
								<td>
								<?php
									if(trim($row['attachment']) != '')	{
										$attachments = explode(';',$row['attachment']);
										foreach($attachments as $filename){
											echo '<a target="_blank" href="'.base_url().'files/agae/circular_order/'.$filename.'"><img src="'.SITE_BASE_URL.'assets/images/PDF.png" style="max-height:40px;"/></a> &nbsp; &nbsp; &nbsp; &nbsp;';
										}
										
									}
								?>
								</td>
								<td>
									<button class="btn btn-mini btn-primary" onclick="goEdit('<?php echo $row['order_id'] ?>')"><i class="icon-pencil icon-white"></i> Edit</button>
									<button class="btn btn-mini btn-danger" onclick="goDelete('<?php //echo $row['order_id'] ?>')"><i class="icon-remove icon-white"></i> Delete</button>
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
			window.location.href = '<?php echo ADMIN_BASE_URL ?>admin_ii/document_order_edit/'+id;
		}
	}
}
function goDelete(id){
	if(id != undefined){
		var conf = confirm('Do you want to delete?');
		if(conf){
			window.location.href = '<?php echo ADMIN_BASE_URL ?>admin_ii/document_order_delete/'+id;
		}
		
	}
}
</script>
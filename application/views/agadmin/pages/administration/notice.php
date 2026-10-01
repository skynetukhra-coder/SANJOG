<div class="row-fluid">
	<div class="navbar navbar-inner block-header">
		<div class="muted pull-left" style = "color:red; font-size:14px;">***Search Notice with title key word and edit the same. *** Add, if not exit. </div>
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
</div>
<div class="row-fluid">
  <div class="span12" id="content">
    <div class="block">
      <div class="navbar navbar-inner block-header">
        <div class="muted pull-left">Office Notice</div>
		<div class="pull-right block-header-btn"><button class="btn btn-success" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>administration/notice_add'"><i class="icon-plus icon-white"></i>Add</button></div>
      </div>
      <div class="block-content collapse in">
        <div class="span12">
         <div class="table-scroll">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>#</th>
				<th>Title</th>
				<th>File Name</th>
				<th>Expiry Date</th>
				<th>Upload Date</th>
				<th>Display</th>
				<th>Flash</th>
				<th class="action">Action</th>
              </tr>
            </thead>
            <tbody>
			  	<?php
					if(count($results) > 0){
						$sl = 1;
						foreach($results as $row){?>
						 <tr>
						 	<td><?php echo $sl++ ?></td>
							<td><?php echo $row['title'] ?></td>
							<td><a href="<?php echo base_url().'files/agae/tender_whatsnew/'.$row['link_file'] ?>" target="_blank"><?php echo $row['link_file'] ?></a></td>
							<td><?php echo isset($row['expiry_dt']) && $row['expiry_dt'] != '0000-00-00' ? date('d-m-Y',strtotime($row['expiry_dt'])) : ''; ?></td>
							<td><?php echo  get_datepicker_date($row['create_dt'])?></td>
							<td><?php echo  ucwords($row['display'])?></td>
							<td><?php echo  ucwords($row['flash'])?></td>
							<td>
								<button class="btn btn-mini btn-primary" onclick="goEdit('<?php echo $row['notice_id'] ?>')"><i class="icon-pencil icon-white"></i> Edit</button>
								<button class="btn btn-mini btn-danger" onclick="goDelete('<?php //echo $row['notice_id'] ?>')"><i class="icon-remove icon-white"></i> Delete</button>
							</td>
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
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
function goEdit(id,type){
	if(id != undefined){
		window.location.href = '<?php echo ADMIN_BASE_URL ?>administration/notice_edit/'+id;
	}
}
function goDelete(id){
	if(id != undefined){
		var conf = confirm('Do you want to delete?');
		if(conf){
			window.location.href = '<?php echo ADMIN_BASE_URL ?>administration/notice_delete/'+id;
		}
		
	}
}
</script>
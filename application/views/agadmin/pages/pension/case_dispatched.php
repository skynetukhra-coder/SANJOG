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
        <div class="muted pull-left">List of Pension Dispatched Status</div>
		<div class="header-btn-wrap"><button class="btn btn-success" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>pension/case_dispatched_upload'"><i class="icon-upload icon-white"></i> Upload CSV</button></div>
      </div>
      <div class="block-content collapse in">
        <div class="span12">
         <div class="table-scroll">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>&nbsp;</th>
				<th>#</th>
                <th>Inout appln pk</th>
				<th>Return Memo No </th>
				<th>Outward Type</th>
				<th>Dispatched Artical No</th>
                <th>Dispatched Mode</th>
				<th>Recipient</th>
				<th>Receipient Address</th>
              </tr>
            </thead>
            <tbody>
			  	<?php
					if(count($results) > 0){
						$sl = intval($this->input->get('per_page',true)) + 1;
						foreach($results as $row){?>
						 <tr>
						 	<td style="width:10px"><button class="btn btn-small btn-primary" onclick="get_details('<?php echo $row['inout_appln_pk'] ?>','<?php echo $row['inout_out_type']?>')"><i class="icon-plus icon-white"></i></button></td>
						 	<td><?php echo $sl++ ?></td>
							<td><?php echo $row['inout_appln_pk'] ?></td>
							<td><?php echo $row['inout_no'] ?></td>
							<td>
							<?php 
								if(trim($row['inout_out_type']) == 'X'){
									echo '"X" - PPO dispatch.';
								}else if(trim($row['inout_out_type']) == 'A'){
									echo '"A" - PSA dispatch.';
								}else if(trim($row['inout_out_type']) == 'R'){
									echo '"R" - Return to PSA.';
								}
							?>
							</td>
							<td><?php echo $row['inout_dispatch_artical_no'] ?></td>
							<td><?php echo $row['f_get_lov_name_inout_dispatch_mode'] ?></td>
							<td><?php echo $row['inout_sndr_name'] ?></td>
							<td><?php echo $row['inout_out_address'] != '' ? $row['inout_out_address'] : $row['address_1'] ?></td>
						</tr>
				<?php
						}
					}else{
						echo '<tr><td colspan="9">No data found!</td></tr>';
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
<script>
function get_details(id,type){
	if(id == undefined || type == undefined){
		alert('Wrong input!');
	}
	$.get('<?php echo base_url()?>admin/pension/case_dispatched_details/'+id+'/'+type,function(data){
		 var obj = $.parseJSON(data);
		 if(obj.success == false){
		 	alert(obj.msg);
		 }
		 var details = obj.details;
		 var html = '<table>';
		 for(row in details){
		 	if(row != 'p_d_id'){
		 	 	html += '<tr><td>'+row.toUpperCase()+'</td><td>'+details[row]+'</td><tr>';
			}
		 }
		 html += '</table>';
		 $('#row_details').html(html);
		 $("#myModal").modal("toggle");
	});
}
</script>
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
        <div class="muted pull-left">List of Pension Cases Status</div>
		<div class="header-btn-wrap"><button class="btn btn-success" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>pension/case_status_upload'"><i class="icon-upload icon-white"></i> Upload CSV</button></div>
      </div>
      <div class="block-content collapse in">
        <div class="span12">
         <div class="table-scroll">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>&nbsp;</th>
				<th>#</th>
                <th>Application No</th>
				<th>Name</th>
				<th>DOA</th>
				<th>DOB</th>
				<th>Mobile</th>
                <th>Designation</th>
                <th>Case Type</th>
				<th>Status</th>
              </tr>
            </thead>
            <tbody>
			  	<?php
					if(count($results) > 0){
						$sl = intval($this->input->get('per_page',true)) + 1;
						foreach($results as $row){?>
						 <tr>
						 	<td style="width:10px"><button class="btn btn-small btn-primary" onclick="get_details('<?php echo $row['application_no'] ?>')"><i class="icon-plus icon-white"></i></button></td>
						 	<td><?php echo $sl++ ?></td>
							<td><?php echo $row['application_no'] ?></td>
							<td><?php echo $row['pnsr_name'] ?></td>
							<td><?php echo $row['apen_doa'] ?></td>
							<td><?php echo $row['apen_dob'] ?></td>
							<td><?php echo $row['mobile_no'] != '' ? $row['mobile_no'] : $row['mobile_num'] ?></td>
							<td><?php echo $row['designation'] ?></td>
							<td><?php echo $row['case_type'] ?></td>
							<td><?php echo $row['status_des'] ?></td>
						</tr>
				<?php
						}
					}else{
						echo '<tr><td colspan="10">No data found!</td></tr>';
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
function get_details(id){
	if(id == undefined){
		alert('Wrong input!');
	}
	$.get('<?php echo base_url()?>admin/pension/case_status_details/'+id,function(data){
		 var obj = $.parseJSON(data);
		 if(obj.success == false){
		 	alert(obj.msg);
		 }
		 var details = obj.details;
		 var html = '<table>';
		 var i = 0;
		 for(row in details){
		 	if(row != 'p_c_id'){
		 	 	html += '<tr><td>'+row.toUpperCase()+'</td><td>'+details[row]+'</td><tr>';
			}
		 }
		 html += '</table>';
		 $('#row_details').html(html);
		 $("#myModal").modal("toggle");
	});
}
</script>
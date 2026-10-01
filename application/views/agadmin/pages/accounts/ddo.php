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
        <div class="muted pull-left">List of DDO Office</div>
		<div class="header-btn-wrap"><button class="btn btn-success" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>accounts/ddo_upload'"><i class="icon-upload icon-white"></i> Upload CSV</button></div>
      </div>
      <div class="block-content collapse in">
        <div class="span12">
         <div class="table-scroll">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>#</th>
                <th>DDO Code</th>
                <th>Name</th>
				<th>Treasury</th>
                <th>Email</th>
				<th>Mobile</th>
				<th>Last Login</th>
				<th>Action</th>
              </tr>
            </thead>
            <tbody>
			  	<?php
					if(count($results) > 0){
						$sl = intval($this->input->get('per_page',true)) + 1;
						foreach($results as $row){?>
						 <tr>
						 	<td><?php echo $sl++ ?></td>
							<td><?php echo $row['ddo_cd'] ?></td>
							<td><?php echo $row['ddo_desc'] ?></td>
							<td><?php echo $row['tr_cd'] ?></td>
							<td><?php echo $row['emailid'] ?></td>
							<td><?php echo $row['mb_no'] ?></td>
							<td><?php echo get_datepicker_date($row['last_login']) ?></td>
							<td><button class="btn btn-mini btn-primary" onclick="goEdit('<?php echo $row['ddo_cd'] ?>')"><i class="icon-pencil icon-white"></i> Edit</button></td>
						</tr>
				<?php
						}
					}else{
						echo '<tr><td colspan="7">No data found!</td></tr>';
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
function goEdit(id){
	if(id != undefined){
		window.location.href = '<?php echo ADMIN_BASE_URL ?>accounts/ddo_edit/'+id;
	}
}
</script>
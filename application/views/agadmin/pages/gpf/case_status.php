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
        <div class="muted pull-left">List of Cases Status</div>
		<div class="header-btn-wrap"><button class="btn btn-success" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>gpf/case_status_upload'"><i class="icon-upload icon-white"></i> Upload Case Status</button></div>
      </div>
      <div class="block-content collapse in">
        <div class="span12">
         <div class="table-scroll">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>#</th>
                <th>Financial Year</th>
				<th>GPF A/C</th>
                <th>Name</th>
                <th>Designation</th>
                <th>Case Type</th>
				<th>Receipt Date</th>
				<th>Referance</th>
				<th>Authority</th>
              </tr>
            </thead>
            <tbody>
			  	<?php
					if(count($results) > 0){
						$sl = intval($this->input->get('per_page',true)) + 1;
						foreach($results as $row){?>
						 <tr>
						 	<td><?php echo $sl++ ?></td>
							<td><?php echo $row['f_year'] ?></td>
							<td><?php echo $row['gpf_ac_no'] ?></td>
							<td><?php echo $row['subs_name'] ?></td>
							<td><?php echo $row['designation'] ?></td>
							<td><?php echo $row['case_type'] ?></td>
							<td><?php echo $row['dt_receipt'] ?></td>
							<td><?php echo $row['reference'] ?></td>
							<td><?php echo $row['authority'] ?></td>
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
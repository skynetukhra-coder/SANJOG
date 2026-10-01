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
        <div class="muted pull-left">Pension</div>
		<div class="header-btn-wrap"><button class="btn btn-success" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>pension/pension_upload'"><i class="icon-upload icon-white"></i> Upload CSV</button></div>
      </div>
      <div class="block-content collapse in">
        <div class="span12">
         <div class="table-scroll">
          <table class="table table-bordered">
            <thead>
              <tr>
				<th>#</th>
                <th>Application No</th>
				<th>Pension Date</th>
				<th>EFP Date</th>
                <th>FP Date</th>
              </tr>
            </thead>
            <tbody>
			  	<?php
					if(count($results) > 0){
						$sl = intval($this->input->get('per_page',true)) + 1;
						foreach($results as $row){?>
						 <tr>
							<td><?php echo $sl++ ?></td>
							<td><?php echo $row['apa_appln_pk'] ?></td>
							<td><?php echo $row['pension_date'] ?></td>
							<td><?php echo $row['efp_date'] ?></td>
							<td><?php echo $row['fp_date'] ?></td>
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
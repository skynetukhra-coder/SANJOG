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
				<label class="control-label">Series</label>
				<div class="controls">
				 <input type="text" name="series" value="<?php echo $this->input->get('series',true)?>" placeholder="Series"/>
				</div>
			  </div>
			  <div class="control-form">
				<label class="control-label">AC Code</label>
				<div class="controls">
				 <input type="text" name="ac_code" value="<?php echo $this->input->get('ac_code',true)?>" placeholder="Ac code"/>
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
        <div class="muted pull-left">List of Part I Data</div>
		<div class="header-btn-wrap"><button class="btn btn-success" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>gpf/part_1_upload_temp'"><i class="icon-upload icon-white"></i> Upload Part I Data</button></div>
      </div>
      <div class="block-content collapse in">
        <div class="span12">
         <div class="table-scroll">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>#</th>
                <th>Year</th>
                <th>Series</th>
				<th>Ac Code</th>
                <th>Name</th>
                <th>Basic</th>
				<th>Int</th>
				<th>Nomi.</th>
              </tr>
            </thead>
            <tbody>
			  	<?php
					if(count($results) > 0){
						$sl = intval($this->input->get('per_page',true)) + 1;
						foreach($results as $row){?>
						 <tr>
							<td><?php echo $sl++ ?></td>
							<td><?php echo date(DATE_FORMAT,strtotime($row['fyear']))?></td>
							<td><?php echo $row['series']?></td>
							<td><?php echo $row['ac_code']?></td>
							<td><?php echo $row['sub_name']?></td>
							<td><?php echo $row['basic_pay']?></td>
							<td><?php echo $row['int_rate']?></td>
							<td><?php echo $row['nomination']?></td>
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
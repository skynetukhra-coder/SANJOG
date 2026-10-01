<div class="row-fluid">
	
  <div class="span12" id="content">
  	<div class="block" style="padding:10px 0; border-top:1px solid #ccc">
		<div class="block-content">
			<form method="get">
			  <div class="control-form">
				<label class="control-label">APA APPLN PK</label>
				<div class="controls">
				 <input type="text" name="apa_appln_pk" value="<?php echo $this->input->get('apa_appln_pk',true)?>" placeholder="Search ......."/>
				</div>
			  </div>
			  <div class="control-form">
				<label class="control-label">PPO NO</label>
				<div class="controls">
				 <input type="text" name="ppo_no" value="<?php echo $this->input->get('ppo_no',true)?>" placeholder="Search ......."/>
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
	<div class="navbar navbar-inner block-header">
		<div class="muted pull-left" style = "color:red; font-size:14px;">***Search BY "APA APPLN PK" to find more than one PPO No.    ***Thereafter, Delete the appropriate record.</div>
	</div>
    <div class="block">
      <div class="navbar navbar-inner block-header">
        <div class="muted pull-left">List of Pensionrs PPO No</div>
		<div class="header-btn-wrap">
            <button class="btn btn-warning" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>pension/ppo_duplicate'"> <i class="icon-download icon-white"></i> Download Duplicate PPO list</button>
         </div>
		<div class="header-btn-wrap"><button class="btn btn-success" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>pension/ppo_upload'"><i class="icon-upload icon-white"></i> Upload CSV</button></div>
      </div>
      <div class="block-content collapse in">
        <div class="span12">
          <div class="table-scroll">
           <table class="table table-bordered">
            <thead>
              <tr>
                <th>#</th>
				<th>APA APPLN PK</th>
				<th style="text-align:left">PPO NO</th>
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
							<td><?php echo $row['apa_appln_pk'] ?></td>
							<td><?php echo $row['ppo_no'] ?></td>
							<td>
								<button class="btn btn-mini btn-danger" onclick="goDelete('<?php echo $row['p_p_id'] ?>')"><i class="icon-remove icon-white"></i> Delete</button>
							</td>
						</tr>
				<?php
						}
					}else{
						echo '<tr><td colspan="3">No data found!</td></tr>';
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

function goDelete(id){
	if(id != undefined){
		var conf = confirm('Do you want to delete this PPO record?');
		if(conf){
			window.location.href = '<?php echo ADMIN_BASE_URL ?>pension/ppo_delete/'+id;
		}
		
	}
}
</script>
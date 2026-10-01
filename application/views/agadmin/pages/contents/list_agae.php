<div class="row-fluid">
  <div class="span12" id="content">
  	<div class="block" style="padding:10px 0; border-top:1px solid #ccc">
		<div class="block-content">
			<form method="get">
			<?php
			if($this->session->userdata('admin_details')['admin_type_name'] == 'superadmin'){?>
				<div class="control-form">
					<label class="control-label">Wing</label>
					<div class="controls">
					  <select name="wing" class="span12 m-wrap" >
						<option value="all" <?php echo $this->input->get('wing') == 'all' ? 'selected' : '' ?> >All Wing</option>
						<option value="administration" <?php echo $this->input->get('wing') == 'administration' ? 'selected' : '' ?> >Administration</option>
						<option value="accounts" <?php echo $this->input->get('wing') == 'accounts' ? 'selected' : '' ?>  >Accounts</option>
						<option value="fund" <?php echo $this->input->get('wing') == 'fund' ? 'selected' : '' ?> >Fund</option>
						<option value="pension" <?php echo $this->input->get('wing') == 'pension' ? 'selected' : '' ?> >Pension</option>
					  </select>
					</div>
				  </div>
		  <?php
		  }?>
			  <div class="control-form">
				<label class="control-label">Page Name</label>
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
        <div class="muted pull-left">List of Contents for <?php echo $this->lang->line('agae'); ?></div>
		<div class="pull-right block-header-btn"><button class="btn btn-success" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>pages/add_agae'"><i class="icon-plus icon-white"></i> Add Page</button></div>
      </div>
      <div class="block-content collapse in">
        <div class="span12">
         <div class="table-scroll">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>#</th>
                <th>Page Name</th>
                <th>URL</th>
				<th>Type</th>
                <th>Status</th>
				<th>Wing</th>
                <th class="action">Action</th>
              </tr>
            </thead>
            <tbody>
			  	<?php
					if(count($results) > 0){
						$sl = intval($this->input->get('per_page',true)) + 1;
						foreach($results as $row){?>
						 <tr>
							<td><?php echo $sl++?></td>
							<td><?php echo $row['page_name']?></td>
							<td><?php 
								if($row['type'] == 'LINK'){
									if($row['filename'] != ''){
										echo '<a href="'.$row['filename'].'" target="_blank">'.$row['filename'].'</a>';
									}
								}else{
									echo !empty($row['page_url']) ? '<a href="'.AGAE_BASE_URL.'page/'.$row['page_url'].'" target="_blank">'.AGAE_BASE_URL.'page/'.$row['page_url'].'</a>' : '';
								}
								?></td>
							<td><?php echo $row['type']?></td>
							<td><?php echo $row['status']?></td>
							<td><?php echo trim($row['wing']) == '' ? '' : ucfirst($row['wing'])?></td>
							<td>
								<button class="btn btn-mini btn-primary" onclick="goEdit('<?php echo $row['page_id'] ?>','<?php echo $row['type']?>')"><i class="icon-pencil icon-white"></i> Edit</button>
								<button class="btn btn-mini btn-danger" onclick="goDelete('<?php echo $row['page_id'] ?>')"><i class="icon-remove icon-white"></i> Delete</button>
							</td>
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
function goEdit(id,type){
	if(id != undefined){
		if(type == 'BLOG'){
			window.location.href = '<?php echo ADMIN_BASE_URL ?>blogs/edit/'+id;
		}else if(type == 'LINK'){
			window.location.href = '<?php echo ADMIN_BASE_URL ?>links/edit_agae/'+id;
		}else{
			window.location.href = '<?php echo ADMIN_BASE_URL ?>pages/edit_agae/'+id;
		}
	}
}
function goDelete(id){
	if(id != undefined){
		var conf = confirm('Do you want to delete?');
		if(conf){
			window.location.href = '<?php echo ADMIN_BASE_URL ?>pages/delete_agae/'+id;
		}
		
	}
}
</script>
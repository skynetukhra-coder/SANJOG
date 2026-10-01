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
        <div class="muted pull-left">List of Tender Notice</div>
        <div class="header-btn-wrap">
		<button class="btn btn-success" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>praggssa/tender_notice_add'"><i class="icon-plus icon-white"></i> Add Tender Notice</button>
        </div>
      </div>
      <div class="block-content collapse in">
        <div class="span12">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Sl no.</th>
                <th>Date</th>
				<th>Description</th>
				<th style="text-align:center;" >URL / FILE</th>
				<th style="text-align:center;" >Closing Date</th>
				<th class="action" style="text-align:center;" >Action</th>
              </tr>
            </thead>
            <tbody>
			  	<?php
					if(count($results) > 0){
						$sl = intval($this->input->get('per_page',true)) + 1;
						foreach($results as $row){?>
						 <tr>
						 	<td><?php echo $sl++ ?></td>
							<td><?php echo date(DATE_FORMAT,strtotime($row['f_year'])) ?></td>
							<td><?php echo $row['description'] ?></td>
							<td style="text-align:center;">
							<?php
							if(trim($row['url_link']) != ''){
								echo '<a target="_blank" href="'.$row['url_link'].'" target="_blank">Open URL</a><br/>';
							}
							else if(trim($row['pdf_name']) != ''){
								echo '<a href="'.base_url().'files/gssa/'.$row['pdf_name'].'" target="_blank">'.$row['pdf_name'].'</a>';
							}?>
							</td>
							<td><?php echo isset($row['closing_date']) ? date('d-m-Y',strtotime($row['closing_date'])) : '' ?></td>
							<td><button class="btn btn-mini btn-primary" onclick="goEdit('<?php echo $row['tender_id'] ?>')"><i class="icon-pencil icon-white"></i> Edit</button>&nbsp;<button class="btn btn-mini btn-danger" onclick="goDelete('<?php echo $row['tender_id'] ?>')"><i class="icon-pencil icon-white"></i> Delete</button></td>
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
		<div class="pagination"><?php echo $this->pagination->create_links();?></div>
		
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
function goEdit(id,type){
	if(id != undefined){
		window.location.href = '<?php echo ADMIN_BASE_URL ?>praggssa/tender_notice_edit/'+id;
	}
}
function goDelete(id){
	if(id != undefined){
		var conf = confirm('Do you want to delete?');
		if(conf){
			window.location.href = '<?php echo ADMIN_BASE_URL ?>praggssa/tender_notice_delete/'+id;
		}
		
	}
}
</script>
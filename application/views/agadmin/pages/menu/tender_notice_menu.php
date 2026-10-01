<style type="text/css">
.table tr.small td{
	padding:2px 10px;
}
.table tr.small:hover{
	background:#f4f1f1;
}
.table tr.root-parent td{
	background:#ccc;
}
</style>
<div class="row-fluid">
  <div class="span12" id="content">
    <div class="block">
      <div class="navbar navbar-inner block-header">
        <div class="muted pull-left" style="color:#000000; font-size:18px;">Tender Notice</div>
		<div class="pull-right block-header-btn"><button class="btn btn-success" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>menu/tender-notice-add'"><i class="icon-plus icon-white"></i> Add</button></div>
      </div>
      <div class="block-content collapse in">
        <div class="span12">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Name</th>
				<th>Page / Url</th>
				<th>Sort</th>
				<th>Status</th>
                <th class="action">Action</th>
              </tr>
            </thead>
            <tbody>
			  	<?php
					$sl = 1;
					function callsub($sub,$parent_id = 0,$inner){
									$submenu = $sub[$parent_id];
									$sb = 1;
									++$inner;
									foreach($submenu as $r){?>
										 <tr class="small">
											<td><?php echo str_repeat('-----',$inner).'&nbsp;'.$r['menu_name']?></td>
											<td>
												<?php 
													if(trim($r['url_link']) != ''){
														echo '<a target="_blank" href="'.$r['url_link'].'">'.$r['url_link'].'</a>';
													}else if(trim(strtolower($r['type'])) == 'link'){
														if($r['filename'] != ''){
															echo '<a href="'.$r['filename'].'" target="_blank">'.$r['filename'].'</a>';
														}
													}else{
														echo trim($r['page_url']) != '' ? '<a target="_blank" href="'.AGAE_BASE_URL.'page/'.$r['page_url'].'">'.$r['page_name'].'</a>' : ''; 
													}
												?>
											</td>
											<td><?php echo $r['sort']?></td>
											<td><?php echo $r['status']?></td>
											<td>
												<button class="btn btn-mini btn-primary" onclick="goEdit('<?php echo $r['menu_id'] ?>')"><i class="icon-pencil icon-white"></i> Edit</button>
												<button class="btn btn-mini btn-danger" onclick="goDelete('<?php echo $r['menu_id'] ?>')"><i class="icon-remove icon-white"></i> Delete</button>
											</td>
										</tr>
							<?php 
										if(isset($sub[$r['menu_id']])){
											//++$inner;
											callsub($sub,$r['menu_id'],$inner);
										}
									}
								}
					if(count($results) > 0){
						
						foreach($results as $row){?>
						 <tr class="small root-parent">
							<td><?php echo $row['menu_name']?></td>
							<td><?php 
									if(trim($row['url_link']) != ''){
										echo '<a target="_blank" href="'.$row['url_link'].'">'.$row['url_link'].'</a>';
									}else if(trim(strtolower($row['type'])) == 'link'){
										if($row['filename'] != ''){
											echo '<a href="'.$row['filename'].'" target="_blank">'.$row['filename'].'</a>';
										}
									}else{
										echo trim($row['page_url']) != '' ? '<a target="_blank" href="'.AGAE_BASE_URL.'page/'.$row['page_url'].'">'.$row['page_name'].'</a>' : ''; 
									}
								?>
							</td>
							<td><?php echo $row['sort']?></td>
							<td><?php echo $row['status']?></td>
							<td>
								<button class="btn btn-mini btn-primary" onclick="goEdit('<?php echo $row['menu_id'] ?>')"><i class="icon-pencil icon-white"></i> Edit</button>
								<button class="btn btn-mini btn-danger" onclick="goDelete('<?php echo $row['menu_id'] ?>')"><i class="icon-remove icon-white"></i> Delete</button>
							</td>
						</tr>
						<?php
							if(isset($sub[$row['menu_id']])){
								// Has sub menu
								
								$inner = 1;
								callsub($sub,$row['menu_id'],$inner);
							}
						?>
				<?php
						}
					}else{
						echo '<tr><td colspan="4">No data found!</td></tr>';
					}
				?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
function goEdit(id,type){
	if(id != undefined){
		window.location.href = '<?php echo ADMIN_BASE_URL ?>menu/tender-notice-edit/'+id;
	}
}
function goDelete(id){
	if(id != undefined){
		var conf = confirm('Do you want to delete?');
		if(conf){
			window.location.href = '<?php echo ADMIN_BASE_URL ?>menu/tender-notice-delete/'+id;
		}
		
	}
}
</script>
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
	<div class="block" style="padding:10px 0; border-top:1px solid #ccc">
		<div class="block-content">
			 <form method="post" action="<?php echo ADMIN_BASE_URL ?>gpf/subscribers_profile_download">
                    <div class="control-form">
                        <label class="control-label">Profile Updated From</label>
                        <div class="controls">
                            <input type="text" name="date_from" data-required="1" class="datepicker" data-provide="datepicker" autocomplete="off" placeholder="DD-MM-YYYY" />
                        </div>
                    </div>
                    <div class="control-form">
                        <label class="control-label">To</label>
                        <div class="controls">
                            <input type="text" name="date_to"  data-required="1" class="datepicker" data-provide="datepicker" autocomplete="off" placeholder="DD-MM-YYYY" />
                        </div>
                    </div>
                    
                    <div class="control-form">
                        <label class="control-label">&nbsp;</label>
                        <div class="controls">
                            <input type="submit" value="Download Profile" />
                        </div>
                    </div>
                    <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                    <div class="clearfix"></div>
               </form>
		</div>
	</div>
</div>
    <div class="block">
      <div class="navbar navbar-inner block-header">
        <div class="muted pull-left">List of Subscribers</div>
		<div class="header-btn-wrap"><button class="btn btn-success" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>gpf/subscriber_upload'"><i class="icon-upload icon-white"></i> Upload CSV</button></div>
      </div>
      <div class="block-content collapse in">
        <div class="span12">
         <div class="table-scroll">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>#</th>
                <th>Year From</th>
                <th>Year To</th>
				<th>Series</th>
                <th>AC Code</th>
                <th>MHCD</th>
				<th>Name</th>
				<th>DOB</th>
				<th>Basic Pay</th>
				<th>Nomi.</th>
				<th>Status</th>
				<th>Login Allowed [Last Login]</th>
				<th class="action">Action</th>
              </tr>
            </thead>
            <tbody>
			  	<?php
					if(count($results) > 0){
						$sl = intval($this->input->get('per_page',true)) + 1;
						foreach($results as $row){?>
						 <tr>
						 	<td><?php echo $sl++ ?></td>
							<td><?php echo $row['year_from'] ?></td>
							<td><?php echo $row['year_to'] ?></td>
							<td><?php echo $row['series'] ?></td>
							<td><?php echo $row['ac_code'] ?></td>
							<td><?php echo $row['mhcd'] ?></td>
							<td><?php echo $row['fst_nme'] ?></td>
							<td><?php echo get_datepicker_date($row['dob']) ?></td>
							<td><?php echo $row['basic_pay'] ?></td>
							<td><?php echo $row['nomination'] ?></td>
							<td><?php echo $row['ac_status'] ?></td>
							<td><?php echo $row['account_active'] ?> - [<?php echo get_datepicker_date($row['last_login']) ?>]</td>
							<td>
							<button class="btn btn-mini btn-primary" onclick="goEdit('<?php echo $row['series'] ?>','<?php echo $row['ac_code'] ?>')"><i class="icon-pencil icon-white"></i> Edit</button>
								<?php if ($row['account_active'] == 'Y'){ ?>
										<span><button id ="updt" class="btn-mini btn-warning" 
										onclick="goDeactive('<?php echo $row['subs_id'] ?>')" ><i 
										class=""></i>Deactivate</button></span>
								<?php } 
									else { ?>
										<span><button id ="close" class="btn-mini btn-success" 
										onclick="goActive('<?php echo $row['subs_id'] ?>')" ><i 
										class=""></i>Activate</button></span>
								<?php } ?>
							</td>
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
<script type="text/javascript">

$(document).ready(function(){
	$('.datepicker').datepicker({dateFormat:'dd-mm-yy'});
});

function goEdit(series,code){
	if(series != undefined && code != undefined){
		window.location.href = '<?php echo ADMIN_BASE_URL ?>gpf/subscriber_edit/'+series+'/'+code;
	}
}
function goActive(id,type){
	if(id != undefined){
		window.location.href = '<?php echo ADMIN_BASE_URL ?>gpf/subscriber_active/'+id;
	}
}
function goDeactive(id,type){
	if(id != undefined){
		window.location.href = '<?php echo ADMIN_BASE_URL ?>gpf/subscriber_deactive/'+id;
	}
}
</script>
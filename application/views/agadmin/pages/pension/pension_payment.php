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
	<div class="row-fluid">
    <div class="span12" id="filter-content">
        <div class="block">
            <div class="block-content">
                <form method="post" action="<?php echo ADMIN_BASE_URL ?>pension/payment_records_download">
                    <div class="control-form">
                        <label class="control-label">From </label>
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
                            <input type="submit" value="Download Records" />
                        </div>
                    </div>
                    <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                    <div class="clearfix"></div>
                </form>
            </div>
		  </div>
		</div>
	</div>
	
	<div class="block">
			<div class="navbar navbar-inner block-header">
				<div class="muted pull-left">List of Pension Payment Documents</div>
			</div>
			<div class="block-content collapse in">
				<div class="span12">
                  <div class="table-scroll">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Sl no.</th>
								<th>Appliction Date</th>
								<th>Name</th>
								<th>PPO No</th>
								<th>Mobile</th>
								<th>Email</th>
								<th>Month & Year</th>
								<th>Document</th>
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
								<td><?php echo date('d-m-Y',strtotime($row['appl_dt'])) ?></td>
								<td><?php echo $row['full_name'] ?></td>
								<td><?php echo $row['ppo_no'] ?></td>
								<td><?php echo $row['mobile'] ?></td>
								<td><?php echo $row['email_id'] ?></td>
								<td><?php echo $row['pen_month'] ?> ,  <?php echo $row['pen_year'] ?></td>
								<td>
								<?php
									if(trim($row['doc_name']) != '')	{
										$doc_name = explode(';',$row['doc_name']);
										foreach($doc_name as $filename){
											echo '<a target="_blank" href="'.base_url().'files/agae/pension/'.$filename.'"><img src="'.SITE_BASE_URL.'assets/images/PDF.png" style="max-height:40px;"/></a> &nbsp; &nbsp; &nbsp; &nbsp;';
										}
										
									}
								?>
								</td>
								<td>
									<button class="btn btn-mini btn-primary" onclick="goEdit('<?php //echo $row['appl_id'] ?>')"><i class="icon-pencil icon-white"></i> Edit</button>
									<button class="btn btn-mini btn-danger" onclick="goDelete('<?php //echo $row['appl_id'] ?>')"><i class="icon-remove icon-white"></i> Delete</button>
								</td>
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
<script type="text/javascript">
$(document).ready(function(){
	$('.datepicker').datepicker({dateFormat:'dd-mm-yy'});
});
function goEdit(id,type){
	if(id != undefined){
		var conf = confirm('Do not upload file once uploaded, unless you want to replace it. Do you want to continue?');
		if(conf){
			window.location.href = '<?php echo ADMIN_BASE_URL ?>administration/document_order_edit/'+id;
		}
	}
}
function goDelete(id){
	if(id != undefined){
		var conf = confirm('Do you want to delete?');
		if(conf){
			window.location.href = '<?php echo ADMIN_BASE_URL ?>administration/document_order_delete/'+id;
		}
		
	}
}
</script>
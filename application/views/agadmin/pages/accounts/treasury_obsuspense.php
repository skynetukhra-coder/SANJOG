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
				<div class="muted pull-left">List of Missing Vouchers</div>
				<div class="pull-right block-header-btn">
					<button class="btn btn-success" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>accounts/treasury_obsuspense_upload'"><i class="icon-plus icon-white"></i> Upload Missing Voucher Records</button>
				</div>
			</div>
			<div class="block-content collapse in">
				<div class="span12">
                  <div class="table-scroll">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Sl no.</th>
								<th>Upload Dt</th>
								<th>Try Code</th>
								<th>Fin Year</th>
								<th>Month</th>
								<th>Major Head</th>
								<th>LOP / CAC</th>
								<th>Challan / Voucher</th>
								<th>Gross</th>
								<th>Try's File</th>
								<th>Try's Remark</th>
								<th>Name</th>
								<th>Desig</th>
								<th>Phone No</th>
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
								<td><?php echo get_datepicker_date($row['upload_dt']) ?></td>
								<td><?php echo $row['treasury_code'] ?></td>
								<td><?php echo $row['fin_year'] ?></td>
								<td><?php echo $row['month_tr'] ?></td>
								<td><?php echo $row['major_head'] ?></td>
								<td><?php echo $row['lop_cac'] ?></td>
								<td><?php echo $row['voucher_challan'] ?></td>
								<td><?php echo $row['gross'] ?></td>
								<td>
								<?php
									if(trim($row['try_attachment']) != ''){
										echo '<a href="'.base_url().'files/agae/department/'.$row['try_attachment'].'" target="_blank"><img src="'.SITE_BASE_URL.'assets/images/PDF.png" style="max-height:40px;"/></a>';
									}
								?>
								</td>
								<td><?php echo $row['try_remark'] ?></td>
								<td><?php echo $row['try_official_name'] ?></td>
								<td><?php echo $row['try_official_desig'] ?></td>
								<td><?php echo $row['try_official_contact'] ?></td>
								<td>
									<button class="btn btn-mini btn-primary" onclick="goEdit('<?php echo $row['ob_recd_id'] ?>')"><i class="icon-pencil icon-white"></i> Edit</button>
									<button class="btn btn-mini btn-danger" onclick="goDelete('<?php echo $row['ob_recd_id'] ?>')"><i class="icon-remove icon-white"></i> Delete</button>
								</td>
							</tr>
							<?php
						}
					}else{
						echo '<tr><td colspan="15">No data found!</td></tr>';
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
		window.location.href = '<?php echo ADMIN_BASE_URL ?>accounts/treasury_obsuspense_edit/'+id;
	}
}
function goDelete(id){
	if(id != undefined){
		var conf = confirm('Do you want to delete?');
		if(conf){
			window.location.href = '<?php echo ADMIN_BASE_URL ?>accounts/treasury_obsuspense_delete/'+id;
		}
		
	}
}
</script>
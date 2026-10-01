<div class="row-fluid">
	<div class="span12" id="content">
		<div class="block" style="padding:10px 0; border-top:1px solid #ccc">
		<div class="block-content">
			<form method="get">
			  <div class="control-form">
				<label class="control-label">Search</label>
				<div class="controls">
				 <input type="text" name="search" value="<?php echo $this->input->get('search',true)?>" placeholder="Search by Order ID/ PAN....."/>
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
			
			<div class="block-content collapse in">
				<div class="span12">
                  <div class="table-scroll">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Sl no.</th>
<!--								<th>Issue ID</th>		-->
								<th>Order ID</th>
								<th>Details</th>
								<th>Employee PAN</th>
								<th>Employee Name</th>
								<th>Designation</th>
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
<!--								<td><?php echo $row['eord_id'] ?></td>   -->
								<td><?php echo $row['emp_order_id'] ?></td>
								<td><?php echo $row['details'] ?><br>(<?php echo get_datepicker_date($row['order_dt']) ?>)</br></td>
								<td><?php echo $row['empid'] ?></td>
								<td><?php echo $row['empname'] ?></td>
								<td><?php echo $row['desig'] ?></td>
								<td><button class="btn btn-mini btn-success" onclick="goOpen('<?php echo $row['emp_order_id'] ?>')"><i class="icon-pencil icon-white"></i>Order</button>
								<button class="btn btn-mini btn-danger" onclick="goDelete('<?php echo $row['eord_id'] ?>')"><i class="icon-pencil icon-white"></i> Delete</button>
								</td>
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
<script type="text/javascript">
function goOpen(id,type){
	if(id != undefined){
//		window.location.href = '<?php echo ADMIN_BASE_URL ?>administration/office_order/?search='+id;
		window.location.href = '<?php echo ADMIN_BASE_URL ?>administration/office_order/'+id;
	}
}
function goDelete(id){
	if(id != undefined){
		var conf = confirm('Do you want to delete?');
		if(conf){
			window.location.href = '<?php echo ADMIN_BASE_URL ?>administration/order_employee_delete/'+id;
		}
		
	}
}
</script>
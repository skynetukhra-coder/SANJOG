<link href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
<div class="row-fluid">
		<div class="navbar navbar-inner block-header">
			<div class="muted pull-left" style = "color:red; font-size:14px;">*** 1.    Add New Oder and assign the same to the employees.    *** 2.   Update records of the employee(s) transferred on the basis of the New Transfer Order added.  *** 3.   Update charge of the transferred official(s)</div>
		</div>
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
</div>
<div class="row-fluid">
    <div class="span12" id="content">
        <div class="block">
			<div class="navbar navbar-inner block-header">
                <div class="muted pull-left">Transfer Order Master</div>
				<div class="header-btn-wrap">
                    <button class="btn btn-success"
                    onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>accounts/section_transfer_new'">
					<i class="icon-plus icon-white"></i>Add New Order</button>
                </div>
            </div>
            <div class="block-content collapse in">
                <div class="span12">
                    <div class="table-scroll">
                        <table class="table table-bordered">
                            <thead>
                                <tr>	
                                    <th>Sl no.</th>
									<th>Order ID</th>
									<th>Year</th>
									<th>Order No</th>
                                    <th>Order Date</th>
									<th>Type</th>
									<th>Group</th>
                                    <th>Tag</th>
                                    <th class="action" style="">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
					if(count($results) > 0){
						$sl = intval($this->input->get('per_page',true)) + 1;
						foreach($results as $row){?>
                                <tr>
                                    <td><?php echo $sl++ ?></td>
                                    <td><?php echo $row['transf_order_id'] ?> </td>
									<td><?php echo $row['transf_month'] ?>, <?php //echo $row['transf_year'] ?></td>
                                    <td><?php echo $row['transf_order_no'] ?></td>
									<td><?php echo get_datepicker_date($row['transf_order_dt']) ?></td>
									<td><?php echo $row['transf_type'] ?></td>
									<td><?php echo $row['transf_group'] ?></td>
									<td> <?php //echo $row['mbno'].' <br>'.$row['nicmail'] .' <br>'.$row['email']?></td>
                                    <td style = "width : 13%">
									
									<button class="btn btn-mini btn-primary" onclick="goAssign('<?php echo $row['transf_order_id'] ?>')"><i class="icon-pencil icon-white"></i>Update &nbsp;&nbsp;</button>
									<button class="btn btn-mini btn-danger" onclick="goDelete('<?php //echo $row['transf_order_id'] ?>')"><i class="icon-remove icon-white"></i>Delete &nbsp;&nbsp;&nbsp;</button
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
$(document).ready(function(){
	$('.datepicker').datepicker({dateFormat:'dd-mm-yy'});
});
function goAssign(id,type){
	var conf = confirm('Check correctness of the master record before assignment.');
	if(conf){
		if(id != undefined){
			window.location.href = '<?php echo ADMIN_BASE_URL ?>accounts/section_transfer_assignment/'+id;
		}
	}
}
function goDelete(id){
	if(id != undefined){
		var conf = confirm('Do you want to delete?');
		if(conf){
			window.location.href = '<?php echo ADMIN_BASE_URL ?>accounts/treasury_inspection_delete/'+id;
		}
		
	}
}
</script>
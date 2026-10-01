<link href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
<div class="row-fluid">
		
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
                <div class="muted pull-left">Charge Allotment Details</div>
                <div class="header-btn-wrap">
                  
                </div>
            </div>
            <div class="block-content collapse in">
                <div class="span12">
                    <div class="table-scroll">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Sl no.</th>
									<th>Allotment Date</th>
                                    <th>Employee PAN</th>
                                    <th>Name</th>
									<th>Designation</th>
									<th>Group</th>
									<th>Charge From</th>
									<th>Charge To</th>
									<th>Status</th>
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
									<td><?php echo get_datepicker_date($row['allotment_dt']) ?></td>
                                    <td><?php echo $row['empid'] ?> </br></td>
                                    <td><?php echo $row['emp_name'] ?></td>
									<td><?php echo $row['emp_desig'] ?></td>
									<td><?php echo $row['allot_group'] ?></td>
									<td><?php echo get_datepicker_date($row['charge_from_dt']) ?></td>
									<td><?php echo get_datepicker_date($row['charge_to_dt']) ?></td>
									<td><?php echo $row['status'] ?></td>
                                    <td style = "width : 11%">
									<button class="btn btn-mini btn-primary" onclick="goEdit('<?php echo $row['sallt_id'] ?>')"><i class="icon-pencil icon-white"> </i>Edit &nbsp;&nbsp;&nbsp;</button>
									<button class="btn btn-mini btn-danger" onclick="goDelete('<?php //echo $row['transf_order_id'] ?>')"><i class="icon-remove icon-white"></i>Delete </button>
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
		window.location.href = '<?php echo ADMIN_BASE_URL ?>administration/section_charge_edit/'+id;
	}
}
function goDelete(id){
	if(id != undefined){
		var conf = confirm('Do you want to delete?');
		if(conf){
			window.location.href = '<?php echo ADMIN_BASE_URL ?>administration/section_allotment_delete/'+id;
		}
		
	}
}
</script>
<link href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
<div class="row-fluid">
    <div class="span12" id="filter-content">
        <div class="block">
            <div class="block-content">
                <form method="get">
                    <div class="control-form">
                        <label class="control-label">Search</label>
                        <div class="controls">
                            <input type="text" name="search" value="<?php echo $this->input->get('search',true)?>"
                                placeholder="Search ......." />
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
                <form method="post" action="<?php echo ADMIN_BASE_URL ?>admin_iii/all_employees_leaves">
                    <div class="control-form">
                        <label class="control-label">From</label>
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
                    <div class="control-form" style="padding-right:40px;">
                        <label class="control-label">Type</label>
                        <div class="controls">
                            <select name="leave_type" style="height:34px;">
								<option value=""> -- Select --</option>
								<?php
								if(isset($leave_types) && !empty($leave_types)){
									foreach($leave_types as $leaves){
										echo '<option value="'.$leaves['leave_type'].'">'.$leaves['leave_type'].'</option>';
									}
								}
								?>
							</select>
                        </div>
                    </div>
                    <div class="control-form">
                        <label class="control-label">&nbsp;</label>
                        <div class="controls">
                            <input type="submit" value="Download" />
                        </div>
                    </div>
                    <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row-fluid">
    <div class="span12" id="content">
        <div class="block">
            <div class="navbar navbar-inner block-header">
                <div class="muted pull-left">HW Inventory</div>
                <div class="header-btn-wrap">
                   <button class="btn btn-success"
                        onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>administration/hw_inventory_upload'">
                        <i class="icon-plus icon-white"></i> Upload HW Inventory</button>
                </div>
            </div>
            <div class="block-content collapse in">
                <div class="span12">
                    <div class="table-scroll">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Sl no.</th>
                                    <th>Type / Sub-Type</th>
									<th>Cagetory / Make</th>
                                    <th>Unique ID/ Online ID</th>
									<th>HW Number</th>
                                    <th>Purchase Dt</th>
                                    <th>Specifications</th>
                                    <th>Working Status</th>
									<th>AMC Status</th>
									<th>Date Issue</th>
                                    <th>Location</th>
									<th>Addl Information</th>
									<th>Remark</th>
                                    <th >Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
					if(count($results) > 0){
						$sl = intval($this->input->get('per_page',true)) + 1;
						foreach($results as $row){
								?>
                                <tr>
                                    <td><?php echo $sl++ ?></td>
                                    <td>Type: <?php echo $row['type'] ?><br>Sub-type: <?php echo $row['sub_type'] ?></br></td>
									<td>Categaroy: <?php echo $row['categaroy'] ?><br>Make: <?php echo $row['make'] ?></br></td>
                                    <td><?php echo $row['unique_id_no'] ?><br>Online ID: <?php echo $row['id'] ?></br></td>
									<td><?php echo $row['hw_number']?></td>
									<td><?php echo get_datepicker_date($row['date_of_purchase'])?></td>
                                    <td>processor: <?php echo $row['processor'] ?><br>RAM: <?php echo $row['ram'] ?><br>HDD: <?php echo $row['hdd'] ?></br></td>
									<td><?php echo $row['working']?></td>
									<td><?php echo $row['amc']?></td>
                                    <td><?php echo get_datepicker_date($row['date_of_issue'])?></td>
                                    <td>Group: <?php echo $row['purpose'] ?><br>Type: <?php echo $row['sec_store'] ?><br>Section: <?php echo $row['placed'] ?></br></td>
									<td>Office CD:<?php echo $row['office_code'] ?><br><?php echo $row['additional_info'] ?></br></td>
									<td>Remark: <?php echo $row['remk'] ?><br>Last Update: <?php echo get_datepicker_date($row['update_dt'])?></br></td>
									<td><button class="btn btn-mini btn-primary"
                                            onclick="goEdit('<?php //echo $row['hwitem_id'] ?>')"><i
                                            class="icon-pencil icon-white"></i>Update</button></td>
                                </tr>
                                <?php
						}    
					}			
					else{
						echo '<tr><td colspan="13">No data found!</td></tr>';
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
function goEdit(id, type) {
    if (id != undefined) {
        window.location.href = '<?php echo ADMIN_BASE_URL ?>administration/hw_inventory_edit/' + id;
    }
}
function goClPrint(id, type) {
    if (id != undefined) {
        window.location.href = '<?php echo ADMIN_BASE_URL ?>administration/leave_application_clrh_print/' + id;
    }
}
function goElPrint(id, type) {
    if (id != undefined) {
        window.location.href = '<?php echo ADMIN_BASE_URL ?>administration/leave_application_print/' + id;
    }
}
</script>
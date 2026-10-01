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
                        <label class="control-label">Leave Application </label>
                        <div class="controls">
                            <input type="text" name="date_from" data-required="1" class="datepicker" data-provide="datepicker" autocomplete="off" placeholder="DD-MM-YYYY" />
                        </div>
                    </div>
                    <div class="control-form">
                        <label class="control-label">to</label>
                        <div class="controls">
                            <input type="text" name="date_to"  data-required="1" class="datepicker" data-provide="datepicker" autocomplete="off" placeholder="DD-MM-YYYY" />
                        </div>
                    </div>
                    <div class="control-form" style="padding-right:40px;">
                        <label class="control-label">Leave</label>
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
                            <input type="submit" value="Download Leave Application" />
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
                <div class="muted pull-left">List of Leave</div>
                <div class="header-btn-wrap">
                   <button class="btn btn-success"
                        onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>administration/leave_debit_upload'">
                        <i class="icon-plus icon-white"></i> Add or Update Leave</button>
                </div>
            </div>
            <div class="block-content collapse in">
                <div class="span12">
                    <div class="table-scroll">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Sl no.</th>
                                    <th>Employee PAN</th>
									<th>Application Date</th>
                                    <th>Name</th>
                                    <th>Type of Leave</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Days</th>
									<th>Documents</th>
                                    <th>Leave Status</th>
									<th>Joining Date</th>
									<th>Joining Status</th>
									<th>Service Entry</th>
									<th>Entry Date</th>
                                    <th >Action</th>
									<th >Print</th>
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
                                    <td><?php echo $row['empid'] ?></td>
									<td><?php echo get_datepicker_date($row['application_dt'])?></td>
                                    <td><?php echo $row['name'] ?></td>
                                    <td><?php echo $row['leave_type'] ?></td>
                                    <td><?php echo get_datepicker_date($row['leave_from'])?></td>
                                    <td><?php echo get_datepicker_date($row['leave_to'])?></td>
                                    <td><?php echo $row['leave_day_no']?></td>
									<td><?php
										 if(trim($row['link_file']) != ''){
											echo '<a href="'.base_url().'files/agae/leave_documents/'.$row['link_file'].'" target="_blank">'.$row['link_file'].'</a>';
									}?></td>
									<td><?php echo $row['leave_status'] ?></td>
									<td><?php echo get_datepicker_date($row['joining_dt'])?></td>
									<td><?php echo $row['joining_status'] ?></td>
                                    <td><?php echo $row['servicebk_record'] ?></td>
									<td><?php echo get_datepicker_date($row['servicebk_record_dt']) ?></td>
									<td><button class="btn btn-mini btn-primary"
                                            onclick="goEdit('<?php echo $row['leav_id'] ?>')"><i
                                            class="icon-pencil icon-white"></i>Update</button></td>
									<td><?php
									if($row['leave_type'] =='Casual Leave' || $row['leave_type'] =='Restricted Holiday'){?>
										<button class="btn btn-mini btn-success"
                                            onclick="goClPrint('<?php echo $row['leav_id'] ?>')"><i
                                            class="icon-pencil icon-white"></i>Print</button>
									<?php }else {?>
										<button class="btn btn-mini btn-success"
                                            onclick="goElPrint('<?php echo $row['leav_id'] ?>')"><i
                                            class="icon-pencil icon-white"></i>Print</button></td>
									<?php }?>
                                </tr>
                                <?php
						}    
					}			
					else{
						echo '<tr><td colspan="16">No data found!</td></tr>';
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
        window.location.href = '<?php echo ADMIN_BASE_URL ?>administration/leave_debit_edit/' + id;
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
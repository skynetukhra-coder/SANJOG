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
                <form method="post" action="<?php echo ADMIN_BASE_URL ?>administration/all_employees_application">
                    <div class="control-form">
                        <label class="control-label">Leave From</label>
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
                            <select name="exam_name" style="height:34px;">
								<option value=""> -- Select leave--</option>
								<option data-value="1" value="Eearned leave">Eearned leave</option>
								<option data-value="3" value="Commuted Leave">Commuted Leave</option>
								<option data-value="4" value="Extra-Ordinary Leave">Extra-Ordinary Leave</option>
								<option data-value="5" value="Study Leve">Study Leve</option>
								
								<?php /*
								if(isset($leaves) && !empty($leaves)){
									foreach($leaves as $leav){
										echo '<option value="'.$leav['exm_nm'].'">'.$leav['exm_nm'].'</option>';
									}
								}  */
								?>
								
							</select>
                        </div>
                    </div>
                    <div class="control-form">
                        <label class="control-label">&nbsp;</label>
                        <div class="controls">
                            <input type="submit" value="Download Leave" />
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
                        onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>admin_iii/leave_upload'">
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
									<th>Leave Id</th>
                                    <th>Name</th>
                                    <th>Type of Leave</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Days</th>
									<th>Application Date</th>
                                    <th>Status</th>
                                    <th class="action" style="">Action</th>
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
									<td><?php echo $row['leav_id'] ?></td>
                                    <td><?php echo $row['name'] ?></td>
                                    <td><?php echo $row['leave_type'] ?></td>
                                    <td><?php echo date('d-m-Y',strtotime($row['leave_from']))?></td>
                                    <td><?php echo date('d-m-Y',strtotime($row['leave_to']))?></td>
                                    <td><?php echo $row['leave_day_no']?></td>
                                    <td><?php echo date('d-m-Y',strtotime($row['application_dt']))?></td>
									<td><?php echo $row['leave_status'] ?></td>
                                    <td><button class="btn btn-mini btn-primary"
                                            onclick="goEdit('<?php echo $row['leav_id'] ?>')"><i
                                                class="icon-pencil icon-white"></i> Edit</button></td>
                                </tr>
                                <?php
						}    
					}			
					else{
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
function goEdit(id, type) {
    if (id != undefined) {
        window.location.href = '<?php echo ADMIN_BASE_URL ?>admin_iii/leave_edit/' + id;
    }
}
</script>
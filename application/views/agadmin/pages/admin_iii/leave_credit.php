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
                    <div class="control-form" style="padding-right:40px;">
						<label class="control-label">Leave Year</label>
						<div class="controls">
							<select name="leave_year" style="height:34px;">
								<option value=""> -- Select --</option>
										<?php
										for($i = date('Y')+1; $i >= 2019; $i--){
											echo '<option value="'.$i.'" '.($this->input->get('year',true) == $i ? 'selected': '').' >'.$i.'</option>';
										}?>
							</select>
						</div>
					</div>
					<div class="control-form" style="padding-right:40px;">
						<label class="control-label">Leave Type</label>
						<div class="controls">
							<select name="leave_search" style="height:34px;">
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
                            <input type="submit" value="Filter" />
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
                        onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>admin_iii/leave_credit_upload'">
                        <i class="icon-plus icon-white"></i> Add or Update Leave Credit</button>
					<button class="btn btn-success"
                        onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>admin_iii/leave_credit_upload_auto'">
                        <i class="icon-plus icon-white"></i> EL / HPL Leave Credit (Auto)</button>
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
<!--								<th>Name</th>
                                    <th>Designation</th>
-->									<th>Year</th>
                                    <th>Leave Type</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Days</th>
									<th>Credit Date</th>  
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
<!--								<td><?php //echo $row['name'] ?></td>
									<td><?php //echo $row['desig'] ?></td>
-->                                 <td><?php echo $row['leave_cr_year'] ?></td>
                                    <td><?php echo $row['leave_type'] ?></td>
                                    <td><?php echo date('d-m-Y',strtotime($row['cr_from_date']))?></td>
                                    <td><?php echo date('d-m-Y',strtotime($row['cr_to_date']))?></td>
                                    <td><?php echo $row['no_days']?></td>
                                    <td><?php echo date('d-m-Y',strtotime($row['credit_date']))?></td>
                                    <td><button class="btn btn-mini btn-primary"
                                            onclick="goEdit('<?php echo $row['leavcr_id'] ?>')"><i
                                                class="icon-pencil icon-white"></i> Edit</button></td>
                                </tr>
                                <?php
						}    
					}			
					else{
						echo '<tr><td colspan="11">No data found!</td></tr>';
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
        window.location.href = '<?php echo ADMIN_BASE_URL ?>admin_iii/leave_credit_edit/' + id;
    }
}
</script>
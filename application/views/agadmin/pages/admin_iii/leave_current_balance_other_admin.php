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
						<label class="control-label">Leave Type</label>
						<div class="controls">
							<select name="leave_search" style="height:34px;">
								<option value="" >--- Select Leave ---</option>
								<option value="Earned Leave" >Earned Leave</option>
								<option value="Half Pay Leave" >Half Pay Leave</option>
								<option value="Child Care Leave" >Child Care Leave</option>
								<option value="Maternity Leave" >Maternity Leave</option>
								<option value="Paternity Leave" >Paternity Leave</option>
								<option value="Study Leave" >Study Leave</option>
							</select>
						</div>
					</div>
<!--
					<div class="control-form" style="padding-right:40px;">
						<label class="control-label">Leave Year</label>
						<div class="controls">
							<select name="leave_year" style="height:34px;">
								<option value=""> -- Select Year --</option>
										<?php
										for($i = date('Y')+1; $i >= 2019; $i--){
											echo '<option value="'.$i.'" '.($this->input->get('year',true) == $i ? 'selected': '').' >'.$i.'</option>';
										}?>
							</select>
						</div>
					</div>
-->
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
                <div class="muted pull-left">List of Other Leave Balances</div>
                <div class="header-btn-wrap">
 <!--                   <button class="btn btn-success"
                        onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>admin_iii/leave_balance_upload'">
                        
						 <i class="icon-plus icon-white"></i> Add or Update Leave Balance</button>
 -->               </div>
            </div>
            <div class="block-content collapse in">
                <div class="span12">
                    <div class="table-scroll">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Sl no.</th>
                                    <th>Employee PAN</th>
									<th>Name</th>
									<th>Designation</th>
									<th>Year</th>
                                    <th>Type of Leave</th>
									<th>Balance</th>
									<th>Action</th>
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
									<td><?php echo $row['empname'] ?></td>
									<td><?php echo $row['desig'] ?></td>
                                    <td><?php echo $row['leave_type'] ?></td>
                                    <td><?php echo $row['leave_cb'] ?></td>
									<td><button class="btn btn-mini btn-warning"
                                            onclick="goEdit('<?php echo $row['leavecb_id'] ?>')"><i
                                            class="icon-pencil icon-white"></i>Edit</button>
									</td>
                                </tr>
                                <?php
						}    
					}			
					else{
						echo '<tr><td colspan="6">No data found!</td></tr>';
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
        window.location.href = '<?php echo ADMIN_BASE_URL ?>admin_iii/leave_other_balance_update/' + id;
    }
}
</script>
<style>
.table1 tr{text-align:center;
   font-size:11px;
}
.table1 td{text-align:center;
   font-size:11px;
}
.table1 th{text-align:center;
   font-size:11px;
}
button{ background-color:#6FF88E; text-align: center; font-size:10px;}
button:hover{ background-color: #48BBF9; }
</style>

<link href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
<div class="row-fluid">
<table width="1169">
    <tr>
<td>
    <div class="span12" id="filter-content">
        <div class="block">
            <div class="block-content">
                <form method="get">
                    <div class="control-form">
                        <label class="control-label"><br>Search</br></label>
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
            </div>
        </div>
    </div>
</td>
<td>
	<div class="row-fluid">
	<div class="span12" id="filter-content">
        <div class="block">
            <div class="block-content">
                <form method="post" action="<?php echo ADMIN_BASE_URL ?>training/faculty_order_download">
                    <div class="control-form" style="padding-right:40px;">
                        <label class="control-label"><br>Select Training ID</br></label>
                        <div class="controls">
                            <select name="training_id" style="height:34px;">
								<option value=""> -- Select --</option>
								<?php
								if(isset($training_ids) && !empty($training_ids)){
									foreach($training_ids as $ids){
										echo '<option value="'.$ids['trang_id'].'">'.$ids['trang_id'].'</option>';
									}
								}
								?>
							</select>
                        </div>
                    </div>
                    <div class="control-form">
                        <label class="control-label">&nbsp;</label>
                        <div class="controls">
                            <input type="submit" value="Download Order" />
                        </div>
                    </div>
                    <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
	</div>
</td>
<td>
	<div class="row-fluid">
	<div class="span12" id="filter-content">
        <div class="block">
            <div class="block-content">
                <form method="post" action="<?php echo ADMIN_BASE_URL ?>training/trg_feedback_download">
                    <div class="control-form" style="padding-right:40px;">
                        <label class="control-label"><br>Select Training ID</br></label>
                        <div class="controls">
                            <select name="training_id" style="height:34px;">
								<option value=""> -- Select --</option>
								<?php
								if(isset($training_ids) && !empty($training_ids)){
									foreach($training_ids as $ids){
										echo '<option value="'.$ids['trang_id'].'">'.$ids['trang_id'].'</option>';
									}
								}
								?>
							</select>
                        </div>
                    </div>
                    <div class="control-form">
                        <label class="control-label">&nbsp;</label>
                        <div class="controls">
                            <input type="submit" value="Download Feedback" />
                        </div>
                    </div>
                    <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
	</div>
</td>
</tr>
</table>
	<div class="row-fluid">
    <div class="span12" id="filter-content">
        <div class="block">
            <div class="block-content">
                <form method="post" action="<?php echo ADMIN_BASE_URL ?>training/all_training_faculties">
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
                    <div class="control-form" style="padding-right:40px;">
                        <label class="control-label">Training </label>
                        <div class="controls">
                            <select name="training_type" style="height:34px;">
								<option value=""> -- Select --</option>
								<?php
								if(isset($training_types) && !empty($training_types)){
									foreach($training_types as $trainings){
										echo '<option value="'.$trainings['training_type'].'">'.$trainings['training_type'].'</option>';
									}
								}
								?>
							</select>
                        </div>
                    </div>
                    <div class="control-form">
                        <label class="control-label">&nbsp;</label>
                        <div class="controls">
                            <input type="submit" value="Download Faculties" />
                        </div>
                    </div>
                    <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<div class="row-fluid">
    <div class="span12" id="content">
        <div class="block">
            <div class="navbar navbar-inner block-header">
                <div class="muted pull-left">List of Training</div>
				<div class="header-btn-wrap">
                    <button class="btn btn-success"
                    onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>training/training_upload'">
					<i class="icon-plus icon-white"></i> Add or Update Employee's Training</button>
                </div>
				<div class="header-btn-wrap">
                    <button class="btn btn-success"
                    onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>training/training_program'">
					<i class="icon-plus icon-white"></i> Assign Training to Employee</button>
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
									<th>Name</th>
									<th>Designation</th>
									<th>Trg.ID</th>
									<th>Year</th>
									<th>Mode</th>
									<th>Type</th>
									<th style="width:15%">Description</th>
                                    <th>Location</th>
                                    <th>Period</th>
                                    <th>Tr.Days</th>
                                    <th>Faculty Date</th>
                                    <th>Faculty time</th>
									<th>No. Session</th>
                                    <th>Bill No</th>
									<th>Bill Amount</th>
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
									<td><?php echo $row['name'] ?></td>
									<td><?php echo $row['desig'] ?></td>
									<td><?php echo $row['training_id'] ?></td>
									<td><?php echo $row['fin_year'] ?></td>
									<td><?php echo $row['training_mode'] ?></td>	
									<td><?php echo $row['training_type'] ?></td>
                                    <td><?php echo $row['description'] ?></td>
									<td><?php echo $row['location'] ?></td>
									<td><?php echo get_datepicker_date($row['training_from'])?> to <?php echo get_datepicker_date($row['training_to'])?></td>
                                    <td><?php echo $row['training_days'] ?></td>
									<td><?php echo get_datepicker_date($row['faculty_trg_dt_from'])?> to <?php echo get_datepicker_date($row['faculty_trg_dt_to'])?></td>
									<td><?php echo $row['faculty_trg_time'] ?></td>
									<td><?php echo $row['no_session'] ?></td>
                                    <td><?php echo $row['bill_no'] ?></td>
									<td><?php echo $row['bill_amt'] ?></td>
                                    <td>
									<button class="btn btn-mini btn-primary" onclick="goEdit('<?php echo $row['trg_detail_id'] ?>')"><i class="icon-pencil icon-white"></i> Edit</button>
									<button class="btn btn-mini btn-danger" onclick="goDelete('<?php //echo $row['trg_detail_id'] ?>')"><i class="icon-pencil icon-white"></i> Delete</button>
									</td>
                                </tr>
                                <?php
						}    
					}			
					else{
						echo '<tr><td colspan="14">No data found!</td></tr>';
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
        window.location.href = '<?php echo ADMIN_BASE_URL ?>training/faculty_edit/' + id;
    }
}
function goDelete(id){
	if(id != undefined){
		var conf = confirm('Do you want to delete?');
		if(conf){
			window.location.href = '<?php echo ADMIN_BASE_URL ?>training/faculty_delete/'+id;
		}
		
	}
}
</script>
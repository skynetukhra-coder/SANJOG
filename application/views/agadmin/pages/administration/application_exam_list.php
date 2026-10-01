<link href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
<iv class="row-fluid">
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
                        <label class="control-label">Application From</label>
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
                        <label class="control-label">Examination</label>
                        <div class="controls">
                            <select name="exam_name" style="height:34px;">
								<option value=""> -- Select --</option>
								<?php
								if(isset($examinations) && !empty($examinations)){
									foreach($examinations as $exam){
										echo '<option value="'.$exam['exm_nm'].'">'.$exam['exm_nm'].'</option>';
									}
								}
								?>
							</select>
                        </div>
                    </div>
                    <div class="control-form">
                        <label class="control-label">&nbsp;</label>
                        <div class="controls">
                            <input type="submit" value="Download Exam Application" />
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
                <div class="muted pull-left">List of All Applications</div>
            </div>
            <div class="block-content collapse in">
                <div class="span12">
                    <div class="table-scroll">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Sl no.</th>
                                    <th>Aplied On</th>
                                    <th>PAN</th>
                                    <th>Name</th>
									<th>Designation</th>
									<th>Contact Nos</th>
									<th>Applied For</th>
									<th>B.O.</th>
									<th>Recommendation</th>
									<th>Status </th>
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
									<td><?php echo $row['applied_on'] ?></td>
									<td><?php echo $row['emp_id'] ?></td>
                                    <td><?php echo $row['full_name'] ?></td>
									<td><?php echo $row['desig'] ?></td>
									<td><?php echo $row['mobile'] ?>, <?php echo $row['phone_office'] ?></td>
									<td><?php echo $row['exm_nm'] ?> -<?php echo $row['exm_month'] ?>, <?php echo $row['exm_year'] ?></td>
									<td><?php echo $row['recom_autho'] ?></td>
									<td><?php echo $row['recom_autho_remark'] ?></td>
									<td><?php echo $row['application_status'] ?></td>
									<td><button class="btn btn-mini btn-primary" onclick="goEdit('<?php echo $row['appl_id'] ?>')"><i class="icon-pencil icon-white"></i> Edit</button>&nbsp;
									<button class="btn btn-mini btn-danger" onclick="goDelete('<?php //echo $row['appl_id'] ?>')"><i class="icon-pencil icon-white"></i> Delete</button></td>
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
function goEdit(id, type) {
    if (id != undefined) {
        window.location.href = '<?php echo ADMIN_BASE_URL ?>administration/application_exam_list_edit/' + id;
    }
}
function goDelete(id){
	if(id != undefined){
		var conf = confirm('Do you want to delete?');
		if(conf){
			window.location.href = '<?php echo ADMIN_BASE_URL ?>administration/application_exam_delete/'+id;
		}
		
	}
}
</script>
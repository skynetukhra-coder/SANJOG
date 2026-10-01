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
            </div>
        </div>
    </div>
</div>
<div class="row-fluid">
    <div class="span12" id="content">
        <div class="block">
            <div class="navbar navbar-inner block-header">
                <div class="muted pull-left">List of Examination Names</div>
				
            </div>
            <div class="block-content collapse in">
                <div class="span12">
                    <div class="table-scroll">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Sl no.</th>
                                    <th>Examination Name</th>
									<th>Appliction Invited</th>
									<th>Start Date </th>
									<th>End Date</th>
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
									<td><?php echo $row['exam_name'] ?></td>
									<td style = "text-align:center "><?php echo $row['off_on'] ?></td>
                                    <td><?php echo get_datepicker_date($row['exam_start_dt']) ?></td>
									<td><?php echo get_datepicker_date($row['exam_end_dt']) ?></td>
									<td><?php echo $row['status'] ?></td>
									<td><button class="btn btn-mini btn-primary" onclick="goEdit('<?php echo $row['exam_nm_id'] ?>')"><i class="icon-pencil icon-white"></i> Update </button>&nbsp;
<!--								<button class="btn btn-mini btn-danger" onclick="goDelete('<?php //echo $row['exam_nm_id'] ?>')"><i class="icon-pencil icon-white"></i> Delete</button></td>	-->
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
        window.location.href = '<?php echo ADMIN_BASE_URL ?>administration/application_invited_update/' + id;
    }
}
function goDelete(id){
	if(id != undefined){
		var conf = confirm('Do you want to delete?');
		if(conf){
			window.location.href = '<?php echo ADMIN_BASE_URL ?>administration/application_invite_delete/'+id;
		}
		
	}
}
</script>
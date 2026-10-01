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
                                placeholder="Search by Mobile No......." />
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
    </div><div class="row-fluid">
    <div class="span12" id="filter-content">
        <div class="block">
            <div class="block-content">
                <form method="post" action="<?php echo ADMIN_BASE_URL ?>gpf/feedback_download">
                    <div class="control-form">
                        <label class="control-label">Feedback Details </label>
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
                        <label class="control-label">Group</label>
                        <div class="controls">
                            <select name="visit_for" style="height:34px;">
								<option value=""> -- Group --</option>
								<?php
								if(isset($all_groups) && !empty($all_groups)){
									foreach($all_groups as $groups){
										echo '<option value="'.$groups['visit_for'].'">'.$groups['visit_for'].'</option>';
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
</div>
<div class="row-fluid">
    <div class="span12" id="content">
       
        <div class="block-content collapse in">
                <div class="span12">
                    <div class="table-scroll">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Sl no.</th>
                                    <th>Feedback ID</th>
									<th>Name</th>
									<th>MB No</th>
									<th>Group</th>
									<th>GPF No</th>
									<th>Office</th>
                                    <th>Comment</th>
                                    <th>Feedback_Date</th>
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
                                    <td><?php echo $row['feed_id'] ?></td>
									<td><?php echo $row['name'] ?></td>
									<td><?php echo $row['mobile'] ?><br><?php echo $row['email'] ?></td>
									<td><?php echo $row['visit_for'] ?></td>
									<td><?php echo $row['gpf_no'] ?></td>
                                    <td><?php echo $row['office'] ?></td>
									<td><?php echo $row['details'] ?></td>
									<td><?php echo date('d-m-Y',strtotime($row['feed_date']))?></td>
                                    <td><?php echo $row['status'] ?></td>
                                    <td>
									<button class="btn btn-mini btn-primary" onclick="goEdit('<?php echo $row['feed_id'] ?>')"><i class="icon-pencil icon-white"></i>Update</button>
									<?php 
									$date1=date_create(date('Y-m-d',strtotime($row['feed_date'])));
									$date2=date_create(date('Y-m-d',strtotime($row['due_date'])));
									$diff=date_diff($date1,$date2);
									$diffDays= intval($diff->format("%d"));
									if($diffDays < 6 ){
									?>
									<img width="30" height="30" title="Less than 5 days" src="<?php echo base_url()?>assets/images/flag_red.png" alt="">
									<?php } ?>
									</td>
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
        window.location.href = '<?php echo ADMIN_BASE_URL ?>grievance/feedback_action/' + id;
    }
}
function goDelete(id){
	if(id != undefined){
		var conf = confirm('Do you want to delete?');
		if(conf){
			window.location.href = '<?php echo ADMIN_BASE_URL ?>grievance/feedback_action/'+id;
		}
		
	}
}
</script>
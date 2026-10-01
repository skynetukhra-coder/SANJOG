<link href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
<div class="row-fluid">
<table width = "100%">
<tr>
<td>
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
</td>
</tr>
</table>
</div>
<div class="row-fluid">
    <div class="span12" id="content">
        <div class="block">
            <div class="navbar navbar-inner block-header">
                <div class="muted pull-left">List of Training</div>
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
									<th>Description</th>
                                    <th>Location</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Days</th>
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
									<td><?php echo date('d-m-Y',strtotime($row['training_from']))?></td>
									<td><?php echo date('d-m-Y',strtotime($row['training_to']))?></td>
                                    <td><?php echo $row['training_days'] ?></td>
                                    
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
        window.location.href = '<?php echo ADMIN_BASE_URL ?>administration/training_edit/' + id;
    }
}
function goDelete(id){
	if(id != undefined){
		var conf = confirm('Do you want to delete?');
		if(conf){
			window.location.href = '<?php echo ADMIN_BASE_URL ?>administration/training_delete/'+id;
		}
		
	}
}
</script>
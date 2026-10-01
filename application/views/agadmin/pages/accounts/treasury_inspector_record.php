<style>
tr{text-align:center;
   font-size:13px;
}
td{text-align:center;
   font-size:13px;
}
th{text-align:center;
   font-size:13px;
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
<td>
	<div class="row-fluid">
	<div class="span12" id="filter-content">
        <div class="block">
            <div class="block-content">
                <form method="post" action="<?php echo ADMIN_BASE_URL ?>accounts/treasury_inspection_order_print">
                    <div class="control-form" style="padding-right:40px;">
                        <label class="control-label">Select Inspection ID</label>
                        <div class="controls">
                            <select name="try_insp_id" style="height:34px;">
								<option value=""> -- Select --</option>
								<?php
								if(isset($training_ids) && !empty($training_ids)){
									foreach($training_ids as $ids){
										echo '<option value="'.$ids['try_insp_id'].'">'.$ids['try_insp_id'].'</option>';
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
</tr>
</table>
	<div class="row-fluid">
    <div class="span12" id="filter-content">
        <div class="block">
            <div class="block-content">
                <form method="post" action="<?php echo ADMIN_BASE_URL ?>accounts/all_employees_try_inspection">
                    <div class="control-form" style="padding-right:40px;">
                        <label class="control-label">Year </label>
							<select name="para_year" class="form-control" style="height:34px;">
									<option value="">-- <?php echo $this->lang->line('select_year'); ?> --</option>
									<?php
									for($i = date('Y'); $i >= 2019; $i--){
									echo '<option value="'.$i.'" '.($this->input->get('para_year',true) == $i ? 'selected': '').' >'.$i.'</option>';
									}?>
							</select>
                    </div>
                    <div class="control-form" style="padding-right:40px;">
                        <label class="control-label">Month</label>
                        <div class="controls">
                            <select class="form-control" name="tr_mn" style="height:34px;">
								<option value="">-----Select Month----</option>
								<option value="January" >January</option>
								<option value="February" >February</option>
								<option value="March"  >March</option>
								<option value="April"  >April</option>
								<option value="May"  >May</option>
								<option value="June" >June</option>
								<option value="July" >July</option>
								<option value="August"  >August</option>
								<option value="September"  >September</option>
								<option value="October"  >October</option>
								<option value="November" >November</option>
								<option value="December" >December</option>
							 </select>
                        </div>
                    </div>
                    <div class="control-form" style="padding-right:40px;">
                        <label class="control-label">Treasury</label>
                        <div class="controls">
                            <select name="treasury_nm" style="height:34px;">
								<option value=""> -- Select Treasury --</option>
								<?php
								if(isset($training_types) && !empty($training_types)){
									foreach($training_types as $trainings){
										echo '<option value="'.$trainings['treasury_nm'].'">'.$trainings['treasury_nm'].'</option>';
									}
								}
								?>
							</select>
                        </div>
                    </div>
                    <div class="control-form">
                        <label class="control-label">&nbsp;</label>
                        <div class="controls">
                            <input type="submit" value="Download Insp Records" />
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
                <div class="muted pull-left">List of employes for Treasury Inspection</div>
				
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
									<th>Try. Inspection ID</th>
									<th>Year</th>
									<th>Treasury</th>
									<th>District</th>
									<th>Party No</th>
                                    <th>Period of Insp</th>
                                    <th>Conducted During</th>
                                    <th>Days</th>
                                    <th>Bill No</th>
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
									<td><?php echo $row['try_insp_prg_id'] ?></td>
									<td><?php echo $row['try_insp_month'] ?>, <?php echo $row['try_insp_year'] ?></td>
									<td><?php echo $row['treasury_nm'] ?></td>	
									<td><?php echo $row['dist_nam'] ?></td>
									<td><?php echo $row['insp_party_nos'] ?></td>
                                    <td><?php echo $row['period_under_inspct'] ?></td>
									<td><?php echo date('d-m-Y',strtotime($row['try_insp_from']))?> to <?php echo date('d-m-Y',strtotime($row['try_insp_to']))?></td>
                                    <td><?php echo $row['insp_days'] ?></td>
                                    <td><?php echo $row['bill_no'] ?></td>
                                    <td>
										<button class="btn btn-mini btn-primary" onclick="goEdit('<?php echo $row['insp_rec_id'] ?>')"><i class="icon-pencil icon-white"></i>Update</button>
										<button class="btn btn-mini btn-danger" onclick="goDelete('<?php //echo $row['insp_rec_id'] ?>')"><i class="icon-pencil icon-white"></i>Delete</button>
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
        window.location.href = '<?php echo ADMIN_BASE_URL ?>accounts/treasury_inspector_record_edit/' + id;
    }
}
function goDelete(id){
	if(id != undefined){
		var conf = confirm('Do you want to delete?');
		if(conf){
			window.location.href = '<?php echo ADMIN_BASE_URL ?>accounts/treasury_inspector_record_delete/'+id;
		}
		
	}
}
</script>
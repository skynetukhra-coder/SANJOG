<link href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
<div class="row-fluid">
		<div class="navbar navbar-inner block-header">
			<div class="muted pull-left" style = "color:red; font-size:14px;">***Search employee and Assign section(s).    ***To add PAN No of an existing employee without PAN, contact ITSC. </div>
		</div>
   	<div class="block" style="padding:10px 0; border-top:1px solid #ccc">
		<div class="block-content">
			<form method="get">
			  <div class="control-form">
				<label class="control-label">Search</label>
				<div class="controls">
				 <input type="text" name="search" value="<?php echo $this->input->get('search',true)?>" placeholder="Search ......."/>
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
<div class="row-fluid">
    <div class="span12" id="content">
        <div class="block">
            <div class="navbar navbar-inner block-header">
                <div class="muted pull-left">List of Section Allotment .</div>
                <div class="header-btn-wrap">
                  
                </div>
            </div>
            <div class="block-content collapse in">
                <div class="span12">
                    <div class="table-scroll">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Sl no.</th>
									<th>PAN</th>
									<th>Name</th>
									<th>Designation</th>
									<th>Present Group</th>
									<th>Present Section</th>
                                    <th>Charge Type</th>
                                    <th class="action" style=""> Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
					if(count($results) > 0){
						$sl = intval($this->input->get('per_page',true)) + 1;
						foreach($results as $row){?>
                                <tr>
                                    <td><?php echo $sl++ ?></td>
									<td><?php echo $row['empid_inch_bo'] ?></td>
									<td><?php echo $row['emp_name'] ?></td>
									<td><?php echo $row['emp_desig'] ?></td>
									<td><?php echo $row['present_group'] ?></td>
                                    <td><?php echo $row['section_desc'] ?> [<?php echo $row['sectn_indx'] ?>]</td>
									<td><?php echo $row['charge_type'] ?></td>
                                    <td style = "width : 5%">
									<button class="btn btn-mini btn-primary" onclick="goEdit('<?php echo $row['sallot_id'] ?>')"><!-- <i class="icon-pencil icon-white"> --></i>Update</button>
								</td>
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
function goEdit(id,type){
	var conf = confirm('Assign Section(s) to the Official carefully.');
	if(conf){
		if(id != undefined){
			window.location.href = '<?php echo ADMIN_BASE_URL ?>gpf/section_allotment_edit/'+id;
		}
	}
}
function goDelete(id){
	if(id != undefined){
		var conf = confirm('Do you want to delete?');
		if(conf){
			window.location.href = '<?php echo ADMIN_BASE_URL ?>gpf/treasury_inspection_delete/'+id;
		}
		
	}
}
</script>
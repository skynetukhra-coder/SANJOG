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
                
            </div>
        </div>
    </div>
</div>
<div class="row-fluid">
    <div class="span12" id="content">
        <div class="block">
            
            <div class="block-content collapse in">
                <div class="span12">
                    <div class="table-scroll">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Sl no.</th>
                                    <th>Employee PAN</th>
									<th>Employee Id</th>
                                    <th>Name</th>
									<th>Designation</th>
									<th>Section</th>
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>DOB</th>
                                    <th>DOR</th>
                                    <th>DOAPP</th>
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
                                    <td><?php echo $row['empid'] ?></td>
									<td><?php echo $row['office_id'] ?></td>
                                    <td><?php echo $row['empname'] ?></td>
									<td><?php echo $row['desig'] ?></td>
									<td><?php echo $row['section'] ?></td>
                                    <td><?php echo $row['mbno'] ?></td>
                                    <td><?php echo $row['nicmail'] .' <br>'.$row['email']?></td>
                                    <td><?php echo date('d-m-Y',strtotime($row['dob']))?></td>
                                    <td><?php echo date('d-m-Y',strtotime($row['dor']))?></td>
                                    <td><?php echo date('d-m-Y',strtotime($row['doapp']))?></td>
                                    <td><button class="btn btn-mini btn-primary"
                                            onclick="goEdit('<?php echo $row['empid'] ?>')"><i
                                                class="icon-pencil icon-white"></i> Edit</button>
									<button class="btn btn-mini btn-warning"
                                            onclick="goPrint('<?php echo $row['empid'] ?>')"><i
                                                class="icon-pencil icon-white"></i> PDF</button></td>
                                </tr>
                                <?php
						}
					}else{
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
        window.location.href = '<?php echo ADMIN_BASE_URL ?>admin_iii/employee_edit/' + id;
    }
}
function goPrint(id, type) {
    if (id != undefined) {
        window.location.href = '<?php echo ADMIN_BASE_URL ?>admin_iii/employee_print/' + id;
    }
}
</script>
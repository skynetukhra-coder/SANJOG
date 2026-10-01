
<link href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
<div class="row-fluid">
		<div class="navbar navbar-inner block-header">
			<div class="muted pull-left" style = "color:red; font-size:14px;">*** 1.   Update records of the employee(s) transferred on the basis of the New Transfer Order added.  *** 2. Update charge of the transferred official(s)</div>
		</div>
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
                <form method="post" action="<?php echo ADMIN_BASE_URL ?>gpf/transfer_order_download">
                    <div class="control-form" style="padding-right:40px;">
                        <label class="control-label">Select Transfer Order ID</label>
                        <div class="controls">
                            <select name="transf_order_id" style="height:34px;">
								<option value=""> -- Select --</option>
								<?php
								if(isset($transf_ids) && !empty($transf_ids)){
									foreach($transf_ids as $ids){
										echo '<option value="'.$ids['transf_order_id'].'">'.$ids['transf_order_id'].'</option>';
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
                <form method="post" action="<?php echo ADMIN_BASE_URL ?>gpf/all_employees_transfer">
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
                        <label class="control-label">Group </label>
                        <div class="controls">
                            <select id="order_group" name="order_group" class="form-control" required >
								<option data-value="0" value=""> ---- Select Group----</option>
								<option data-value="1" value="ADMINISTRATION" > ADMINISTRATION</option>
								<option data-value="2" value="ACCOUNTS" > ACCOUNTS</option>
								<option data-value="3" value="FUND" >FUND</option>
								<option data-value="4" value="PENSION" > PENSION</option>
							</select>
                        </div>
                    </div>
                    <div class="control-form">
                        <label class="control-label">&nbsp;</label>
                        <div class="controls">
                            <input type="submit" value="Download Reocords" />
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
                <div class="muted pull-left">List of Transferred Employees</div>
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
									<th>Transfer ID</th>
									<th>Picture</th>
                                    <th>Employee PAN</th>
                                    <th>Name</th>
									<th>Designation</th>
									<th>From Group / Section</th>
									<th>To Group / Secton</th>
									<th>Order No & Date</th>
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
									 <td><?php echo $row['trans_ord_id'] ?></br></td>
									<td>
										<span>
											<?php if($row['emp_pic']!==''){ ?>
												<span><img width="70" height="70" src="https://agwb.cag.gov.in/files/agae/picture/<?php echo $row['emp_pic']?>" alt=""></span>
												<?php }else{ 
													if($row['emp_gender']=='MALE'){ ?>
														<span><img width="70" height="70" src="<?php echo SITE_BASE_URL?>assets/images/dummy-profile-pic-male.jpg" alt=""></span>
													<?php }else{ ?>
														<span><img width="70" height="70" src="<?php echo SITE_BASE_URL?>assets/images/dummy-female.png" alt=""></span>
													<?php } 
												} ?>
										</span>
									</td>
                                    <td><?php echo $row['emp_id'] ?></br></td>
                                    <td><?php echo $row['emp_name'] ?></td>
									<td><?php echo $row['emp_desig'] ?></td>
									<td><?php echo $row['trans_from_grp'] ?> <br><?php echo $row['trans_from_sec'] ?></br></td>
									<td><?php echo $row['trans_to_grp'] ?> <br><?php echo $row['trans_to_sec'] ?></br></td>
									<td><?php echo $row['trans_order_no'] ?><br>Dated <?php echo $row['trans_order_dt'] ?></br></td>
									<td><?php echo $row['status'] ?></td>
                                    <td style = "width : 13%">
									<button class="btn btn-mini btn-primary" onclick="goEdit('<?php echo $row['sec_tnsf_id'] ?>')"><i class="icon-pencil icon-white"></i> Update &nbsp;</button>
									<button class="btn btn-mini btn-danger" onclick="goDelete('<?php //echo $row['sec_tnsf_id'] ?>')"><i class="icon-remove icon-white"></i>&nbsp; Delete &nbsp;</button>
									</td>
                                </tr>
                                <?php
						}
					}else{
						echo '<tr><td colspan="9">No data found!</td></tr>';
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
        window.location.href = '<?php echo ADMIN_BASE_URL ?>gpf/section_transfer_record_edit/' + id;
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
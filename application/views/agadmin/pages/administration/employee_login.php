<link href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
<div class="row-fluid">
		<div class="navbar navbar-inner block-header">
			<div class="muted pull-left" style = "color:red; font-size:14px;">***Search employee first before adding into Database.    ***To add PAN No of an existing employee without PAN, contact ITSC.    ***Deactivate employee immediately on transfer, voluntary retirement or death.</div>
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
                        <label class="control-label">Employee Logged in: From</label>
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
                        <label class="control-label"> Employee (Active) </label>
                        <div class="controls">
                            <select name="da_cadare" style="height:34px;" required>
								<option  value= "" > ----- Select -----</option>
								<option  value= "0" > AG (A&E) Employee</option>
								<option  value= "1" > DA Cadre Employee</option>
							</select>
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
                <div class="muted pull-left">List of Employee Logged in Today</div>
                <div class="header-btn-wrap">
                    <button class="btn btn-success"
                        onclick="window.location.href = '<?php //echo ADMIN_BASE_URL ?>administration/all_employees_application'">
                        <i class="icon-file icon-white"></i> Add</button>
                </div>
            </div>
            <div class="block-content collapse in">
                <div class="span12">
                    <div class="table-scroll">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Sl no.</th>
									<th>Employee Picture</th>
                                    <th>Employee PAN / Office ID</th>
                                    <th>Name</th>
									<th>Designation</th>
									<th>Section</th>
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>Profile Updated</th>
									<th>Last_Login</th>
									<th>Remark</th>
									<th>Login</th>
                                    <th class="action" style="">Action</th>
									<th class="action" style="">PAN</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
					if(count($results) > 0){
						$sl = intval($this->input->get('per_page',true)) + 1;
						foreach($results as $row){?>
                                <tr>
                                    <td><?php echo $sl++ ?></td>
									<td>
										<span>
											<?php if($row['picture']!==''){ ?>
												<span><img width="70" height="70" src="https://agwb.cag.gov.in/files/agae/picture/<?php echo $row['picture']?>" alt=""></span>
												<?php }else{ 
													if($row['gender']=='MALE'){ ?>
														<span><img width="70" height="70" src="<?php echo SITE_BASE_URL?>assets/images/dummy-profile-pic-male.jpg" alt=""></span>
													<?php }else{ ?>
														<span><img width="70" height="70" src="<?php echo SITE_BASE_URL?>assets/images/dummy-female.png" alt=""></span>
													<?php } 
												} ?>
										</span>
									</td>
                                    <td><?php echo $row['empid'] ?> / <br><?php echo $row['office_id'] ?></br></td>
                                    <td><?php echo $row['empname'] ?></td>
									<td><?php echo $row['desig'] ?></td>
									<td><?php echo $row['section'] ?></td>
                                    <td><?php echo $row['mbno'] ?></td>
                                    <td><?php echo $row['nicmail'] .' <br>'.$row['email']?></td>
									<td><?php echo get_datepicker_date($row['profile_updated'])?></td>
                                    <td><?php echo date('d-m-Y H:i:s',strtotime($row['last_login']))?></td>
									<td><?php echo $row['remark'] ?></td>
									<td><?php echo $row['status'] ?></td>
                                    <td><button class="btn btn-mini btn-primary"
                                            onclick="goEdit('<?php echo $row['empid'] ?>')"><i
                                                class="icon-pencil icon-white"></i> Edit</button></td>
												<td><button class="btn btn-mini btn-warning"
                                            onclick="goPan('<?php echo $row['e_id'] ?>')"><i
                                                class="icon-pencil icon-white"></i> PAN </button></td>
                                </tr>
                                <?php
						}
					}else{
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
        window.location.href = '<?php echo ADMIN_BASE_URL ?>administration/employee_edit/' + id;
    }
}
function goPan(id, type) {
    if (id != undefined) {
        window.location.href = '<?php echo ADMIN_BASE_URL ?>administration/employee_pan/' + id;
    }
}
</script>
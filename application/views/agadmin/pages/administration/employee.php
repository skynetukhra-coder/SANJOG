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
			  <div class="control-form" style="padding-right:40px;">
                    <label class="control-label"> Employee Designation </label>
                    <div class="controls">
                        <select id="desig" name="desig" class="form-control" >
									<option data-value="0" value="">--Select--</option>
									<option data-value="1" value="ACCOUNTANT GENERAL" >ACCOUNTANT GENERAL</option>
									<option data-value="2" value="PR. ACCOUNTANT GENERAL" >PR. ACCOUNTANT GENERAL</option>
									<option data-value="3" value="ACCOUNTANT" >ACCOUNTANT</option>
									<option data-value="4" value="ACCOUNTS OFFICER" >ACCOUNTS OFFICER</option>
									<option data-value="5" value="ASSTT. ACCOUNTS OFFICER" >ASSTT. ACCOUNTS OFFICER</option>
									<option data-value="6" value="ASSTT. ACCOUNTS OFFICER (Adhoc)" >ASSTT. ACCOUNTS OFFICER (Adhoc)</option>
									<option data-value="31" value="ASSTT. SUPERVISOR" >ASSTT. SUPERVISOR</option>
									<option data-value="7" value="CANTEEN ATTENDENT" >CANTEEN ATTENDENT</option>
									<option data-value="8" value="CANTEEN MANAGER" >CANTEEN MANAGER</option>
									<option data-value="9" value="CLERK TYPIST" >CLERK TYPIST</option>
									<option data-value="10" value="DATA ENTRY OPERATOR">DATA ENTRY OPERATOR</option>
									<option data-value="11" value="DATA ENTRY OPERATOR-I" >DATA ENTRY OPERATOR-I</option>
									<option data-value="12" value="DATA ENTRY OPERATOR-II" >DATA ENTRY OPERATOR-II</option>
									<option data-value="13" value="DIVISIONAL ACCOUNTANT">DIVISIONAL ACCOUNTANT</option>
									<option data-value="14" value="DIVISIONAL ACCOUNTS OFFICER-I">DIVISIONAL ACCOUNTS OFFICER-I</option>
									<option data-value="15" value="DIVISIONAL ACCOUNTS OFFICER-II">DIVISIONAL ACCOUNTS OFFICER-II</option>
									<option data-value="16" value="DY. ACCOUNTANT GENERAL" >DY. ACCOUNTANT GENERAL</option>
									<option data-value="17" value="SR.DY. ACCOUNTANT GENERAL" >SR.DY. ACCOUNTANT GENERAL</option>
									<option data-value="18" value="HINDI OFFICER" >HINDI OFFICER</option>
									<option data-value="18" value="JUNIOR TRANSLATOR" >JUNIOR TRANSLATOR</option>
									<option data-value="33" value="SENIOR TRANSLATOR" >SENIOR TRANSLATOR</option>
									<option data-value="20" value="MULTI TASKING STAFF" >MULTI TASKING STAFF</option>
									<option data-value="21" value="PA TO DAG (ADMIN)" >PA TO DAG (ADMIN)</option>
									<option data-value="22" value="PA TO DAG (ACCOUNTS)" >PA TO DAG (ACCOUNTS)</option>
									<option data-value="23" value="PA TO DAG (FUND)" >PA TO DAG (FUND)</option>
									<option data-value="24" value="PA TO DAG (PENSION)" >PA TO DAG (PENSION)</option>
									<option data-value="25" value="SR. ACCOUNTANT" >SR. ACCOUNTANT</option>
									<option data-value="26" value="SR. ACCOUNTS CLERK" >SR. ACCOUNTS CLERK</option>
									<option data-value="27" value="SR. ACCOUNTS OFFICER" >SR. ACCOUNTS OFFICER</option>
									<option data-value="34" value="SR. ACCOUNTS OFFICER (Adhoc)" >SR. ACCOUNTS OFFICER (Adhoc)</option>
									<option data-value="28" value="SR. PRIVATE SECRETARY" >SR. PRIVATE SECRETARY</option>
									<option data-value="29" value="STENO GR-I" >STENO GR-I</option>
									<option data-value="30" value="SUPERVISOR" >SUPERVISOR</option>
									<option data-value="32" value="WELFARE ASSISTANT" >WELFARE ASSISTANT</option>
									<option data-value="33" value="SR. ACCOUNTANT" >SR. ACCOUNTANT</option>
								</select>
                    </div>
               </div>
			   <div class="control-form" style="padding-right:40px;">
				<label class="control-label">Section</label>
					<select id="section" name="section" class = "form-control" >
						<option value="">--Select--</option>
							<?php
								if(isset($section_list) && !empty($section_list)){
									foreach($section_list as $sections){
										echo '<option value="'.$sections['section'].'">'.$sections['section'].'</option>';
									}
								}
							?>
					</select>
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
<div class="block" style="padding:10px 0; border-top:1px solid #ccc">
		<div class="block-content">
			 <form method="post" action="<?php echo ADMIN_BASE_URL ?>administration/employee_download">
                    <div class="control-form">
                        <label class="control-label">Employee DOR from</label>
                        <div class="controls">
                            <input type="text" name="date_from" data-required="1" class="datepicker" data-provide="datepicker" autocomplete="off" placeholder="DD-MM-YYYY" required />
                        </div>
                    </div>
                    <div class="control-form">
                        <label class="control-label">to</label>
                        <div class="controls">
                            <input type="text" name="date_to"  data-required="1" class="datepicker" data-provide="datepicker" autocomplete="off" placeholder="DD-MM-YYYY" required />
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
                            <input type="submit" value="Download Emp List" />
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
                <div class="muted pull-left">List of Employee</div>
                <div class="header-btn-wrap">
                    <button class="btn btn-success"
                        onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>administration/employee_upload'">
                        <i class="icon-plus icon-white"></i> Add Employee Info</button>
<!--                  <button class="btn btn-success"
                        onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>administration/all_employees_application'">
                        <i class="icon-file icon-white"></i> Download All Application</button>
					  <button class="btn btn-success"
                        onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>administration/employee_details_upload'">
                        <i class="icon-upload icon-white"></i>Update Employee Details</button>
-->
                </div>
            </div>
            <div class="block-content collapse in">
                <div class="span12">
                    <div class="table-scroll">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Sl no.</th>
									<th>Employee</th>
                                    <th>Employee PAN / Office ID</th>
                                    <th>Name</th>
									<th>Designation</th>
									<th>Section</th>
                                    <th>Contact</th>
                                    <th>DOB</th>
                                    <th>DOR</th>
                                    <th>DOAPP</th>
                                    <th>Application</th>
									<th>Remark</th>
									<th>Login</th>
                                    <th class="action" Action>Action</th>
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
                                    <td> <?php echo $row['mbno'].' <br>'.$row['nicmail'] .' <br>'.$row['email']?></td>
                                    <td><?php echo date('d-m-Y',strtotime($row['dob']))?></td>
                                    <td><?php echo date('d-m-Y',strtotime($row['dor']))?></td>
                                    <td><?php echo date('d-m-Y',strtotime($row['doapp']))?></td>
                                    <td>
                                        <?php 
									$is_applied =  is_employee_applied_form($row['empid']);
									if($is_applied){
										echo '<a href="'.ADMIN_BASE_URL.'administration/employee_application?id='.$row['empid'].'" target="_blank"><img src="'.base_url().'assets/images/xlsx.png"></a>';
									}else{
										echo 'Not Applied';
									}
								?>
                                    </td>
									<td><?php echo $row['remark'] ?></td>
									<td><?php echo $row['status'] ?></td>
                                    <td style = "width : 7%">
										<button style = "height: 30px" class="btn btn-mini btn-primary" onclick="goUpdate('<?php echo $row['empid'] ?>')"><i class="icon-pencil icon-white"></i>&nbsp; Update</button>
										<button style = "height: 30px" class="btn btn-mini btn-warning" onclick="goPdf('<?php echo $row['empid'] ?>')"><i class="icon-pencil icon-white"></i> Add Pdf</button>
										<button style = "height: 30px" class="btn btn-mini btn-success" onclick="goEdit('<?php echo $row['empid'] ?>')"><i class="icon-pencil icon-white"></i>&nbsp; Section</button>
									</td>
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
function goUpdate(id, type) {
    if (id != undefined) {
        window.location.href = '<?php echo ADMIN_BASE_URL ?>administration/employee_edit/' + id;
    }
}
function goPdf(id, type) {
    if (id != undefined) {
        window.location.href = '<?php echo ADMIN_BASE_URL ?>administration/employee_edit_pdf/' + id;
    }
}
function goEdit(id, type) {
    if (id != undefined) {
        window.location.href = '<?php echo ADMIN_BASE_URL ?>administration/employee_edit_sec/' + id;
    }
}
</script>
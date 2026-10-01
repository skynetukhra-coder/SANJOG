<link href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
<div class="row-fluid">
		<div class="navbar navbar-inner block-header">
			<div class="muted pull-left" style = "color:red; font-size:14px;">***Search Branch Officer and Assign section(s).    ***To add PAN No of an existing employee without PAN, contact ITSC. </div>
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
                <div class="muted pull-left">List of Branch Officers / Section In-charges</div>
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
									<th>Employee Picture</th>
                                    <th>Employee PAN / Office ID</th>
                                    <th>Name</th>
									<th>Designation</th>
									<th>Group</th>
									<th>Section</th>
                                    <th>Contact</th>
                                    <th class="action" style="">Section</th>
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
									<td><?php echo $row['group_name'] ?></td>
									<td><?php echo $row['section'] ?></td>
									<td> <?php echo $row['mbno'].' <br>'.$row['nicmail'] .' <br>'.$row['email']?></td>
                                    <td style = "width : 7%">
									<button class="btn btn-mini btn-primary" onclick="goAssign('<?php echo $row['empid'] ?>')"><!-- <i class="icon-pencil icon-white"> --></i>&nbsp;&nbsp; Assign &nbsp;&nbsp;</button>
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
function goAssign(id,type){
	var conf = confirm('Assign Sections to the Branch Officer carefully.');
	if(conf){
		if(id != undefined){
			window.location.href = '<?php echo ADMIN_BASE_URL ?>administration/section_assignment/'+id;
		}
	}
}
function goEdit(id,type){
	if(id != undefined){
		window.location.href = '<?php echo ADMIN_BASE_URL ?>administration/treasury_inspection_edit/'+id;
	}
}
function goDelete(id){
	if(id != undefined){
		var conf = confirm('Do you want to delete?');
		if(conf){
			window.location.href = '<?php echo ADMIN_BASE_URL ?>administration/treasury_inspection_delete/'+id;
		}
		
	}
}
</script>
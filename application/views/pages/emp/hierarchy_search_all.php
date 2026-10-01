<div class="row">
	<div class="col-md-3 col-sm-4">
		<div class="left-panel">
			<?php $this->load->view('layout/emp_left_panel',$header);?>
		</div>
	</div>
	<div class="col-md-9 col-sm-8">
		<div class="right-panel">
		<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('employee'); ?> &raquo; Utilities</div>
		<div class="login-box">
					<div class="new-cont medium whats-new">
						<ul class="nav nav-tabs " style="background-color: ">
							<li><a data-toggle="tab" href="#tab" onclick="myBO()" >Branch Officer</a></li>
							<li><a data-toggle="tab" href="#tab1" onclick="myAAO()" >Section Incharge</a></li>
							<li><a data-toggle="tab" href="#tab2" onclick="mySECTION()" >Sectional Staff</a></li>
							<li class="active"><a data-toggle="tab" href="#tab1" onclick="mySearch()" >&nbsp;&nbsp;&nbsp;   Search   &nbsp;&nbsp;&nbsp;</a></li>
						</ul>
					</div>
				<div>&nbsp;</div>
		<div class="right-panel">
			<div>
				<div class="page-details">
					<form method="get">
						<div class="filter-form1">
							<div class="form-group row">
								<div class="col-sm-4">
									<label class="name-label">Section:</label>
									<select id="section" name="section" class = "form-control" >
										<option value="">--Select--</option>
										<?php
										if(isset($section_list) && !empty($section_list)){
											foreach($section_list as $sections){
												echo '<option value="'.$sections['section'].'">'.$sections['section'].'</option>';
											}
										}
										?>
									</select></span>
								</div>
								<div class="col-sm-4">
									<label class="name-label">Official:</label>
									<select id="staff_type" name="staff_type" class="form-control" required >
										<option data-value="0" value=""> ---- Select Group----</option>
										<option data-value="1" value="Staff" >Dealing Staff</option>
										<option data-value="2" value="Incharge" > Section Incharge</option>
										<option data-value="3" value="BO" > Branch Officer</option>
									</select>
								</div>
								<div class="col-sm-4">
									<input type="submit" class="submit-btn" value="<?php echo $this->lang->line('search'); ?>" />
								</div>
							</div>
						</div>
					</form>
					<table border="1" style="width:100%">
						<thead>
							<tr style="text-align:center">
								<th style="text-align:center">Sl no.</th>
								<th style="text-align:center">Picture</th>
								<th style="text-align:center">Name</th>
								<th style="text-align:center">Designation</th>
								<th style="text-align:center">Branch / Section</th>
								<th style="text-align:center">Contact</th>
								<th style="text-align:center">Sections</th>
							</tr>
						</thead>
						<tbody>
							<?php
					if(!empty($results)){
						$sl = 1;
						foreach($results as $row){?>
							<tr>
								<td style="text-align:center"><?php echo $sl++ ?></td>
								<td>
									<span>
										<?php if($row['picture']!==''){ ?>
											<span><img width="80" height="80" src="https://agwb.cag.gov.in/files/agae/picture/<?php echo $row['picture']?>" alt=""></span>
											<?php }else{ 
												if($row['gender']=='MALE'){ ?>
													<span><img width="80" height="80" src="<?php echo SITE_BASE_URL?>assets/images/dummy-profile-pic-male.jpg" alt=""></span>
													<?php }else{ ?>
													<span><img width="80" height="80" src="<?php echo SITE_BASE_URL?>assets/images/dummy-female.png" alt=""></span>
													<?php } 
											} ?>
									</span>
								</td>
								<td style="text-align:center"><?php echo $row['empname']?></td>
								<td style="text-align:center"><?php echo $row['desig']?></td>
								<td style="text-align:center"><?php echo $row['section'] ?></td>
								<td><?php //echo $row['mbno'] ?><?php echo $row['nicmail'] ?> </br><br> <?php echo $row['email'] ?></br></td>
								<?php if($row['staff_type'] == 'BO' ){ ?>
								<td style = "text-align: center">
									<button id ="charge" class="btn-mini btn-success" 
									onclick="mySections('<?php echo $row['sect_idx'] ?>')" style="display:inline-block; padding:2px; margin:2px; width:auto"><i 
									class="icon-pencil icon-white"></i>View</button>
								</td>
								<?php }else{ ?>
								<td style="text-align:center"><?php //echo $row['desig']?></td>
								<?php } ?>
							</tr>
							<?php
						}
					}else{?>
							<tr>
								<td colspan="7" style="font-size:12px"><?php echo $this->lang->line('no_data_found')?></td>
							</tr>
							<?php
					}?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	</div>
   </div>
</div>

<script type="text/javascript" src="<?php echo SITE_BASE_URL?>assets/js/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('.datepicker').datepicker({dateFormat:'dd-mm-yy'});
});
function myBO() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/hierarchy/';
}

function myAAO() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/hierarchy_incharge/';
}

function mySECTION() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/hierarchy_section/';
}
function mySearch() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/hierarchy_search_all/';
}
function mySections(id, type) {
    if (id != undefined) {
		window.location.href = '<?php echo SITE_BASE_URL ?>emp/hierarchy_bo_sections/' + id;
    }
}
</script>
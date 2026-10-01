<style>
td{padding:5px;}
</style>
<div class="row">
	<div class="col-md-3 col-sm-4">
		<div class="left-panel">
			<?php $this->load->view('layout/emp_left_panel',$header);?>
		</div>
	</div>
	<div class="col-md-9 col-sm-8">
		<div class="right-panel">
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; Employee &raquo; My Information </div>
			<div class="msg_cont">
				<div class="success">
					<?php if(isset($success) && !empty($success)){
						echo '<div class="msg">'.$success.'</div>';
					  }else if($this->session->flashdata('success')){
					  	echo '<div class="msg">'.$this->session->flashdata('success').'</div>';
					  }
				 ?>
				</div>
				<div class="err">
					<?php if(isset($error) && !empty($error)){
						echo '<div class="msg">'.$error.'</div>';
					  }else if($this->session->flashdata('error')){
					  	echo '<div class="msg">'.$this->session->flashdata('error').'</div>';
					  }
				 ?>
				</div>
			</div>
			<div class="login-box">
				<h4><strong>Welcome,</strong> <?php echo $emp_data['empname'] ?></h4>
				<hr />
				<table border="1" style="width:100%">
					<tbody>
						<?php
						if($profile['da_cadare']){?>
						<tr>
							<td class="col_1">DA Cadre ID</td>
							<td class="col_2"><?php echo $profile['empid'] ?></td>
						</tr>
						<?php
						}else{?>
						<tr>
							<td class="col_1">Employee ID</td>
							<td class="col_2"><?php echo $profile['empid'] ?></td>
						</tr>
						<?php
						}?>
						<tr>
							<td class="col_1">Name</td>
							<td class="col_2"><?php echo $profile['empname'] ?></td>
						</tr>
						<tr>
							<td class="col_1">Father's Name</td>
							<td class="col_2"><?php echo $profile['father_name'] ?></td>
						</tr>
						<tr>
							<td class="col_1">Gender</td>
							<td class="col_2"><?php echo $profile['gender'] ?></td>
						</tr>
						<tr>
							<td class="col_1">NIC Email</td>
							<td class="col_2"><?php echo $profile['nicmail'] ?></td>
						</tr>
						<tr>
							<td class="col_1">Email</td>
							<td class="col_2"><?php echo $profile['email'] ?></td>
						</tr>
						<tr>
							<td class="col_1">Phone</td>
							<td class="col_2"><?php echo $profile['mbno'] ?></td>
						</tr>
						<tr>
							<td class="col_1">Category</td>
							<td class="col_2"><?php echo $profile['category'] ?></td>
						</tr>
						<tr>
							<td class="col_1">Stream</td>
							<td class="col_2"><?php echo $profile['stream'] ?></td>
						</tr>
						<tr>
							<td class="col_1">Date of Birth</td>
							<td class="col_2"><?php echo get_date($profile['dob']) ?></td>
						</tr>
						<tr>
							<td class="col_1">Office</td>
							<td class="col_2"><?php echo $profile['office'] ?></td>
						</tr>
						<tr>
							<td class="col_1">ID Card No</td>
							<td class="col_2"><?php echo $profile['id_cardno'] ?></td>
						</tr>
						<tr>
							<td class="col_1">Date of Retirement</td>
							<td class="col_2"><?php echo get_date($profile['dor']) ?></td>
						</tr>
						<tr>
							<td class="col_1" style="border-bottom:1px solid #000">Joining Type</td>
							<td class="col_2" style="border-bottom:1px solid #000"><?php echo $profile['joning_type'] ?></td>
						</tr>
						<tr>
							<td class="col_1">Designation</td>
							<td class="col_2"><?php echo $profile['desig'] ?></td>
						</tr>
						<tr>
							<td class="col_1">Section</td>
							<td class="col_2"><?php echo $profile['section'] ?></td>
						</tr>
						<tr>
							<td class="col_1">Department</td>
							<td class="col_2"><?php echo $profile['dept_appt'] ?></td>
						</tr>
						<tr>
							<td class="col_1">Blood Group</td>
							<td class="col_2"><?php echo $profile['blodd_grp'] ?></td>
						</tr>
						<tr>
							<td class="col_1">Gratuity Nomination</td>
							<td class="col_2"><?php echo $profile['gratuity_nomination'] ?></td>
						</tr>
						<tr>
							<td class="col_1">GIS Nomination</td>
							<td class="col_2"><?php echo $profile['gis_nomination'] ?></td>
						</tr>
						<tr>
							<td class="col_1">Qualification</td>
							<td class="col_2"><?php echo $profile['qualifi'] ?></td>
						</tr>
						<tr>
							<td class="col_1">Address</td>
							<td class="col_2"><?php echo $profile['address1'] ?></td>
						</tr>
						<tr>
							<td class="col_1">State</td>
							<td class="col_2"><?php echo $profile['state'] ?></td>
						</tr>
						<tr>
							<td class="col_1">District</td>
							<td class="col_2"><?php echo $profile['district'] ?></td>
						</tr>
						<tr>
							<td class="col_1">Post Office</td>
							<td class="col_2"><?php echo $profile['postoffice'] ?></td>
						</tr>
						<tr>
							<td class="col_1">Pin</td>
							<td class="col_2"><?php echo $profile['pin'] ?></td>
						</tr>
						<tr>
							<td class="col_1">Gradation List Serial No</td>
							<td class="col_2"><?php echo $profile['grd_slno'] ?></td>
						</tr>
						<tr>
							<td class="col_1">Gradation List Page No</td>
							<td class="col_2"><?php echo $profile['grd_pageno'] ?></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<style>
	.table1 td{padding:5px 0;padding-left:10px; width:50%}
</style>
<div class="row">
	<div class="col-md-3 col-sm-4">
		<div class="left-panel">
			<?php $this->load->view('layout/subscribers_left_panel',$header);?>
		</div>
	</div>
	<div class="col-md-9 col-sm-8">
		<div class="right-panel">
			<div class="breadcrumb"><a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('subscriber')?> &raquo; <?php echo $this->lang->line('dashboard')?>										
			</div>
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
				<div class="row">
					<h4><strong><?php echo $this->lang->line('welcome')?>,</strong> <?php echo $subscribers_data['fst_nme'].' '.$subscribers_data['mid_nme'].' '.$subscribers_data['lst_nme'] ?></h4>
					<hr />
					<div class="table-responsive" style="margin-top: 15px;">
						<table class="table table-bordered table-striped" style="width:100%;">
							<tbody>
								<tr><td style="width: 35%; font-weight: 600;">Series</td><td><?php echo $subscribers_data['series'] ?></td></tr>	
								<tr><td style="font-weight: 600;">GPF A/c No</td><td><span class="badge badge-info" style="font-size: 13px;"><?php echo $subscribers_data['series'].'/WB/'.$subscribers_data['ac_code'] ?></span></td></tr>			
								<tr><td style="font-weight: 600;">Employee Code</td><td><?php echo $subscribers_data['emp_code'] ?></td></tr>		
								<tr><td style="font-weight: 600;">Name</td><td><strong><?php echo $subscribers_data['fst_nme'].' '.$subscribers_data['mid_nme'].' '.$subscribers_data['lst_nme'] ?></strong></td></tr>	
								<tr><td style="font-weight: 600;">Father's / Husband's Name</td><td><?php echo $subscribers_data['nm_father_e'] ?></td></tr>	
								<tr><td style="font-weight: 600;">Date of Birth</td><td><?php if($subscribers_data['dob'] != '1970-01-01 00:00:00'){echo get_date($subscribers_data['dob']); } else {echo '00-00-0000';} ?></td></tr>
								<tr><td style="font-weight: 600;">Date of Joining</td><td><?php if($subscribers_data['date_o_join'] != '1970-01-01 00:00:00'){echo get_date($subscribers_data['date_o_join']); } else {echo '00-00-0000';} ?></td></tr>
								<tr><td style="font-weight: 600;">Gender</td><td><?php if($subscribers_data['sex']=='F'){ echo "Female";} elseif($subscribers_data['sex']=='M'){echo "Male";} else{ echo '';}  ?></td></tr>
								<tr><td style="font-weight: 600;">Allotment Date</td><td><?php if($subscribers_data['allot_dt'] != '1970-01-01 00:00:00'){echo get_date($subscribers_data['allot_dt']); } else {echo '00-00-0000';} ?></td></tr>
								<tr><td style="font-weight: 600;">Mobile</td><td><?php echo $subscribers_data['mobile_no'] ?></td></tr>	
								<tr><td style="font-weight: 600;">Email</td><td><?php echo $subscribers_data['email_id'] ?></td></tr>	
								<tr><td style="font-weight: 600;">Nomination</td><td><?php echo $subscribers_data['nomination'] == 'Y' ? '<span class="label label-success">Yes</span>': '<span class="label label-warning">No</span>'; ?></td></tr>		
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="alert alert-info" style="margin-top: 20px; border-left: 4px solid #275e93; border-radius: 4px; padding: 12px 18px;">
				<div style="font-size: 14px; color: #1e395b; line-height: 1.5;">
					<i class="fa fa-info-circle" style="color: #275e93; margin-right: 6px;"></i>
					<strong>Notice:</strong> You can update your mobile number and other information by sending an email to: 
					<a href="mailto:edpfnd-agae-wb@nic.in" style="font-weight: 700; color: #c9302c;">edpfnd-agae-wb@nic.in</a>.
					Please mention your <em>Name, Designation, GPF A/c No, HRMS ID Number</em> and <em>Date of Birth</em> for verification.
				</div>
			</div>
		</div>
	</div>
</div> 

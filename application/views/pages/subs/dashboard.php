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
					<table class="table1" border="1" style="width:100%">
						<tbody>
							<tr><td class="col_1">Series</td><td class="col_2"><?php echo $subscribers_data['series'] ?></td></tr>	
							<tr><td class="col_1">GPF A/c No</td><td class="col_2"><?php echo $subscribers_data['series'].'/WB/'.$subscribers_data['ac_code'] ?></td></tr>			
							<tr><td class="col_1">Employee Code</td><td class="col_2"><?php echo $subscribers_data['emp_code'] ?></td></tr>		
							<tr><td class="col_1">Name</td><td class="col_2"><?php echo $subscribers_data['fst_nme'].' '.$subscribers_data['mid_nme'].' '.$subscribers_data['lst_nme'] ?></td></tr>	
							<tr><td class="col_1">Father's / Husband's Name</td><td class="col_2"><?php echo $subscribers_data['nm_father_e'] ?></td></tr>	
							<tr><td class="col_1">Date of Birth</td><td class="col_2"><?php if($subscribers_data['dob'] != '1970-01-01 00:00:00'){echo get_date($subscribers_data['dob']); } else {echo '00-00-0000';} ?></td></tr>
							<tr><td class="col_1">Date of Joining</td><td class="col_2"><?php if($subscribers_data['date_o_join'] != '1970-01-01 00:00:00'){echo get_date($subscribers_data['date_o_join']); } else {echo '00-00-0000';} ?></td></tr>
							<tr><td class="col_1">Gender</td><td class="col_2"><?php if($subscribers_data['sex']=='F'){ echo "Female";} elseif($subscribers_data['sex']=='M'){echo "Male";} else{ echo '';}  ?></td></tr>
							<tr><td class="col_1">Allotment Date</td><td class="col_2"><?php if($subscribers_data['allot_dt'] != '1970-01-01 00:00:00'){echo get_date($subscribers_data['allot_dt']); } else {echo '00-00-0000';} ?></td></tr>
							<tr><td class="col_1">Mobile</td><td class="col_2"><?php echo $subscribers_data['mobile_no'] ?></td></tr>	
							<tr><td class="col_1">Email</td><td class="col_2"><?php echo $subscribers_data['email_id'] ?></td></tr>	
							<tr><td class="col_1">Nomination</td><td class="col_2"><?php echo $subscribers_data['nomination'] == 'Y' ? 'Yes': 'No'  ?></td></tr>		
							<tr><td class="col_1">Last Nomination Date</td><td class="col_2"><?php //echo $subscribers_data['nomination'] == 'Y' ? 'Yes': 'No'  ?></td></tr>		
						</tbody>
					</table>
				</div>
			</div>
			<div class="muted pull-left" style = "color: #00004d; font-size:18px;">
				<marquee direction="left"  onMouseOver="this.stop()" onMouseOut="this.start()">
					*You can update your mobile number and other information by sending an email to:- <span style = "color: red;"> edpfnd-agae-wb@nic.in </span>* Please mention your Name, Designation, GPF A/c No, HRMS ID Number and Date of Birth for the purpose.
				</marquee>
			</div>
		</div>
	</div>
</div> 

<style>
.table1 th{text-align:center;
}
.table1 td{text-align:center;
}
</style>
<div class="row">
	<div class="col-md-3 col-sm-4">
		<div class="left-panel">
			<?php $this->load->view('layout/treasury_left_panel',$header);?>
		</div>
	</div>
	<div class="col-md-9 col-sm-8">
		<div class="right-panel">
			<div class="breadcrumb"><a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; Treasury &raquo; Dashboard </div>
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
			<div class="page-details">
				<h4><strong>Welcome, </strong><?php echo $treasury_data['user_name'] ?></h4>
				<hr />
					<h3><span style="color:#3498db; text-align: center">Status of Treasury</span></h3>
					<table class="table1" border="1" style="width:100%">
						<thead>
							<tr style="text-align:center" >
								<th>Sl No</th>
								<th>Treasury</th>
								<th>Mis-class</th>
								<th>OB Sus</th>
								<th>C. Memo</th>
								<th>O. Paras</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if(!empty($results)){?>		
										<?php
										$sl = intval($this->input->get('per_page',true)) + 1;
											foreach($results as $row){?>
												<tr>
													<td><?php echo $sl++ ?></td>
													<td><?php echo $row['tr_nm'] ?></td>
													<td><?php echo $row['misc'] ?></td>
													<td><?php echo $row['obc'] ?></td>
													<td><?php echo $row['csc'] ?></td>
													<td><?php echo $row['ipc'] ?></td>
												</tr>
										<?php		
											}
										?>
							<?php
							}else{?>
							<tr>
								<td colspan="8">No records found!</td>
							</tr>
						<?php
							}?>
							</tbody>
					</table>
			</div>
		</div>
	</div>
</div>

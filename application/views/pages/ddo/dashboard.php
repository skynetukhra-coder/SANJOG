<style>
.table1 td{padding:5px 0;padding-left:10px; width:50%}
</style>
<div class="row">
	<div class="col-md-3 col-sm-4">
		<div class="left-panel">
			<?php $this->load->view('layout/ddo_left_panel',$header);?>
		</div>
	</div>
	<div class="col-md-9 col-sm-8">
			<div class="breadcrumb">
					<a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; DDO &raquo;  Dashboard												
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
		<div class="right-panel">
			<div class="login-box">
				<div class="heading"><?php echo $ddo_data['ddo_desc'] ?></div>
				<div class="name"><font style = "color:green; font-size:18px;">Update Subscriber's DDO to view his / her GPF Statement in the list.</font></div>
				<br />
				<div class="row">
					<table  border="1" style="width:100%">
						<thead>
							<tr style="text-align:center">
								<th style="text-align:center;width:50px;">Sl No.</th>
								<th style="text-align:center;width:15%;">GPF A/c No.</th>
								<th style="text-align:center;width:50%;">Subscribers Name</th>
								<th style="text-align:center;width:15%;">Final payment authority</th>
								<th style="text-align:center;width:15%;">GPF Annual Accounts Statement</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$sl = 1;
							foreach($subscribers as $subs){?>
								<tr>
									<td style="text-align:center;width:10px;"><?php echo $sl++?></td>
									<td class="col_1"><?php echo $subs['series'].'/WB/'.$subs['ac_code']?></td>
									<td class="col_2"><?php echo $subs['fst_nme']?></td>
									<td class="col_2" style="text-align:center; "><?php echo get_fp_authority($subs['series'],$subs['ac_code'])?></td>
									<td class="col_3" style="text-align:center;" >
										<a href="<?php echo SITE_BASE_URL.'ddo/acnt_stat?ac_code='.$subs['ac_code'].'&series='.$subs['series'].'&fyear='.date('Y-m-d',strtotime($subs['fyear']))?>" target="_blank">
											<img src="<?php echo SITE_BASE_URL.'assets/images/PDF.png';?>" style="max-height:40px;"/>
										</a>
									</td>
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
<style>
<style>
.table1 tr{text-align:center;
   font-size:13px;
}
.table1 td{text-align:center;
   font-size:13px;
}
.table1 th{text-align:center;
   font-size:13px;
}
button{ background-color:#6FF88E; text-align: center; font-size:10px;}
button:hover{ background-color: #48BBF9; }
</style>
</style>
<div class="row">
	<div class="col-md-3 col-sm-4">
		<div class="left-panel">
			<?php $this->load->view('layout/ddo_left_panel',$header);?>
		</div>
	</div>
	<div class="col-md-9 col-sm-8">
		<div class="right-panel">
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('ddo'); ?> &raquo;  <?php echo $this->lang->line('try_repor'); ?>Subscriber's DDO</div>
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
				<h4><strong>Current DDO of Subscriber</strong></h4>
				<hr />
					<form method="get">
							<div class="filter-form1">
									<div class="form-group row">
										<div class="col-sm-4">
											 <label class="name-label"><?php echo $this->lang->line('mont'); ?> Series:</label>
												<select class="form-control" id="series_code" name="series">
													<option value="">--- <?php echo $this->lang->line('choose_series_code'); ?> ---</option>
													<?php
														if(isset($series_codes)){
															foreach($series_codes as $code){
																echo '<option value="'.$code['series'].'">'.$code['series'].'</option>';
															}
														}
													?>
												</select>
										</div>
										<div class="col-sm-4">
											<label class="name-label"><?php echo $this->lang->line('yea'); ?>GPF No :</label>
												<input  name ="ac_code" value="" class="form-control"  >
										</div>
										<div class="col-sm-4"><input type="submit" class="submit-btn" value="<?php echo $this->lang->line('search'); ?>" /></div>
									</div>
								</div>
						</form>
					<table class="table1" border="1" style="width:100%">
						<thead>
							<tr style="text-align:center">
								<th style="text-align:center">Sl No</th>
								<th style="text-align:center">Employee ID</th>
								<th style="text-align:center">Name</th>
								<th style="text-align:center">GPF A/c No</th>
								<th style="text-align:center">DDO</th>
								<th style="text-align:center">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
								if(!empty($subs_details)){
									$sl = 1;
									foreach($subs_details as $details){?>
										<tr>
											<td><?php echo $sl++ ?></td>
											<td><?php echo $details['emp_code'] ?></td>
											<td><?php echo $details['fst_nme'] ?> <?php echo $details['mid_nme'] ?> <?php echo $details['lst_nme'] ?></td>
											<td><?php echo $details['series'] ?> / WB/ <?php echo $details['ac_code'] ?></td>
											<td><?php echo $details['cur_ddo'] ?></td>
											<td align="center">
												<button id ="edit" 
												onclick="goEdit('<?php echo $details['subs_id'] ?>')" style="display:inline-block; padding:5px; margin:2px; width:auto"><i 
												class="icon-pencil icon-white"></i> Update</button>
												&nbsp;
											</td>
										</tr>
								<?php	}
								}else{
									echo '<tr><td colspan="7">No documents found!</td></tr>';
								}
							?>
						</tbody>
					</table>
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
        window.location.href = '<?php echo SITE_BASE_URL ?>ddo/subscriber_ddo_update/' + id;
    }
}

</script>
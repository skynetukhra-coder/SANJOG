<?php
$item_id = isset($records['item_id']) ? $records['item_id'] : '';
$item_desc = isset($records['item_desc']) ? $records['item_desc'] : '';
$item_for = isset($records['item_for']) ? $records['item_for'] : '';
$item_cat = isset($records['item_cat']) ? $records['item_cat'] : '';
$item_make = isset($records['item_make']) ? $records['item_make'] : '';
$item_box = isset($records['item_box']) ? $records['item_box'] : '';
$remk = isset($records['remk']) ? $records['remk'] : '';
?>
<div class="row">
	<div class="col-md-3 col-sm-4">
		<div class="left-panel">
			<?php $this->load->view('layout/emp_left_panel',$header);?>
		</div>
	</div>
	<div class="col-md-9 col-sm-8">
		<div class="right-panel">
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('employee'); ?> &raquo; Consumable / Software </div>
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
<!--			
			<div class="form-group row">
				<div class="col-sm-12" style = "text-align: right">
					<!-- Trigger/Open The Modal 
					<button  id="myBtn" class="btn btn-warning">INSTRUCTIONS</button>
				</div>
			</div>
-->			
			<div class="login-box">
				<div class="application-formwrap">
					<form method="post" onmouseover ="disabledField(); AvailByCheck(); FieldsReadOnly();"enctype="multipart/form-data" >
						<div class="row">
						<div class="col-sm-12">
							<div class="top-box">
							<label class="name" style="text-align:center"> <font color="#1E0BA9"><b>CONSUMABLE /SOFTWARE DETAILS</b></font></span></label>
								<div class="row">
									<div id="other_exam_name" class="row" style="display:none;">
										<div class="col-md-8 col-sm-6">
											<div class="form-group">
											
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-4 col-sm-6">
										<label class="name">Item Serial No<span class="star"></span></label>
										<input id="item_id" name="item_id" value="<?php echo $records['item_id'] ?>" type="text" class="form-control" readonly >
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Description</label>
										<input id="item_desc" name="item_desc" value="<?php echo $records['item_desc'] ?>" type="text" class="form-control" >
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Item For</label>
										<select id="item_for" name="item_for" class = "form-control" >
											<option data-value="0" value="">---- Select ----</option>
											<option data-value="1" value="DESKTOP" <?=$records['item_for']=='DESKTOP' ? 'selected="selected"': '' ;?>>DESKTOP</option>
											<option data-value="2" value="LAPTOP" <?=$records['item_for']=='LAPTOP' ? 'selected="selected"': '' ;?>>LAPTOP</option>
											<option data-value="3" value="MONITOR" <?=$records['item_for']=='MONITOR' ? 'selected="selected"': '' ;?>>MONITOR</option>
											<option data-value="4" value="BATTERY" <?=$records['item_for']=='BATTERY' ? 'selected="selected"': '' ;?>>BATTERY</option>
											<option data-value="5" value="LAN" <?=$records['item_for']=='LAN' ? 'selected="selected"': '' ;?>>LAN</option>
											<option data-value="6" value="PRINTER" <?=$records['item_for']=='PRINTER' ? 'selected="selected"': '' ;?>>PRINTER</option>
											<option data-value="7" value="SERVER" <?=$records['item_for']=='SERVER' ? 'selected="selected"': '' ;?>>SERVER</option>
											<option data-value="9" value="OTHER" <?=$records['item_for']=='OTHER' ? 'selected="selected"': '' ;?>>OTHER</option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-4 col-sm-6">
										<label class="name">Item Catetory<span class="star"></span></label>
										<select id="item_cat" name="item_cat" class = "form-control" >
													<option data-value="0" value="" >--- select ---</option>
													<option data-value="1" value="CONSUMABLES" <?=$records['item_cat']=='CONSUMABLES' ? 'selected="selected"': '' ;?>>CONSUMABLES</option>
													<option data-value="2" value="DESKTOP PARTS" <?=$records['item_cat']=='DESKTOP PARTS' ? 'selected="selected"': '' ;?>>DESKTOP PARTS</option>
													<option data-value="3" value="LAPTOP PARTS" <?=$records['item_cat']=='LAPTOP PARTS' ? 'selected="selected"': '' ;?>>LAPTOP PARTS</option>
													<option data-value="4" value="BATTERY PARTS" <?=$records['item_cat']=='BATTERY PARTS' ? 'selected="selected"': '' ;?>>BATTERY PARTS</option>
													<option data-value="5" value="LAN PARTS" <?=$records['item_cat']=='LAN PARTS' ? 'selected="selected"': '' ;?>>LAN PARTS</option>
												</select>
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Make / Product <span class="star"></span></label>
										<input id="item_make" name="item_make" value="<?php echo $records['item_make'] ?>" type="text" class="form-control" >
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Location / Box No<span class="star"></span></label>
										<input id="item_box" name="item_box" value="<?php echo $records['item_box'] ?>" type="text" class="form-control" >
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-4 col-sm-6">
										<label class="name">CD / DVD<span class="star"></span></label>
											<select id="media_type" name="media_type" class = "form-control" >
													<option data-value="0" value="" >--- select ---</option>
													<option data-value="1" value="CD" <?=$records['media_type']=='CD' ? 'selected="selected"': '' ;?>>CD</option>
													<option data-value="2" value="DVD" <?=$records['media_type']=='DVD' ? 'selected="selected"': '' ;?>>DVD</option>
													<option data-value="3" value="CD-DVD" <?=$records['media_type']=='CD-DVD' ? 'selected="selected"': '' ;?>>CD-DVD</option>
											</select>
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Stock / Balance <span class="star"></span></label>
										<input id="stk_bal" name="stk_bal" value="<?php echo $records['stk_bal'] ?>" type="text" class="form-control" >
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-12 col-sm-12 name-mrgbtm">
										<label class="name">Remarks<span class="star"></span></label>
										<input id="remk" name="remk" value="<?php echo $records['remk'] ?>" type="text" class="form-control" >
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-12 col-sm-6 name-mrgbtm">
										
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="btn-wrap">
									<div class="row">
										<div class="col-sm-6 col-xs-6">
											<input type="button" class="btn btn-success" onclick="myCanl();" value="Cancel" />
										</div>
										<div class="col-sm-6 col-xs-6">
											<input id="submit_btn" type="submit" class="btn btn-primary" value="Submit"  />
										</div>
									</div>
								</div>
							</div>
						</div>
							<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
						</div>	
					</form>	
				</div>
			</div>
		</div>
	</div>
</div>

<!--

<div id="myModal" class="modal-small">

  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h2>Instructions</h2>
    </div>
    <div class="modal-body">
      <p>1. Check whether all your inforamation is updated before application. </p>
      <p>2. Fill up the Form carefully.</p>
    </div>
    <div class="modal-footer">
      <h3>Thanks</h3>
    </div>
  </div>

</div>
-->

<script type="text/javascript" src="<?php echo SITE_BASE_URL?>assets/js/jquery.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	$('.datepicker').datepicker({dateFormat:'dd-mm-yy'});
//	document.getElementById("pass_for").style.display = 'none';
});



function myCanl() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/emdbg_cons/';
}



</script>

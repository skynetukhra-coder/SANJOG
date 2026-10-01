<?php
$sl_no = isset($records['sl_no']) ? $records['sl_no'] : '';
$emdbg_type = isset($records['emdbg_type']) ? $records['emdbg_type'] : '';
$entry_dt = isset($records['entry_dt']) ? $records['entry_dt'] : '';
$fin_yr = isset($records['fin_yr']) ? $records['fin_yr'] : '';
$niq_no = isset($records['niq_no']) ? $records['niq_no'] : '';
$niq_dt = isset($records['niq_dt']) ? $records['niq_dt'] : '';
$vend_nm = isset($records['vend_nm']) ? $records['vend_nm'] : '';
$vend_add = isset($records['vend_add']) ? $records['vend_add'] : '';
$dd_cq_no = isset($records['dd_cq_no']) ? $records['dd_cq_no'] : '';
$dd_cq_dt = isset($records['dd_cq_dt']) ? $records['dd_cq_dt'] : '';
$amt = isset($records['amt']) ? $records['amt'] : '';
$valid_from = isset($records['valid_from']) ? $records['valid_from'] : '';
$valid_to = isset($records['valid_to']) ? $records['valid_to'] : '';
$bank_nm = isset($records['bank_nm']) ? $records['bank_nm'] : '';
$status = isset($records['status']) ? $records['status'] : '';
$pao_letter = isset($records['pao_letter']) ? $records['pao_letter'] : '';
$pao_letter_dt = isset($records['pao_letter_dt']) ? $records['pao_letter_dt'] : '';
$autho = isset($records['autho']) ? $records['autho'] : '';
$refund_ref = isset($records['refund_ref']) ? $records['refund_ref'] : '';
$refund_ref_dt = isset($records['refund_ref_dt']) ? $records['refund_ref_dt'] : '';
$autho_dt = isset($records['autho_dt']) ? $records['autho_dt'] : '';
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
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('employee'); ?> &raquo; EMD/BG </div>
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
					<div class="new-cont medium whats-new">
						<ul class="nav nav-tabs " style="background-color: ">
							<li><a data-toggle="tab" href="#tab1" onclick="FinYr()" >Add Financial Year</a></li>
							<li><a data-toggle="tab" href="#tab2" onclick="EmdBank()" >Add Bank</a></li>
							<li><a data-toggle="tab" href="#tab3" onclick="EmdVend()" >Add Vendor</a></li>
							<li class="active" ><a data-toggle="tab" href="#tab" onclick="EmdbgDtail()" >ADD EMD/BG Dtails</a></li>
							<li><a data-toggle="tab" href="#tab" onclick="EmdbgBills()" >ADD EMD/BG Bills</a></li>
						</ul>
					</div>
				<div class="application-formwrap">
					<form method="post" onmouseover ="disabledField(); AvailByCheck(); FieldsReadOnly();"enctype="multipart/form-data" >
						<?php
								if(!empty($leave_balance)){
									$s1=0;
									foreach($leave_balance as $balance){											
											$s1=$balance['leave_cb']; 
									}
								}else{
									$s1=0;
								}?>
						<div class="row">
						<div class="col-sm-12">
							<div class="top-box">
							<label class="name" style="text-align:center"> <font color="#1E0BA9"><b>EMD / BG DETAILS</b></font></span></label>
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
										<label class="name">Serial No<span class="star"></span></label>
										<input id="sl_no" name="sl_no" value="<?php echo $records['sl_no'] ?>" type="text" class="form-control" >
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">EMD / BG</label>
										<input id="emdbg_type" name="emdbg_type" value="<?php echo $records['emdbg_type'] ?>" type="text" class="form-control" >
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Entry Date</label>
										<input id="entry_dt" name="entry_dt" type="text" value="<?php echo get_datepicker_date($records['entry_dt']) ?>" class="form-control datepicker" >
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-4 col-sm-6">
										<label class="name">Financial Year<span class="star"></span></label>
										<input id="fin_yr" name="fin_yr" value="<?php echo $records['fin_yr'] ?>" type="text" class="form-control" >
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">NIQ No<span class="star"></span></label>
										<input id="niq_no" name="niq_no" value="<?php echo $records['niq_no'] ?>" type="text" class="form-control" >
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">NIQ Date<span class="star"></span></label>
										<input id="niq_dt" name="niq_dt" value="<?php echo get_datepicker_date($records['niq_dt']) ?>" type="text" class="form-control datepicker" >
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-4 col-sm-6">
										<label class="name">Vendor Name<span class="star"></span></label>
										<input id="vend_nm" name="vend_nm" value="<?php echo $records['vend_nm'] ?>" type="text" class="form-control" >
									</div>
									
									<div class="col-md-8 col-sm-6 name-mrgbtm">
										<label class="name">Vendor Address<span class="star"></span></label>
										<input id="vend_add" name="vend_add" type="text"  value="<?php echo $records['vend_add'] ?>" class="form-control" >
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">DD / Cheque No</label>
										<input id="dd_cq_no" name="dd_cq_no"  type="text" value="<?php echo $records['dd_cq_no'] ?>" class="form-control" required>
									</div>
									<div class="col-md-4 col-sm-6">
										<label class="name">DD / Cheque Date<span class="star"></span></label>
										<input id="dd_cq_dt" name="dd_cq_dt" value="<?php echo get_datepicker_date($records['dd_cq_dt']) ?>" type="text" class="form-control datepicker" >
									</div>
									<div class="col-md-4 col-sm-6">
										<label class="name">Amount<span class="star"></span></label>
										<input id="amt" name="amt" type="text"  value="<?php echo $records['amt'] ?>" class="form-control" >
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Valid From<span class="star"></span></label>
											<input id="valid_from" name="valid_from" type="text"  value="<?php echo get_datepicker_date($records['valid_from']) ?>" class="form-control datepicker" >
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Valid To</label>
										<input id="valid_to" name="valid_to"  type="text" value="<?php echo get_datepicker_date($records['valid_to']) ?>" class="form-control datepicker" required>
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Refund Status<span class="star"></span></label>
										<select id="status" name="status" class="form-control" required >
											<option value="">---- Select Type -----</option>
											<option value="Received" <?=$records['status']=='Received' ? 'selected="selected"': '' ;?> >Received</option>
											<option value="Deposited" <?=$records['status']=='Deposited' ? 'selected="selected"': '' ;?> >Deposited</option>
											<option value="Refunded"<?=$records['status']=='Refunded' ? 'selected="selected"': '' ;?> >Refunded</option>
											<option value="Unclaimed" <?=$records['status']=='Unclaimed' ? 'selected="selected"': '' ;?>>Unclaimed</option>
											<option value="Forfieted" <?=$records['status']=='Forfieted' ? 'selected="selected"': '' ;?>>Forfieted</option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
								<div class="col-md-8 col-sm-6 name-mrgbtm">
									<label class="name">Bank Branch</label>
									<input id="bank_nm" name="bank_nm" value="<?php echo $records['bank_nm'] ?>" type="text" class="form-control" >
								</div>
								<div class="col-md-4 col-sm-6">
										<label class="name">Refund Date<span class="star"></span></label>
										<input id="refund_dt" name="refund_dt" type="text"  value="<?php echo get_datepicker_date($records['refund_dt']) ?>" class="form-control datepicker" >
								</div>
								</div>
							</div>
							<div class="col-sm-12">
							<div class="btn-wrap">
								<div class="form-group row">
									<div class="col-md-4 col-sm-6">
										<label class="name">PAO Letter<span class="star"></span></label>
										<input id="pao_letter" name="pao_letter" value="<?php echo $records['pao_letter'] ?>" type="text" class="form-control" >
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">PAO Letter Date<span class="star"></span></label>
										<input id="pao_letter_dt" name="pao_letter_dt" value="<?php echo get_datepicker_date($records['pao_letter_dt']) ?>" type="text" class="form-control datepicker" >
									</div>
									
								</div>
							</div>
							</div>
							<div class="col-sm-12">
								<div class="btn-wrap">
								<div class="form-group row">
									<div class="col-md-4 col-sm-6">
										<label class="name">Authoity<span class="star"></span></label>
										<input id="autho" name="autho" value="<?php echo $records['autho'] ?>" type="text" class="form-control" >
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Reference File No<span class="star"></span></label>
											<input id="refund_ref" name="refund_ref" type="text"  value="<?php echo $records['refund_ref'] ?>" class="form-control" >
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Reference Date</label>
										<input id="refund_ref_dt" name="refund_ref_dt"  type="text" value="<?php echo get_datepicker_date($records['refund_ref_dt']) ?>" class="form-control datepicker" >
									</div>
								</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Authoity Date<span class="star"></span></label>
										<input id="autho_dt" name="autho_dt" value="<?php echo get_datepicker_date($records['autho_dt']) ?>" type="text" class="form-control datepicker" >
									</div>
									<div class="col-md-8 col-sm-6 name-mrgbtm">
										<label class="name">Remarks<span class="star"></span></label>
										<input id="remk" name="remk" value="<?php echo $records['remk'] ?>" type="text" class="form-control" >
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
<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>

<script type="text/javascript">
$(document).ready(function(){
	$('.datepicker').datepicker({dateFormat:'dd-mm-yy'});
//	document.getElementById("pass_for").style.display = 'none';
});

function show_hide_submit(){
	if($('#i_agree').is(':checked')){
		$('#submit_btn').prop('disabled',false);
	}else{
		$('#submit_btn').prop('disabled',true);
	}
}

function previewImage(file_obj,container_id){
	 if (file_obj.files && file_obj.files[0]) {
		var url = file_obj.value;
		var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
		var filename =  url.substring(url.lastIndexOf('/') + 1);
		filename =  filename.substring(filename.lastIndexOf('\\') + 1);
		if( ext == 'pdf'){
      $('#'+container_id).html('<em>&nbsp;&nbsp;' + filename + '</em>');
    }else{
      $('#attachment').val(''); 
      $('#'+container_id).html('');      
      alert('file type not supported! Supported file types is .pdf');
    }
	}
}
function filterEmployeeByDesignation(desig){
  desig = desig.toLowerCase();
   $('.emp-row').each(function(i){
      if(desig != 'all'){
        $(this).css('display','none');
        if($(this).attr('data-designation') == desig){
          $(this).css('display','block');
        }
      }else{
        $(this).css('display','block');
      }
    });
   checkUncheckAll();
}

function checkSelectedOnly(){
  let isChecked = $('#selected-only').is(':checked');
  $('.emp-row').each(function(i){
    if(isChecked){
      if(!$(this).find('input').prop('checked')){
        $(this).css('display','none');
      }
    }else{
      $(this).css('display','block');
    }
  });
}

function checkUncheckAll(){
  var desig = $('#filter-designation').val().toLowerCase();
  let isChecked = $('#all-checked').is(':checked');
  $('.emp-row').each(function(i){
    $(this).find('input').prop('checked',false);
    if(isChecked){
      if(desig != 'all'){
        if($(this).attr('data-designation') == desig){
          $(this).find('input').prop('checked',true);
        }
      }else{
        $(this).find('input').prop('checked',true);
      }
    }    
  });
}
function selectcheckbox(id){
	for ( var i =1; i<=4;i++)
	{
		document.getElementById(i).checked = false;
	}
	document.getElementById(id).checked = true;	
}

function browse(){
	$('#attachment').click();
}

function MyAlert(){
//	var myText = "Instructions\n\n** Update your inforamation before applying leave.\n\** Select the type of leave that you want to apply.\n\** Click on the Select button.\n\** Check whether the balance is showing under Balance.\n\** Enter 'No of Days' in numerical value i.e. 1, 2, 3 etc. \n\** For Commuted Leave, enter no of days multiplyig by 2. \n\** For example, Enter 20 no of days of  Half Pay Leave for 10 Days Commuted Leave. \n\** Select the Designation of the Leave Sanctioning Authority.\n\** Click the Radio button against the Authoity.\n\** Write the Capta and Submit the leave.";
    myText ='Please Read Intructions before application.'
	alert (myText);
}
function EmdbgDtail() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/emdbg_add/';
}
function EmdbgBills() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/emdbg_bill_add/';
}
function FinYr() {
    //if (id != undefined) {
		window.location.href = '<?php echo SITE_BASE_URL ?>emp/emdbg_finyr_add/';
    //}
}
function EmdBank() {
    //if (id != undefined) {
		window.location.href = '<?php echo SITE_BASE_URL ?>emp/emdbg_bank_add/';
    //}
}
function EmdVend() {
    //if (id != undefined) {
		window.location.href = '<?php echo SITE_BASE_URL ?>emp/emdbg_vendor_add/';
    //}
}
function myCanl() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/emdbg_all/';
}

function PassVisa(){
	var val = document.getElementById('pass_ren_visa').value;
	
if (val == 'Passport' || val == 'Passport Renewal'  ) 
    {
		document.getElementById("pass_for").disabled = true;
		document.getElementById("pass_for").style.display = 'block';
		document.getElementById("visa_for").disabled = false;
		document.getElementById("visa_for").style.display = 'none';
		
    }
	else{
		document.getElementById("visa_for").disabled = true;
		document.getElementById("visa_for").style.display = 'block';
		document.getElementById("pass_for").disabled = false;
		document.getElementById("pass_for").style.display = 'none';
	}
}

</script>

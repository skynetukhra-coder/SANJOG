<?php
$attachment = isset($records['attachment']) ? $records['attachment'] : '';
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
							<li class="active" ><a data-toggle="tab" href="#tab" onclick="ProcDtail()" >ADD Procurement Bill</a></li>
							<li><a data-toggle="tab" href="#tab" onclick="EmdbgBills()" >ADD EMD/BG Bill</a></li>
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
							<label class="name" style="text-align:center"> <font color="#1E0BA9"><b>Procurement Bill Details</b></font></span></label>
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
										<input id="invsl_no" name="invsl_no" value="" type="text" class="form-control" >
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Inward No</label>
										<input id="inward_no" name="inward_no" value="" type="text" class="form-control" >
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Entry Date</label>
										<input id="entry_dt" name="entry_dt" type="text" value="<?php echo get_datepicker_date(date('Y-m-d')) ?>" class="form-control datepicker" >
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-4 col-sm-6">
										<label class="name">Financial Year<span class="star"></span></label>
										<select  id="fin_yr" name="fin_yr" class="form-control" required>
											<option value="">--- Select Financial Year ---</option>
												<?php
													if(isset($years)){
														foreach($years as $year){
															echo '<option value="'.$year['fin_year'].'">'.$year['fin_year'].'</option>';
														}
													}
												?>
										</select>
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">NIQ No<span class="star"></span></label>
										<input id="niq_no" name="niq_no" value="" type="text" class="form-control" required>
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">NIQ Date<span class="star"></span></label>
										<input id="niq_dt" name="niq_dt" value="" type="text" class="form-control datepicker" required>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">PO No<span class="star"></span></label>
										<input id="po_letter_no" name="po_letter_no" value="" type="text" class="form-control" >
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">PO Date<span class="star"></span></label>
										<input id="po_letter_dt" name="po_letter_dt" value="" type="text" class="form-control datepicker" >
									</div>
									<div class="col-md-4 col-sm-6">
										<label class="name">Purpose<span class="star"></span></label>
										<input id="purpos" name="purpos" value="" type="text" class="form-control" >
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-4 col-sm-6">
										<label class="name">Vendor Name<span class="star"></span></label>
										<select  id="vend_nm" name="vend_nm" class="form-control" required>
												<option value="">--- Select Vendor ---</option>
												<?php
													if(isset($vendors)){
														foreach($vendors as $vendor){
															echo '<option value="'.$vendor['vendor_nm'].'">'.$vendor['vendor_nm'].'</option>';
														}
													}
												?>
										</select>
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Vendor Address<span class="star"></span></label>
										<input id="vend_add" name="vend_add" type="text"  value="" class="form-control" >
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Budget Category</label>
										<select id="budg_cat" name="budg_cat" class = "form-control" >
											<option data-value="0" value="AMC HW" >--- select ---</option>
											<option data-value="1" value="AMC" >AMC</option>
											<option data-value="2" value="HARDWARE" >HARDWARE</option>
											<option data-value="2" value="CONSUMABLES" >CONSUMABLES</option>
											<option data-value="4" value="LAN" >LAN</option>
											<option data-value="5" value="SOFTWARE" >SOFTWARE</option>										
											<option data-value="6" value="SMS" >SMS</option>
											<option data-value="7" value="OIOS" >OIOS</option>
											<option data-value="7" value="ICT" >ICT</option>
											<option data-value="8" value="MACHINERY" >MACHINERY</option>
											<option data-value="9" value="OTHER" >OTHER</option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Challan No<span class="star"></span></label>
											<input id="chall_no" name="chall_no" type="text"  value="" class="form-control " >
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Challan Date</label>
										<input id="chall_dt" name="chall_dt"  type="text" value="" class="form-control datepicker" required>
									</div>
									<div class="col-md-4 col-sm-6">
										<label class="name">Work Type<span class="star"></span></label>
										<select id="trans_type" name="trans_type" class = "form-control" >
											<option data-value="0" value="AMC HW" >--- select ---</option>
											<option data-value="1" value="AMC HW" >AMC HW</option>
											<option data-value="2" value="AMC UPS" >AMC UPS</option>
											<option data-value="3" value="AMC LIPI" >AMC LIPI</option>
											<option data-value="4" value="HARDWARE" >HARDWARE</option>
											<option data-value="5" value="DESKTOP" >DESKTOP</option>
											<option data-value="6" value="LAPTOP" >LAPTOP</option>
											<option data-value="7" value="CONSUMABLES" >CONSUMABLES</option>
											<option data-value="8" value="BATTERY" >BATTERY</option>
											<option data-value="9" value="LAN" >LAN</option>
											<option data-value="10" value="SOFTWARE" >SOFTWARE</option>	
											<option data-value="11" value="GPF" >GPF</option>													
											<option data-value="12" value="VLC" >VLC</option>
											<option data-value="13" value="PSAI" >PSAI</option>
											<option data-value="14" value="SMS" >SMS</option>
											<option data-value="14" value="ICT" >ICT</option>
											<option data-value="15" value="MACHINERY" >MACHINERY</option>
											<option data-value="16" value="OIOS" >OIOS</option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Invoice No</label>
										<input id="inv_no" name="inv_no"  type="text" value="" class="form-control" required>
									</div>
									<div class="col-md-4 col-sm-6">
										<label class="name">Invoice Date<span class="star"></span></label>
										<input id="inv_dt" name="inv_dt" value="" type="text" class="form-control datepicker" >
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Invoice Amount</label>
										<input id="invoc_amt" name="invoc_amt"  type="text" value="" class="form-control" required>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Bill No<span class="star"></span></label>
											<input id="bill_no" name="bill_no" type="text"  value="" class="form-control " >
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Bill Date</label>
										<input id="bill_dt" name="bill_dt"  type="text" value="" class="form-control datepicker" required>
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
									<label class="name">Amount</label>
									<input id="bill_amt" name="bill_amt" type="text"  value="" class="form-control" >
								</div>
								</div>
							</div>
							
							<div class="control-group" title ="Click the Radio button against the authotity to whom you want to send the applicaiton.">
								<label class="control-label">Bank Branch</label>
								<div class="controls">
								  <div class="filter-area">
									<div class="filter-row">
									  <div class="filter" style="display: inline-block; margin: 0px 10px 0px 0px;">
										
									  </div>
									  <div class="filter" style="display: inline-block; margin: 0px 10px 0px 10px;">
										<select type= "hidden" id="filter-designation" onchange="filterEmployeeByDesignation(this.value)">
										  <option  value="all">*</option>		
										  <?php
											foreach($designation as $value){
											  echo '<option value="'.$value.'">'.$value.'</option>';
											}
										  ?>
										</select>
	 
									  </div>
									  <div class="filter" style="display: inline-block; margin: 0px 0px 0px 10px;">
   
									  </div>
									</div> 
								  </div>
								  <div class="epmloyees-list" style="width:100%; max-height: 100px; overflow: auto;">
										<?php
										  foreach($banks as $bank){
										       echo '<div class="minor-row"><input type="checkbox" name="bank_nm['.$bank['ifsc_code'].']" value="'.$bank['bank_name'].'" />&nbsp; '.$bank['bank_name'].'  [ '.$bank['ifsc_code'].' ]</div>';
										}?>
								  </div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Bank A/c No<span class="star"></span></label>
											<input id="bank_acno" name="bank_acno" type="text"  value="" class="form-control " >
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Amount Paid<span class="star"></span></label>
											<input id="paid_amnt" name="paid_amnt" type="text"  value="" class="form-control " >
									</div>
									<div class="col-md-2 col-sm-6 name-mrgbtm">
										<label class="name">Status</label>
										<select id="status" name="status" class="form-control" required >
											<option value="">---- Select Type -----</option>
											<option value="Received" >Received</option>
											<option value="Initiated" >Initiated</option>
											<option value="Billed" >Billed</option>
											<option value="Paid"  >Paid</option>
										</select>
									</div>
									<div class="col-md-2 col-sm-6 name-mrgbtm">
										<label class="name">Mode</label>
										<select id="status" name="gem_pm" class="form-control" required >
											<option value="">---- Select Type -----</option>
											<option value="GEM" >GeM Procurement</option>
											<option value="OTHER" >Other</option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
							
							<div class="col-sm-12">
								<div class="btn-wrap">
								<div class="form-group row">
									<div class="col-md-4 col-sm-6">
										<label class="name">Authoity<span class="star"></span></label>
										<input id="autho" name="autho" value="" type="text" class="form-control" >
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">File No<span class="star"></span></label>
											<input id="file_no" name="file_no" type="text"  value="" class="form-control" >
									</div>
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">File Date</label>
										<input id="file_dt" name="file_dt"  type="text" value="" class="form-control datepicker" >
									</div>
								</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="col-md-4 col-sm-6 name-mrgbtm">
										<label class="name">Authoity Date<span class="star"></span></label>
										<input id="autho_dt" name="autho_dt" value="" type="text" class="form-control datepicker" >
									</div>
									<div class="col-md-8 col-sm-6 name-mrgbtm">
										<label class="name">Remarks<span class="star"></span></label>
										<input id="remk" name="remk" value="" type="text" class="form-control" >
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="btn-wrap">
									<div class="row">
										<div class="col-sm-6 col-xs-6">
											<input type="button" class="btn btn-success" onclick="window.location.reload();" value="Reset" />
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
function ProcDtail() {
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


</script>

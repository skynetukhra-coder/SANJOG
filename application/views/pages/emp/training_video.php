<div class="row">
	<div class="col-md-3 col-sm-4">
		<div class="left-panel">
			<?php $this->load->view('layout/emp_left_panel',$header);?>
		</div>
	</div>
	<div class="col-md-9 col-sm-8">
		<div class="right-panel">
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('employee'); ?> &raquo; <?php echo $this->lang->line('my_documents'); ?> &raquo; Documemts</div>
			<div class="login-box">
					<div class="new-cont medium whats-new">
						<ul class="nav nav-tabs " style="background-color: ">
							<li><a data-toggle="tab" href="#tab" onclick="AdmnOrder()" >Administrative Order</a></li>
							<li><a data-toggle="tab" href="#tab1" onclick="BookMan()" >Books and Manual</a></li>
							<li><a data-toggle="tab" href="#tab2" onclick="TryMat()" >Training Material</a></li>
							<li class="active"><a data-toggle="tab" href="#tab3" onclick="myVideo()" >Training Videos</a></li>
							<li><a data-toggle="tab" href="#tab4" onclick="TryRept()" >Treasury Inspection Report</a></li>
							
						</ul>
					</div>
					<div>&nbsp;</div>
				<h4><strong>E-Office Training Videos</strong></h4>
				<hr />
				<div>
					<span>
						<select id="eoff_video" name="eoff_video" class="form-control" onchange = "">
							<option value="">--- Select Video ---</option>
							<option value="0">eOffice-Accessing eOffice through VPN</option>
							<option value="1">eOffice-Receipt Diarisation 1</option>
							<option value="2">eOffice-Receipt Diarisation 2</option>
							<option value="51">eOffice-Open letter received in e-Office</option>
							<option value="52">eOffice-Diarise letter received in e-Office</option>
							<option value="3">eOffice-Put a Receipt in a File </option>
							<option value="4">eOffice-Attaching Receipt in Correspondence side of a File </option>
							<option value="5">eOffice-Detaching Receipt from Correspondence side of a File</option>
							<option value="6">eOffice-Attaching File or Receipt with a File (Showing as clip after File No)</option>
							<option value="7">eOffice-Detaching File Receipt from a File (Not showing in Correspondence Side)</option>
							<option value="8">eOffice-Editing Reciept</option>
							<option value="9">eOffice-Noting in a File</option>
							<option value="10">eOffice-Hyperlinking page from Correspondence in a Note</option>
							<option value="11">eOffice-Creating new Draft in a File</option>
							<option value="12">eOffice-Editing Draft in a File</option>
							<option value="13">eOffice-Editing Recipient in Draft in a File</option>
							<option value="14">eOffice-Open Aproved Draft</option>
							<option value="15">eOffice-Ink Signing and Confirmation</option>
							<option value="16">eOffice-Add Recipients in a Draft</option>
							<option value="17">eOffice-Edit Recipients in a Draft</option>
							<option value="18">eOffice-Initiating Dispatch of Approved Draft</option>
							<option value="19">eOffice-Add more Recipients in Approved Draft</option>
							<option value="20">eOffice-No eMail Option during dispatching Draft</option>
							<option value="21">eOffice-Write eMail Details while dispatching Draft</option>
							
							<option value="22">EMD-Create New User</option>
							<option value="23">EMD-Search Employee </option>
							<option value="24">EMD-Relieving Employee from Old Designation</option>
							<option value="25">EMD-Assigning Employee a New Designation</option>
							<option value="26">EMD-Relieving Employee from Old Post</option>
							<option value="27">EMD-Assigning Employee to a New Post</option>
						</select>
					<span>
				</div>	
				<div>
					<video id="screen" width="835" height="450" controls>
						<source  type=video/mp4>
					</video>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="<?php echo SITE_BASE_URL?>assets/js/jquery.min.js"></script>

<script>
$(document).ready(function(){
	$('.datepicker').datepicker({dateFormat:'dd-mm-yy'});
});
</script>

<script>
document.getElementById("eoff_video").onchange = function() {myFunction()};
function myFunction() {
  var x = document.getElementById("eoff_video").value;
  if (x == 0 ){
	var url = "https://agwb.cag.gov.in/files/videos/V0.mp4";
  }
  if (x == 1 ){
	var url = "https://agwb.cag.gov.in/files/videos/R1.mp4";
  }
  if (x == 2 ){
	var url = "https://agwb.cag.gov.in/files/videos/R2.mp4";
  }
   if (x == 51 ){
	var url = "https://agwb.cag.gov.in/files/videos/RL.mp4";
  }
   if (x == 52 ){
	var url = "https://agwb.cag.gov.in/files/videos/RLD.mp4";
  } 
  if (x == 3 ){
	var url = "https://agwb.cag.gov.in/files/videos/R3.mp4";
  }
  if (x == 4 ){
	var url = "https://agwb.cag.gov.in/files/videos/R4.mp4";
  }
  if (x == 5 ){
	var url = "https://agwb.cag.gov.in/files/videos/R5.mp4";
  }
   if (x == 6 ){
	var url = "https://agwb.cag.gov.in/files/videos/R6.mp4";
  }
   if (x == 7 ){
	var url = "https://agwb.cag.gov.in/files/videos/R7.mp4";
  }
  if (x == 8 ){
	var url = "https://agwb.cag.gov.in/files/videos/R8.mp4";
  }
  if (x == 9 ){
	var url = "https://agwb.cag.gov.in/files/videos/F9.mp4";
  }
  if (x == 10 ){
	var url = "https://agwb.cag.gov.in/files/videos/F10.mp4";
  }
  if (x == 11 ){
	var url = "https://agwb.cag.gov.in/files/videos/F11.mp4";
  }
  if (x == 12 ){
	var url = "https://agwb.cag.gov.in/files/videos/F12.mp4";
  }
  if (x == 13 ){
	var url = "https://agwb.cag.gov.in/files/videos/F13.mp4";
  }
  if (x == 14 ){
	var url = "https://agwb.cag.gov.in/files/videos/D11.mp4";
  }
  if (x == 15 ){
	var url = "https://agwb.cag.gov.in/files/videos/D12.mp4";
  }
  if (x == 16 ){
	var url = "https://agwb.cag.gov.in/files/videos/D13.mp4";
  }
  if (x == 17 ){
	var url = "https://agwb.cag.gov.in/files/videos/D14.mp4";
  }
  if (x == 18 ){
	var url = "https://agwb.cag.gov.in/files/videos/D15.mp4";
  }
  if (x == 19 ){
	var url = "https://agwb.cag.gov.in/files/videos/D16.mp4";
  }
  if (x == 20 ){
	var url = "https://agwb.cag.gov.in/files/videos/D17.mp4";
  }
  if (x == 21 ){
	var url = "https://agwb.cag.gov.in/files/videos/D18.mp4";
  }
  
  if (x == 22 ){
	var url = "https://agwb.cag.gov.in/files/videos/EMD1.mp4";
  }
  if (x == 23 ){
	var url = "https://agwb.cag.gov.in/files/videos/EMD2.mp4";
  }
  if (x == 24 ){
	var url = "https://agwb.cag.gov.in/files/videos/EMD3.mp4";
  }
  if (x == 25 ){
	var url = "https://agwb.cag.gov.in/files/videos/EMD4.mp4";
  }
  if (x == 26 ){
	var url = "https://agwb.cag.gov.in/files/videos/EMD5.mp4";
  }
  if (x == 27 ){
	var url = "https://agwb.cag.gov.in/files/videos/EMD6.mp4";
  }
  document.getElementById("screen").src = url;
}
</script>

<script>
function AdmnOrder() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/administrative_order/';
}
function BookMan() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/kms_document/';
}
function TryMat(id, type) {
   window.location.href = '<?php echo SITE_BASE_URL ?>emp/training_material/';
}
function myVideo(id, type) {
   window.location.href = '<?php echo SITE_BASE_URL ?>emp/training_video/';
}
function TryRept(id, type) {
   window.location.href = '<?php echo SITE_BASE_URL ?>emp/treasury_ir/';
}

</script>
<style>
.col_1{font-weight:bold;}
.hide_res{display:none;}
.show_res{display:block;}
.return_reason_li{
	border-bottom:1px solid gray;
	padding:5px 5px 5px 5px; 
	font-size:13px;
}
.show_more,.show_less{
	cursor: pointer;
    color: #c25700;
    font-weight: bold;
    font-size: 12px;
}
.show_less{
	display:none;
}
</style>
<?php
	$application_no = isset($user) ? $user: '';
?>
<!--	<div class="col-md-9 col-sm-8 col-md-push-3 col-sm-push-4">		-->
<div align= "center" >
		<div class="right-panel">
			<div class="breadcrumb" align= "left"><a href="https://agwb.cag.gov.in/" role="link">Principal Accountant General (A & E)</a> &raquo; Pension &raquo; Pensioner Copy Download</div>
			<div class="msg_cont">
				<div class="success">
									</div>
				<div class="err">
									</div>
			</div>
			<div>
				<h3 class="title">Pension Payment Order(PPO) / Graguity Payment Order(GPO) / Comutation Payment Order</h3>
				<div class="page-details">
				<form id="fpa" method="post">
					<div class="row">
					<div class="col-md-1"></div>
<!--					
						<div class="col-md-2">
							<Label>Series</Label>
						</div>
						<div class="col-md-2">
							<input type="text" name="series" id="series" data-class="series" placeholder="Series" value='' class="form-control accno">
						</div>
-->					
						<div class="col-md-2">
							<Label><b>Appliction No:</b></Label>
						</div>
						<div class="col-md-2">
							<input type="text" name="accno" id="accno" data-class="accno" placeholder="Appliction No" value="<?php echo $application_no?>" class="form-control accno" readonly>
						</div>

					<div class="Search-Result" id="Result"></div>
					<div class="col-md-2"><input type="submit" class="submit-btn btn-success btn-lg" value="Search" /></div>
					</div>
					</div>
					</div>
					<div><input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" /></div>
				</form>
				<div>&nbsp;</div>

<?php
//			if ((isset($_POST['series'])) && (isset($_POST['accno']))) {
			if ((isset($_POST['accno']))) {
//				$pname=strtolower('PPO_'.$_POST['series'].$_POST['accno']).'.pdf';
				$pname=strtoupper('PPO_'.$_POST['accno']).'.pdf';
				$ppath='pension/ppo/'.$pname;
//				$gname=strtolower('GPO_'.$_POST['series'].$_POST['accno']).'.pdf';
				$gname=strtoupper('GPO_'.$_POST['accno']).'.pdf';
				$gpath='pension/ppo/'.$gname;
//				$cname=strtolower('CPO_'.$_POST['series'].$_POST['accno']).'.pdf';
				$cname=strtoupper('CPO_'.$_POST['accno']).'.pdf';
				$cpath='pension/ppo/'.$cname;
				$pgc='<div class="row row-centered"><div class="col-md-12"></div>';
				if (file_exists($ppath)) {
					$pgc.='<div class="col-md-4 col-centered"><a class="btn btn-primary" href="#" data-link="'.$ppath.'" id="lnk" style="width:25%;">VIEW PPO</a></div>';
				} else {
					$pgc.='<div class="col-md-4 col-centered">No PPO</div>';
				}
				if (file_exists($gpath)) {
					$pgc.='<div class="col-md-4 col-centered"><a class="btn btn-primary" href="#" data-link="'.$gpath.'" id="lnk1" style="width:25%;">VIEW GPO</a></div>';
				} else {
					$pgc.='<div class="col-md-4 col-centered">No GPO</div>';
				}
				if (file_exists($cpath)) {
					$pgc.='<div class="col-md-4 col-centered"><a class="btn btn-primary" href="#" data-link="'.$cpath.'" id="lnk2" style="width:25%;">VIEW CPO</a></div>';
				} else {
					$pgc.='<div class="col-md-4 col-centered">No CPO</div>';
				}
				$pgc.='</div>';
			}
			else {
				$pgc='<h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Search Result.</h3>';
			}
			echo $pgc;
			?>
			<div>
				<iframe id="ppogpocpo" width="90%" height="750px;"></iframe>
			</div>

				</div>
			</div>
		</div>
	</div>

</div>
<script>
function show_all_return(){
 	$('.return_reason_li').each(function(){
		$(this).css('display','block');
	});
 }
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script type="text/javascript">
	$(document).ready(function () {
//		var b_url = "https://localhost/";
		var b_url = "https://agwb.cag.gov.in/";
  	$("#lnk").click(function () {
    	var url = $(this).attr('data-link');
		var f_url = b_url.concat(url);
//		alert (f_url);
      $("#ppogpocpo").attr('src', f_url);
    });
    $("#lnk1").click(function () {
    	var url = $(this).attr('data-link');
		var f_url = b_url.concat(url);
      $("#ppogpocpo").attr('src', f_url);
    });
    $("#lnk2").click(function () {
    	var url = $(this).attr('data-link');
		var f_url = b_url.concat(url);
      $("#ppogpocpo").attr('src', f_url);
    });
  });
</script>

<div id="myBtn" class="scroll-top-btn" onclick="topFunction()"><i class="fa fa-angle-up" style="font-size:35px;"></i></div>
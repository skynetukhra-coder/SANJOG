<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start();
//error_reporting(1);
//ini_set('display_errors', 0);
//ini_set('display_startup_errors', 0);
//error_reporting(E_ALL);

$host='10.246.20.147';
$username = "karmick";
$password = "Karmick@123";
$dbname = "agwb";

$con = new mysqli($host, $username, $password, $dbname);
if($con->connect_error) {
  die("Connection Failed : " . $con->connect_error);
} 
date_default_timezone_set("Asia/Kolkata"); 
$con->set_charset("utf8");
if (isset($_POST['file']) || isset($_POST['remarks'])){
	$id = strip_tags(mysqli_real_escape_string($con, $_POST['id']));
	$ser = strip_tags(mysqli_real_escape_string($con, $_POST['ser']));
	$acc = strip_tags(mysqli_real_escape_string($con, $_POST['acc']));
	$miss_yr = strip_tags(mysqli_real_escape_string($con, $_POST['misscrdr']));
	$miss_mon = strip_tags(mysqli_real_escape_string($con, $_POST['misscdmnth']));
	$mcode = strip_tags(mysqli_real_escape_string($con, $_POST['mcode']));
	$payhead = strip_tags(mysqli_real_escape_string($con, $_POST['payhead']));
	$tcode = strip_tags(mysqli_real_escape_string($con, $_POST['tcode']));
	$treasury = strip_tags(mysqli_real_escape_string($con, $_POST['treasury']));
	$dcode = strip_tags(mysqli_real_escape_string($con, $_POST['dcode']));
	$ddo = strip_tags(mysqli_real_escape_string($con, $_POST['ddo']));
	$scat = strip_tags(mysqli_real_escape_string($con, $_POST['scat']));
	$samt = strip_tags(mysqli_real_escape_string($con, $_POST['samt']));
	$othcat = strip_tags(mysqli_real_escape_string($con, $_POST['othcat']));
	$ramt = strip_tags(mysqli_real_escape_string($con, $_POST['ramt']));
	$tvno = strip_tags(mysqli_real_escape_string($con, $_POST['tvno']));
	$tvdt = strip_tags(mysqli_real_escape_string($con, $_POST['tvdt']));
	$remarks = strip_tags(mysqli_real_escape_string($con, $_POST['remarks']));
	$rply_dt = date('Y-m-d');
	$reply_date = strip_tags(mysqli_real_escape_string($con, $rply_dt));
	$usr = '';//$_SESSION['mail'];
	$ip = $_SERVER['REMOTE_ADDR'];
	$dt= date('Y-m-d H:i:s');
	$filename = $_FILES['file']['name'];
	$dlocation = 'sus/upload/'.$id.'_'.date('Ymd_His').'-'.$filename;
	$location = 'upload/'.$id.'_'.date('Ymd_His').'-'.$filename;
	$file_extension = pathinfo($location, PATHINFO_EXTENSION);
	$file_extension = strtolower($file_extension);

	// Valid extensions
	//$valid_ext = array("jpg","png","jpeg","pdf");
	$valid_ext = array("pdf");

	$response = 0;
	if(in_array($file_extension,$valid_ext)){
		// Upload file
		if (file_exists($location)) {
			echo json_encode(['result'=>'dupfile']);
			$con->close();
			exit;
		} else {
			if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
				$response = $location;
				$sql="INSERT INTO agb_missingcr_reply(missing_id,series,accno,misscrdr,misscdmnth,mcode,payhead,tcode,treasury,dcode,ddo,scat,samt,othcat,ramt,tvno,tvdt,file_location,reply_sts,remarks,reply_date,userid,ipaddress)
				VALUES('$id','$ser','$acc','$miss_yr','$miss_mon','$mcode','$payhead','$tcode','$treasury','$dcode','$ddo','$scat','$samt','$othcat','$ramt','$tvno','$tvdt','$dlocation','P','$remarks','$reply_date','$usr','$ip')";
				
				
				if($con->query($sql) == TRUE) {
					$sql1="update agb_missingcr set crdr_flag='I' where id='$id'";
					$con->query($sql1) ;
					echo json_encode(['result'=>'success']);
					$con->close();
					exit;
				} else {
					echo json_encode(['result'=>'invalid']);
					$con->close();
					exit;
				}
			}
		}
	}
	//echo $response;
}	else {
	echo json_encode(['result'=>'missing']);
	$con->close();
	exit;
}
?>
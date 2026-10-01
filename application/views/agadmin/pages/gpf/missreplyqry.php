<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start();
//error_reporting(1);
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
$host='p:127.0.0.1:3307';
$username = "root";
$password = "hirani";
$dbname = "wb";
$con = new mysqli($host, $username, $password, $dbname);
if($con->connect_error) {
  die("Connection Failed : " . $con->connect_error);
} 
date_default_timezone_set("Asia/Kolkata"); 
$con->set_charset("utf8");

if (isset($_POST['id'])){
	$id = $_POST['id'];
	$mid = $_POST['mid'];
	$ser = $_POST['ser'];
	$acc = $_POST['acc'];
	$miss_mon = $_POST['misscrdr'];
	$sts = $_POST['sts'];
	$remarks = $_POST['remarks'];
	$usr = '';//$_SESSION['mail'];
	$ip = $_SERVER['REMOTE_ADDR'];
	$dt= date('Y-m-d H:i:s');
	$sql="update agb_missingcr_reply set reply_sts='$sts', rply_rem='$remarks', userid='$usr' ,ipaddress='$ip' where id='$id' ";
	if($con->query($sql) == TRUE) {
		if ($sts=='C') {
			$sql1="update agb_missingcr set crdr_flag='Y', remarks='$remarks' where  id='$mid' ";
			$con->query($sql1) ;
			echo json_encode(['result'=>'success']);
			$con->close();
			exit;
		} else {
			$sql1="update agb_missingcr set remarks='$remarks' where  id='$mid' ";
			$con->query($sql1) ;
			echo json_encode(['result'=>'success']);
			$con->close();
			exit;
		}
	} else {
		echo json_encode(['result'=>'unsuccess']);
		$con->close();
		exit;
	}
}
?>
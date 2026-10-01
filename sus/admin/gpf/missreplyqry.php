<?php
if (session_id() == "") session_start();
ob_start();

$host = '127.0.0.1';
$username = 'root';
$password = '1234';
$dbname = 'agwb';

// Dynamically load database configuration if available
$db_file = __DIR__ . '/../../../application/config/database.php';
if (file_exists($db_file)) {
	if (!defined('BASEPATH')) define('BASEPATH', true);
	if (!defined('ENVIRONMENT')) define('ENVIRONMENT', 'development');
	@include $db_file;
	if (isset($db['default'])) {
		$host = $db['default']['hostname'] ?? $host;
		$username = $db['default']['username'] ?? $username;
		$password = $db['default']['password'] ?? $password;
		$dbname = $db['default']['database'] ?? $dbname;
	}
}

$con = new mysqli($host, $username, $password, $dbname);
if ($con->connect_error) {
	echo json_encode(['result' => 'unsuccess', 'error' => 'Connection Failed']);
	exit;
}
date_default_timezone_set("Asia/Kolkata"); 
$con->set_charset("utf8mb4");

if (isset($_POST['id'])) {
	$id = (int)$_POST['id'];
	$mid = (int)($_POST['mid'] ?? 0);
	$sts = $_POST['sts'] ?? '';
	$remarks = $_POST['remarks'] ?? '';
	$usr = $_SESSION['mail'] ?? '';
	$ip = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
	$clear_dt = date('Y-m-d');
	
	$stmt = $con->prepare("UPDATE agb_missingcr_reply SET reply_sts = ?, rply_rem = ?, userid = ?, clear_date = ?, ipaddress = ? WHERE id = ?");
	if ($stmt) {
		$stmt->bind_param("sssssi", $sts, $remarks, $usr, $clear_dt, $ip, $id);
		$stmt->execute();
		$stmt->close();
	}

	$crdr_flag = ($sts === 'C') ? 'Y' : (($sts === 'I') ? 'I' : 'N');
	$stmt1 = $con->prepare("UPDATE agb_missingcr SET crdr_flag = ?, remarks = ? WHERE id = ?");
	if ($stmt1) {
		$stmt1->bind_param("ssi", $crdr_flag, $remarks, $mid);
		$stmt1->execute();
		$stmt1->close();
		echo json_encode(['result' => 'success']);
	} else {
		echo json_encode(['result' => 'unsuccess']);
	}
	$con->close();
	exit;
}
?>
<?php
session_start();
include "../config/config.php";

if ($_SESSION['userid'] == "" || $_SESSION["accountid"] == "") {
	return "error";
}

$strAmout = addslashes(trim($_POST["tAmout"]));
$strAccountId = addslashes($_SESSION["accountid"]);

$strRef = addslashes(trim($_SESSION["userid"]));
$strRef = (strlen($strRef)>9?substr($strRef,0, 9):$strRef).date('ymd').rand(10000,99999);

$strConfirmId = mb_strtoupper($strRef);
$date = date("Y-m-d H:i:s");
$strSQLPay = "SELECT count(*) NumQRNotPay FROM `payment` WHERE user_id = " . $strAccountId . " and status = '01' and added_time >= ADDTIME(NOW(), '-0:10:0')";
$objQueryPay = mysqli_query($conn, $strSQLPay);
$objResultPay = mysqli_fetch_array($objQueryPay, MYSQLI_ASSOC);
if($objResultPay["NumQRNotPay"] > 10)  {
	echo "error";
} else {
	$curl = curl_init($_CONFIG['scb']['access_domain'] . '/api/payment/checkConfirm/' . $_CONFIG['scb']['merchant_id'] . '/' . $strConfirmId);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($curl, CURLOPT_TIMEOUT, 10);
	curl_setopt($curl, CURLOPT_HEADER, false);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
	$curl_content = curl_exec($curl);
	curl_close($curl);
	$DATA = json_decode($curl_content, true);

	$resCode = '01';
	if($DATA["resCode"]) {
		$resCode = $DATA["resCode"];
	}

	$strSQL = "INSERT INTO payment (user_id,confirmId,transactionId,amount,amount_muliple,status,added_time) VALUES ('" . $strAccountId . "','" . $strConfirmId . "','" . $DATA["transactionId"] . "','" . $strAmout . "',1,'" . $resCode . "','" . $date . "')";
	$objQuery = mysqli_query($conn, $strSQL);

	echo $strConfirmId;
}
mysqli_close($conn);
?>
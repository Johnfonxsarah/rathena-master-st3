<?php
session_start();
include "../config/config.php";

$strRef = addslashes(trim($_POST["tRef"]));
$strAccountId = addslashes(trim($_POST["tAccountId"]));
$date = date("Y-m-d H:i:s");
$curdate = date("Y-m-d");

$strSQL = "SELECT * FROM payment where user_id = '" . $strAccountId . "' AND confirmId = '" . $strRef . "'";
$objQuery = mysqli_query($conn, $strSQL);
$objResult = mysqli_fetch_array($objQuery, MYSQLI_ASSOC);

if($objResult["status"] == "02" || $objResult["status"] == "00") {
	echo "true";
	exit();
}

$curl = curl_init($_CONFIG['scb']['access_domain'] . '/api/payment/checkConfirm/' . $_CONFIG['scb']['merchant_id'] . '/' . $objResult["confirmId"]);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($curl, CURLOPT_TIMEOUT, 10);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
$curl_content = curl_exec($curl);

if($curl_content) {
	$DATA = json_decode($curl_content, true);

	$result = "error";
	if ($DATA["resCode"] == "01") {
		$result = "error";
	} else if ($DATA["resCode"] == "02") {
		$result = "true";
	} else if ($DATA["resCode"] == "00") {
		$item_add = 0;
		$qty_add = 0;
		$item_add_1 = 0;
		$qty_add_1 = 0;
		$item_add_2 = 0;
		$qty_add_2 = 0;
		$item_add_3 = 0;
		$qty_add_3 = 0;
		$item_add_4 = 0;
		$qty_add_4 = 0;
		$item_add_5 = 0;
		$qty_add_5 = 0;
		$item_add_6 = 0;
		$qty_add_6 = 0;
		$item_add_7 = 0;
		$qty_add_7 = 0;
		$item_add_8 = 0;
		$qty_add_8 = 0;
		$item_add_9 = 0;
		$qty_add_9 = 0;
		$item_add_10 = 0;
		$qty_add_10 = 0;
		$item_add_11 = 0;
		$qty_add_11 = 0;
		$item_add_12 = 0;
		$qty_add_12 = 0;
		$item_add_13 = 0;
		$qty_add_13 = 0;
		$item_add_14 = 0;
		$qty_add_14 = 0;
		$item_add_15 = 0;
		$qty_add_15 = 0;
		$item_add_16 = 0;
		$qty_add_16 = 0;
		$item_add_17 = 0;
		$qty_add_17 = 0;
		$item_add_18 = 0;
		$qty_add_18 = 0;
		$item_add_19 = 0;
		$qty_add_19 = 0;
		$item_add_20 = 0;
		$qty_add_20 = 0;

		$f_donate_cash = 1;
		if($_CONFIG['scb']['f_donate_item'] > 0 || $_CONFIG['scb']['f_donate_cash'] > 1) {
			$SQL = "SELECT count(*) num from payment where user_id = '" . $strAccountId . "' and status in ('00','02')";
			if($_CONFIG['scb']['f_donate_start'] != '') {
				$SQL = $SQL . " and added_time >= '".$_CONFIG['scb']['f_donate_start']."'";
			}
			$fdonateQuery = mysqli_query($conn, $SQL);
			$fdonateResult = mysqli_fetch_array($fdonateQuery, MYSQLI_ASSOC);
			if($fdonateResult["num"] <= 0 && $_CONFIG['scb']['f_donate_item'] > 0) {
				$item_add = $_CONFIG['scb']['f_donate_item'];
				$qty_add = $_CONFIG['scb']['f_donate_qty'];
			}
			if($fdonateResult["num"] <= 0 && $_CONFIG['scb']['f_donate_cash'] > 1) {
				$f_donate_cash = $_CONFIG['scb']['f_donate_cash'];
			}
		}
		
		if($_CONFIG['scb']['cash_acc_start'] != '' && $curdate >= $_CONFIG['scb']['cash_acc_start']) {
			$SQL = "SELECT sum(amount) amt from payment where user_id = '" . $strAccountId . "' and status in ('00','02') and added_time >='".$_CONFIG['scb']['cash_acc_start']."'";
			$accQuery = mysqli_query($conn, $SQL);
			$accResult = mysqli_fetch_array($accQuery, MYSQLI_ASSOC);
			if($accResult["amt"] >= 0) {
				for($i=0; $i<count($_CONFIG['scb']['cash_acc']);$i++) {
					if($_CONFIG['scb']['cash_acc'][$i] > $accResult["amt"] && ($accResult["amt"]+$DATA["amount"])>= $_CONFIG['scb']['cash_acc'][$i] ) {
						for($j=0; $j<count($_CONFIG['scb']['cash_acc_item'][$i]);$j++) {
							if($item_add == 0) {
								$item_add = $_CONFIG['scb']['cash_acc_item'][$i][$j];
								$qty_add = $_CONFIG['scb']['cash_acc_qty'][$i][$j];			
							} else if($item_add_1 == 0) {
								$item_add_1 = $_CONFIG['scb']['cash_acc_item'][$i][$j];
								$qty_add_1 = $_CONFIG['scb']['cash_acc_qty'][$i][$j];
							} else if($item_add_2 == 0) {
								$item_add_2 = $_CONFIG['scb']['cash_acc_item'][$i][$j];
								$qty_add_2 = $_CONFIG['scb']['cash_acc_qty'][$i][$j];
							} else if($item_add_3 == 0) {
								$item_add_3 = $_CONFIG['scb']['cash_acc_item'][$i][$j];
								$qty_add_3 = $_CONFIG['scb']['cash_acc_qty'][$i][$j];
							} else if($item_add_4 == 0) {
								$item_add_4 = $_CONFIG['scb']['cash_acc_item'][$i][$j];
								$qty_add_4 = $_CONFIG['scb']['cash_acc_qty'][$i][$j];
							} else if($item_add_5 == 0) {
								$item_add_5 = $_CONFIG['scb']['cash_acc_item'][$i][$j];
								$qty_add_5 = $_CONFIG['scb']['cash_acc_qty'][$i][$j];
							} else if($item_add_6 == 0) {
								$item_add_6 = $_CONFIG['scb']['cash_acc_item'][$i][$j];
								$qty_add_6 = $_CONFIG['scb']['cash_acc_qty'][$i][$j];
							} else if($item_add_7 == 0) {
								$item_add_7 = $_CONFIG['scb']['cash_acc_item'][$i][$j];
								$qty_add_7 = $_CONFIG['scb']['cash_acc_qty'][$i][$j];
							} else if($item_add_8 == 0) {
								$item_add_8 = $_CONFIG['scb']['cash_acc_item'][$i][$j];
								$qty_add_8 = $_CONFIG['scb']['cash_acc_qty'][$i][$j];
							} else if($item_add_9 == 0) {
								$item_add_9 = $_CONFIG['scb']['cash_acc_item'][$i][$j];
								$qty_add_9 = $_CONFIG['scb']['cash_acc_qty'][$i][$j];
							} else if($item_add_10 == 0) {
								$item_add_10 = $_CONFIG['scb']['cash_acc_item'][$i][$j];
								$qty_add_10 = $_CONFIG['scb']['cash_acc_qty'][$i][$j];
							} else if($item_add_11 == 0) {
								$item_add_11 = $_CONFIG['scb']['cash_acc_item'][$i][$j];
								$qty_add_11 = $_CONFIG['scb']['cash_acc_qty'][$i][$j];
							} else if($item_add_12 == 0) {
								$item_add_12 = $_CONFIG['scb']['cash_acc_item'][$i][$j];
								$qty_add_12 = $_CONFIG['scb']['cash_acc_qty'][$i][$j];
							} else if($item_add_13 == 0) {
								$item_add_13 = $_CONFIG['scb']['cash_acc_item'][$i][$j];
								$qty_add_13 = $_CONFIG['scb']['cash_acc_qty'][$i][$j];
							} else if($item_add_14 == 0) {
								$item_add_14 = $_CONFIG['scb']['cash_acc_item'][$i][$j];
								$qty_add_14 = $_CONFIG['scb']['cash_acc_qty'][$i][$j];
							} else if($item_add_15 == 0) {
								$item_add_15 = $_CONFIG['scb']['cash_acc_item'][$i][$j];
								$qty_add_15 = $_CONFIG['scb']['cash_acc_qty'][$i][$j];
							} else if($item_add_16 == 0) {
								$item_add_16 = $_CONFIG['scb']['cash_acc_item'][$i][$j];
								$qty_add_16 = $_CONFIG['scb']['cash_acc_qty'][$i][$j];
							} else if($item_add_17 == 0) {
								$item_add_17 = $_CONFIG['scb']['cash_acc_item'][$i][$j];
								$qty_add_17 = $_CONFIG['scb']['cash_acc_qty'][$i][$j];
							} else if($item_add_18 == 0) {
								$item_add_18 = $_CONFIG['scb']['cash_acc_item'][$i][$j];
								$qty_add_18 = $_CONFIG['scb']['cash_acc_qty'][$i][$j];
							} else if($item_add_19 == 0) {
								$item_add_19 = $_CONFIG['scb']['cash_acc_item'][$i][$j];
								$qty_add_19 = $_CONFIG['scb']['cash_acc_qty'][$i][$j];
							} else if($item_add_20 == 0) {
								$item_add_20 = $_CONFIG['scb']['cash_acc_item'][$i][$j];
								$qty_add_20 = $_CONFIG['scb']['cash_acc_qty'][$i][$j];
							}
						}
					}
				}
			}
		}

		$SQL = "UPDATE payment SET transactionId = '" . $DATA["transactionId"] . "', amount=".$DATA["amount"].",amount_muliple=".$f_donate_cash.", status = '" . $DATA["resCode"] . "', added_time = '" . $date . "', item_add=".$item_add.",qty_add=".$qty_add.", item_add_1=".$item_add_1.",qty_add_1=".$qty_add_1.", item_add_2=".$item_add_2.",qty_add_2=".$qty_add_2.", item_add_3=".$item_add_3.",qty_add_3=".$qty_add_3.", item_add_4=".$item_add_4.",qty_add_4=".$qty_add_4.", item_add_5=".$item_add_5.",qty_add_5=".$qty_add_5.", item_add_6=".$item_add_6.",qty_add_6=".$qty_add_6.", item_add_7=".$item_add_7.",qty_add_7=".$qty_add_7.", item_add_8=".$item_add_8.",qty_add_8=".$qty_add_8.", item_add_9=".$item_add_9.",qty_add_9=".$qty_add_9.", item_add_10=".$item_add_10.",qty_add_10=".$qty_add_10.", item_add_11=".$item_add_11.",qty_add_11=".$qty_add_11.", item_add_12=".$item_add_12.",qty_add_12=".$qty_add_12.", item_add_13=".$item_add_13.",qty_add_13=".$qty_add_13.", item_add_14=".$item_add_14.",qty_add_14=".$qty_add_14.", item_add_15=".$item_add_15.",qty_add_15=".$qty_add_15.", item_add_16=".$item_add_16.",qty_add_16=".$qty_add_16.", item_add_17=".$item_add_17.",qty_add_17=".$qty_add_17.", item_add_18=".$item_add_18.",qty_add_18=".$qty_add_18.", item_add_19=".$item_add_19.",qty_add_19=".$qty_add_19.", item_add_20=".$item_add_20.",qty_add_20=".$qty_add_20." where confirmId = '" . $objResult["confirmId"] . "' and status = '01'";
		$objQuery = mysqli_query($conn, $SQL);

		$SQL = "SELECT sum(amount) totalAmt from payment where user_id = '" . $strAccountId . "' and status in ('00','02')";
		$lvQuery = mysqli_query($conn, $SQL);
		$lvResult = mysqli_fetch_array($lvQuery, MYSQLI_ASSOC);

		$allLv = count($_CONFIG['scb']['lv']);
		if($allLv > 1) {
			$lv = 0;
			for($i=0; $i < $allLv; $i++)
			{
				if($lvResult["totalAmt"] >= $_CONFIG['scb']['lv'][$i]) {
					$lv = $i;
				}
			}
			if($lv > 0) {
				$SQL = "UPDATE login SET member_status = " . $lv . " WHERE account_id = '" . $strAccountId . "'";
				$objQuery = mysqli_query($conn, $SQL);
			}
		}

		$result = "ok";
	}
} else {
	$result =  'Curl error: ' . curl_error($curl);
}
curl_close($curl);

echo $result;
mysqli_close($conn);
?>
<?php
session_start();
include "config/config.php";
if ($_SESSION['userid'] == "" || $_SESSION["accountid"] == "") {
	
	$strUsername = addslashes(trim($_POST["txtUsername"]));
	$strPassword = addslashes(trim($_POST["txtPassword"]));
	
	$strSQL = "SELECT * FROM login where userid = '" . $strUsername . "' AND user_pass = '" . $strPassword . "'";
	$objQuery = mysqli_query($conn, $strSQL);
	$objResult = mysqli_fetch_array($objQuery, MYSQLI_ASSOC);

	if (!$objResult) {
		echo "<script>window.location.replace('index.php');</script>";
	} else {
		$_SESSION["userid"] = $strUsername;
		$_SESSION["accountid"] = $objResult["account_id"];
		session_write_close();
		echo "<script>window.location.replace('member.php');</script>";
	}

} else {
    $strSQL = "SELECT * FROM login WHERE userid = '" . $_SESSION['userid'] . "' ";
    $objQuery = mysqli_query($conn, $strSQL);
    $objResult = mysqli_fetch_array($objQuery, MYSQLI_ASSOC);

    $strSQLPoint = "SELECT * FROM acc_reg_num a WHERE account_id = " . $objResult['account_id'] . " AND a.key = '#CASHPOINTS'";
    $objQueryPoint = mysqli_query($conn, $strSQLPoint);
	$num_rows = mysqli_num_rows($objQueryPoint);

    $objResultPoint = mysqli_fetch_array($objQueryPoint, MYSQLI_ASSOC);


    if ($num_rows<=0 || !$objResultPoint["value"]) {
        $cash = "0";
    } else {
        $cash = $objResultPoint["value"];
    }

    $strSQLBonus = "SELECT * FROM acc_reg_num a WHERE account_id = " . $objResult['account_id'] . " AND a.key = '#CASHBONUS'";
    $objQueryBonus = mysqli_query($conn, $strSQLBonus);
	$num_rows = mysqli_num_rows($objQueryBonus);

    $objResultBonus = mysqli_fetch_array($objQueryBonus, MYSQLI_ASSOC);


    if ($num_rows<=0 || !$objResultBonus["value"]) {
        $cashBonus = "0";
    } else {
        $cashBonus = $objResultBonus["value"];
    }

    $strSQLPay = "SELECT * FROM `payment` WHERE user_id = '" . $objResult['account_id'] . "' ORDER BY scb_id DESC LIMIT 10";
    $objQueryPay = mysqli_query($conn, $strSQLPay);
	$num_rows = mysqli_num_rows($objQueryPay);

}
?>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Refill Center</title>
	<meta name="robots" content="index,follow">
	<meta name="googlebots" content="index,follow" />
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="css/style.css" rel="stylesheet">
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="system/system.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-10 mx-auto mt-5">
                <div class="card animated bounceInDown">
                    <div class="card-header text-center">
                        <h5><b>Refill Infomation</b></h5>
                        <h6>บันชีผู้เล่น Username : <?php echo $objResult["userid"]; ?></h6>
                    </div>
                    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav mr-auto">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle cursor-pointer" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-money"></i> เติมเงิน
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
<?php
    foreach($_CONFIG['scb']['amount'] as $cash_amout) {
        if($cash_amout > 0) {
            echo '<a class="dropdown-item" onclick="FunctionPay('.$cash_amout.')">โอน '.$cash_amout.' บาท</a>';
        }
    }
?>
                                    </div>
                                </li>
								<li class="nav-item">
									<a id="exchangePay" class="nav-link"> <i class="fa fa-exchange"></i> อัตราการเติมเงิน</a>
								</li>
								<li class="nav-item">
									<a id="pay" class="nav-link"> <i class="fa fa-history"></i> ประวัติการโอนเงิน</a>
								</li>								
                            </ul>
                            <form class="form-inline my-2 my-lg-0">
                                <button type="button" class="btn btn-outline-danger my-2 my-sm-0" onclick="doCallAjaxLogout();">Logout <i class="fa fa-sign-out"></i></button>
                            </form>
                        </div>
                    </nav>
                    <div class="card-body">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-money"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Cash Point : <?php echo $cash; ?> แต้ม" readonly>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-star-o"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Cash Bonus : <?php echo $cashBonus; ?> แต้ม" readonly>
                        </div>
<?php 		if($_CONFIG['scb']['cash_acc_start'] != '') { 
			$SQL = "SELECT sum(amount) amt from payment where user_id = '" . $objResult['account_id'] . "' and status in ('00','02') and added_time >='".$_CONFIG['scb']['cash_acc_start']."'";
			$accQuery = mysqli_query($conn, $SQL);
			$accResult = mysqli_fetch_array($accQuery, MYSQLI_ASSOC);
?>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-star-o"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="ยอดกิจกรรมสะสม : <?php echo  $accResult["amt"]; ?> แต้ม" readonly>
                        </div>
<?php } ?>
                    </div>
                    <div class="card-footer text-center">
                        <div class="table table-hover" >
                            <table id="exchange" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center" scope="col">โอนเงิน QR Code</th>
                                        <th class="text-center" scope="col">Cash</th>
										<th class="text-center" scope="col">Cash Bonus</th>
                                        <th class="text-center" scope="col">โปรโมชั่นของแถม</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr onclick="FunctionPay('<?php echo $_CONFIG['scb']['amount'][1] ?>')">
                                            <td class="text-center"><?php echo $_CONFIG['scb']['amount'][1]; ?> บาท</td>
                                            <td class="text-center"><?php echo $_CONFIG['scb']['cash'][1]; ?> Cash</td>
											<td class="text-center"><?php echo $_CONFIG['scb']['cashbonus'][1]; ?> Point</td>
											<td class="text-center">-</td>
                                    </tr>
                                    <tr onclick="FunctionPay('<?php echo $_CONFIG['scb']['amount'][2] ?>')">
                                            <td class="text-center"><?php echo $_CONFIG['scb']['amount'][2]; ?> บาท</td>
                                            <td class="text-center"><?php echo $_CONFIG['scb']['cash'][2]; ?> Cash</td>
											<td class="text-center"><?php echo $_CONFIG['scb']['cashbonus'][2]; ?> Point</td>
                                            <td class="text-center">-</td>
                                    </tr>
                                    <tr onclick="FunctionPay('<?php echo $_CONFIG['scb']['amount'][3] ?>')">
                                            <td class="text-center"><?php echo $_CONFIG['scb']['amount'][3]; ?> บาท</td>
                                            <td class="text-center"><?php echo $_CONFIG['scb']['cash'][3]; ?> Cash</td>
											<td class="text-center"><?php echo $_CONFIG['scb']['cashbonus'][3]; ?> Point</td>
                                            <td class="text-center">-</td>
                                    </tr>
                                    <tr onclick="FunctionPay('<?php echo $_CONFIG['scb']['amount'][4] ?>')">
                                            <td class="text-center"><?php echo $_CONFIG['scb']['amount'][4]; ?> บาท</td>
                                            <td class="text-center"><?php echo $_CONFIG['scb']['cash'][4]; ?> Cash</td>
											<td class="text-center"><?php echo $_CONFIG['scb']['cashbonus'][4]; ?> Point</td>
                                            <td class="text-center">-</td>
                                    </tr>
                                    <tr onclick="FunctionPay('<?php echo $_CONFIG['scb']['amount'][5] ?>')">
                                            <td class="text-center"><?php echo $_CONFIG['scb']['amount'][5]; ?> บาท</td>
                                            <td class="text-center"><?php echo $_CONFIG['scb']['cash'][5]; ?> Cash</td>
											<td class="text-center"><?php echo $_CONFIG['scb']['cashbonus'][5]; ?> Point</td>
                                            <td class="text-center">-</td>
                                    </tr>
                                    <tr onclick="FunctionPay('<?php echo $_CONFIG['scb']['amount'][6] ?>')">
                                            <td class="text-center"><?php echo $_CONFIG['scb']['amount'][6]; ?> บาท</td>
                                            <td class="text-center"><?php echo $_CONFIG['scb']['cash'][6]; ?> Cash</td>
											<td class="text-center"><?php echo $_CONFIG['scb']['cashbonus'][6]; ?> Point</td>
                                            <td class="text-center">-</td>
                                    </tr>
                                    <tr onclick="FunctionPay('<?php echo $_CONFIG['scb']['amount'][7] ?>')">
                                            <td class="text-center"><?php echo $_CONFIG['scb']['amount'][7]; ?> บาท</td>
                                            <td class="text-center"><?php echo $_CONFIG['scb']['cash'][7]; ?> Cash</td>
											<td class="text-center"><?php echo $_CONFIG['scb']['cashbonus'][6]; ?> Point</td>
                                            <td class="text-center">-</td>
                                    </tr>
                                </tbody>
                            </table>
							
                        </div>
							<div id="exchangeTMTZ" class="form-group p-3 mb-2 bg-danger" style="font-size:12px; color: #fff; text-align: left; border-radius: 10px;">
								<li>หมายเหตุ : ทีมงานขอสงวนสิทธิ์ในการเปลี่ยนแปลงอัตรา Cash Point และ โปรโมชั่นตามความเหมาะสมโดยไม่ได้แจ้งให้ทราบล่วงหน้า</li>
							</div>
                        <div class="table-responsive">
                            <table id="history" class="table table-hover" style="display:none;">
                                <thead>
                                    <tr>
                                        <th class="text-center" scope="col">เลขที่ยืนยัน</th>
                                        <th class="text-center" scope="col">Transaction ID</th>
                                        <th class="text-center" scope="col">มูลค่า</th>
                                        <th class="text-center" scope="col">สถานะ</th>
                                        <th class="text-center" scope="col">เวลา</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <?php
										if($num_rows > 0) {
											while ($objResultPay = mysqli_fetch_array($objQueryPay, MYSQLI_ASSOC)) {
												$conFirm = mb_strtoupper($objResultPay["confirmId"]);
                                        ?>
                                    <tr>
                                            <td class="text-center"><?php echo $conFirm; ?></th>
                                            <td class="text-center"><?php echo $objResultPay["transactionId"]; ?></td>
                                            <td class="text-center"><?php echo $objResultPay["amount"]; ?> บาท</td>
                                            <td class="text-center"><?php echo ($objResultPay["status"] == "01" ? '<button type="button" class="btn btn-outline-danger my-2 my-sm-0" onclick="FunctionPayConfirm(\'' . $conFirm . '\');">ยืนยันอีกครั้ง <i class="fa fa-refresh"></i></button>' : '<span class="online">โอนเงินสำเร็จ</span>'); ?></td>
                                            <td class="text-center"><?php echo $objResultPay["added_time"]; ?></td>
                                    </tr>
                                <?php
											}
										}
                                ?>
                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    var now = new Date();
    var ref;
    var userid = encodeURI('<?= $objResult["userid"] ?>');
    var accountid = encodeURI('<?= $objResult["account_id"] ?>');
    var scb_domain = '<?= $_CONFIG['scb']['access_domain'] ?>';
    var scb_id = '<?= $_CONFIG['scb']['merchant_id'] ?>';
	
function doCallAjaxOBT() {
  Swal.fire({
      type: 'error',
      title: 'เกิดข้อผิดพลาด',
      text: 'เปิดให้ใช้ได้ได้ตอน OBT!',
  });
}
</script>

</html>
<?php
mysqli_close($conn);
?>
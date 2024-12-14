<?php
session_start();
include "../config/config.php";

$strUsername = addslashes(trim($_POST["tUsername"]));
$strPassword = addslashes(trim($_POST["tPassword"]));

$strSQL = "SELECT * FROM login where userid = '" . $strUsername . "' AND user_pass = '" . $strPassword . "'";
$objQuery = mysqli_query($conn, $strSQL);
$objResult = mysqli_fetch_array($objQuery, MYSQLI_ASSOC);

if (!$objResult) {
    echo "error";
} else {
    $_SESSION["userid"] = $strUsername;
	$_SESSION["accountid"] = $objResult["account_id"];
	
    session_write_close();
    echo "ok";
}
mysqli_close($conn);
?>
<?php
/*===== config database web =====*/
$Srv_Host = "localhost";
$Srv_Username = "root";
$Srv_Password = "038211415631";
$Srv_DBname = "romain";

date_default_timezone_set("Asia/Bangkok");
/*===============================*/

// Create connection
$conn = new mysqli($Srv_Host, $Srv_Username, $Srv_Password, $Srv_DBname);

// Check connection
if ($conn->connect_errno) {
    die("Connection failed: " . $conn->connect_error);
}

/*===== config เติมเงิน =====*/
// IP ของ SCB ที่อนุญาติให้รับส่งข้อมูล QR Code (ไม่ควรแก้ไข)
$_CONFIG['scb']['access_domain'] = 'https://payment.polymath.best';
// รหัสร้านค้า (merchant_id) ของ Payment API Key
$_CONFIG['scb']['merchant_id'] = '234cc4b4-1807-44ff-8c8b-6068d81923b6';

// มูลค่าโอนเงินสด
$_CONFIG['scb']['amount'][0] = 0;
$_CONFIG['scb']['amount'][1] = 50;
$_CONFIG['scb']['amount'][2] = 100;
$_CONFIG['scb']['amount'][3] = 300;
$_CONFIG['scb']['amount'][4] = 500;
$_CONFIG['scb']['amount'][5] = 1000;
$_CONFIG['scb']['amount'][6] = 3000;
$_CONFIG['scb']['amount'][7] = 5000;

// ข้อมูลแคชที่จะได้รับ
$_CONFIG['scb']['cash'][0] = 0;
$_CONFIG['scb']['cash'][1] = 5000;
$_CONFIG['scb']['cash'][2] = 10000;
$_CONFIG['scb']['cash'][3] = 30000;
$_CONFIG['scb']['cash'][4] = 51000;
$_CONFIG['scb']['cash'][5] = 103000;
$_CONFIG['scb']['cash'][6] = 310000;
$_CONFIG['scb']['cash'][7] = 520000;

// ข้อมูลแคชโบนัสที่จะได้รับ
$_CONFIG['scb']['cashbonus'][0] = 0;
$_CONFIG['scb']['cashbonus'][1] = 0;
$_CONFIG['scb']['cashbonus'][2] = 0;
$_CONFIG['scb']['cashbonus'][3] = 0;
$_CONFIG['scb']['cashbonus'][4] = 0;
$_CONFIG['scb']['cashbonus'][5] = 0;
$_CONFIG['scb']['cashbonus'][6] = 0;
$_CONFIG['scb']['cashbonus'][7] = 0;
$_CONFIG['scb']['cashbonus'][8] = 0;
/*====================*/

// lv ที่ได้ตามยอดเงินสะสม
$_CONFIG['scb']['lv'][0] = 0;
$_CONFIG['scb']['lv'][1] = 9999999999;
$_CONFIG['scb']['lv'][2] = 9999999999;
$_CONFIG['scb']['lv'][3] = 9999999999;
$_CONFIG['scb']['lv'][4] = 9999999999;
$_CONFIG['scb']['lv'][5] = 9999999999;
$_CONFIG['scb']['lv'][6] = 9999999999;
$_CONFIG['scb']['lv'][7] = 9999999999;

// เมื่อเติมครั้งแรก ได้รับ  Item กับ cash * 2
$_CONFIG['scb']['f_donate_start'] = ''; // วันที่เริ่มนับยอด x2 yyyy-mm-dd เช่น 2021-11-10, ถ้าต้องการเริ่มตั้งแต่แรกใส่ ''
$_CONFIG['scb']['f_donate_cash'] = 1; //เติมเงินครั้งแรก ได้ cash เท่าตัว ถ้าต้องการ x 2 ให้ใส่เลข 2
$_CONFIG['scb']['f_donate_item'] = 0;
$_CONFIG['scb']['f_donate_qty'] = 0;

// ข้อมูลยอดเงินสะสมที่จะได้รับ
$_CONFIG['scb']['cash_acc_start'] = ''; // วันที่เริ่มนับยอดสะสม yyyy-mm-dd เช่น 2021-11-10, ถ้าไม่ใช้ให้ระบุเป็น ''
$_CONFIG['scb']['cash_acc'][0] = 300;
$_CONFIG['scb']['cash_acc'][1] = 500;
$_CONFIG['scb']['cash_acc'][2] = 1000;
$_CONFIG['scb']['cash_acc'][3] = 5000;

// ทุก level รวมกันไม่เกิน 20 ชนิด จากตัวอย่าง เติมครบ 300 แจกของ 5001 1 ชิ้น , เติมครบ 500 บาท แจกของ 5001 1 ชิ้น และ 5002 2 ชิ้น
$_CONFIG['scb']['cash_acc_item'][0][0] = 5001; 
$_CONFIG['scb']['cash_acc_qty'][0][0] = 1;

$_CONFIG['scb']['cash_acc_item'][1][0] = 5001;
$_CONFIG['scb']['cash_acc_qty'][1][0] = 1;
$_CONFIG['scb']['cash_acc_item'][1][1] = 5002;
$_CONFIG['scb']['cash_acc_qty'][1][1] = 2;

?>
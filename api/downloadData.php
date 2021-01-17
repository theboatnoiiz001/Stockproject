<?php
include("../core/config.php");
if(isset($_GET['date1'])){
    if($_GET['date1'] == "" || $_GET['date2'] == ""){
        header('Content-Type: application/json');
        echo json_encode(['status'=>100,'msg'=>'กรุณากรอก วันที่ให้ถุกต้อง']);
        exit();
    }
    $text = "SELECT DISTINCT `phone` FROM `orders` WHERE `uid` = ?";
    $exe = [$_SESSION['uid']];
    if($_GET['province'] != "NULL"){
        $text .= " AND `province` = ?";
        $exe[] = $_GET['province'];
    }
    if($_GET['sector'] != "NULL"){
        $text .= " AND `sector` = ?";
        $exe[] = $_GET['sector'];
    }
    $timestart = strtotime($_GET['date1']);
    $timeend = strtotime($_GET['date2'])+86400;
    $text .= " AND `created_at` BETWEEN ? AND ?";
    $exe[] = $timestart;
    $exe[] = $timeend;
    $getdata = $connect->prepare($text);
    $getdata->execute($exe);
    $datatext = "";
    while($row = $getdata->fetch()){
          echo $row['phone']."\r\n";
     }
     $handle = fopen("PhoneNumber.txt", "w");
    fwrite($handle, $datatext);
    fclose($handle);
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.basename('PhoneNumber.txt'));
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize('PhoneNumber.txt'));
    readfile('PhoneNumber.txt');
    exit;
}
?>
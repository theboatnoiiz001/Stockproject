<?php
header('Content-Type: application/json');
include("../core/config.php");
if(isset($_POST['get'])){
    $moneytoday = $connect->prepare("SELECT SUM(`summoney`) as `moneytoday`  FROM `orders` WHERE `uid` = ? AND `created_at` BETWEEN ? AND ?");
    $moneytoday->execute([$_SESSION['uid'],strtotime(date('d-m-Y')),(strtotime(date('d-m-Y'))+86399)]);
    $moneytoday = $moneytoday->fetch();
    $moneytoday = $moneytoday['moneytoday'];

    $ordertoday = $connect->prepare("SELECT `uid` as `moneytoday`  FROM `orders` WHERE `uid` = ? AND `created_at` BETWEEN ? AND ?");
    $ordertoday->execute([$_SESSION['uid'],strtotime(date('d-m-Y')),(strtotime(date('d-m-Y'))+86399)]);

    $dayStart = '01-'. date('m').'-'.date('Y');
    $dayEnd =  cal_days_in_month(CAL_GREGORIAN, date("m"), date("Y")) .'-'. date('m').'-'.date('Y');
    $moneymonth = $connect->prepare("SELECT SUM(`summoney`) as `moneymonth`  FROM `orders` WHERE `uid` = ? AND `created_at` BETWEEN ? AND ?");
    $moneymonth->execute([$_SESSION['uid'],strtotime($dayStart),strtotime($dayEnd)+86399]);
    $moneymonth = $moneymonth->fetch();
    $moneymonth = $moneymonth['moneymonth'];

    $dayStart = '01-01-'.date('Y');
    $dayEnd =  '31-12-'.date('Y');
    $moneyyear = $connect->prepare("SELECT SUM(`summoney`) as `moneyyear`  FROM `orders` WHERE `uid` = ? AND `created_at` BETWEEN ? AND ?");
    $moneyyear->execute([$_SESSION['uid'],strtotime($dayStart),strtotime($dayEnd)+86399]);
    $moneyyear = $moneyyear->fetch();
    $moneyyear = $moneyyear['moneyyear'];
    echo json_encode(['today'=>number_format($moneytoday,2),'month'=>number_format($moneymonth,2),'year'=>number_format($moneyyear,2),'ordertoday'=>$ordertoday->rowCount() ]);
    exit();
}
?>
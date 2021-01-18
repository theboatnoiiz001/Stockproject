<?php
header('Content-Type: application/json');
include("../core/config.php");
if(isset($_POST['stats'])){
    $getp = $connect->prepare("SELECT DISTINCT `province` FROM `orders` WHERE `uid` = ?");
    $getp->execute([$_SESSION['uid']]);
    while($row = $getp->fetch()){
        $sum = $connect->prepare("SELECT SUM(`summoney`) as totalmoney FROM `orders` WHERE `uid` = ? AND `province` = ? AND `created_at` BETWEEN ? AND ?");
        $sum->execute([$_SESSION['uid'],$row['province'],strtotime('01-01-'.date("Y")),strtotime('31-12-'.date("Y"))+86399]);
        $sum = $sum->fetch();
        $province[] = [
            'name' => $row['province'],
            'money' => $sum['totalmoney']
        ];
    }
    $getp = $connect->prepare("SELECT DISTINCT `sector` FROM `orders` WHERE `uid` = ?");
    $getp->execute([$_SESSION['uid']]);
    while($row = $getp->fetch()){
        $sum = $connect->prepare("SELECT SUM(`summoney`) as totalmoney FROM `orders` WHERE `uid` = ? AND `sector` = ? AND `created_at` BETWEEN ? AND ?");
        $sum->execute([$_SESSION['uid'],$row['sector'],strtotime('01-01-'.date("Y")),strtotime('31-12-'.date("Y"))+86399]);
        $sum = $sum->fetch();
        $sector[] = [
            'name' => $row['sector'],
            'money' => $sum['totalmoney']
        ];
    }
    $sectorAll = ["sector" => $sector];
    $provinceAll = ["province" => $province];
    $data = $sectorAll + $provinceAll;
    echo json_encode($data);
}
?>
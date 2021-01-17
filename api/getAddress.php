<?php
$time1 = time();
header('Content-Type: application/json');
include("../core/config.php");
if(isset($_POST['zipcode'])){
    $zipcode = $connect->prepare("SELECT `amphure_id` FROM `districts` WHERE `zip_code` = ?");
    $zipcode->execute([$_POST['zipcode']]);
    if($zipcode->rowCount() == 0){
        echo json_encode(['status'=>100,'msg'=>'ไม่พบข้อมูลจังหวัด กรุณาตรวจสอบเลขไปรษณีย์']);
        exit();
    }
    $zipcode = $zipcode->fetch();
    
    $district = $connect->prepare("SELECT `name_th`,`province_id` FROM `amphures` WHERE `id` = ?");
    $district->execute([$zipcode['amphure_id']]);
    $district = $district->fetch();
    
    $province = $connect->prepare("SELECT `geography_id`,`name_th` FROM `provinces` WHERE `id` = ?");
    $province->execute([$district['province_id']]);
    $province = $province->fetch();

    $sector = $connect->prepare("SELECT `name` FROM `geographies` WHERE `id` = ?");
    $sector->execute([$province['geography_id']]);
    $sector = $sector->fetch();

    echo json_encode(['status'=>200,'district'=>$district['name_th'],'province'=>$province['name_th'],'sector' => $sector['name']]);
    exit();
}
?>
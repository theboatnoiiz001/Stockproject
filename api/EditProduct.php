<?php
header('Content-Type: application/json');
include("../core/config.php");
if(isset($_POST['id'])){
    if($_POST['name'] == "" || $_POST['priceBuy'] == "" || $_POST['priceSell'] == "" || $_POST['unit'] == ""){
        echo json_encode(['status'=>100,'msg'=>'กรุณากรอกข้อมูลให้ครบถ้วน']);
        exit();
    }
    $getdata = $connect->prepare("SELECT `name`,`selling_price` FROM `product` WHERE `id_prod` = ? AND `uid` = ?");
    $getdata->execute([$_POST['id'],$_SESSION['uid']]);
    if($getdata->rowCount() != 0){
        $update = $connect->prepare("UPDATE `product` SET `name` = ?, `unit` = ?, `purchase_price`= ?,`selling_price`= ? WHERE `uid` = ? AND `id_prod` = ?");
        $update->execute([$_POST['name'],$_POST['unit'],$_POST['priceBuy'],$_POST['priceSell'],$_SESSION['uid'],$_POST['id']]);
        echo json_encode(['status'=>200,'msg'=>'แก้ไขข้อมูลสำเร็จ']);
        exit();
    }else{
        echo json_encode(['status'=>100,'msg'=>'ไม่พบสินค้านี้']);
        exit();
    }
}
?>
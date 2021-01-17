<?php
header('Content-Type: application/json');
include("../core/config.php");
if(isset($_POST['id'])){
    if($_POST['name'] == "" || $_POST['id'] == ""){
        echo json_encode(['status'=>100,'msg'=>'กรุณากรอกข้อมูลให้ครบถ้วน']);
        exit();
    }
    $getdata = $connect->prepare("SELECT `id_cate` FROM `category` WHERE `id_cate` = ? AND `uid` = ?");
    $getdata->execute([$_POST['id'],$_SESSION['uid']]);
    if($getdata->rowCount() != 0){
        $update = $connect->prepare("UPDATE `category` SET `name` = ?  WHERE `id_cate` = ? AND `uid` = ?");
        $update->execute([$_POST['name'],$_POST['id'],$_SESSION['uid']]);
        echo json_encode(['status'=>200,'msg'=>'เปลี่ยนชื่อสำเร็จ']);
        exit();
    }else{
        echo json_encode(['status'=>100,'msg'=>'ไม่พบสินค้านี้']);
        exit();
    }
}
?>
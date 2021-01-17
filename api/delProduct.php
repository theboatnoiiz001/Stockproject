<?php
header('Content-Type: application/json');
include("../core/config.php");
if(isset($_POST['id'])){
    $getdata = $connect->prepare("SELECT `name`,`selling_price` FROM `product` WHERE `id_prod` = ? AND `uid` = ?");
    $getdata->execute([$_POST['id'],$_SESSION['uid']]);
    if($getdata->rowCount() != 0){
        $del = $connect->prepare("DELETE FROM `product` WHERE `id_prod` = ? AND `uid` = ?");
        $del->execute([$_POST['id'],$_SESSION['uid']]);
        echo json_encode(['status'=>200,'msg'=>'ลบสินค้าสำเร็จ']);
        exit();
    }else{
        echo json_encode(['status'=>100,'msg'=>'ไม่พบสินค้านี้']);
        exit();
    }
}
?>
<?php
header('Content-Type: application/json');
include("../core/config.php");
if(isset($_POST['id'])){
    $getdata = $connect->prepare("SELECT `inventory`,`name`,`selling_price` FROM `product` WHERE `id_prod` = ? AND `uid` = ?");
    $getdata->execute([$_POST['id'],$_SESSION['uid']]);
    if($getdata->rowCount() != 0){
        $getdata = $getdata->fetch();
        echo json_encode(['status'=>200,'name'=>$getdata['name'],'price'=>$getdata['selling_price'],'inventory'=> $getdata['inventory']]);
        exit();
    }else{
        echo json_encode(['status'=>100,'msg'=>'ไม่พบสินค้านี้']);
        exit();
    }
}
?>
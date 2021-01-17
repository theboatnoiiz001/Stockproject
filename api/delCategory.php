<?php
header('Content-Type: application/json');
include("../core/config.php");
if(isset($_POST['id'])){
    $getdata = $connect->prepare("SELECT  `id_cate` FROM `category` WHERE `id_cate` = ? AND `uid` = ?");
    $getdata->execute([$_POST['id'],$_SESSION['uid']]);
    if($getdata->rowCount() != 0){
        $del = $connect->prepare("DELETE FROM `category` WHERE `id_cate` = ? AND `uid` = ?");
        $del->execute([$_POST['id'],$_SESSION['uid']]);
        echo json_encode(['status'=>200,'msg'=>'ลบสำเร็จ']);
        exit();
    }else{
        echo json_encode(['status'=>100,'msg'=>'ไม่พบหมวดหมู่']);
        exit();
    }
}
?>
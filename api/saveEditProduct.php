<?php
header('Content-Type: application/json');
include("../core/config.php");
if(isset($_POST['id'])){
    if($_POST['amount'] == ""){
        $amount = 0;
    }else{
        $amount = $_POST['amount'];
    }
    $getdata = $connect->prepare("SELECT `name` FROM `product` WHERE `id_prod` = ? AND `uid` = ?");
    $getdata->execute([$_POST['id'],$_SESSION['uid']]);
    if($getdata->rowCount() != 0){
        $update = $connect->prepare("UPDATE `product` SET `inventory` = ? WHERE `uid` = ? AND `id_prod` = ?");
        $update->execute([$amount,$_SESSION['uid'],$_POST['id']]);

        $adddataProduce = $connect->prepare("INSERT INTO `logs_editproduct` (`id_prod`, `uid`, `amount`, `date`, `ip`) VALUES (?,?,?,?,?)");
        $adddataProduce->execute([$_POST['id'],$_SESSION['uid'],$amount,time(),$ip]);

        echo json_encode(['status'=>200,'msg'=>'แก้ไขจำนวนสินค้าสำเร็จ']);
        exit();
    }else{
        echo json_encode(['status'=>100,'msg'=>'ไม่พบสินค้านี้']);
        exit();
    }
}
?>
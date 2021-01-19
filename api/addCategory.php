<?php
header('Content-Type: application/json');
include("../core/config.php");
if(isset($_POST['name'])){
    $getdata = $connect->prepare("SELECT `id_cate` FROM `category` WHERE `uid` = ? AND `name` = ?");
    $getdata->execute([$_SESSION['uid'],$_POST['name']]);
    if($getdata->rowCount() == 0){
        $add = $connect->prepare("INSERT INTO `category`(`uid`, `name`, `created_at`) VALUES (?,?,?)");
        $add->execute([$_SESSION['uid'],$_POST['name'],time()]);
        $getdata = $connect->prepare("SELECT `id_cate` FROM `category` WHERE `uid` = ? AND `name` = ?");
        $getdata->execute([$_SESSION['uid'],$_POST['name']]);
        $getdata = $getdata->fetch();
        $data = [
            'status' => 200,
            'msg' => 'เพิ่มหมวดหมู่สำเร็จ',
            'id' => $getdata['id_cate']
        ];
    }else{
        $data = [
            'status' => 100,
            'msg' => 'มีหมวดหมู่นี้อยู่แล้ว'
        ];
    }
    echo json_encode($data);
    exit();
}
?>
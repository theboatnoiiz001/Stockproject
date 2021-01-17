<?php
header('Content-Type: application/json');
include("../core/config.php");
if(isset($_POST['get'])){
    $getdata = $connect->prepare("SELECT * FROM `category` WHERE `uid` = ?");
    $getdata->execute([$_SESSION['uid']]);
    $arrayData = [];
    while($row = $getdata->fetch()){
        $arrayData[] = [
            'id' => $row['id_cate'],
            'name' => $row['name']
        ];
    }
    echo json_encode($arrayData);
    exit();
}
?>
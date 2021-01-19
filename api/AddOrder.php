<?php
header('Content-Type: application/json');
include("../core/config.php");
if(isset($_POST)){
    if(!isset($_SESSION['orderid'])){
        echo json_encode(['status'=>100,'msg'=>'ออเดอร์ผิดพลาด']);
        exit();
    }
    $listdata = $_POST['listdata'];
    $address = $_POST['address'];
    $zipcode = $_POST['zipcode'];
    $province = $_POST['province'];
    $district = $_POST['district'];
    $sector = $_POST['sector'];
    $phone = $_POST['phone'];
    $summoney = $_POST['summoney'];
    $channelsale = $_POST['channelsale'];
    if($phone == ""){
        echo json_encode(['status'=>100,'msg'=>'กรุณากรอกเบอร์โทร']);
        exit();
    }
    $checkCode = $connect->prepare("SELECT `id_order` FROM `orders` WHERE `order_code` = ?");
    $checkCode->execute([$_SESSION['orderid']]);
    if($checkCode->rowCount() != 0){
        $_SESSION['orderid'] = getToken(30);
    }
    if($address == ""){
        echo json_encode(['status'=>100,'msg'=>'กรุณากรอกที่อยู่ลูกค้า']);
        exit();
    }
    if($zipcode == ""){
        echo json_encode(['status'=>100,'msg'=>'กรุณากรอกรหัสไปรษณีย์']);
        exit();
    }
    if(sizeof($listdata) != 0){
        $expenditure = 0;
        foreach($listdata as $data){
            $checkProd = $connect->prepare("SELECT `id_prod`,`purchase_price` FROM `product` WHERE `name` = ? AND `uid` = ?");
            $checkProd->execute([$data[0],$_SESSION['uid']]);
            if($checkProd->rowCount() != 0){
                $checkProd = $checkProd->fetch();
                $prodid = $checkProd['id_prod'];
                $expenditure += ($checkProd['purchase_price']*$data[1]);
            }else{
                $prodid = 0;
            }
            $adddetail = $connect->prepare("INSERT INTO `order_detail`(`uid`,`order_code`, `id_prod`, `prod_name`, `amount`, `price`, `discount`, `created_at`) VALUES (?,?,?,?,?,?,?,?)");
            $adddetail->execute([$_SESSION['uid'],$_SESSION['orderid'],$prodid,$data[0],$data[1],$data[2],$data[3],time()]);
        }
        $createOrder = $connect->prepare("INSERT INTO `orders`( `order_code`, `uid`, `saleschannel`, `phone`, `address`, `province`, `district`, `sector`,`summoney`,`expense`, `created_at`) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
        $createOrder->execute([$_SESSION['orderid'],$_SESSION['uid'],$channelsale,$phone,$address,$province,$district,$sector,$summoney,$expenditure,time()]);

        echo json_encode(['status'=>200,'msg'=>'รายการซื้อสำเร็จ']);
        exit();
    }else{
        echo json_encode(['status'=>100,'msg'=>'กรุณาเลือกสินค้า']);
        exit();
    }
}
?>
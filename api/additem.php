<?php
header('Content-Type: application/json');
include "../core/config.php";
   /* Getting file name */
   if(isset($_FILES['file']['name'])){
       
		$filename = $_FILES['file']['name'];
		if($filename == "" || $_POST['name'] == "" || $_POST['priceBuy'] == "" || $_POST['priceSell'] == "" || $_POST['unit'] == "" || $_POST['category'] == ""){
			echo json_encode(['status'=>100,'msg'=>'กรุณากรอกข้อมูลให้ครบถ้วน']);
			exit();
        }
        $checkCa = $connect->prepare("SELECT `id_prod` FROM `product` WHERE `name` = ? AND `id_cate` = ? AND `uid` = ?");
        $checkCa->execute([$_POST['name'],$_POST['category'],$_SESSION['uid']]);
        if($checkCa->rowCount() != 0){
            echo json_encode(['status'=>100,'msg'=>'มีสินค้านี้อยู่แล้ว']);
			exit();
        }
		$token = getToken(30);
        $filename = $_FILES['file']['name'];

        /* Location */
        $location = "../uploads/".$filename;
        $uploadOk = 1;
        $imageFileType = pathinfo($location,PATHINFO_EXTENSION);

        /* Valid Extensions */
        $valid_extensions = array("jpg","jpeg","png","gif");
        /* Check file extension */
        if( !in_array(strtolower($imageFileType),$valid_extensions) ) {
			$uploadOk = 0;
        }
        if($_FILES['file']['size'] > 10485760){
            echo'ขนาดรูปใหญ่เกิน 10MB!';
            exit();
        }
        if($uploadOk == 0){
            echo json_encode(['status'=>100,'msg'=>'ไฟล์รูปภาพผิดพลาด']);
			exit();
        }else{
        /* Upload file */
        $location = "../uploads/". $token . ".jpg";
        if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
            $add = $connect->prepare("INSERT INTO `product`(`id_cate`, `uid`, `name`, `unit`, `img`, `purchase_price`, `selling_price`) VALUES (?,?,?,?,?,?,?)");
            $add->execute([$_POST['category'],$_SESSION['uid'],$_POST['name'],$_POST['unit'],$token,$_POST['priceBuy'],$_POST['priceSell']]);
            echo json_encode(['status'=>200,'msg'=>'เพิ่มสินค้าสำเร็จ']);
			exit();
        }else{
            echo json_encode(['status'=>100,'msg'=>'เกิดข้อผิดพลาดเนื่องจากสิทธิ์ในการอัพโหลด']);
			exit();
        }
    }
  }else{
    echo json_encode(['status'=>100,'msg'=>'ไฟล์ผิดพลาด']);
    exit();
  }

?>
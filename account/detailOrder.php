    <?php
        $getdata = $connect->prepare("SELECT * FROM `orders` WHERE `uid` = ? AND `order_code` = ?");
        $getdata->execute([$_SESSION['uid'],$_GET['id']]);
        if($getdata->rowCount() == 0){
            echo'<div class="container-fluid"><div class="alert alert-danger text-center" role="alert" id="msgDanger">สิทธิ์ไม่เพียงพอ</div></div>';
            exit();
        }
        $getdata = $getdata->fetch();
    ?>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800" style="font-weight:bold;">รายละเอียดสินค้า</h1>
        </div>
        <div class="row" style="margin-bottom: 25px;">
            <div class="col-xl-12 col-lg-12">
                <a href="#" class="btn btn-sm btn-primary shadow-sm"><i class="fas fa-print fa-sm text-white-50"></i> พิมพ์ใบแปะพัสดุ</a>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary"> ข้อมูลเบื้องต้น </h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="pl-lg-5 pr-lg-5 mb-5 mb-lg-0">
                                    <h4 style="font-size:1.25rem;"><i class="fas fa-address-card"></i> ข้อมูล</h4>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="col-sm-3 col-form-label">รายการ</label>
                                        <div class="col-sm-6">
                                            <?php echo $getdata['order_code'];?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="col-sm-3 col-form-label">วันที่</label>
                                        <div class="col-sm-6">
                                            <?php echo date("d-m-Y H:i:s",$getdata['created_at']);?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="col-sm-3 col-form-label">ช่องทางการขาย</label>
                                        <div class="col-sm-6">
                                            <?php echo $getdata['saleschannel'];?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="pl-lg-5 pr-lg-5 mb-5 mb-lg-0">
                                    <h4 style="font-size:1.25rem;"><i class="fas fa-user"></i> ลูกค้า</h4>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="col-sm-3 col-form-label">เบอร์ลูกค้า</label>
                                        <div class="col-sm-6">
                                            <?php echo $getdata['phone'];?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="col-sm-3 col-form-label">จังหวัด</label>
                                        <div class="col-sm-6">
                                            <?php echo $getdata['province'];?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail"
                                            class="col-sm-3 col-form-label">รายละเอียดที่อยู่</label>
                                        <div class="col-sm-6">
                                            <?php echo $getdata['address'];?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary"> สินค้า </h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>ชื่อสินค้า</th>
                                            <th>จำนวน</th>
                                            <th>มูลค่าต่อหน่วย</th>
                                            <th>ส่วนลดต่อหน่วย</th>
                                            <th>รวม</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $listitem = $connect->prepare("SELECT `id_prod`,`prod_name`,`amount`,`price`,`discount` FROM `order_detail` WHERE `uid` = ? AND `order_code` = ?");
                                            $listitem->execute([$_SESSION['uid'],$_GET['id']]);
                                            while($row = $listitem->fetch()){
                                                if($row['id_prod'] != 0){
                                                    $getimg  = $connect->prepare("SELECT `img` FROM `product` WHERE `id_prod` = ?");
                                                    $getimg->execute([$row['id_prod']]);
                                                    $getimg = $getimg->fetch();
                                                    $img = $getimg['img'];
                                                }else{
                                                    $img = "nophoto";
                                                }
                                                echo '<tr>
                                                        <td class="text-center"><img class="rounded" src="../uploads/'.$img.'.jpg" width="100px"></td>
                                                        <td>'.$row['prod_name'].'</td>
                                                        <td>'.$row['amount'].'</td>
                                                        <td>'.number_format($row['price'],2).'</td>
                                                        <td>'.number_format($row['discount'],2).'</td>
                                                        <td>'.number_format((($row['amount']*$row['price'])-$row['discount']),2).'</td>
                                                    </tr>';
                                            }
                                        ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                            <hr>
                                <div class="col-xl-5">
                                    <div class="alert alert-warning" role="alert">
                                        มูลค่ารวมสุทธิ : <b><?php echo number_format($getdata['summoney'],2);?></b>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
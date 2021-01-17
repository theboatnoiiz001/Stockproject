    <?php
        $getdata = $connect->prepare("SELECT `name`,`purchase_price`,`selling_price`,`img`,`unit` FROM `product` WHERE `uid` = ? AND `id_prod` = ?");
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
            <h1 class="h3 mb-0 text-gray-800" style="font-weight:bold;">แก้ไขสินค้า</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary"> แก้ไขสินค้า </h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                aria-labelledby="dropdownMenuLink">
                                <div class="dropdown-header">Dropdown Header:</div>
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="alert alert-danger" role="alert" id="msgDanger" style="display:none;">
                        </div>
                        <div class="text-center">
                            <img class="rounded" src="<?php echo $website;?>/uploads/<?php echo $getdata['img'];?>.jpg" width="200px">
                        </div>
                        <form method="post" name="formupfile" id="formpost">
                            <div class="form-group">
                                <label class="small mb-1" for="name">ชื่อสินค้า</label>
                                <input class="form-control" id="name" type="text" value="<?php echo $getdata['name']?>">
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="small mb-1" for="priceBuy">ราคาซื้อ</label>
                                    <input class="form-control" id="priceBuy" type="number" value="<?php echo $getdata['purchase_price']?>" placeholder="0.00">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="small mb-1" for="priceSell">ราคาขาย</label>
                                    <input class="form-control" id="priceSell" type="number" value="<?php echo $getdata['selling_price']?>" placeholder="0.00">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="small mb-1" for="unit">หน่วย</label>
                                    <input class="form-control" id="unit" type="text" value="<?php echo $getdata['unit']?>"
                                        placeholder="ตัวอย่าง : ตัว,ชิ้น,หลัง,ฝืน">
                                </div>
                            </div>
                            <div class="text-center">
                                <hr>
                                <button class="btn btn-primary" id="send" type="button" onclick="updateitem(<?php echo $_GET['id'];?>)">บันทึกการแก้ไข</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
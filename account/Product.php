    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800" style="font-weight:bold;">หมวดหมู่สินค้า</h1>
        </div>


        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary"> หมวดหมู่สินค้า </h6>

                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="alert alert-danger" role="alert" id="msgDanger" style="display:none;">
                        </div>
                        <div style="float:right;margin-right:30px">
                            <a class="btn btn-info" href="./AddProduct"><i class="fas fa-plus"></i> เพิ่มสินค้า</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ชื่อสินค้า</th>
                                        <th>ราคาซื้อ</th>
                                        <th>ราคาขาย</th>
                                        <th>คงเหลือ</th>
                                        <th>แก้ไขจำนวน</th>
                                        <th>อื่นๆ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $getdata = $connect->prepare("SELECT `id_prod`,`id_cate`,`name`,`img`,`purchase_price`,`selling_price`,`inventory`  FROM `product` WHERE `uid` = ?");
                                        $getdata->execute([$_SESSION['uid']]);
                                        while($row = $getdata->fetch()){
                                            echo'<tr id="itemid'.$row['id_prod'].'">
                                            <td>
                                                <div class="d-flex justify-content-start"><img
                                                      class="rounded" src="./uploads/'.$row['img'].'.jpg" width="100px">
                                                    <div style="margin-left:10px;margin-top:20px;" id="name'.$row['id_prod'].'">'.$row['name'].' <br><span
                                                            class="badge badge-light">หมวดหมู่ : '.getCategory($row['id_cate'],$connect).'</span></div>
                                                </div>
                                            </td>
                                            <td><span class="badge badge-warning">'.$row['purchase_price'].'</span></td>
                                            <td><span class="badge badge-success">'.$row['selling_price'].'</span></td>
                                            <td><span class="badge badge-primary" id="inventory'.$row['id_prod'].'">'.$row['inventory'].'</span></td>
                                            <td><button class="btn btn-success" data-toggle="modal" data-target="#ModalEdititem" onclick="edititem('.$row['id_prod'].')">
                                                    <i class="fas fa-edit"></i> แก้ไข
                                                </button></td>
                                            <td><div class="dropdown no-arrow">
                                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                aria-labelledby="dropdownMenuLink">
                                                <div class="dropdown-header">เมนูแก้ไข</div>
                                                <a class="dropdown-item" href="'.$website.'/ProductEdit/'.$row['id_prod'].'">แก้ไขสินค้า</a>
                                                <a class="dropdown-item" onclick="DelProduct('.$row['id_prod'].')" href="#">ลบสินค้า</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="#">Something else here</a>
                                            </div>
                                        </div></td>
                                        </tr>';
                                        }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- Modal -->
    <div class="modal fade" id="ModalEdititem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalEdititem">แก้ไขจำนวนสินค้า</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="idEdit" value="">
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-3 col-form-label">ชื่อสินค้า</label>
                        <div class="col-sm-7">
                            <input type="text" readonly class="form-control-plaintext" id="nameitem"
                                value="KungBoat">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-3 col-form-label">จำนวนคงเหลือ</label>
                        <div class="col-sm-7">
                            <input type="text" readonly class="form-control-plaintext" id="inventory"
                                value="150">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-4 col-form-label">จำนวนคงเหลือที่ปรับ</label>
                        <div class="col-sm-7">
                            <input type="number" class="form-control" id="inventory2"
                                value="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer"><button class="btn btn-secondary" type="button"
                        data-dismiss="modal">Close</button><button class="btn btn-primary" data-dismiss="modal" onclick="saveEditProduct();" type="button">แก้ไขจำนวนสินค้า</button></div>
            </div>
        </div>
    </div>
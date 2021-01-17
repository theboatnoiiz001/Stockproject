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
                            <button class="btn btn-info" data-toggle="modal" data-target="#addCategory"><i
                                    class="fas fa-plus"></i> เพิ่มหมวดหมู่</button>
                        </div>
                        <div class="table-responsive">
                            <table class="table" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ชื่อหมวดหมู่</th>
                                        <th>จำนวนสินค้าในหมวดหมู่</th>
                                        <th>มูลค่าสินค้าคงเหลือ</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $getData = $connect->prepare("SELECT `id_cate`,`name` FROM `category` WHERE `uid` = ?");
                                        $getData->execute([$_SESSION['uid']]);
                                        while($row = $getData->fetch()){
                                            $moneyAll = 0;
                                            $calmoney = $connect->prepare("SELECT `selling_price`,`inventory` FROM `product` WHERE `uid` = ? AND `id_cate` = ?");
                                            $calmoney->execute([$_SESSION['uid'],$row['id_cate']]);
                                            while($data = $calmoney->fetch()){
                                                $moneyAll += ($data['selling_price']*$data['inventory']);
                                            }
                                            echo'<tr id="idcategory'.$row['id_cate'].'">
                                            <td id="nameid'.$row['id_cate'].'">'.$row['name'].'</td>
                                            <td>'.$calmoney->rowCount().'</td>
                                            <td><span class="badge badge-primary">'.number_format($moneyAll, 2).'</span></td>
                                            <td><div class="dropdown no-arrow">
                                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                aria-labelledby="dropdownMenuLink">
                                                <div class="dropdown-header">เมนูแก้ไข</div>
                                                <a class="dropdown-item" data-toggle="modal" data-target="#EditCategory" onclick="getCategory('.$row['id_cate'].')" href="#">แก้ไข</a>
                                                <a class="dropdown-item" onclick="DelCategory('.$row['id_cate'].')" href="#">ลบ</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="#">ดูภาพรวม</a>
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
    <div class="modal fade" id="EditCategory" tabindex="-1" role="dialog" aria-labelledby="addCategory" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="EditCategory">แก้ไขหมวดหมู่</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="idcategory" value="">
                <div class="row">
                    <label for="addcategoryname" class="col-sm-3 pt-md-2">ชื่อหมวดหมู่<span
                            class="required-field">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="CategoryEdit" value="">
                    </div>
                </div>
            </div>
            <div class="modal-footer"><button class="btn btn-primary" data-dismiss="modal"  type="button" onclick="EditCategory()">แก้ไขชื่อ</button><button
                    class="btn btn-secondary" type="button" data-dismiss="modal">Close</button></div>
        </div>
    </div>
</div>
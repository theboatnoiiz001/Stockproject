    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800" style="font-weight:bold;">ประวัติการแก้ไขสินค้า</h1>
        </div>


        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary"> รายการแก้ไขจำนวนสินค้า </h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="alert alert-danger" role="alert" id="msgDanger" style="display:none;">
                        </div>
                        
                        <div class="table-responsive">
                            <table class="table" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>วันที่</th>
                                        <th>รายการ</th>
                                        <th>ช่องทาง</th>
                                        <th>มูลค่า</th>
                                        <th>เบอร์</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $getData = $connect->prepare("SELECT `id_order`,`order_code`,`saleschannel`,`phone`,`summoney`,`created_at` FROM `orders` WHERE `uid` = ? ORDER BY `id_order` DESC");
                                        $getData->execute([$_SESSION['uid']]);
                                        while($row = $getData->fetch()){
                                            echo'<tr>
                                            <td>'.$row['id_order'].'</td>
                                            <td>'.date("d-m-Y",$row['created_at']).'</td>
                                            <td><a href="./detailOrder/'.$row['order_code'] .'">'.$row['order_code'] .'</a></td>
                                            <td>'.$row['saleschannel'] .'</td>
                                            <td>'.number_format($row['summoney'],2).'</td>
                                            <td>'.$row['phone'].'</td>
                                            <td><div class="dropdown no-arrow">
                                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="#">พิมพ์ใบแปะพัสดุ</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="#">ลบ</a>
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
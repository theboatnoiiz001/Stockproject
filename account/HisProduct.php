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
                                        <th>ชื่อสินค้า</th>
                                        <th>จำนวนที่เปลี่ยนแปลง</th>
                                        <th>เวลา</th>
                                        <th>IP Address</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $getData = $connect->prepare("SELECT `id_prod`,`amount`,`date`,`ip` FROM `logs_editproduct` WHERE `uid` = ? ORDER BY `ip` DESC");
                                        $getData->execute([$_SESSION['uid']]);
                                        while($row = $getData->fetch()){
                                            $dataprod = $connect->prepare("SELECT `name`,`unit` FROM `product` WHERE `id_prod` = ?");
                                            $dataprod->execute([$row['id_prod']]);
                                            $dataprod = $dataprod->fetch();
                                            echo'<tr>
                                            <td>'.$dataprod['name'].'</td>
                                            <td>'.$row['amount'] .' '. $dataprod['unit']  .'</td>
                                            <td>'.date("Y-m-d H:i:s",$row['date']).'</td>
                                            <td>'.$row['ip'].'</td>
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
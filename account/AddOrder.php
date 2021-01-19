    <?php
        $_SESSION['orderid'] = getToken(30);
    ?>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800" style="font-weight:bold;">สร้างรายการขาย</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
        </div>


        <div class="row">
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary"> ข้อมูลลูกค้า </h6>
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
                        <form autocomplete="off" action="/action_page.php">
                            <div class="form-group">
                                <label class="small mb-1" for="address">ที่อยู่ของลูกค้า</label>
                                <textarea class="form-control" id="address" rows="6" onchange="getphone()"></textarea>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="small mb-1" for="zipcode">รหัสไปรษณีย์</label>
                                    <input class="form-control" id="zipcode" type="text" value=""
                                        onchange="getaddress()">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="small mb-1" for="channelsale">ช่องทางขาย</label>
                                    <input class="form-control" id="channelsale" type="text" value="Facebook">
                                </div>
                            </div>
                            <div class="form-row" id="address_other" style="display:none;">
                                <div class="form-group col-md-6">
                                    <label class="small mb-1" for="province">จังหวัด</label>
                                    <input class="form-control" id="province" type="text" value="" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="small mb-1" for="district">อำเภอ</label>
                                    <input class="form-control" id="district" type="text" value="" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="small mb-1" for="sector">ภาค</label>
                                    <input class="form-control" id="sector" type="text" value="" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="small mb-1" for="phone">เบอร์โทร</label>
                                    <input class="form-control" id="phone" type="text" value="">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary"> รายการสินค้า </h6>
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
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="listitem">
                                    <tr id="itemlist1">
                                        <td class="text-center">
                                            <button href="#" class="btn btn-primary btn-icon-split btn-sm"
                                                onclick="getitem(1)" data-toggle="modal" data-target="#ModalItem">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-plus"></i>
                                                </span>
                                                <span class="text">เลือก</span>
                                            </button>
                                            <!-- Modal -->
                                        </td>
                                        <td><input type="text" class="form-control" style="width:200px" id="nameitem1"
                                                value=""></td>
                                        <td><input type="number" onchange="calItem()" style="width:90px"
                                                class="form-control" id="amount1" value="" placeholder="0"></td>
                                        <td><input type="number" onchange="calItem()" style="width:90px"
                                                class="form-control" id="price1" value="" placeholder="0.00"></td>
                                        <td><input type="number" onchange="calItem()" style="width:90px"
                                                class="form-control" id="discount1" value="" placeholder="0.00"></td>
                                        <td id="totalMoney1">0.00</td>
                                        <td><a onclick="delitem(1)" style="color:red;cursor:pointer;"><i
                                                    class="fas fa-trash-alt"></i></a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <button class="btn btn-info  btn-sm" id="additem" type="button"><span
                                class="icon text-white-50">
                                <i class="fas fa-plus"></i>
                            </span> เพิ่มสินค้า</button>
                        <hr>
                        <div class="col-xl-5">
                            <div class="alert alert-warning" role="alert">
                                มูลค่ารวมสุทธิ : <b id="totalMoney">0.00</b>
                            </div>
                        </div>
                        <hr>
                        <div class="text-center">
                            <button class="btn btn-primary justify-content-center" id="send" onclick="addOrder()"
                                type="button">ยืนยันรายการ</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary"> มูลค่าสินค้าคงเหลือรายหมวดหมู่</h6>
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
                        <div class="chart-pie pt-4 pb-2">
                            <canvas id="myPieChart"></canvas>
                        </div>
                        <div class="mt-4 text-center small">
                            <span class="mr-2">
                                <i class="fas fa-circle text-primary"></i> Direct
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle text-success"></i> Social
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle text-info"></i> Referral
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- End of Main Content -->
    <div class="modal fade" id="ModalItem" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">เลือกสินค้า</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="indexitemSelect" value="">
                    <div class="table-responsive">
                        <table class="table" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ชื่อสินค้า</th>
                                    <th>คงเหลือ</th>
                                    <th>ราคาขาย</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                        $getdata = $connect->prepare("SELECT `id_prod`,`id_cate`,`name`,`img`,`purchase_price`,`selling_price`,`inventory`  FROM `product` WHERE `uid` = ?");
                                        $getdata->execute([$_SESSION['uid']]);
                                        while($row = $getdata->fetch()){
                                            echo'<tr>
                                            <td>
                                                <div class="d-flex justify-content-start"><img
                                                      class="rounded float-left"  src="./uploads/'.$row['img'].'.jpg" height="100px">
                                                    <div style="margin-left:10px;margin-top:20px;">'.$row['name'].'<br><span
                                                            class="badge badge-light">หมวดหมู่ : '.getCategory($row['id_cate'],$connect).'</span></div>
                                                </div>
                                            </td>
                                            <td><span class="badge badge-warning">'.$row['purchase_price'].'</span></td>
                                            <td><span class="badge badge-success">'.$row['selling_price'].'</span></td>
                                            <td><a href="#" data-dismiss="modal" onclick="selectitem('.$row['id_prod'].')" class="btn btn-primary btn-icon-split btn-sm">
                                                    <span class="icon text-white-50">
                                                        <i class="fas fa-flag"></i>
                                                    </span>
                                                    <span class="text">เลือก</span>
                                                </a></td>
                                        </tr>';
                                        }
                                    ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer"><button class="btn btn-primary" type="button"
                        data-dismiss="modal">ปิด</button></div>
            </div>
        </div>
    </div>
    <script>

    </script>
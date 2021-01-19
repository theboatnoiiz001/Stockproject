<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800" style="font-weight:bold;">ดึงข้อมูลลูกค้า</h1>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"> ตัวเลือกดึงข้อมูลลูกค้า </h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="pl-lg-5 pr-lg-5 mb-5 mb-lg-0">
                                <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <label class="small mb-1" for="date1">จาก</label>
                                        <input type="text" class="form-control datepicker" id="date1" value="<?php echo date('d-m-Y');?>">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="small mb-1" for="date2">ถึง</label>
                                        <input type="text" class="form-control datepicker" id="date2" value="<?php echo date('d-m-Y');?>">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="small mb-1" for="province">จังหวัด</label>
                                        <select class="form-control" id="province">
                                            <option value="NULL">--ไม่เลือก--</option>
                                            <?php
                                            $getp = $connect->prepare("SELECT DISTINCT `province` FROM `orders` WHERE `uid` = ?");
                                            $getp->execute([$_SESSION['uid']]);
                                            while($row = $getp->fetch()){
                                                echo'<option value="'.$row['province'].'">'.$row['province'].'</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="small mb-1" for="sector">ภาค</label>
                                        <select class="form-control" id="sector">
                                            <option value="NULL">--ไม่เลือก--</option>
                                            <?php
                                            $getp = $connect->prepare("SELECT DISTINCT `sector` FROM `orders` WHERE `uid` = ?");
                                            $getp->execute([$_SESSION['uid']]);
                                            while($row = $getp->fetch()){
                                                echo'<option value="'.$row['sector'].'">'.$row['sector'].'</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="text-center">
                                    <a href="#" class="btn btn-sm btn-success shadow-sm" onclick="DownloadData()"><i class="fas fa-download fa-sm text-white-50"></i> โหลดข้อมูล</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

</div>
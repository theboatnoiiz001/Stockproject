    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800" style="font-weight:bold;">สถิติการขาย</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
        </div>

        <!-- Content Row -->
        <div class="row justify-content-md-center">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-5 col-md-6 mb-4">
                <div class="card shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xl font-weight-bold text-primary text-uppercase mb-1">
                                    วันที่จะดึงข้อมูล</div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="small mb-1" for="date1">จาก</label>
                                        <input type="text" class="form-control datepicker" id="date1"
                                            value="<?php echo date('d-m-Y');?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="small mb-1" for="date2">ถึง</label>
                                        <input type="text" class="form-control datepicker" id="date2"
                                            value="<?php echo date('d-m-Y');?>">
                                    </div>
                                </div>
                                <div class="text-center">
                                    <a style="cursor:pointer;" class="btn btn-sm btn-primary shadow-sm" onclick="getDataSummary(GraphSummaryFull)"><i
                                            class="fas fa-download fa-sm text-white-50"></i> ดึงข้อมูล</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Row -->

        <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-6">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary"> สถิติการขายรายเดือน </h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="DataGraph"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Content Column -->
            <div class="col-lg-6 mb-4">
                <!-- Project Card Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">รายได้แต่ละจังหวัด</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataProvince" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>จังหวัด</th>
                                        <th>รายได้รวม</th>
                                        <th>กำไร</th>
                                    </tr>
                                </thead>
                                <tbody id="addProvince">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <!-- Project Card Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">รายได้แต่ละภาค</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataSector" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ภาค</th>
                                        <th>รายได้รวม</th>
                                        <th>กำไร</th>
                                    </tr>
                                </thead>
                                <tbody id="addSector">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <!-- Project Card Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">รายได้แต่ละสินค้า</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataProduct" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ชื่อสินค้า</th>
                                        <th>รายได้รวม</th>
                                        <th>กำไร</th>
                                    </tr>
                                </thead>
                                <tbody id="addProduct">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <!-- Project Card Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">รายได้หมวดหมู่</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataCategory" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ชื่อสินค้า</th>
                                        <th>รายได้รวม</th>
                                        <th>กำไร</th>
                                    </tr>
                                </thead>
                                <tbody id="addCategory">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
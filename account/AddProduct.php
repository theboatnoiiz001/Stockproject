    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800" style="font-weight:bold;">เพิ่มสินค้า</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
        </div>


        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary"> ใสารายละเอียดสินค้า </h6>
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
                        <form method="post" name="formupfile" id="formpost">
                            <div class="form-group">
                                <label class="small mb-1" for="name">ชื่อสินค้า</label>
                                <input class="form-control" id="name" type="text" value="">
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="small mb-1" for="priceBuy">ราคาซื้อ</label>
                                    <input class="form-control" id="priceBuy" type="number" value="" placeholder="0.00">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="small mb-1" for="priceSell">ราคาขาย</label>
                                    <input class="form-control" id="priceSell" type="number" value=""
                                        placeholder="0.00">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="small mb-1" for="unit">หน่วย</label>
                                    <input class="form-control" id="unit" type="text" value=""
                                        placeholder="ตัวอย่าง : ตัว,ชิ้น,หลัง,ฝืน">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="small mb-1" for="unit">หมวดหมู่</label>
                                    <select name="category" id="category" class="form-control">
                                        <?php
                                            $getdata = $connect->prepare("SELECT * FROM `category` WHERE `uid` = ?");
                                            $getdata->execute([$_SESSION['uid']]);
                                            $arrayData = [];
                                            while($row = $getdata->fetch()){
                                                echo'<option value="'.$row['id_cate'].'">'.$row['name'].'</option>';
                                            }
                                        ?>
                                    </select>
                                    <a class="d-block mt-1" data-toggle="modal" data-target="#addCategory"
                                        style="cursor:pointer;">+เพิ่มหมวดหมู่</a>
                                </div>
                            </div>
                            <div class="text-center">
                                <!-- Profile picture help block-->
                                <div class="small font-italic text-muted mb-4">รูปภาพ JPG or PNG no larger than 5 MB
                                </div>
                                <!-- Profile picture upload button-->
                                <style>
                                .custom-file-upload {
                                    border: 1px solid #ccc;
                                    display: inline-block;
                                    padding: 15px 12px;
                                    cursor: pointer;
                                }
                                </style>
                                <input type="file" name="upfile" class="custom-file-upload" id="fileupimg"
                                    onchange="setimg(this)" aria-describedby="fileHelp">
                                <br>
                                <br>
                                <hr>
                                <button class="btn btn-primary" id="send" type="button"
                                    onclick="additem()">บันทึกข้อมูล</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
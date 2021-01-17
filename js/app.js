var indexitel = 1;
var indexarray = [1];
$("#additem").click(function() {
    indexitel++;
    indexarray.push(indexitel);
    console.log(indexarray)
    $("#listitem").append(`<tr id="itemlist${indexitel}">
                                        <td class="text-center">
                                            <button href="#" class="btn btn-primary btn-icon-split btn-sm" onclick="getitem(${indexitel})"
                                                data-toggle="modal" data-target="#ModalItem">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-plus"></i>
                                                </span>
                                                <span class="text">เลือก</span>
                                            </button>
                                        </td>
                                        <td><input type="text" class="form-control" style="width:200px" id="nameitem${indexitel}" value=""></td>
                                        <td><input type="number" onchange="calItem()" style="width:90px" class="form-control" id="amount${indexitel}" value=""
                                                placeholder="0"></td>
                                        <td><input type="number" onchange="calItem()" style="width:90px" class="form-control" id="price${indexitel}" value=""
                                                placeholder="0.00"></td>
                                        <td><input type="number" onchange="calItem()" style="width:90px" class="form-control" id="discount${indexitel}" value=""
                                                placeholder="0.00"></td>
                                        <td id="totalMoney${indexitel}">0.00</td>
                                        <td><a onclick="delitem(${indexitel})" style="color:red;cursor:pointer;"><i class="fas fa-trash-alt"></i></a></td>
                                    </tr>`);
});

Array.prototype.remove = function() {
    var what, a = arguments,
        L = a.length,
        ax;
    while (L && this.length) {
        what = a[--L];
        while ((ax = this.indexOf(what)) !== -1) {
            this.splice(ax, 1);
        }
    }
    return this;
};

function selectitem(id) {
    $.post("./api/dataProduct.php", { id: id }, function(data) {
        if (data.status == 200) {
            let index = $("#indexitemSelect").val();
            $("#nameitem" + index).val(data.name);
            $("#amount" + index).val('1');
            $("#price" + index).val(data.price);
            $("#discount" + index).val('0');
            calItem();
        } else {
            Swal.fire({
                icon: 'error',
                title: 'ผิดพลาด!',
                text: data.msg,
            })
        }
    })
}

function DelProduct(id) {
    let name = $("#name" + id).text();
    Swal.fire({
        title: 'คุณมั่นใจ ?',
        html: "คุณต้องการที่จะลบ <b>" + name + "</b> ใช่หรือไม่ ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ใช่, ลบเลย!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.post("./api/delProduct.php", { id: id }, function(data) {
                if (data.status == 200) {
                    $("#itemid" + id).remove();
                    Swal.fire({
                        icon: 'success',
                        title: 'ลบสินค้าสำเร็จ!',
                        text: data.msg,
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'ผิดพลาด!',
                        text: data.msg,
                    })
                }
            })
        }
    })
}

function saveEditProduct() {
    let amount = $("#inventory2").val();
    let id = $("#idEdit").val();
    if (amount != "") {
        $.post("./api/saveEditProduct.php", { id: id, amount: amount }, function(data) {
            if (data.status == 200) {
                Swal.fire({
                    icon: 'success',
                    title: 'สำเร็จ!',
                    text: data.msg,
                })
                $("#inventory" + id).html(amount)
                $("#inventory2").val("")
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'ผิดพลาด!',
                    text: data.msg,
                })
            }
        })
    }
}

function edititem(id) {
    $.post("./api/dataProduct.php", { id: id }, function(data) {
        if (data.status == 200) {
            $("#nameitem").val(data.name);
            $("#inventory").val(data.inventory);
            $("#idEdit").val(id)
        } else {
            Swal.fire({
                icon: 'error',
                title: 'ผิดพลาด!',
                text: data.msg,
            })
        }
    })
}

function getitem(id) {
    $("#indexitemSelect").val(id);
}

function delitem(id) {
    indexarray.remove(id);
    console.log(indexarray)
    $("#itemlist" + id).remove();
    calItem()
}

function getphone() {
    data = $("#address").val();
    data = data.split(" ").join("")
    data = data.split("-").join("")
    console.log(data)
    indexData = 0
    arrayindex = []
    for (j = 0; j < data.length; j++) { if (data[j] == '0') { arrayindex.push(j) } }
    for (b = 0; b < arrayindex.length; b++) {
        phone = data.substring(arrayindex[b], arrayindex[b] + 10);
        if (Number(phone)) {
            if (phone.length == 10) {
                $("#phone").val(phone);
            }
        }
    }
}

function moneyFomat(money) {
    return new Intl.NumberFormat('th-TH', { style: 'currency', currency: 'THB' }).format(money);
}

function calItem() {
    let sumMoney = 0;
    indexarray.forEach(element => {
        if ($("#nameitem" + element).val() != "") {
            let amount = $("#amount" + element).val();
            let price = $("#price" + element).val();
            let discount;
            if ($("#discount" + element).val() != "") {
                discount = $("#discount" + element).val();
            } else {
                discount = 0;
            }
            if (amount != "" || price != "") {

                $("#totalMoney" + element).text(moneyFomat((amount * price) - discount));
                sumMoney += (amount * price) - discount;
            } else {
                $("#totalMoney" + element).text(moneyFomat(0));
            }
        }
    })
    $("#totalMoney").text(moneyFomat(sumMoney));
}

function getaddress() {
    var zipcode = $("#zipcode").val();
    $.post("./api/getAddress.php", { zipcode: zipcode }, function(data) {
        if (data.status == 200) {
            $("#address_other").show();
            $("#msgDanger").hide();
            $("#province").val(data.province);
            $("#district").val(data.district);
            $("#sector").val(data.sector);
        } else {
            $("#address_other").hide();
            $("#msgDanger").show();
            $("#msgDanger").html(data.msg);
        }
    })
}

function additem() {
    console.log($("#category").val())
    $("#send").attr('disabled', 'disabled');
    if (document.formupfile.upfile.value != "") {
        var fd = new FormData();
        var files = $('#fileupimg')[0].files[0];
        fd.append('file', files);
        fd.append('name', $("#name").val());
        fd.append('priceBuy', $("#priceBuy").val());
        fd.append('priceSell', $("#priceSell").val());
        fd.append('unit', $("#unit").val());
        fd.append('category', $("#category").val());
        $.ajax({
            url: "./api/additem.php",
            type: "POST",
            data: fd,
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                if (data.status == 200) {
                    Swal.fire({
                        icon: 'success',
                        title: 'เพิ่มสินค้าสำเร็จ!',
                        text: data.msg,
                    })
                    document.getElementById("formpost").reset();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'ผิดพลาด!',
                        text: data.msg,
                    })
                }
                $("#send").attr('disabled', false);
            }
        });
    } else {
        Swal.fire({
            icon: 'error',
            title: 'กรุณากรอกข้อมูลให้ครบถ้วน!',
            text: 'ข้ออมูลไม่ครบถ้วน',
        })
        $("#send").attr('disabled', false);
    }

}

function addOption(text, value) {
    $('#category').append($('<option>').val(value).text(text));
}

function addCategory() {
    let name = $("#CategoryNew").val();
    if (name != "") {
        $.post("./api/addCategory.php", { name: name }, function(data) {
            if (data.status == 200) {
                Swal.fire({
                    icon: 'success',
                    title: 'เพิ่มหมวดหมู่สำเร็จ!',
                    text: data.msg,
                })
                $("#CategoryNew").val("");
                addOption(name, data.id)
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'เกิดข้อผิดพลาด!',
                    text: data.msg,
                })
            }
        })
    }
}

function updateitem(id) {
    let name = $("#name").val();
    let priceBuy = $("#priceBuy").val();
    let priceSell = $("#priceSell").val();
    let unit = $("#unit").val();
    if (name != "" || priceBuy != "" || priceSell != "" || unit != "") {
        $.post("../api/EditProduct.php", { id: id, name: name, priceBuy: priceBuy, priceSell: priceSell, unit: unit }, function(data) {
            if (data.status == 200) {
                Swal.fire({
                    icon: 'success',
                    title: 'สำเร็จ!',
                    text: data.msg,
                })
                setTimeout(function() {
                    window.location.href = "../Product";
                }, 1500)

            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'เกิดข้อผิดพลาด!',
                    text: data.msg,
                })
            }
        })
    } else {
        Swal.fire({
            icon: 'error',
            title: 'เกิดข้อผิดพลาด!',
            text: 'กรุณากรอกข้อมูลให้ครบถ้วน',
        })
    }

}

function getCategory(id) {
    $("#CategoryEdit").val($("#nameid" + id).html());
    $("#idcategory").val(id);
}

function EditCategory() {
    let id = $("#idcategory").val();
    let name = $("#CategoryEdit").val();
    if (name != "") {
        $.post("./api/EditCategory.php", { name: name, id: id }, function(data) {
            if (data.status == 200) {
                Swal.fire({
                    icon: 'success',
                    title: 'สำเร็จ!',
                    text: data.msg,
                })
                $("#nameid" + id).html(name)
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'เกิดข้อผิดพลาด!',
                    text: data.msg,
                })
            }
        })
    }
}

function DelCategory(id) {
    let name = $("#nameid" + id).text();
    Swal.fire({
        title: 'คุณมั่นใจ ?',
        html: "คุณต้องการที่จะลบ <b>" + name + "</b> ใช่หรือไม่ ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ใช่, ลบเลย!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.post("./api/delCategory.php", { id: id }, function(data) {
                if (data.status == 200) {
                    $("#idcategory" + id).remove();
                    Swal.fire({
                        icon: 'success',
                        title: 'ลบหมวดหมู่สำเร็จ !',
                        text: data.msg,
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'ผิดพลาด!',
                        text: data.msg,
                    })
                }
            })
        }
    })
}

function addOrder() {
    $("#send").attr('disabled', 'disabled');
    let listdata = [];
    let summoney = 0;
    if ($("#address").val() == "") {
        Swal.fire({
            icon: 'error',
            title: 'ผิดพลาด!',
            text: 'กรุณากรอกที่อยู่ลูกค้า',
        })
        $("#send").attr('disabled', false);
    }
    if ($("#phone").val() == "") {
        Swal.fire({
            icon: 'error',
            title: 'ผิดพลาด!',
            text: 'กรุณากรอกเบอร์โทรลูกค้า',
        })
        $("#send").attr('disabled', false);
    }
    indexarray.forEach(index => {
        let name = $("#nameitem" + index).val();
        if (name != "") {
            let amount = $("#amount" + index).val();
            let price = $("#price" + index).val();
            let discount = $("#discount" + index).val();
            if (discount == "") {
                discount = 0;
            }
            summoney += (amount * price) - discount;
            listdata.push([name, amount, price, discount, (amount * price)])

        }
    })
    if (listdata.length != 0) {
        let address = $("#address").val();
        let zipcode = $("#zipcode").val();
        let province = $("#province").val();
        let district = $("#district").val();
        let sector = $("#sector").val();
        let phone = $("#phone").val();
        let channelsale = $("#channelsale").val();
        $.post("./api/AddOrder.php", { listdata: listdata, address: address, zipcode: zipcode, province: province, district: district, sector: sector, phone: phone, summoney: summoney, channelsale: channelsale }, function(data) {
            if (data.status == 200) {
                Swal.fire({
                    icon: 'success',
                    title: 'สำเร็จ!',
                    text: data.msg,
                })
                setTimeout(function() {
                    location.reload();
                }, 1200)
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'ผิดพลาด!',
                    text: data.msg,
                })
                $("#send").attr('disabled', false);
            }

        })
    }
    console.log(listdata)
}
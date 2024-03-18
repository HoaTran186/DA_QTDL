<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/DA_QTDL/assets/vendor/bootstrap/css/bootstrap.min.css">
    <title>Đăng kí</title>
</head>
<style>
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background: url('/DA_QTDL/assets/img/backgound-login.jpg');
        background-size: cover;
        background-position: center;
    }

    label {
        color: black;
    }

    h1 {
        color: white;
    }
</style>

<body>
    <div class="container-fluid">
        <h1 align="center" style="font-size: 50px">Đăng kí</h1>
        <form action="" method="post" name="frmDangki" id="frmDangki">
            <div class="form-row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <label>Tên đăng nhập:</label>
                    <input type="text" name="kh_tendangnhap" class="form-control" id="kh_tendangnhap" placeholder="Tên đăng nhập">
                </div>
                <div class="col-md-4"></div>
            </div>
            <div class="form-row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <label>Mật khẩu:</label>
                    <input type="password" name="kh_matkhau" class="form-control" id="kh_matkhau" placeholder="Nhập mật khẩu">
                </div>
                <div class="col-md-4"></div>
            </div>
            <div class="form-row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <label>Nhập lại mật khẩu:</label>
                    <input type="password" name="kh_matkhau1" class="form-control" id="kh_matkhau1" placeholder="Nhập lại mật khẩu">
                </div>
                <div class="col-md-4"></div>
            </div>
            <div class="form-row">
                <div class="col-md-4"></div>
                <div class="col-md-2">
                    <label>Họ và tên :</label>
                    <input type="text" name="kh_ten" class="form-control" id="kh_ten" placeholder="Nhập họ và tên">
                </div>
                <div class="col-md-2">
                    <label>CMND :</label>
                    <input type="text" name="kh_cmnd" class="form-control" id="kh_cmnd" placeholder="Nhập CMND">
                </div>
                <div class="col-md-2">
                    <label>Số điện thoại:</label>
                    <input type="text" name="kh_dienthoai" class="form-control" id="kh_dienthoai" placeholder="Nhập số điện thoại">
                </div>
                <div class="col-md-1">
                    <label>Giới tính:</label>
                    <select name="kh_gioitinh" class="form-control" id="kh_gioitinh">
                        <option value="M">Nam</option>
                        <option value="F">Nữ</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-4"></div>
                <div class="col-md-1">
                    <label>Ngày sinh:</label>
                    <select name="kh_ngaysinh" class="form-control" id="kh_ngaysinh" >
                        <?php for ($x = 1; $x <= 31; $x++) : ?>
                            <option value="<?= $x ?> "><?= $x ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="col-md-1">
                    <label>Tháng sinh:</label>
                    <select name="kh_thangsinh" class="form-control" id="kh_thangsinh">
                        <?php for ($x = 1; $x <= 12; $x++) : ?>
                            <option value="<?= $x ?> "><?= $x ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="col-md-1">
                    <label>Năm sinh:</label>
                    <select name="kh_namsinh" class="form-control" id="kh_namsinh">
                        <?php for ($x = 1950; $x <= 2023; $x++) : ?>
                            <option value="<?= $x ?> "><?= $x ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-4"></div>
                <div class="col-md-5">
                    <label>Địa chỉ:</label>
                    <input type="text" name="kh_diachi" class="form-control" id="kh_diachi" placeholder="Nhập địa chỉ">
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-4"></div>
                <div class="col-md-3">
                    <label>Email :</label>
                    <input type="email" name="kh_email" class="form-control" id="kh_email" placeholder="Nhập email của bạn">
                </div>
            </div>
            <br>
            <div class="form-row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <button class="btn btn-primary" name="btnDangki">Đăng kí</button>
                    <a href="login.php" class="btn btn-secondary">Quay lại</a>
                </div>
            </div>
        </form>
    </div>
    <?php
    if (isset($_POST['btnDangki'])) {
        include_once __DIR__ . './dbconnect.php';
        $kh_tendangnhap = $_POST['kh_tendangnhap'];
        $kh_matkhau = sha1($_POST['kh_matkhau']);
        $kh_ten = $_POST['kh_ten'];
        $kh_cmnd = $_POST['kh_cmnd'];
        $kh_goitinh = $_POST['kh_gioitinh'];
        $kh_ngaysinh = $_POST['kh_ngaysinh'];
        $kh_thangsinh = $_POST['kh_thangsinh'];
        $kh_namsinh = $_POST['kh_namsinh'];
        $kh_diachi = $_POST['kh_diachi'];
        $kh_dienthoai = $_POST['kh_dienthoai'];
        $kh_email = $_POST['kh_email'];
        $sqlKH = "INSERT INTO khachhang
        (kh_tendangnhap, kh_matkhau, kh_ten, kh_gioitinh, kh_diachi, kh_dienthoai, kh_email, kh_ngaysinh, kh_thangsinh, kh_namsinh, kh_cmnd, kh_quantri)
        VALUES ('$kh_tendangnhap', '$kh_matkhau', '$kh_ten', '$kh_goitinh', '$kh_diachi', '$kh_dienthoai', '$kh_email', $kh_ngaysinh, $kh_thangsinh, $kh_namsinh, '$kh_cmnd', 0);";
        mysqli_query($conn, $sqlKH);
        echo '<script>location.href="login.php"</script>';
    }
    ?>
</body>
<script src="/DA_QTDL/assets/vendor/jquery/jquery.min.js"></script>
<script src="/DA_QTDL/assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="/DA_QTDL/assets/vendor/jquery/dist/jquery.validate.min.js"></script>
<script>
    $(document).ready(function() {
        $('#frmDangki').validate({
            rules: {
                kh_tendangnhap: {
                    required: true,
                    minlength: 3,
                    maxlength: 15
                },
                kh_matkhau: {
                    required: true,
                    minlength: 1,
                },
                kh_matkhau1:{
                    required:true,
                    password:"#kh_matkhau"
                },
                kh_ten: {
                    required: true,
                    minlength: 8,
                    maxlength: 30
                },
                kh_dienthoai: {
                    required: true,
                    number: true,
                    minlength: 10,
                    maxlength: 10
                },
                kh_diachi: {
                    required: true,
                },
                kh_cmnd: {
                    required: true,
                    minlength: 9,
                    maxlength: 12
                },
                kh_email: {
                    required: true,
                    email: true
                },
            },
            messages: {
                kh_tendangnhap: {
                    required: "Vui lòng nhập tên đăng nhập!",
                    minlength: "Tên đăng nhập tối thiểu 3 kí tự!",
                    maxlength: "Tên đăng nhập không được vượt quá 15 kí tự!"
                },
                kh_matkhau: {
                    required: "Vui lòng nhập mật khẩu!",
                    minlength: "Mật khẩu tối thiểu 8 kí tự!",
                    maxlength: "Mật khẩu không được vượt quá 30 kí tự!"
                },
                kh_matkhau1:{
                    required:"Vui lòng nhập lại mật khẩu !",
                    password:"Mật khẩu không trùng khớp vui lòng nhập lại !"
                },
                kh_dienthoai: {
                    required: "Vui lòng nhập số điện thoại!",
                    number: "Số điện thoại không được chứa kí tự!",
                    minlength: "Số điện thoại tổng 10 số!",
                    maxlength: "Số điện không được vượt quá 10 số!"
                },
                kh_diachi: {
                    required: "Vui lòng nhập địa chỉ!",
                },
                kh_cmnd: {
                    required: "Vui lòng nhập số chứng minh thư!",
                    minlength: "số chứng minh thư tối thiểu 9 kí tự!",
                    maxlength: "số chứng minh thư không được vượt quá 12 kí tự!"
                },
                kh_email: {
                    required: "Vui lòng nhập email!",
                    email: "Vui lòng nhập chính xác email!"
                },
            },
            errorElement: "em",
            errorPlacement: function(error, element) {
                // Thêm class `invalid-feedback` cho field đang có lỗi
                error.addClass("invalid-feedback");
                if (element.prop("type") === "checkbox") {
                    error.insertAfter(element.parent("label"));
                } else {
                    error.insertAfter(element);
                }
            },
            success: function(label, element) {},
            highlight: function(element, errorClass, validClass) {
                $(element).addClass("is-invalid").removeClass("is-valid");
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).addClass("is-valid").removeClass("is-invalid");
            }
        });
    });
</script>

</html>
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/DA_QTDL/assets/vendor/bootstrap/css/bootstrap.min.css">
    <script src="/DA_QTDL/assets/vendor/jquery/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.9.0/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.9.0/dist/sweetalert2.all.min.js"></script>
    <title>Cấp lại mật khẩu</title>
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
        color: white;
    }

    h1 {
        color: white;
    }
</style>

<body>
    <?php
    if (isset($_SESSION['dadangnhap']) && $_SESSION['dadangnhap'] == false || !isset($_SESSION['dadangnhap'])) {
        echo '<script>location.href="/DA_QTDL.com/login.php";</script>';
    } elseif (isset($_SESSION['kh_quantri']) && $_SESSION['kh_quantri'] == false) {
        echo 'Bạn không có quyền sử dụng chức năng này!';
        echo '<a href="/DA_QTDL/login.php">Quay lại trang chủ</a>';
    } else {
    ?>
        <?php
        include_once __DIR__ . '/../../dbconnect.php';
        $kh_tendangnhap = $_GET['kh_tendangnhap'];
        $sql = "SELECT * FROM khachhang WHERE kh_tendangnhap = '$kh_tendangnhap';";
        $reusult = mysqli_query($conn, $sql);
        $data = [];
        while ($row = mysqli_fetch_array($reusult, MYSQLI_ASSOC)) {
            $data = array(
                'kh_tendangnhap' => $row['kh_tendangnhap']
            );
        }
        ?>
        <div class="container-fluid">
            <h1 align="center" style="font-size: 50px">Cấp lại mật khẩu</h1>
            <form action="" method="post" id="frmMK">
                <div class="form-row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <label>Tên đăng nhập:</label>
                        <input type="text" name="kh_tendangnhap" id="kh_tendangnhap" value="<?= $data['kh_tendangnhap'] ?>" disabled class="form-control">
                    </div>
                    <div class="col-md-3"></div>
                </div>
                <div class="form-row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <label>Mật khẩu mới:</label>
                        <input type="password" name="kh_matkhau" id="kh_matkhau" placeholder="Nhập mật khẩu mới" class="form-control">
                    </div>
                    <div class="col-md-3"></div>
                </div>
                <div class="form-row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <label>Nhập lại mật khẩu mới:</label>
                        <input type="password" name="kh_matkhau2" id="kh_matkhau2" placeholder="Nhập lại mật khẩu mới" class="form-control">
                    </div>
                    <div class="col-md-3"></div>
                </div>
                <div class="form-row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <button class="btn btn-primary" name="btnLuu">Lưu</button>
                        <a href="/DA_QTDL/khachhang.php" class="btn btn-secondary">Quay lại</a>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </form>
            <?php if (isset($_POST['btnLuu'])) {
                $kh_matkhau = sha1($_POST['kh_matkhau']);
                $sqlMK = "UPDATE khachhang
                SET
                    kh_matkhau='$kh_matkhau'
                WHERE kh_tendangnhap = '$kh_tendangnhap';";
                mysqli_query($conn, $sqlMK);
                echo '<script>
                                            $(document).ready(function() {
                                                Swal.fire({
                                                    position: "top-end",
                                                    icon: "success",
                                                    title: "Cấp lại mật khẩu thành công",
                                                    showConfirmButton: false,
                                                    timer: 1500
                                                });
                                            })
                                        </script>';
            } ?>
        </div>
    <?php } ?>
</body>
<script src="/DA_QTDL/assets/vendor/jquery/jquery.min.js"></script>
<script src="/DA_QTDL/assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="/DA_QTDL/assets/vendor/jquery/dist/jquery.validate.min.js"></script>
<script>
    $(document).ready(function() {
        $('#frmMK').validate({
            rules: {
                kh_matkhau: {
                    required: true,
                    minlength: 1,
                },
                kh_matkhau2: {
                    required: true,
                    equalTo: "#kh_matkhau",
                    minlength: 1,
                },
            },
            messages: {
                kh_matkhau: {
                    required: "Vui lòng nhập mật khẩu!",
                    minlength: "Mật khẩu tối thiểu 1 kí tự!",
                },
                kh_matkhau2: {
                    required: "Vui lòng nhập mật khẩu!",
                    equalTo: "Mật khẩu nhập lại không khớp!!",
                    minlength: "Mật khẩu tối thiểu 1 kí tự!"
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
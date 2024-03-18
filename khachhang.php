<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/js/datatable/datatables.min.css">
    <script src="./assets/js/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.9.0/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.9.0/dist/sweetalert2.all.min.js"></script>
    <title>Khách hàng</title>
</head>
<?php
include_once __DIR__ . '/dbconnect.php';
$sqlSP = "SELECT * FROM sanpham ;";
$resultSP = mysqli_query($conn, $sqlSP);
$dataSP = [];
while ($row = mysqli_fetch_array($resultSP, MYSQLI_ASSOC)) {
    $dataSP[] = array(
        'sp_ma' => $row['sp_ma'],
        'sp_ten' => $row['sp_ten'],
        'sp_gia' => $row['sp_gia'],
        'sp_giacu' => $row['sp_giacu'],
        'sp_ngaycapnhat' => $row['sp_ngaycapnhat'],

    );
}
$sqlKH = "SELECT *FROM khachhang
WHERE  kh_ten NOT LIKE 'admin';";
$resultKH = mysqli_query($conn, $sqlKH);
$dataKH = [];
while ($row = mysqli_fetch_array($resultKH, MYSQLI_ASSOC)) {
    $dataKH[] = array(
        'kh_ten' => $row['kh_ten'],
        'kh_diachi' => $row['kh_diachi'],
        'kh_tendangnhap' => $row['kh_tendangnhap'],
        'kh_dienthoai' => $row['kh_dienthoai']
    );
}
$sqlSLSP = "SELECT COUNT(*) as soluongsp FROM sanpham ;";
$resultSLSP = mysqli_query($conn, $sqlSLSP);
$dataSLSP = mysqli_fetch_array($resultSLSP, MYSQLI_ASSOC);
$sqlSLKH = "SELECT COUNT(*) as soluongkh FROM khachhang ;";
$resultSLKH = mysqli_query($conn, $sqlSLKH);
$dataSLKH = mysqli_fetch_array($resultSLKH, MYSQLI_ASSOC);
$sqlSLDDH = "SELECT COUNT(*) as soluongddh FROM dondathang ;";
$resultSLDDH = mysqli_query($conn, $sqlSLDDH);
$dataSLDDH = mysqli_fetch_array($resultSLDDH, MYSQLI_ASSOC);
$sqlSLGOPY = "SELECT COUNT(*) as soluonggopy FROM gopy ;";
$resultSLGOPY = mysqli_query($conn, $sqlSLGOPY);
$dataSLGOPY = mysqli_fetch_array($resultSLGOPY, MYSQLI_ASSOC);

?>

<body>
    <?php
    if (isset($_SESSION['dadangnhap']) && $_SESSION['dadangnhap'] == false || !isset($_SESSION['dadangnhap'])) {
        echo '<script>location.href="/DA_QTDL/login.php";</script>';
    } elseif (isset($_SESSION['kh_quantri']) && $_SESSION['kh_quantri'] == false) {
        echo 'Bạn không có quyền sử dụng chức năng này!';
    } else {
    ?>
        <div class="container">
            <div class="navigation">
                <ul>
                    <li>
                        <a href="#">
                            <span class="icon">
                                <ion-icon name="speedometer-outline"></ion-icon>
                            </span>
                            <!-- <span class="title">Dashboard</span> -->
                        </a>
                    </li>
                    <li>
                        <a href="./dashboard.php" id="Dashboard">
                            <span class="icon">
                                <ion-icon name="speedometer-outline"></ion-icon>
                            </span>
                            <span class="title">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="./sanpham.php" id="SanPham">
                            <span class="icon">
                                <ion-icon name="cart-outline"></ion-icon>
                            </span>
                            <span class="title">Sản phẩm</span>
                        </a>
                    </li>
                    <li>
                        <a href="./hinhsanpham.php" id="HinhSanPham">
                            <span class="icon">
                                <ion-icon name="images"></ion-icon>
                            </span>
                            <span class="title">Hình sản phẩm</span>
                        </a>
                    </li>
                    <li class="hovered">
                        <a href="./khachhang.php" id="KhachHang">
                            <span class="icon">
                                <ion-icon name="person-outline"></ion-icon>
                            </span>
                            <span class="title">Khách hàng</span>
                        </a>
                    </li>
                    <li>
                        <a href="./dondathang.php">
                            <span class="icon" id="DonDatHang">
                                <ion-icon name="bag-handle-outline"></ion-icon>
                            </span>
                            <span class="title">Đơn đặt hàng</span>
                        </a>
                    </li>
                    <li>
                        <a href="./giaohang.php">
                            <span class="icon" id="GiaoHang">
                                <ion-icon name="bicycle-outline"></ion-icon>
                            </span>
                            <span class="title">Giao hàng</span>
                        </a>
                    </li>
                    <li>
                        <a href="./gopy.php">
                            <span class="icon" id="GopY">
                                <ion-icon name="help-outline"></ion-icon>
                            </span>
                            <span class="title">Góp ý</span>
                        </a>
                    </li>
                    <li>
                        <a href="./logout.php">
                            <span class="icon">
                                <ion-icon name="log-out-outline"></ion-icon>
                            </span>
                            <span class="title">Đăng xuất</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="main">
                <div class="topbar">
                    <div class="toggle">
                        <ion-icon name="chevron-forward-circle-outline"></ion-icon>
                    </div>
                    <div class="search">
                        <label>
                            <input type="text" placeholder="Tìm kiếm">
                            <ion-icon name="search-outline"></ion-icon>
                        </label>
                    </div>
                    <div class="user">
                        <img src="./assets/img/user.png">
                    </div>
                </div>

                <div class="cardBox">
                    <div class="card">
                        <div>
                            <div class="numbers"><?= $dataSLSP['soluongsp'] ?></div>
                            <div class="cardName">Tổng sản phẩm</div>
                        </div>
                        <div class="iconBx">
                            <ion-icon name="cart-outline"></ion-icon>
                        </div>
                    </div>
                    <div class="card" style="background: #2a2185;">
                        <div>
                            <div class="numbers" style="color: #fff;"><?= $dataSLKH['soluongkh'] ?></div>
                            <div class="cardName" style="color: #fff;">Tổng khách hàng</div>
                        </div>
                        <div class="iconBx" style="color: #fff;">
                            <ion-icon name="people-outline"></ion-icon>
                        </div>
                    </div>
                    <div class="card">
                        <div>
                            <div class="numbers"><?= $dataSLDDH['soluongddh'] ?></div>
                            <div class="cardName">Tổng đơn hàng</div>
                        </div>
                        <div class="iconBx">
                            <ion-icon name="bag-add-outline"></ion-icon>
                        </div>
                    </div>
                    <div class="card">
                        <div>
                            <div class="numbers"><?= $dataSLGOPY['soluonggopy'] ?></div>
                            <div class="cardName">Tổng góp ý</div>
                        </div>
                        <div class="iconBx">
                            <ion-icon name="chatbubbles-outline"></ion-icon>
                        </div>
                    </div>
                </div>
                <!-- <div class="chartsBx">
                <div class="chart"><canvas id="chart-1"></canvas></div>
                <div class="chart"><canvas id="chart-2"></canvas></div>
            </div> -->
                <div class="details">
                    <div class="recentOrders">
                        <div class="cardHeader">
                            <h2>Danh sách khách hàng</h2>
                            <a href="./backend/xuatfile/export_KH.php" class="btn">Xuất file</a>
                        </div>
                        <table id="myTable" class="display">
                            <thead>
                                <tr>
                                    <td>Tên khách hàng</td>
                                    <td>Tên dăng nhập</td>
                                    <td>Địa chỉ</td>
                                    <td>Số điện thoại</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($dataKH as $kh) : ?>
                                    <tr>
                                        <td><?= $kh['kh_ten'] ?></td>
                                        <td><?= $kh['kh_tendangnhap'] ?></td>
                                        <td><?= $kh['kh_diachi'] ?></td>
                                        <td><?= $kh['kh_dienthoai'] ?> </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="recentCustomers">
                        <div class="cardHeader">
                            <table>
                                <form action="" method="post">
                                    <tr>
                                        <td><input type="text" name="kh_ten" id="kh_ten" placeholder="Nhập tên khách hàng"></td>
                                        <td><button name="btnSearch"><ion-icon name="search-outline"></ion-icon></button></td>
                                    </tr>
                                </form>
                                <?php
                                if (isset($_POST['btnSearch'])) {
                                    $kh_ten = $_POST['kh_ten'];

                                    if (!empty($kh_ten)) {
                                        //$sqlSKH = "CALL TimKiemKH('".$kh_ten."')";
                                        $sqlSKH = "SELECT * FROM khachhang WHERE kh_tendangnhap = '$kh_ten' OR kh_ten = '$kh_ten';";
                                        $resultSKH = mysqli_query($conn, $sqlSKH);
                                        $dataSKH = [];
                                        while ($row = mysqli_fetch_array($resultSKH, MYSQLI_ASSOC)) {
                                            $dataSKH = array(
                                                'kh_tendangnhap' => $row['kh_tendangnhap'],
                                                'kh_ten' => $row['kh_ten'],
                                                'kh_matkhau' => $row['kh_matkhau'],
                                                'kh_gioitinh' => $row['kh_gioitinh'],
                                                'kh_diachi' => $row['kh_diachi'],
                                                'kh_dienthoai' => $row['kh_dienthoai'],
                                                'kh_email' => $row['kh_email'],
                                                'kh_ngaysinh' => $row['kh_ngaysinh'],
                                                'kh_thangsinh' => $row['kh_thangsinh'],
                                                'kh_namsinh' => $row['kh_namsinh'],
                                            );
                                        }
                                        if (empty($dataSKH)) {
                                            echo '<script>
                                                    $(document).ready(function() {
                                                        // $(".Add").click(function() {
                                                            Swal.fire({
                                                                icon: "error",
                                                                title: "Lỗi",
                                                                text: "Dữ liệu không có!",
                                                            });
                                                        // });
                                                    })
                                                </script>';
                                        }
                                    } else {
                                        echo '<script>
                                        $(document).ready(function() {
                                            // $(".Add").click(function() {
                                                Swal.fire({
                                                    icon: "error",
                                                    title: "Lỗi",
                                                    text: "Không để trống dữ liệu!",
                                                });
                                            // });
                                        })
                                    </script>';
                                    }
                                }
                                ?>
                                <?php if (isset($_POST['btnSearch']) && !empty($dataSKH)) : ?>
                                    <form action="" method="post">
                                        <tr>
                                            <td>Tên đăng nhập:</td>
                                            <td><input type="text" name="kh_tendangnhap" value="<?= $dataSKH['kh_tendangnhap'] ?>" disabled></td>
                                        </tr>
                                        <tr>
                                            <td>Tên khách hàng:</td>
                                            <td><input type="text" name="kh_ten" value="<?= $dataSKH['kh_ten'] ?>" disabled></td>
                                        </tr>
                                        <tr>
                                            <td>Giới tính:</td>
                                            <td><input type="text" name="kh_gioitinh" value="<?= $dataSKH['kh_gioitinh'] ?>" disabled></td>
                                        </tr>
                                        <tr>
                                            <td>Địa chỉ:</td>
                                            <td><input type="text" name="kh_diachi" value="<?= $dataSKH['kh_diachi'] ?>" disabled></td>
                                        </tr>
                                        <tr>
                                            <td>Điện thoại:</td>
                                            <td><input type="text" name="kh_dienthoai" value="<?= $dataSKH['kh_dienthoai'] ?>" disabled></td>
                                        </tr>
                                        <tr>
                                            <td>Email:</td>
                                            <td><input type="email" name="kh_email" value="<?= $dataSKH['kh_email'] ?>" disabled></td>
                                        </tr>
                                        <tr>
                                            <td>Ngày sinh:</td>
                                            <td><input type="number" name="kh_ngaysinh" value="<?= $dataSKH['kh_ngaysinh'] ?>" disabled></td>
                                        </tr>
                                        <tr>
                                            <td>Tháng sinh:</td>
                                            <td><input type="number" name="kh_ngaysinh" value="<?= $dataSKH['kh_thangsinh'] ?>" disabled></td>
                                        </tr>
                                        <tr>
                                            <td>Năm sinh:</td>
                                            <td><input type="number" name="kh_ngaysinh" value="<?= $dataSKH['kh_namsinh'] ?>" disabled></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <a class="Delete" href="#" style=" cursor: pointer;"><ion-icon name="trash-outline"></ion-icon></a>
                                                <a class="Edit" href="./backend/khachhang/pass.php?kh_tendangnhap=<?= $dataSKH['kh_tendangnhap'] ?>" style="cursor: pointer;"><ion-icon name="key-outline"></ion-icon></a>
                                            </td>
                                        </tr>
                                    </form>
                                <?php endif; ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</body>
<script src="./assets/js/jquery.min.js"></script>
<script src="./assets/js/datatable/datatables.min.js"></script>
<script src="./assets/js/main.js"></script>
<script src="./assets/js/chart.min.js"></script>
<script src="./assets/js/chartsJS.js"></script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script>
    $(document).ready(function() {
        $('.Delete').click(function() {

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-success",
                    cancelButton: "btn btn-danger"
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: "Bạn có chắc chắn xóa không?",
                text: "Dữ liệu sẽ khách hàng sẽ bị xóa!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Vâng, tôi muốn xóa nó!",
                cancelButtonText: "Không, thoát!",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    swalWithBootstrapButtons.fire(
                        "Đã xóa!",
                        "Dữ liệu khách hàng đã xóa.",
                        "success"
                    ).then((rs) => {
                        if (rs.isConfirmed) {
                            location.href = "/DA_QTDL/backend/khachhang/delete.php?kh_tendangnhap=<?= $dataSKH['kh_tendangnhap'] ?>";
                        }
                    })
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Đã thoát',
                        'Bạn không xóa dữ liệu khách hàng',
                        'error'
                    )
                }
            })
        });
    });
</script>

</html>
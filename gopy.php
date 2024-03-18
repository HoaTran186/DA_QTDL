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
    <title>Góp ý</title>
</head>
<?php
include_once __DIR__ . '/dbconnect.php';
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
<?php
$sqlGY = "SELECT gy.*,cdgy.cdgy_ten FROM gopy gy JOIN chudegopy cdgy ON gy.cdgy_ma = cdgy.cdgy_ma;";
$resultGY = mysqli_query($conn, $sqlGY);
$dataGY = [];
while ($row = mysqli_fetch_array($resultGY, MYSQLI_ASSOC)) {
    $dataGY[] = array(
        'gy_ma' => $row['gy_ma'],
        'gy_hoten' => $row['gy_hoten'],
        'gy_email' => $row['gy_email'],
        'gy_dienthoai' => $row['gy_dienthoai'],
        'gy_tieude' => $row['gy_tieude'],
        'gy_noidung' => $row['gy_noidung'],
        'gy_ngaygopy' => $row['gy_ngaygopy'],
        'cdgy_ten' => $row['cdgy_ten']
    );
}
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
                    <li>
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
                    <li class="hovered">
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
                    <div class="card">
                        <div>
                            <div class="numbers"><?= $dataSLKH['soluongkh'] ?></div>
                            <div class="cardName">Tổng khách hàng</div>
                        </div>
                        <div class="iconBx">
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
                    <div class="card" style="background: #2a2185;">
                        <div>
                            <div class="numbers" style="color: #fff;"><?= $dataSLGOPY['soluonggopy'] ?></div>
                            <div class="cardName" style="color: #fff;">Tổng góp ý</div>
                        </div>
                        <div class="iconBx" style="color: #fff;">
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
                            <h2>Góp ý</h2>
                            <a href="./backend/xuatfile/export_GY.php" class="btn">Xuất file</a>
                        </div>
                        <table id="myTable" class="display">
                            <thead>
                                <tr>
                                    <td>Mã góp ý</td>
                                    <td>Khách hàng góp ý</td>
                                    <td>Chủ đề góp ý</td>
                                    <td>Tiêu đề góp ý</td>
                                    <td>Ngày góp ý</td>
                                    <td>Nội dung</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($dataGY as $gy) : ?>
                                    <tr>
                                        <td><?= $gy['gy_ma'] ?></td>
                                        <td><?= $gy['gy_hoten'] ?></td>
                                        <td><?= $gy['cdgy_ten'] ?></td>
                                        <td><?= $gy['gy_tieude'] ?></td>
                                        <td><?= date('d/m/Y', strtotime($gy['gy_ngaygopy'])) ?></td>
                                        <td><?= $gy['gy_noidung'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="recentCustomers">
                        <div class="cardHeader">
                            <table>
                                <tr>
                                    <form action="" method="post">
                                        <td>
                                            <input type="text" name="gy_ma" placeholder="Mã góp ý">
                                        </td>
                                        <td><button name="btnSearch"><ion-icon name="search-outline"></button></td>
                                    </form>
                                    <?php
                                    if (isset($_POST['btnSearch'])) {
                                        $gy_ma = $_POST['gy_ma'];
                                        if (!empty($gy_ma)) {
                                            $sqlSLGY = "Call TimKiemGY('".$gy_ma."');";
                                            $resultSLGY = mysqli_query($conn, $sqlSLGY);
                                            $dataSLGY = [];
                                            while ($row = mysqli_fetch_array($resultSLGY, MYSQLI_ASSOC)) {
                                                $dataSLGY = array(
                                                    'gy_hoten' => $row['gy_hoten'],
                                                    'gy_email' => $row['gy_email']
                                                );
                                            }
                                            if(empty($dataSLGY)){
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
                                    <?php if (isset($_POST['btnSearch']) && !empty($dataSLGY)) : ?>
                                <tr>
                                    <td>Khách hàng:</td>
                                    <td><?= $dataSLGY['gy_hoten'] ?></td>
                                </tr>
                                <tr>
                                    <td>Email:</td>
                                    <td><?= $dataSLGY['gy_email'] ?></td>
                                </tr>
                            <?php endif; ?>
                            </tr>
                            <tr>
                                <td><a href="./backend/gopy/feedback.php?gy_ma=<?= $gy_ma ?>" class="Add"><ion-icon name="mail-outline"></ion-icon></td>
                                <td><a href="#" class="Delete"><ion-icon name="trash-outline"></a></ion-icon></td>
                            </tr>
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
<!-- <script src="./assets/js/chart.min.js"></script>
<script src="./assets/js/chartsJS.js"></script> -->
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
                            location.href = "/DA_QTDL/backend/gopy/delete.php?gy_ma=<?= $gy_ma ?>";
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
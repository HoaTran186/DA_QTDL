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
    <title>DashBoard</title>
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
WHERE  kh_ten NOT LIKE 'admin'
LIMIT 10;";
$resultKH = mysqli_query($conn, $sqlKH);
$dataKH = [];
while ($row = mysqli_fetch_array($resultKH, MYSQLI_ASSOC)) {
    $dataKH[] = array(
        'kh_ten' => $row['kh_ten'],
        'kh_diachi' => $row['kh_diachi']
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
        echo '<a href="/DA_QTDL/login.php">Quay lại trang chủ</a>';
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
                <li class="hovered">
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
            <div class="chartsBx">
                <div class="chart"><canvas id="chart-1"></canvas></div>
                <div class="chart"><canvas id="chart-2"></canvas></div>
            </div>
            <div class="details">
                <div class="recentOrders">
                    <div class="cardHeader">
                        <h2>Sản phẩm</h2>
                        <a href="#" class="btn">View All</a>
                    </div>
                    <table id="myTable" class="display">
                        <thead>
                            <tr>
                                <td>Tên sản phẩm</td>
                                <td>Giá</td>
                                <td>Giá cũ</td>
                                <td>Ngày cập nhật</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dataSP as $sp) : ?>
                                <tr>
                                    <td><?= $sp['sp_ten'] ?></td>
                                    <td><?= number_format($sp['sp_gia'], 0, '.', ',') ?></td>
                                    <td><?= number_format($sp['sp_giacu'], 0, '.', ',') ?></td>
                                    <td><?= date('d/m/Y',strtotime($sp['sp_ngaycapnhat'])) ?> </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="recentCustomers">
                    <div class="cardHeader">
                        <h2>Khách hàng</h2>
                    </div>
                    <table>
                        <?php foreach ($dataKH as $kh) : ?>
                            <tr>
                                <td width="60px">
                                    <div class="imgBx"><img src="./assets/img/user.png"></div>
                                </td>
                                <td>
                                    <h4><?= $kh['kh_ten'] ?></h4>
                                    <span><?= $kh['kh_diachi'] ?></span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
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

</html>
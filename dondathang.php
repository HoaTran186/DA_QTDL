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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.9.0/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.9.0/dist/sweetalert2.all.min.js"></script>
    <title>DashBoard</title>
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
$sqlDSDH = "SELECT ddh.*,kh.kh_ten FROM dondathang ddh JOIN khachhang kh ON ddh.kh_tendangnhap = kh.kh_tendangnhap;";
$resultDSDH = mysqli_query($conn, $sqlDSDH);
$dataDSDH = [];
while ($row = mysqli_fetch_array($resultDSDH, MYSQLI_ASSOC)) {
    $dataDSDH[] = array(
        'kh_ten' => $row['kh_ten'],
        'dh_ma' => $row['dh_ma'],
        'dh_ngaylap' => $row['dh_ngaylap'],
        'dh_ngaygiao' => $row['dh_ngaygiao'],
        'dh_noigiao' => $row['dh_noigiao'],
        'dh_trangthaithanhtoan' => $row['dh_trangthaithanhtoan']
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
                    <li class="hovered">
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
                    <div class="card" style="background: #2a2185;">
                        <div>
                            <div class="numbers" style="color: #fff;"><?= $dataSLDDH['soluongddh'] ?></div>
                            <div class="cardName" style="color: #fff;">Tổng đơn hàng</div>
                        </div>
                        <div class="iconBx" style="color: #fff;">
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
                            <h2>Đơn đặt hàng</h2>
                            <a href="./backend/xuatfile/export_DDH.php" class="btn">Xuất file</a>
                        </div>
                        <table id="myTable" class="display">
                            <thead>
                                <tr>
                                    <td>Mã đơn hàng</td>
                                    <td>Tên khách hàng</td>
                                    <td>Ngày lập</td>
                                    <td>Ngày giao</td>
                                    <td>Nơi giao</td>
                                    <td>Trạng thái</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($dataDSDH as $dh) : ?>
                                    <tr>
                                        <td><?= $dh['dh_ma'] ?></td>
                                        <td><?= $dh['kh_ten'] ?></td>
                                        <td><?= date('d/m/Y', strtotime($dh['dh_ngaylap'])) ?></td>
                                        <td><?= date('d/m/Y', strtotime($dh['dh_ngaygiao'])) ?></td>
                                        <td><?= $dh['dh_noigiao'] ?></td>
                                        <td><?= $dh['dh_trangthaithanhtoan'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="recentCustomers">
                        <div class="cardHeader">
                            <!-- <h2>Khách hàng</h2> -->
                            <table>
                                <form action="" method="post">
                                    <tr>
                                        <td><input type="text" name="dh_ten" id="dh_ma" placeholder="Mã đơn hàng"></td>
                                        <td><button name="btnSearch"><ion-icon name="search-outline"></ion-icon></button></td>
                                    </tr>
                                </form>
                                <?php if (isset($_POST['btnSearch'])) {
                                    $dh_ten = $_POST['dh_ten'];
                                    if (!empty($dh_ten)) {
                                        $sqlDH = "SELECT ddh.*,sp.sp_ma ,kh.kh_ten,sp.sp_ten,spddh.sp_dh_soluong,spddh.sp_dh_dongia
                            FROM dondathang ddh 
                                                        JOIN sanpham_dondathang spddh ON ddh.dh_ma = spddh.dh_ma
                                                        JOIN sanpham sp ON sp.sp_ma = spddh.sp_ma
                                                        JOIN khachhang kh ON kh.kh_tendangnhap = ddh.kh_tendangnhap
                            WHERE ddh.dh_ma = '$dh_ten';";
                                        $resultDH = mysqli_query($conn, $sqlDH);
                                        $dataDH = [];
                                        while ($row = mysqli_fetch_array($resultDH, MYSQLI_ASSOC)) {
                                            $dataDH = array(
                                                'httt_ma' => $row['httt_ma'],
                                                'kh_tendangnhap' => $row['kh_tendangnhap'],
                                                'sp_ma' => $row['sp_ma'],
                                                'dh_ma' => $row['dh_ma'],
                                                'dh_ngaylap' => $row['dh_ngaylap'],
                                                'dh_ngaygiao' => $row['dh_ngaygiao'],
                                                'dh_noigiao' => $row['dh_noigiao'],
                                                'dh_trangthaithanhtoan' => $row['dh_trangthaithanhtoan'],
                                                'kh_ten' => $row['kh_ten'],
                                                'sp_ten' => $row['sp_ten'],
                                                'sp_dh_soluong' => $row['sp_dh_soluong'],
                                                'sp_dh_dongia' => $row['sp_dh_dongia']
                                            );
                                        }
                                        if (empty($dataDH)) {
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
                                <?php
                                $sqlSSP = "SELECT * FROM sanpham;";
                                $resultSSP = mysqli_query($conn, $sqlSSP);
                                $dataSSP = [];
                                while ($row = mysqli_fetch_array($resultSSP, MYSQLI_ASSOC)) {
                                    $dataSSP[] = array(
                                        'sp_ma' => $row['sp_ma'],
                                        'sp_ten' => $row['sp_ten'],
                                        'sp_soluong' => $row['sp_soluong']
                                    );
                                }
                                $sqlHTTT = "SELECT * FROM hinhthucthanhtoan;";
                                $resultHTTT  = mysqli_query($conn, $sqlHTTT);
                                $dataHTTT = [];
                                while ($row = mysqli_fetch_array($resultHTTT, MYSQLI_ASSOC)) {
                                    $dataHTTT[] = array(
                                        'httt_ma' => $row['httt_ma'],
                                        'httt_ten' => $row['httt_ten']
                                    );
                                }
                                ?>
                                <form action="" method="post">
                                    <tr>
                                        <td>Mã đơn hàng:</td>
                                        <?php if (isset($_POST['btnSearch']) && !empty($dataDH)) : ?>
                                            <td><input type="text" name="dh_ma" value="<?= $dataDH['dh_ma'] ?>"></td>
                                        <?php else : ?>
                                            <td><input type="text" name="dh_ma" placeholder="Mã đơn hàng"></td>
                                        <?php endif; ?>
                                    </tr>
                                    <tr>
                                        <td>Ngày lập:</td>
                                        <?php if (isset($_POST['btnSearch']) && !empty($dataDH)) : ?>
                                            <td><input type="date" name="dh_ngaylap" value="<?= $dataDH['dh_ngaylap'] ?>"></td>
                                        <?php else : ?>
                                            <td><input type="date" name="dh_ngaylap"></td>
                                        <?php endif; ?>
                                    </tr>
                                    <tr>
                                        <td>Ngày giao:</td>
                                        <?php if (isset($_POST['btnSearch']) && !empty($dataDH)) : ?>
                                            <td><input type="date" name="dh_ngaygiao" value="<?= $dataDH['dh_ngaygiao'] ?>"></td>
                                        <?php else : ?>
                                            <td><input type="date" name="dh_ngaygiao"></td>
                                        <?php endif; ?>
                                    </tr>
                                    <tr>
                                        <td>Nơi giao:</td>
                                        <?php if (isset($_POST['btnSearch']) && !empty($dataDH)) : ?>
                                            <td><input type="text" name="dh_noigiao" value="<?= $dataDH['dh_noigiao'] ?>"></td>
                                        <?php else : ?>
                                            <td><input type="text" name="dh_noigiao" placeholder="Nơi giao"></td>
                                        <?php endif; ?>
                                    </tr>
                                    <tr>
                                        <td>Trạng thái thanh toán:</td>
                                        <?php if (isset($_POST['btnSearch']) && !empty($dataDH)) : ?>
                                            <td><input type="text" name="dh_trangthaithanhtoan" value="<?= $dataDH['dh_trangthaithanhtoan'] ?>"></td>
                                        <?php else : ?>
                                            <td><input type="text" name="dh_trangthaithanhtoan" placeholder="Trạng thái thanh toán"></td>
                                        <?php endif; ?>
                                    </tr>
                                    <tr>
                                        <td>Hình thức thanh toán:</td>
                                        <td>
                                            <select name="httt_ma">
                                                <?php foreach ($dataHTTT as $httt) : ?>
                                                    <?php if ($httt['httt_ma'] == $dataDH['httt_ma']) : ?>
                                                        <option value="<?= $httt['httt_ma'] ?>" selected><?= $httt['httt_ten'] ?></option>
                                                    <?php else : ?>
                                                        <option value="<?= $httt['httt_ma'] ?>"><?= $httt['httt_ten'] ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <?php if (isset($_POST['btnSearch']) && !empty($dataDH)) : ?>
                                            <td>Tên khách hàng:</td>
                                            <td>
                                                <input type="text" name="kh_ten" value="<?= $dataDH['kh_ten'] ?>" disabled>
                                                <input type="hidden" name="kh_tendangnhap" value="<?= $dataDH['kh_tendangnhap'] ?>">
                                            </td>
                                        <?php else : ?>
                                            <td>Mã khách hàng:</td>
                                            <td><input type="text" name="kh_tendangnhap" placeholder="Tên đăng nhập"></td>
                                        <?php endif; ?>
                                    </tr>
                                    <tr>
                                        <td>Tên sản phẩm:</td>
                                        <td>
                                            <select name="sp_ma">
                                                <?php foreach ($dataSSP as $ssp) : ?>
                                                    <?php if ($ssp['sp_ma'] == $dataDH['sp_ma']) : ?>
                                                        <option value="<?= $ssp['sp_ma'] ?>" selected><?= $ssp['sp_ten'] ?></option>
                                                    <?php else : ?>
                                                        <option value="<?= $ssp['sp_ma'] ?>"><?= $ssp['sp_ten'] ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Số lượng:</td>
                                        <?php if (isset($_POST['btnSearch']) && !empty($dataDH)) : ?>
                                            <td><input type="number" name="sp_dh_soluong" value="<?= $dataDH['sp_dh_soluong'] ?>"></td>
                                        <?php else : ?>
                                            <td><input type="number" name="sp_dh_soluong" placeholder="Số lượng"></td>
                                        <?php endif; ?>
                                    </tr>
                                    <?php if (isset($_POST['btnSearch']) && !empty($dataDH)) : ?>
                                        <tr>
                                            <td>Đơn giá:</td>
                                            <td><input type="text" name="sp_dh_dongia" value="<?= number_format($dataDH['sp_dh_dongia'], 0, '.', ',') ?>" disabled></td>
                                        </tr>
                                    <?php endif; ?>
                                    <tr>
                                        <td colspan="2">
                                            <button class="Add" name="btn_Add"><ion-icon name="add-circle-outline"></ion-icon></button>
                                            <button class="Edit" name="btn_Edit"><ion-icon name="create-outline"></ion-icon></button>
                                            <a class="Delete" href="#"><ion-icon name="trash-outline"></ion-icon></a>
                                        </td>
                                    </tr>
                                </form>
                                <?php
                                if (isset($_POST['btn_Add'])) {
                                    $dh_ma = $_POST['dh_ma'];
                                    $dh_ngaylap = $_POST['dh_ngaylap'];
                                    $dh_ngaygiao = $_POST['dh_ngaygiao'];
                                    $dh_noigiao = $_POST['dh_noigiao'];
                                    $dh_trangthaithanhtoan = $_POST['dh_trangthaithanhtoan'];
                                    $httt_ma = $_POST['httt_ma'];
                                    $kh_tendangnhap = $_POST['kh_tendangnhap'];
                                    $sp_ma = $_POST['sp_ma'];
                                    if (!empty($_POST['dh_ma'])) {
                                        $sp_dh_soluong = $_POST['sp_dh_soluong'];
                                        $sqlSLSP = "SELECT * FROM sanpham WHERE sp_ma = '$sp_ma';";
                                        $resultSLSP = mysqli_query($conn, $sqlSLSP);
                                        $dataSLSP = [];
                                        while ($row = mysqli_fetch_array($resultSLSP, MYSQLI_ASSOC)) {
                                            $dataSLSP = array(
                                                'sp_ma' => $row['sp_ma'],
                                                'sp_ten' => $row['sp_ten'],
                                                'sp_soluong' => $row['sp_soluong']
                                            );
                                        }
                                        if (($dataSLSP['sp_soluong'] - $sp_dh_soluong) >= 0) {
                                            $sqlGIA = "SELECT SUM((sp_gia*$sp_dh_soluong)-$sp_dh_soluong*sp_gia*(km.km_giam)) as dongia FROM sanpham sp 
                                    JOIN khuyenmai km ON sp.km_ma = km.km_ma
                                    WHERE sp_ma = '$sp_ma';";
                                            $resultGIA = mysqli_query($conn, $sqlGIA);
                                            $dataGIA = [];
                                            while ($row = mysqli_fetch_array($resultGIA, MYSQLI_ASSOC)) {
                                                $dataGIA = array(
                                                    'dongia' => $row['dongia']
                                                );
                                            }
                                            $sp_dh_dongia = $dataGIA['dongia'];
                                            $sqlUDSP = "UPDATE sanpham
                                    SET
                                        sp_soluong=sp_soluong - $sp_dh_soluong
                                    WHERE sp_ma = '$sp_ma';";
                                            mysqli_query($conn, $sqlUDSP);
                                            $sqlISDDH = "INSERT INTO dondathang
                                (dh_ma, dh_ngaylap, dh_ngaygiao, dh_noigiao, dh_trangthaithanhtoan, httt_ma, kh_tendangnhap)
                                VALUES ('$dh_ma', '$dh_ngaylap', '$dh_ngaygiao', '$dh_noigiao', '$dh_trangthaithanhtoan', $httt_ma, '$kh_tendangnhap');";
                                            $sqlSPDH = "INSERT INTO sanpham_dondathang
                                (sp_ma, dh_ma, sp_dh_soluong, sp_dh_dongia)
                                VALUES ('$sp_ma', '$dh_ma', $sp_dh_soluong, $sp_dh_dongia);";
                                            mysqli_query($conn, $sqlISDDH);
                                            mysqli_query($conn, $sqlSPDH);
                                            echo '<script>
                                            $(document).ready(function() {
                                                Swal.fire({
                                                    position: "top-end",
                                                    icon: "success",
                                                    title: "Đã lưu thành công",
                                                    showConfirmButton: false,
                                                    timer: 1500
                                                });
                                            })
                                        </script>';
                                        } else {
                                            echo '<script>
                                        $(document).ready(function() {
                                            // $(".Add").click(function() {
                                                Swal.fire({
                                                    icon: "error",
                                                    title: "Lỗi",
                                                    text: "Lỗi không thể thêm đơn hàng!",
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
                                <?php
                                if (isset($_POST['btn_Edit'])) {
                                    $dh_ma = $_POST['dh_ma'];
                                    if (!empty($_POST['dh_ma'])) {
                                        $dh_ngaylap = $_POST['dh_ngaylap'];
                                        $dh_ngaygiao = $_POST['dh_ngaygiao'];
                                        $dh_noigiao = $_POST['dh_noigiao'];
                                        $dh_trangthaithanhtoan = $_POST['dh_trangthaithanhtoan'];
                                        $httt_ma = $_POST['httt_ma'];
                                        $kh_tendangnhap = $_POST['kh_tendangnhap'];
                                        $sp_ma = $_POST['sp_ma'];
                                        $sp_dh_soluong = $_POST['sp_dh_soluong'];
                                        $sqlSLSP = "SELECT * FROM sanpham WHERE sp_ma = '$sp_ma';";
                                        $resultSLSP = mysqli_query($conn, $sqlSLSP);
                                        $dataSLSP = [];
                                        while ($row = mysqli_fetch_array($resultSLSP, MYSQLI_ASSOC)) {
                                            $dataSLSP = array(
                                                'sp_ma' => $row['sp_ma'],
                                                'sp_ten' => $row['sp_ten'],
                                                'sp_soluong' => $row['sp_soluong']
                                            );
                                        }
                                        if (($dataSLSP['sp_soluong'] - $sp_dh_soluong) >= 0) {
                                            $sqlGIA = "SELECT SUM((sp_gia*$sp_dh_soluong)-$sp_dh_soluong*sp_gia*(km.km_giam)) as dongia FROM sanpham sp 
                                    JOIN khuyenmai km ON sp.km_ma = km.km_ma
                                    WHERE sp_ma = '$sp_ma';";
                                            $resultGIA = mysqli_query($conn, $sqlGIA);
                                            $dataGIA = [];
                                            while ($row = mysqli_fetch_array($resultGIA, MYSQLI_ASSOC)) {
                                                $dataGIA = array(
                                                    'dongia' => $row['dongia']
                                                );
                                            }
                                            $sp_dh_dongia = $dataGIA['dongia'];
                                            $sqlUDSP = "UPDATE sanpham
                                    SET
                                        sp_soluong=sp_soluong - $sp_dh_soluong
                                    WHERE sp_ma = '$sp_ma';";
                                            mysqli_query($conn, $sqlUDSP);
                                            $sqlSPDH = "UPDATE sanpham_dondathang
                                            SET
                                                sp_ma='$sp_ma',
                                                dh_ma='$dh_ma',
                                                sp_dh_soluong=$sp_dh_soluong,
                                                sp_dh_dongia=$sp_dh_dongia
                                            WHERE sp_ma='$sp_ma' AND dh_ma='$dh_ma';";
                                            $sqlUDDH = "UPDATE dondathang
                                    SET
                                        dh_ngaylap='$dh_ngaylap',
                                        dh_ngaygiao='$dh_ngaygiao',
                                        dh_noigiao='$dh_noigiao',
                                        dh_trangthaithanhtoan='$dh_trangthaithanhtoan',
                                        httt_ma=$httt_ma,
                                        kh_tendangnhap='$kh_tendangnhap'
                                    WHERE dh_ma='$dh_ma';";
                                            mysqli_query($conn, $sqlUDDH);
                                            mysqli_query($conn, $sqlSPDH);
                                            echo '<script>
                                    $(document).ready(function() {
                                        Swal.fire({
                                            position: "top-end",
                                            icon: "success",
                                            title: "Sửa thàng công",
                                            showConfirmButton: false,
                                            timer: 1500
                                        });
                                    })
                                </script>';
                                        } else {
                                            echo '<script>
                            $(document).ready(function() {
                                // $(".Add").click(function() {
                                    Swal.fire({
                                        icon: "error",
                                        title: "Lỗi",
                                        text: "Lỗi không thể sửa đơn hàng!",
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
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</body>
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
                text: "Dữ liệu sẽ đơn hàng sẽ bị xóa!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Vâng, tôi muốn xóa nó!",
                cancelButtonText: "Không, thoát!",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    location.href = "/DA_QTDL/backend/dondathang/delete.php?dh_ma=<?= $dataDH['dh_ma'] ?>";

                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Đã thoát',
                        'Bạn không xóa dữ liệu đơn đặt hàng',
                        'error'
                    )
                }
            })
        });
    });
</script>

</html>
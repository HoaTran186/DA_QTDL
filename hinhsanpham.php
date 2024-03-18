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
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    <script src="./assets/js/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.9.0/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.9.0/dist/sweetalert2.all.min.js"></script>
    <title>Hình sản phẩm</title>
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
                    <li class="hovered">
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
                    <div class="card" style="background: #2a2185;">
                        <div>
                            <div class="numbers" style="color: #fff;"><?= $dataSLSP['soluongsp'] ?></div>
                            <div class="cardName" style="color: #fff;">Tổng sản phẩm</div>
                        </div>
                        <div class="iconBx" style="color: #fff;">
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
                <!-- <div class="chartsBx">
                <div class="chart"><canvas id="chart-1"></canvas></div>
                <div class="chart"><canvas id="chart-2"></canvas></div>
            </div> -->
                <?php
                if (isset($_POST['btnSearch'])) {
                    $sp_ma = $_POST['sp_ma'];
                    if (empty($sp_ma)) {
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
                    } else {
                        $sqlHSP = "SELECT hsp.hsp_ma,hsp.sp_ma,sp.sp_ten,hsp.hsp_tentaptin
                FROM hinhsanpham hsp JOIN sanpham sp ON hsp.sp_ma = sp.sp_ma
                WHERE hsp.sp_ma = '$sp_ma';";
                        $sqlT = "SELECT * FROM sanpham WHERE sp_ma = '$sp_ma';";
                        $dataT = [];
                        $resultT = mysqli_query($conn, $sqlT);
                        while ($row = mysqli_fetch_array($resultT, MYSQLI_ASSOC)) {
                            $dataT = array(
                                'sp_ma' => $row['sp_ma'],
                                'sp_ten' =>$row['sp_ten']
                            );
                        }
                        $resultHSP = mysqli_query($conn, $sqlHSP);
                        $dataHSP = [];
                        while ($row = mysqli_fetch_array($resultHSP, MYSQLI_ASSOC)) {
                            $dataHSP[] = array(
                                'hsp_ma' => $row['hsp_ma'],
                                'sp_ma' => $row['sp_ma'],
                                'sp_ten' => $row['sp_ten'],
                                'hsp_tentaptin' => $row['hsp_tentaptin']
                            );
                        }
                        if (empty($dataT['sp_ma'])) {
                            echo '<script>
                                        $(document).ready(function() {
                                            // $(".Add").click(function() {
                                                Swal.fire({
                                                    icon: "error",
                                                    title: "Lỗi",
                                                    text: "Không có dữ liệu!",
                                                });
                                            // });
                                        })
                                    </script>';
                        }
                    }
                }
                ?>
                <div class="details">
                    <div class="recentOrders">
                        <div class="cardHeader">
                            <h2>Hình sản phẩm</h2>
                            <!-- <a href="#" class="btn">View All</a> -->
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <td>Mã sản phẩm</td>
                                    <td>Tên sản phẩm</td>
                                    <td>Hình sản phẩm</td>
                                    <td>Hành động</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (isset($_POST['btnSearch']) && !empty($dataHSP)) : ?>
                                    <?php foreach ($dataHSP as $hsp) : ?>
                                        <tr>
                                            <form action="" method="get">
                                                <td><?= $hsp['sp_ma'] ?></td>
                                                <td><?= $hsp['sp_ten'] ?></td>
                                                <td><img src="/DA_QTDL/assets/img_sp/<?= $hsp['hsp_tentaptin'] ?>" style="width: 80px;"></td>
                                                <td><a href="/DA_QTDL/backend/hinhsanpham/delete.php?hsp_ma=<?= $hsp['hsp_ma'] ?>" class="Delete"><ion-icon name="trash-outline"></a></td>
                                            </form>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="recentCustomers">
                        <div class="cardHeader">
                            <!-- <h2>Khách hàng</h2> -->
                            <div>
                                <form action="" method="post">
                                    <input type="search" name="sp_ma" id="sp_ma" placeholder="Nhập mã sản phẩm">
                                    <button name="btnSearch"><ion-icon name="search-outline"></button>
                                </form>
                                <?php
                                if (isset($_POST['btnSearch'])) {
                                    $sp_ma = $_POST['sp_ma'];
                                    if (!empty($sp_ma)) {
                                        $sqlSP = "SELECT * FROM sanpham WHERE sp_ma = '$sp_ma';";
                                        $resultSP = mysqli_query($conn, $sqlSP);
                                        $dataSP = [];
                                        while ($row = mysqli_fetch_array($resultSP, MYSQLI_ASSOC)) {
                                            $dataSP = array(
                                                'sp_ma' => $row['sp_ma'],
                                                'sp_ten' => $row['sp_ten'],
                                            );
                                        }
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <div>
                            <?php if (isset($_POST['btnSearch']) && !empty($dataT['sp_ma'])) : ?>
                                <div>
                                    <form action="xuly_upload.php" method="post" name="frmHinhSP" class="dropzone" id="frmHinhSP" enctype="multipart/form-data">
                                        <div>
                                            <input type="hidden" name="sp_ma" value="<?= $dataSP['sp_ma'] ?>">
                                        </div>
                                        <div>
                                            <input type="text" name="sp_ten" id="sp_ten" value="<?= $dataSP['sp_ten'] ?>" disabled>
                                        </div>
                                        <input type="file" name="hsp_tentaptin">
                                    </form>
                                </div>
                            <?php endif; ?>
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
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<script>
    $(document).ready(function() {
        Dropzone.options.frmHinhSP = { // camelized version of the `id`
            paramName: "file", // The name that will be used to transfer the file
            maxFilesize: 2, // MB
            accept: function(file, done) {
                if (file.name == "justinbieber.jpg") {
                    done("Naha, you don't.");
                } else {
                    done();
                }
            }
        };
    });
</script>

</html>
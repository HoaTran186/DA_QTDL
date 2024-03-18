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
$sqlDSGH = "SELECT ddh.*,kh.kh_ten,gh.gh_ma,gh.gh_tennv,gh.gh_trangthaigiaohang
FROM dondathang ddh 
JOIN khachhang kh ON ddh.kh_tendangnhap = kh.kh_tendangnhap
JOIN giaohang gh ON gh.dh_ma = ddh.dh_ma ;";
$resultDSGH = mysqli_query($conn, $sqlDSGH);
$dataDSGH = [];
while ($row = mysqli_fetch_array($resultDSGH, MYSQLI_ASSOC)) {
    $dataDSGH[] = array(
        'kh_ten' => $row['kh_ten'],
        'dh_ma' => $row['dh_ma'],
        'dh_ngaylap' => $row['dh_ngaylap'],
        'dh_ngaygiao' => $row['dh_ngaygiao'],
        'dh_noigiao' => $row['dh_noigiao'],
        'gh_ma' => $row['gh_ma'],
        'gh_tennv' => $row['gh_tennv'],
        'gh_trangthaigiaohang' => $row['gh_trangthaigiaohang'],
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
                    <li>
                        <a href="./dondathang.php">
                            <span class="icon" id="DonDatHang">
                                <ion-icon name="bag-handle-outline"></ion-icon>
                            </span>
                            <span class="title">Đơn đặt hàng</span>
                        </a>
                    </li>
                    <li class="hovered">
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
                            <h2>Giao hàng</h2>
                            <a href="./backend/xuatfile/export_DDH.php" class="btn">Xuất file</a>
                        </div>
                        <table id="myTable" class="display">
                            <thead>
                                <tr>
                                    <td>Mã giao hàng</td>
                                    <td>Tên khách hàng</td>
                                    <td>Tên nhân viên</td>
                                    <td>Ngày giao</td>
                                    <td>Nơi giao</td>
                                    <td>Trạng thái giao hàng</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($dataDSGH as $gh) : ?>
                                    <tr>
                                        <td><?= $gh['gh_ma'] ?></td>
                                        <td><?= $gh['kh_ten'] ?></td>
                                        <td><?= $gh['gh_tennv'] ?></td>
                                        <td><?= date('d/m/Y', strtotime($gh['dh_ngaygiao'])) ?></td>
                                        <td><?= $gh['dh_noigiao'] ?></td>
                                        <td><?= $gh['gh_trangthaigiaohang'] ?></td>
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
                                        <td><input type="text" name="gh_ma" id="gh_ma" placeholder="Mã giao hàng"></td>
                                        <td><button name="btnSearch"><ion-icon name="search-outline"></ion-icon></button></td>
                                    </tr>
                                </form>
                                <?php if (isset($_POST['btnSearch'])) {
                                    $gh_ma = $_POST['gh_ma'];
                                    if (!empty($gh_ma)) {
                                        $sqlDH = "SELECT ddh.*,gh.*,sp.sp_ma ,kh.kh_ten,sp.sp_ten,spddh.sp_dh_soluong,spddh.sp_dh_dongia
                            FROM dondathang ddh 
                                                        JOIN sanpham_dondathang spddh ON ddh.dh_ma = spddh.dh_ma
                                                        JOIN sanpham sp ON sp.sp_ma = spddh.sp_ma
                                                        JOIN khachhang kh ON kh.kh_tendangnhap = ddh.kh_tendangnhap
                                                        JOIN giaohang gh ON gh.dh_ma = ddh.dh_ma
                            WHERE gh.gh_ma = '$gh_ma';";
                                        $resultDH = mysqli_query($conn, $sqlDH);
                                        $dataDH = [];
                                        while ($row = mysqli_fetch_array($resultDH, MYSQLI_ASSOC)) {
                                            $dataDH = array(
                                                'dh_ma' => $row['dh_ma'],
                                                'sp_ma' => $row['sp_ma'],
                                                'kh_tendangnhap' => $row['kh_tendangnhap'],
                                                'gh_ma' => $row['gh_ma'],
                                                'dh_ngaylap' => $row['dh_ngaylap'],
                                                'dh_ngaygiao' => $row['dh_ngaygiao'],
                                                'dh_noigiao' => $row['dh_noigiao'],
                                                'gh_tennv' => $row['gh_tennv'],
                                                'gh_trangthaigiaohang' => $row['gh_trangthaigiaohang'],
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
                                        'sp_ten' => $row['sp_ten']
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
                                $sqlMDH = "SELECT *
                                FROM dondathang 
                                WHERE dh_ma NOT IN (SELECT dh_ma FROM giaohang);";
                                $resultMDH = mysqli_query($conn, $sqlMDH);
                                $dataMDH = [];
                                while ($row = mysqli_fetch_array($resultMDH, MYSQLI_ASSOC)) {
                                    $dataMDH[] = array(
                                        'dh_ma' => $row['dh_ma']
                                    );
                                }
                                ?>
                                <form action="" method="post">
                                    <tr>
                                        <td>Mã giao hàng:</td>
                                        <?php if (isset($_POST['btnSearch']) && !empty($dataDH)) : ?>
                                            <td><input type="text" name="gh_ma" value="<?= $dataDH['gh_ma'] ?>"></td>
                                        <?php else : ?>
                                            <td><input type="text" name="gh_ma" placeholder="Nhập mã giao hàng"></td>
                                        <?php endif; ?>
                                    </tr>
                                    <tr>
                                        <td>Mã đơn hàng:</td>
                                        <?php if (isset($_POST['btnSearch']) && !empty($dataDH)) : ?>
                                            <td><input type="text" name="dh_ma" value="<?= $dataDH['dh_ma'] ?>"></td>
                                        <?php else : ?>
                                            <td><select name="dh_ma">
                                                    <?php foreach ($dataMDH as $mdh) : ?>
                                                        <option value="<?= $mdh['dh_ma'] ?>"><?= $mdh['dh_ma'] ?></option>
                                                    <?php endforeach; ?>
                                                </select></td>
                                        <?php endif; ?>
                                    </tr>
                                    <tr>
                                        <td>Tên nhân viên giao hàng:</td>
                                        <?php if (isset($_POST['btnSearch']) && !empty($dataDH)) : ?>
                                            <td><input type="text" name="gh_tennv" value="<?= $dataDH['gh_tennv'] ?>"></td>
                                        <?php else : ?>
                                            <td><input type="text" name="gh_tennv" placeholder="Nhập tên nhân viên"></td>
                                        <?php endif; ?>
                                    </tr>
                                    <tr>
                                        <td>Trạng thái giao hàng</td>
                                        <?php if (isset($_POST['btnSearch']) && !empty($dataDH)) : ?>
                                            <td><input type="text" name="gh_trangthaigiaohang" value="<?= $dataDH['gh_trangthaigiaohang'] ?>"></td>
                                        <?php else : ?>
                                            <td><input type="text" name="gh_trangthaigiaohang" placeholder="Nhập trạng thái giao hàng" td>
                                            <?php endif; ?>
                                    </tr>
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
                                    $sqlMDH = "SELECT * FROM giaohang;";
                                    $resultMDH = mysqli_query($conn, $sqlMDH);
                                    $dataMDH = [];
                                    while ($row = mysqli_fetch_array($resultMDH, MYSQLI_ASSOC)) {
                                        $dataMDH = array(
                                            'dh_ma' => $row['dh_ma']
                                        );
                                    }
                                    if ($dataMDH['dh_ma'] == $dh_ma) {
                                        echo '<script>
                                        $(document).ready(function() {
                                            // $(".Add").click(function() {
                                                Swal.fire({
                                                    icon: "error",
                                                    title: "Lỗi",
                                                    text: "Mã giao hàng đã tồn tại!",
                                                });
                                            // });
                                        })
                                    </script>';
                                    } else {
                                        $gh_ma = $_POST['gh_ma'];
                                        $gh_trangthaigiaohang = $_POST['gh_trangthaigiaohang'];
                                        $gh_tennv = $_POST['gh_tennv'];
                                        $sqlISSP = "INSERT INTO giaohang
                                (gh_ma, gh_trangthaigiaohang, gh_tennv, dh_ma)
                                VALUES ('$gh_ma', '$gh_trangthaigiaohang', '$gh_tennv', '$dh_ma');";
                                        mysqli_query($conn, $sqlISSP);
                                        echo '<script>
                                            $(document).ready(function() {
                                                Swal.fire({
                                                    position: "top-end",
                                                    icon: "success",
                                                    title: "Thêm giao hàng thành công",
                                                    showConfirmButton: false,
                                                    timer: 1500
                                                });
                                            })
                                        </script>';
                                    }
                                }
                                ?>
                                <?php
                                if (isset($_POST['btn_Edit'])) {
                                    $dh_ma = $_POST['dh_ma'];
                                    $sqlMDH = "SELECT * FROM giaohang;";
                                    $resultMDH = mysqli_query($conn, $sqlMDH);
                                    $dataMDH = [];
                                    while ($row = mysqli_fetch_array($resultMDH, MYSQLI_ASSOC)) {
                                        $dataMDH = array(
                                            'dh_ma' => $row['dh_ma']
                                        );
                                    }
                                    if ($dataMDH['dh_ma'] == $dh_ma) {
                                        echo '<script>
                                        $(document).ready(function() {
                                            // $(".Add").click(function() {
                                                Swal.fire({
                                                    icon: "error",
                                                    title: "Lỗi",
                                                    text: "Mã giao hàng đã tồn tại!",
                                                });
                                            // });
                                        })
                                    </script>';
                                    } else {
                                        $gh_ma = $_POST['gh_ma'];
                                        $gh_trangthaigiaohang = $_POST['gh_trangthaigiaohang'];
                                        $gh_tennv = $_POST['gh_tennv'];
                                        $sqlUDDH = "UPDATE giaohang
                                    SET
                                        gh_ma='$gh_ma',
                                        gh_trangthaigiaohang='$gh_trangthaigiaohang',
                                        gh_tennv='$gh_tennv',
                                        dh_ma='$dh_ma'
                                    WHERE gh_ma='$gh_ma';";
                                        mysqli_query($conn, $sqlUDDH);
                                        echo '<script>
                                            $(document).ready(function() {
                                                Swal.fire({
                                                    position: "top-end",
                                                    icon: "success",
                                                    title: "Sửa thông tin giao hàng thành công",
                                                    showConfirmButton: false,
                                                    timer: 1500
                                                });
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
                            location.href = "/DA_QTDL/backend/giaohang/delete.php?gh_ma=<?= $dataDH['gh_ma'] ?>";
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
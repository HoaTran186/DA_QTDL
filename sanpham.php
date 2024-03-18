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
    <title>Sản phẩm</title>
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
        'sp_soluong' => $row['sp_soluong']

    );
}
$sqlLSP = "SELECT * FROM loaisanpham ;";
$resultLSP = mysqli_query($conn, $sqlLSP);
$dataLSP = [];
while ($row = mysqli_fetch_array($resultLSP, MYSQLI_ASSOC)) {
    $dataLSP[] = array(
        'lsp_ma' => $row['lsp_ma'],
        'lsp_ten' => $row['lsp_ten'],
    );
}
$sqlNSX = "SELECT * FROM nhasanxuat ;";
$resultNSX = mysqli_query($conn, $sqlNSX);
$dataNSX = [];
while ($row = mysqli_fetch_array($resultNSX, MYSQLI_ASSOC)) {
    $dataNSX[] = array(
        'nsx_ma' => $row['nsx_ma'],
        'nsx_ten' => $row['nsx_ten'],
    );
}
$sqlKM = "SELECT * FROM khuyenmai ;";
$resultKM = mysqli_query($conn, $sqlKM);
$dataKM = [];
while ($row = mysqli_fetch_array($resultKM, MYSQLI_ASSOC)) {
    $dataKM[] = array(
        'km_ma' => $row['km_ma'],
        'km_ten' => $row['km_ten'],
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
                    <li class="hovered">
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
                <div class="details">
                    <div class="recentOrders">
                        <div class="cardHeader">
                            <h2>Sản phẩm</h2>
                            <a href="./backend/xuatfile/export_SP.php" class="btn">Xuất file</a>
                        </div>
                        <table id="myTable" class="display">
                            <thead>
                                <tr>
                                    <td>Mã sản phẩm</td>
                                    <td>Tên sản phẩm</td>
                                    <td>Số lượng</td>
                                    <td>Giá</td>
                                    <td>Giá cũ</td>
                                    <td>Ngày cập nhật</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($dataSP as $sp) : ?>
                                    <tr>
                                        <td><?= $sp['sp_ma'] ?></td>
                                        <td><?= $sp['sp_ten'] ?></td>
                                        <td><?= $sp['sp_soluong'] ?></td>
                                        <td><?= number_format($sp['sp_gia'], 0, '.', ',') ?></td>
                                        <td><?= number_format($sp['sp_giacu'], 0, '.', ',') ?></td>
                                        <td><?= date('d/m/Y', strtotime($sp['sp_ngaycapnhat'])) ?> </td>
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
                                        <td colspan="2">

                                            <label>
                                                <input type="text" placeholder="Tìm kiếm" name="sp_ten">
                                            </label>

                                            <!-- </div> -->
                                            <button name="btn_search" class="btn_search"><ion-icon name="search-outline"></ion-icon></button>
                                        </td>
                                    </tr>
                                </form>
                                <?php
                                if (isset($_POST['btn_search'])) {
                                    $sp_ten = $_POST['sp_ten'];
                                    if (empty($sp_ten)) {
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
                                        //$sql = "SELECT * FROM sanpham WHERE sp_ma = '$sp_ten' OR sp_ten = '$sp_ten';";
                                        $sql = "Call TimKiemSanPham ('".$sp_ten."');";

                                        $result = mysqli_query($conn, $sql);
                                        $data = [];
                                        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                            $data = array(
                                                'sp_ma' => $row['sp_ma'],
                                                'sp_ten' => $row['sp_ten'],
                                                'sp_gia' => $row['sp_gia'],
                                                'sp_giacu' => $row['sp_giacu'],
                                                'sp_ngaycapnhat' => $row['sp_ngaycapnhat'],
                                                'sp_soluong' => $row['sp_soluong'],
                                                'lsp_ma' => $row['lsp_ma'],
                                                'nsx_ma' => $row['nsx_ma'],
                                                'km_ma' => $row['km_ma']
                                            );
                                        }
                                        if (empty($data)) {
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
                                    }
                                }
                                ?>
                                <form action="" method="post">
                                    <tr>
                                        <td>Sản phẩm mã:</td>
                                        <?php if (isset($_POST['btn_search']) && !empty($data)) : ?>
                                            <td><input type="text" name="sp_ma" value="<?= $data['sp_ma'] ?>"></td>
                                        <?php else : ?>
                                            <td><input type="text" name="sp_ma" placeholder="Mã sản phẩm"></td>
                                        <?php endif; ?>
                                    </tr>
                                    <tr>
                                        <td>Tên sản phẩm:</td>
                                        <?php if (isset($_POST['btn_search']) && !empty($data)) : ?>
                                            <td><input type="text" name="sp_ten" value="<?= $data['sp_ten'] ?>"></td>
                                        <?php else : ?>
                                            <td><input type="text" name="sp_ten" placeholder="Tên sản phẩm"></td>
                                        <?php endif; ?>
                                    </tr>
                                    <tr>
                                        <td>Giá :</td>
                                        <?php if (isset($_POST['btn_search']) && !empty($data)) : ?>
                                            <td><input type="number" name="sp_gia" value="<?= $data['sp_gia'] ?>"></td>
                                        <?php else : ?>
                                            <td><input type="number" name="sp_gia" placeholder="Giá"></td>
                                        <?php endif; ?>
                                    </tr>
                                    <tr>
                                        <td>Giá cũ:</td>
                                        <?php if (isset($_POST['btn_search']) && !empty($data)) : ?>
                                            <td><input type="number" name="sp_giacu" value="<?= $data['sp_giacu'] ?>"></td>
                                        <?php else : ?>
                                            <td><input type="number" name="sp_giacu" placeholder="Giá cũ"></td>
                                        <?php endif; ?>
                                    </tr>
                                    <tr>
                                        <td>Ngày cập nhật:</td>
                                        <?php if (isset($_POST['btn_search']) && !empty($data)) : ?>
                                            <td><input type="date" name="sp_ngaycapnhat" value="<?= $data['sp_ngaycapnhat'] ?>"></td>
                                        <?php else : ?>
                                            <td><input type="date" name="sp_ngaycapnhat"></td>
                                        <?php endif; ?>
                                    </tr>
                                    <tr>
                                        <td>Số lượng:</td>
                                        <?php if (isset($_POST['btn_search']) && !empty($data)) : ?>
                                            <td><input type="number" name="sp_soluong" value="<?= $data['sp_soluong'] ?>"></td>
                                        <?php else : ?>
                                            <td><input type="number" name="sp_soluong" placeholder="Số lượng"></td>
                                        <?php endif; ?>
                                    </tr>
                                    <tr>
                                        <td>Loại sản phẩm:</td>
                                        <td><select name="lsp_ma" id="">
                                                <?php foreach ($dataLSP as $lsp) : ?>
                                                    <?php if ($lsp['lsp_ma'] == $data['lsp_ma']) : ?>
                                                        <option value="<?= $lsp['lsp_ma'] ?>" selected><?= $lsp['lsp_ten'] ?></option>
                                                    <?php else : ?>
                                                        <option value="<?= $lsp['lsp_ma'] ?>"><?= $lsp['lsp_ten'] ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td>Nhà sản xuất:</td>
                                        <td><select name="nsx_ma">
                                                <?php foreach ($dataNSX as $nsx) : ?>
                                                    <?php if ($nsx['nsx_ma'] == $data['nsx_ma']) : ?>
                                                        <option value="<?= $nsx['nsx_ma'] ?>" selected><?= $nsx['nsx_ten'] ?></option>
                                                    <?php else : ?>
                                                        <option value="<?= $nsx['nsx_ma'] ?>"><?= $nsx['nsx_ten'] ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td>Khuyến mãi</td>
                                        <td><select name="km_ma">
                                                <?php foreach ($dataKM as $km) : ?>
                                                    <?php if ($km['km_ma'] == $data['km_ma']) : ?>
                                                        <option value="<?= $km['km_ma'] ?>" selected><?= $km['km_ten'] ?></option>
                                                    <?php else : ?>
                                                        <option value="<?= $km['km_ma'] ?>"><?= $km['km_ten'] ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <button class="Add" name="btn_Add"><ion-icon name="add-circle-outline"></ion-icon></button>
                                            <button class="Edit" name="btn_Edit"><ion-icon name="create-outline"></ion-icon></button>
                                            <a class="Delete" href="#"><ion-icon name="trash-outline"></ion-icon></a>
                                        </td>
                                    </tr>
                                </form>
                                <?php if (isset($_POST['btn_Add'])) {
                                    $sp_ma = $_POST['sp_ma'];
                                    $sqlDSSP = "SELECT * FROM sanpham;";
                                    $resultDSSP = mysqli_query($conn, $sqlDSSP);
                                    $dataDSSP = [];
                                    while ($row = mysqli_fetch_array($resultDSSP, MYSQLI_ASSOC)) {
                                        $dataDSSP = array(
                                            'sp_ma' => $row['sp_ma']
                                        );
                                    }
                                    if ($dataDSSP['sp_ma'] == $sp_ma) {
                                        echo '<script>
                                        $(document).ready(function() {
                                            // $(".Add").click(function() {
                                                Swal.fire({
                                                    icon: "error",
                                                    title: "Lỗi",
                                                    text: "Mã sản phẩm đã tồn tại!",
                                                });
                                            // });
                                        })
                                    </script>';
                                    } else {
                                        $sp_ten = $_POST['sp_ten'];
                                        $sp_gia = $_POST['sp_gia'];
                                        $sp_giacu = $_POST['sp_giacu'];
                                        $sp_ngaycapnhat = $_POST['sp_ngaycapnhat'];
                                        $sp_soluong = $_POST['sp_soluong'];
                                        $lsp_ma = $_POST['lsp_ma'];
                                        $nsx_ma = $_POST['nsx_ma'];
                                        $km_ma = $_POST['km_ma'];
                                        $sqlISSP = "INSERT INTO sanpham
                                (sp_ma, sp_ten, sp_gia, sp_giacu, sp_ngaycapnhat, sp_soluong, lsp_ma, nsx_ma, km_ma)
                                VALUES ('$sp_ma', '$sp_ten', $sp_gia, $sp_giacu, '$sp_ngaycapnhat', $sp_soluong, '$lsp_ma', '$nsx_ma', '$km_ma');";
                                        mysqli_query($conn, $sqlISSP);
                                        echo '<script>
                                            $(document).ready(function() {
                                                Swal.fire({
                                                    position: "top-end",
                                                    icon: "success",
                                                    title: "Thêm sản phẩm thành công",
                                                    showConfirmButton: false,
                                                    timer: 1500
                                                });
                                            })
                                        </script>';
                                    }
                                }
                                ?>
                                <?php if (isset($_POST['btn_Edit'])) {
                                    $sp_ma = $_POST['sp_ma'];
                                    $sqlDSSP = "SELECT * FROM sanpham;";
                                    $resultDSSP = mysqli_query($conn, $sqlDSSP);
                                    $dataDSSP = [];
                                    while ($row = mysqli_fetch_array($resultDSSP, MYSQLI_ASSOC)) {
                                        $dataDSSP = array(
                                            'sp_ma' => $row['sp_ma']
                                        );
                                    }
                                    if ($dataDSSP['sp_ma'] == $sp_ma) {
                                        echo '<script>
                                        $(document).ready(function() {
                                            // $(".Add").click(function() {
                                                Swal.fire({
                                                    icon: "error",
                                                    title: "Lỗi",
                                                    text: "Mã sản phẩm đã tồn tại!",
                                                });
                                            // });
                                        })
                                    </script>';
                                    } else {
                                        $sp_ten = $_POST['sp_ten'];
                                        $sp_gia = $_POST['sp_gia'];
                                        $sp_giacu = $_POST['sp_giacu'];
                                        $sp_ngaycapnhat = $_POST['sp_ngaycapnhat'];
                                        $sp_soluong = $_POST['sp_soluong'];
                                        $lsp_ma = $_POST['lsp_ma'];
                                        $nsx_ma = $_POST['nsx_ma'];
                                        $km_ma = $_POST['km_ma'];
                                        $sqlUDSP = "UPDATE sanpham
                                SET
                                    sp_ten='$sp_ten',
                                    sp_gia=$sp_gia,
                                    sp_giacu=$sp_giacu,
                                    sp_ngaycapnhat='$sp_ngaycapnhat',
                                    sp_soluong=$sp_soluong,
                                    lsp_ma='$lsp_ma',
                                    nsx_ma='$nsx_ma',
                                    km_ma='$km_ma'
                                WHERE sp_ma='$sp_ma';";
                                        mysqli_query($conn, $sqlUDSP);
                                        echo '<script>
                                            $(document).ready(function() {
                                                Swal.fire({
                                                    position: "top-end",
                                                    icon: "success",
                                                    title: "Sửa sản phẩm thành công",
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
<script src="./assets/js/chart.min.js"></script>
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
                text: "Dữ liệu sẽ sản phẩm sẽ bị xóa!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Vâng, tôi muốn xóa nó!",
                cancelButtonText: "Không, thoát!",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    swalWithBootstrapButtons.fire(
                        "Đã xóa!",
                        "Dữ liệu sản phẩm đã xóa.",
                        "success"
                    ).then((rs) => {
                        if (rs.isConfirmed) {
                            location.href = "/DA_QTDL/backend/sanpham/delete.php?sp_ma=<?= $data['sp_ma'] ?>";
                        }
                    })
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Đã thoát',
                        'Bạn không xóa dữ sản phẩm',
                        'error'
                    )
                }
            })
        });
    });
</script>

</html>
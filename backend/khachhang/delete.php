<?php
session_start();
?>
<?php
    if (isset($_SESSION['dadangnhap']) && $_SESSION['dadangnhap'] == false || !isset($_SESSION['dadangnhap'])) {
        echo '<script>location.href="/PassdoSV.com/dangnhap.php";</script>';
    } elseif (isset($_SESSION['kh_quantri']) && $_SESSION['kh_quantri'] == false) {
        echo 'Bạn không có quyền sử dụng chức năng này!';
        echo '<a href="/PassdoSV.com/index.php">Quay lại trang chủ</a>';
    } else {
    ?>
<?php
include_once __DIR__ . '/../../dbconnect.php';
$kh_tendangnhap = $_GET['kh_tendangnhap'];
$sqlDLKH = "DELETE FROM khachhang WHERE kh_tendangnhap = '$kh_tendangnhap';";
mysqli_query($conn, $sqlDLKH);
echo '<script>location.href="/DA_QTDL/khachhang.php"</script>';
?>
<?php } ?>
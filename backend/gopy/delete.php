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
include_once __DIR__.'/../../dbconnect.php';
    $gy_ma = $_GET['gy_ma'];
    $sqlDL = "DELETE FROM gopy WHERE gy_ma = '$gy_ma';";
    mysqli_query($conn,$sqlDL);
    echo '<script>location.href = "/DA_QTDL/gopy.php"</script>';
?>
<?php } ?>
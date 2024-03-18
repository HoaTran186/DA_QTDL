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
    $hsp_ma = $_GET['hsp_ma'];
    $sqlSLHSP = "SELECT * FROM hinhsanpham WHERE hsp_ma = $hsp_ma;";
    $resultSLHSP = mysqli_query($conn, $sqlSLHSP);
    $dataSLHSP = [];
    while ($row = mysqli_fetch_array($resultSLHSP, MYSQLI_ASSOC)) {
        $dataSLHSP = array(
            'hsp_tentaptin' => $row['hsp_tentaptin'],
        );
    }
    $uploadDir = __DIR__. '/../../assets/img_sp/';
    unlink($uploadDir . $dataSLHSP['hsp_tentaptin']);
    $sqlDLHSP = "DELETE FROM hinhsanpham WHERE hsp_ma = $hsp_ma;";
    mysqli_query($conn, $sqlDLHSP);
    echo '<script>location.href="/DA_QTDL/hinhsanpham.php"</script>';
?>
<?php } ?>
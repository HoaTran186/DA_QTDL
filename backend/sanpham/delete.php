<?php
include_once __DIR__.'/../../dbconnect.php';
$sp_ma = $_GET['sp_ma'];
$sqlDL = "DELETE FROM sanpham WHERE sp_ma='$sp_ma';";
$sqlHSP = "SELECT * FROM hinhsanpham WHERE sp_ma = '$sp_ma';";
$resultHSP = mysqli_query($conn, $sqlHSP);
$dataHSP = [];
while ($row = mysqli_fetch_array($resultHSP, MYSQLI_ASSOC)) {
    $dataHSP[] = array(
        'hsp_tentaptin' => $row['hsp_tentaptin'],
        'sp_ma' => $row['sp_ma']
    );
}
$upload_dir = __DIR__ . "/assets/img_sp/";
foreach ($dataHSP as $hsp) :
    unlink($upload_dir . $hsp['hsp_tentaptin']);
endforeach;
$sqlDLHSP = "DELETE FROM hinhsanpham WHERE sp_ma = '$sp_ma';";
mysqli_query($conn, $sqlDLHSP);
mysqli_query($conn, $sqlDL);
echo '<script>location.href = "/DA_QTDL/sanpham.php"</script>';
?>

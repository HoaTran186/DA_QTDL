<?php
session_start();
?>
<?php
    if (isset($_SESSION['dadangnhap']) && $_SESSION['dadangnhap'] == false || !isset($_SESSION['dadangnhap'])) {
        echo '<script>location.href="/DA_QTDL/login.php";</script>';
    } elseif (isset($_SESSION['kh_quantri']) && $_SESSION['kh_quantri'] == false) {
        echo 'Bạn không có quyền sử dụng chức năng này!';
    } else {
    ?>
<?php
include_once __DIR__ . '/../../dbconnect.php';
$sql = "SELECT * FROM khachhang 
WHERE kh_ten NOT LIKE 'admin';";
$result = mysqli_query($conn, $sql);
$data = [];
while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
    $data[] =array(
        'kh_tendangnhap' =>$row['kh_tendangnhap'],
        'kh_ten' =>$row['kh_ten'],
        'kh_gioitinh' =>$row['kh_gioitinh'],
        'kh_diachi' =>$row['kh_diachi'],
        'kh_dienthoai' =>$row['kh_dienthoai'],
        'kh_email' =>$row['kh_email'],
        'kh_ngaysinh' => $row['kh_ngaysinh'],
        'kh_thangsinh' => $row['kh_thangsinh'],
        'kh_namsinh' => $row['kh_namsinh'],
        'kh_cmnd' =>$row['kh_cmnd']
    );
}
require __DIR__.'/../../assets/vendor/FPDF/fpdf.php';
$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Arial','',14);
$pdf->Cell(200,5,'KHACH HANG',0,1,'C');
foreach($data as $kh):
$pdf->Cell(50,10,'KH_TENDANGNHAP :',0,0);
$pdf->Cell(100,10,$kh['kh_tendangnhap'],0,1);
$pdf->Ln(5);
$pdf->Cell(50,5,'KH_TEN :',0,0);
$pdf->Cell(100,5,$kh['kh_ten'],0,1);
$pdf->Ln(5);
$pdf->Cell(50,5,'KH_GIOITINH :',0,0);
$pdf->Cell(100,5,$kh['kh_gioitinh'],0,1);
$pdf->Ln(5);
$pdf->Cell(50,5,'KH_DIACHI :',0,0);
$pdf->Cell(100,5,$kh['kh_diachi'],0,1);
$pdf->Ln(5);
$pdf->Cell(50,5,'KH_DIENTHOAI :',0,0);
$pdf->Cell(100,5,$kh['kh_dienthoai'],0,1);
$pdf->Ln(5);
$pdf->Cell(50,5,'KH_EMAIL :',0,0);
$pdf->Cell(100,5,$kh['kh_email'],0,1);
$pdf->Ln(5);
$pdf->Cell(50,5,'KH_NGAYSINH :',0,0);
$pdf->Cell(100,5,$kh['kh_ngaysinh'].'/'.$kh['kh_thangsinh'].'/'.$kh['kh_namsinh'],0,1);
$pdf->Ln(5);
$pdf->Cell(50,5,'KH_CMND :',0,0);
$pdf->Cell(100,5,$kh['kh_cmnd'],0,1);
$pdf->Ln(5);
$pdf->Line(20,111,200,111);
endforeach;
$pdf->Output();
?>
<?php } ?>
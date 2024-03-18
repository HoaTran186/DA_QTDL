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
$sql = "SELECT gy.*,cdgy.cdgy_ten FROM gopy gy JOIN chudegopy cdgy ON gy.cdgy_ma = cdgy.cdgy_ma;";
$result  = mysqli_query($conn,$sql);
$data = [];
while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
    $data [] = array(
        'gy_ma' =>$row['gy_ma'],
        'gy_hoten' =>$row['gy_hoten'],
        'gy_email' =>$row['gy_email'],
        'gy_diachi' =>$row['gy_diachi'],
        'gy_dienthoai' =>$row['gy_dienthoai'],
        'gy_tieude' =>$row['gy_tieude'],
        'gy_noidung' =>$row['gy_noidung'],
        'gy_ngaygopy' =>$row['gy_ngaygopy'],
        'cdgy_ten' =>$row['cdgy_ten']
    );
}
require __DIR__.'/../../assets/vendor/FPDF/fpdf.php';
$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Arial','',14);
$pdf->Cell(200,5,'GOP Y',0,1,'C');
foreach($data as $gy):
$pdf->Cell(50,10,'GY_ID :',0,0);
$pdf->Cell(100,10,$gy['gy_ma'],0,1);
$pdf->Ln(5);
$pdf->Cell(50,5,'GY_HOTEN :',0,0);
$pdf->Cell(100,5,$gy['gy_hoten'],0,1);
$pdf->Ln(5);
$pdf->Cell(50,5,'GY_EMAIL :',0,0);
$pdf->Cell(100,5,$gy['gy_email'],0,1);
$pdf->Ln(5);
$pdf->Cell(50,5,'GY_DIACHI :',0,0);
$pdf->Cell(100,5,$gy['gy_diachi'],0,1);
$pdf->Ln(5);
$pdf->Cell(50,5,'GY_DIENTHOAI :',0,0);
$pdf->Cell(100,5,$gy['gy_dienthoai'],0,1);
$pdf->Ln(5);
$pdf->Cell(50,5,'GY_TIEUDE :',0,0);
$pdf->Cell(100,5,$gy['gy_tieude'],0,1);
$pdf->Ln(5);
$pdf->Cell(50,5,'GY_NOIDUNG :',0,0);
$pdf->Cell(100,5,$gy['gy_noidung'],0,1);
$pdf->Ln(5);
$pdf->Cell(50,5,'GY_NGAYGOPY :',0,0);
$pdf->Cell(100,5,$gy['gy_ngaygopy'],0,1);
$pdf->Ln(5);
$pdf->Cell(50,5,'CDGY_TEN :',0,0);
$pdf->Cell(100,5,$gy['cdgy_ten'],0,1);
$pdf->Ln(5);
$pdf->Line(20,111,200,111);
endforeach;
$pdf->Output();
?>
<?php } ?>
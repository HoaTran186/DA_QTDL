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

$sql = "SELECT ddh.*,kh.kh_ten,spddh.sp_dh_soluong,spddh.sp_dh_dongia,sp.sp_ten FROM dondathang ddh 
JOIN sanpham_dondathang spddh ON ddh.dh_ma = spddh.dh_ma
JOIN khachhang kh ON ddh.kh_tendangnhap = kh.kh_tendangnhap
JOIN sanpham sp ON sp.sp_ma = spddh.sp_ma;";
$result = mysqli_query($conn, $sql);
$data = [];
while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
    $data[] = array(
        'dh_ma' =>$row['dh_ma'],
        'dh_ngaylap' =>$row['dh_ngaylap'],
        'dh_ngaygiao' =>$row['dh_ngaygiao'],
        'dh_noigiao' =>$row['dh_noigiao'],
        'dh_trangthaithanhtoan' =>$row['dh_trangthaithanhtoan'],
        'kh_ten' =>$row['kh_ten'],
        'sp_ten' =>$row['sp_ten'],
        'sp_dh_soluong' =>$row['sp_dh_dongia'],
        'sp_dh_dongia' =>$row['sp_dh_dongia']
    ); 
}
require __DIR__.'/../../assets/vendor/FPDF/fpdf.php';
$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Arial','',14);
$pdf->Cell(200,5,'DON DAT HANG',0,1,'C');
foreach($data as $dh):
$pdf->Cell(50,10,'DH_ID :',0,0);
$pdf->Cell(100,10,$dh['dh_ma'],0,1);
$pdf->Ln(5);
$pdf->Cell(50,5,'DH_NGAYLAP :',0,0);
$pdf->Cell(100,5,$dh['dh_ngaylap'],0,1);
$pdf->Ln(5);
$pdf->Cell(50,5,'DH_NGAYGIAO :',0,0);
$pdf->Cell(100,5,$dh['dh_ngaygiao'],0,1);
$pdf->Ln(5);
$pdf->Cell(50,5,'DH_NOIGIAO :',0,0);
$pdf->Cell(100,5,$dh['dh_noigiao'],0,1);
$pdf->Ln(5);
$pdf->Cell(50,5,'DH_TTTHANHTOAN :',0,0);
$pdf->Cell(100,5,$dh['dh_trangthaithanhtoan'],0,1);
$pdf->Ln(5);
$pdf->Cell(50,5,'KH_TEN :',0,0);
$pdf->Cell(100,5,$dh['kh_ten'],0,1);
$pdf->Ln(5);
$pdf->Cell(50,5,'SP_TEN :',0,0);
$pdf->Cell(100,5,$dh['sp_ten'],0,1);
$pdf->Ln(5);
$pdf->Cell(50,5,'SO_LUONG :',0,0);
$pdf->Cell(100,5,$dh['sp_dh_soluong'],0,1);
$pdf->Ln(5);
$pdf->Cell(50,5,'DON_GIA :',0,0);
$pdf->Cell(100,5,$dh['sp_dh_dongia'],0,1);
$pdf->Ln(5);
$pdf->Line(20,111,200,111);
endforeach;
$pdf->Output();
?>
<?php } ?>

<?php
session_start();
?>
<?php
    if (isset($_SESSION['dadangnhap']) && $_SESSION['dadangnhap'] == false || !isset($_SESSION['dadangnhap'])) {
        echo '<script>location.href="";</script>';
    } elseif (isset($_SESSION['kh_quantri']) && $_SESSION['kh_quantri'] == false) {
        echo 'Bạn không có quyền sử dụng chức năng này!';
    } else {
    ?>
<?php
include_once __DIR__ . '/../../dbconnect.php';
$sql = "SELECT sp.*,lsp.lsp_ten,nsx.nsx_ten,km.km_ten FROM sanpham sp 
    JOIN loaisanpham lsp ON sp.lsp_ma = lsp.lsp_ma
    JOIN nhasanxuat nsx ON nsx.nsx_ma = sp.nsx_ma
    JOIN khuyenmai km ON sp.km_ma = km.km_ma
     ORDER BY sp_ma desc;";
$result = mysqli_query($conn, $sql);
$data = [];
while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
    $data[] = array(
        'sp_ma' =>$row['sp_ma'],
        'sp_ten' =>$row['sp_ten'],
        'sp_gia' =>$row['sp_gia'],
        'sp_giacu' =>$row['sp_giacu'],
        'sp_ngaycapnhat' =>$row['sp_ngaycapnhat'],
        'sp_soluong' =>$row['sp_soluong'],
        'lsp_ten' =>$row['lsp_ten'],
        'nsx_ten' =>$row['nsx_ten'],
        'km_ten' =>$row['km_ten']
    );
}
require __DIR__.'/../../assets/vendor/FPDF/fpdf.php';
$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Arial','',14);
$pdf->Cell(200,5,'SAN PHAM',0,1,'C');
foreach($data as $sp):
$pdf->Cell(50,10,'SP_ID :',0,0);
$pdf->Cell(100,10,$sp['sp_ma'],0,1);
$pdf->Ln(5);
$pdf->Cell(50,5,'SP_GIA :',0,0);
$pdf->Cell(100,5,$sp['sp_gia'],0,1);
$pdf->Ln(5);
$pdf->Cell(50,5,'SP_GIACU :',0,0);
$pdf->Cell(100,5,$sp['sp_giacu'],0,1);
$pdf->Ln(5);
$pdf->Cell(50,5,'SP_NGAYCAPNHAT :',0,0);
$pdf->Cell(100,5,$sp['sp_ngaycapnhat'],0,1);
$pdf->Ln(5);
$pdf->Cell(50,5,'SP_SOLUONG :',0,0);
$pdf->Cell(100,5,$sp['sp_soluong'],0,1);
$pdf->Ln(5);
$pdf->Cell(50,5,'LSP_TEN :',0,0);
$pdf->Cell(100,5,$sp['lsp_ten'],0,1);
$pdf->Ln(5);
$pdf->Cell(50,5,'NSX_TEN :',0,0);
$pdf->Cell(100,5,$sp['nsx_ten'],0,1);
$pdf->Ln(5);
$pdf->Cell(50,5,'KM_TEN :',0,0);
$pdf->Cell(100,5,$sp['km_ten'],0,1);
$pdf->Ln(5);
$pdf->Line(20,111,200,111);
endforeach;
$pdf->Output();
?>
<?php } ?>
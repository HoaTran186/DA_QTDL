<?php
include_once __DIR__.'/../../dbconnect.php';
    $sqlSoLuongSanPham = <<<EOT
    SELECT lsp.lsp_ten,COUNT(sp.sp_ma) AS SoLuong
    FROM sanpham  sp JOIN loaisanpham lsp ON sp.lsp_ma = lsp.lsp_ma 
    GROUP BY sp.lsp_ma; 
EOT;
    $resultSoLuongSanPham = mysqli_query($conn,$sqlSoLuongSanPham);
    $dataSoLuongSanPham = [];
    while($row = mysqli_fetch_array($resultSoLuongSanPham,MYSQLI_ASSOC)){
        $dataSoLuongSanPham[] =array(
            'lsp_ten' =>$row['lsp_ten'],
            'SoLuong' =>$row['SoLuong']
        );
    }
    echo json_encode($dataSoLuongSanPham);
?>
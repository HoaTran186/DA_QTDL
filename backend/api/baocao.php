<?php
    include_once __DIR__.'/../../dbconnect.php';
    $sql = "SELECT COUNT(*) AS soluong FROM khachhang
    UNION ALL
    SELECT COUNT(*) AS soluong FROM sanpham
    UNION ALL
    SELECT COUNT(*) AS soluong FROM gopy
    UNION ALL
    SELECT COUNT(*) AS soluong FROM dondathang;";
    $resultTSL = mysqli_query($conn,$sql);
    $data = [];
    while($row = mysqli_fetch_array($resultTSL,MYSQLI_ASSOC)){
        $data []= array(
            'soluong' => $row['soluong']
        );
    }
    echo json_encode($data);
?>
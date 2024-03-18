<script src="/DA_QTDL/assets/js/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.9.0/dist/sweetalert2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.9.0/dist/sweetalert2.all.min.js"></script>
<?php
include_once __DIR__ . '/../../dbconnect.php';
$dh_ma = $_GET['dh_ma'];
$sql = "SELECT * FROM dondathang WHERE dh_ma = '$dh_ma';";
$result = mysqli_query($conn, $sql);
$data = [];
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $data = array(
        'dh_trangthaithanhtoan' => $row['dh_trangthaithanhtoan']
    );
}
if ($data['dh_trangthaithanhtoan'] == 'Đã Thanh Toán') {
    $sqlDLSPDH = "DELETE FROM sanpham_dondathang WHERE dh_ma='$dh_ma';";
    $sqlDLDH = "DELETE FROM dondathang WHERE dh_ma='$dh_ma';";
    $sqlDLGH = "DELETE FROM giaohang WHERE dh_ma='$dh_ma';";
    mysqli_query($conn, $sqlDLGH);
    mysqli_query($conn, $sqlDLSPDH);
    mysqli_query($conn, $sqlDLDH);
    echo '<script>
            $(document).ready(function() {
                    Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "Xóa thàng công",
                            showConfirmButton: false,
                            timer: 1500
                             }).then((result) => {           
                                            location.href = "/DA_QTDL/dondathang.php";
                
                            })
            })
        </script>';
} else {
    echo '<script>
    $(document).ready(function() {
            Swal.fire({
                icon: "error",
                title: "Lỗi",
                text: "Đơn hàng chưa thanh toán không thể xóa!",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                            location.href = "/DA_QTDL/dondathang.php";

                }
            })
        })
</script>';
}
?>
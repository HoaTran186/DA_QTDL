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
$upload_dir = __DIR__ . "/assets/img_sp/";
// var_dump($_FILES['file']['name']);
$hsp_tentaptin = date('YmdHis') . '_' . $_FILES['file']['name'];
move_uploaded_file($_FILES['file']['tmp_name'], $upload_dir . $hsp_tentaptin);

include_once __DIR__ . '/dbconnect.php';

$sp_ma = $_POST['sp_ma'];

$sql = "INSERT INTO hinhsanpham
                                (hsp_tentaptin,sp_ma)
                                VALUE ('$hsp_tentaptin','$sp_ma');";
mysqli_query($conn, $sql);
?>
<?php } ?>
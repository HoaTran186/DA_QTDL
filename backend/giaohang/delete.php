<?php
include_once __DIR__.'/../../dbconnect.php';
$gh_ma = $_GET['gh_ma'];
$sqlGH = "DELETE FROM giaohang WHERE gh_ma='$gh_ma';";
mysqli_query($conn, $sqlGH);
echo '<script>location.href = "/DA_QTDL/giaohang.php"</script>';
?>
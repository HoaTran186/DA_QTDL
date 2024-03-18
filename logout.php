<?php
    session_start();
    unset($_SESSION['dadangnhap']);
    unset($_SESSION['kh_tendangnhap']);
    unset($_SESSION['kh_ten']);
    unset($_SESSION['kh_quantri']);
    echo '<script>location.href= "./login.php"</script>';
?>
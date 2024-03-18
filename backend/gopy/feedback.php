<?php
session_start();
?>
<?php
    if (isset($_SESSION['dadangnhap']) && $_SESSION['dadangnhap'] == false || !isset($_SESSION['dadangnhap'])) {
        echo '<script>location.href="/PassdoSV.com/dangnhap.php";</script>';
    } elseif (isset($_SESSION['kh_quantri']) && $_SESSION['kh_quantri'] == false) {
        echo 'Bạn không có quyền sử dụng chức năng này!';
        echo '<a href="/PassdoSV.com/index.php">Quay lại trang chủ</a>';
    } else {
    ?>
<?php
include_once __DIR__.'/../../dbconnect.php';
    $gy_ma = $_GET['gy_ma'];
    $sqlGY = "SELECT gy.*,cdgy.cdgy_ten FROM gopy gy JOIN chudegopy cdgy ON gy.cdgy_ma = cdgy.cdgy_ma WHERE gy_ma = '$gy_ma';";
    $resultGY = mysqli_query($conn,$sqlGY);
    $dataGY = [];
    while($row = mysqli_fetch_array($resultGY,MYSQLI_ASSOC)){
        $dataGY = array(
            'gy_hoten' =>$row['gy_hoten'],
            'gy_email' =>$row['gy_email'],
            'gy_dienthoai' =>$row['gy_dienthoai'],
            'gy_tieude' =>$row['gy_tieude'],
            'gy_noidung' =>$row['gy_noidung'],
            'gy_ngaygopy' =>$row['gy_ngaygopy'],
            'cdgy_ten' =>$row['cdgy_ten']
        );
    }
    require("/xampp/htdocs/DA_QTDL/assets/vendor/PHPMailer-master/src/PHPMailer.php");
    require("/xampp/htdocs/DA_QTDL/assets/vendor/PHPMailer-master/src/Exception.php");
    require("/xampp/htdocs/DA_QTDL/assets/vendor/PHPMailer-master/src/SMTP.php");
    $gy_hoten = $dataGY['gy_hoten'];
    $gy_email = $dataGY['gy_email'];
    $gy_dienthoai = $dataGY['gy_dienthoai'];
    $gy_tieude = $dataGY['gy_tieude'];
    $gy_noidung = $dataGY['gy_noidung'];
    $gy_ngaygopy = $dataGY['gy_ngaygopy'];
    $cdgy_ten = $dataGY['cdgy_ten'];
    $mail = new PHPMailer\PHPMailer\PHPMailer(true);
    try {
        //Server settings
        $mail->SMTPDebug = 2;                                   // Enable verbose debug output
        $mail->isSMTP();                                        // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';                         // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                                 // Enable SMTP authentication
        $mail->Username = 'thh1862002@gmail.com'; // SMTP username
        $mail->Password = 'kcti yefu pdmt htcj';                   // SMTP password
        $mail->SMTPSecure = 'tls';                              // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                      // TCP port to connect to
        $mail->CharSet = "UTF-8";
        // Bật chế bộ tự mình mã hóa SSL
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $mail->setFrom('thh1862002@gmail.com', 'Phản hồi');
        $mail->addAddress("$gy_email");               // Add a recipient
        $mail->addReplyTo($gy_email);
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');        // Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');   // Optional name

        //Content
        $mail->isHTML(true);                                    // Set email format to HTML

        // Tiêu đề Mail
        $mail->Subject = "[Phản hồi góp ý $gy_tieude!!]";

        // Nội dung Mail
        // Lưu ý khi thiết kế Mẫu gởi mail
        // - Chỉ nên sử dụng TABLE, TR, TD, và các định dạng cơ bản của CSS để thiết kế
        // - Các đường link/hình ảnh có sử dụng trong mẫu thiết kế MAIL phải là đường dẫn WEB có thật, ví dụ như logo,banner,...
        $body = <<<EOT
        <h2>Góp ý của bạn $gy_hoten</h2>
        <h3>Cảm ơn bạn đã góp ý về $cdgy_ten</h3>
        <table border=1>
        <thead>
            <tr>
                <td>Tên khách hàng</td>
                <td>Email</td>
                <td>Điện thoại</td>
                <td>Ngày góp ý</td>
                <td>Nội dung góp ý</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>$gy_hoten</td>
                <td>$gy_email</td>
                <td>$gy_dienthoai</td>
                <td>$gy_ngaygopy</td>
                <td>$gy_noidung</td>
            </tr>
        </tbody>
    </table>
    <br>
    <b style="color: red;">Chúng tôi đã tiếp nhận góp ý của bạn</b>
EOT;
        $mail->Body    = $body;

        $mail->send();
    } catch (Exception $e) {
        echo 'Lỗi khi gởi mail: ', $mail->ErrorInfo;
    }
$sqlDLGY = "DELETE FROM gopy WHERE gy_ma = '$gy_ma';";
mysqli_query($conn,$sqlDLGY);
echo '<script>location.href = "/DA_QTDL/gopy.php"</script>';
?>
<?php } ?>
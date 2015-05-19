<?php
    require_once '/lib/PHPGangsta/GoogleAuthenticator.php';

    $ga = new PHPGangsta_GoogleAuthenticator();

    $secret = $ga->createSecret();
    echo "Secret is: ".$secret."\n\n";
    $qrCodeUrl = $ga->getQRCodeGoogleUrl('Blog', $secret);
    echo "Google Charts URL for the QR-Code: ".$qrCodeUrl."\n\n";
    echo '<img src="https://chart.googleapis.com/chart?chs=200x200&chld=M|0&cht=qr&chl=otpauth%3A%2F%2Ftotp%2FBlog%3Fsecret%3D27YGTHFDIBQOWSP5" />';
    $oneCode = $ga->getCode($secret);
    echo "Checking Code '$oneCode' and Secret '$secret':\n";
    $checkResult = $ga->verifyCode($secret, $oneCode, 2);    // 2 = 2*30sec clock tolerance

    if ($checkResult) {
        echo 'OK';
    } else {
        echo 'FAILED';
    }
?>
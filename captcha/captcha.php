<?php

if (!isset($_SESSION)) {
    session_start();
}

header("content-type: image/png");
$codigoCaptcha = substr(md5(time()), 0, 4);
$_SESSION['captcha'] = $codigoCaptcha;
$imagemCaptcha = imagecreatefrompng("fundocaptcha.png");
$fonteCaptcha = imageloadfont("anonymous.gdf");
$corCaptcha = imagecolorallocate($imagemCaptcha, 66, 107, 244);
imagestring($imagemCaptcha, $fonteCaptcha, 80, 5, $codigoCaptcha, $corCaptcha);

imagepng($imagemCaptcha);
imagedestroy($imagemCaptcha);
?>


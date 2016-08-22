<?php

if( !session_id() ) {
    session_start();
    session_regenerate_id();
}

function create_image($session_name = 'form_captcha', $rand = '')
{
    $md5_hash = md5(rand(0,999));
    $security_code = substr($md5_hash, 15, 5);

    if( isset($_SESSION[$session_name.$rand]) && !empty($rand) && $_SESSION[$session_name.$rand] == $rand ) {
        $security_code = $_SESSION[$session_name];
    }else{
        $_SESSION[$session_name] = $security_code;
        $_SESSION[$session_name.'rand'] = $rand;
    }

    $width = 100;
    $height = 30;
    $image = ImageCreate($width, $height);
    $white = ImageColorAllocate($image, 255, 255, 255);
    $black = ImageColorAllocate($image, 102, 51, 0);
    ImageFill($image, 0, 0, $black);
    ImageString($image, 5, 30, 6, $security_code, $white);
    header("Content-Type: image/jpeg");
    ImageJpeg($image);
    ImageDestroy($image);
}

create_image('form_captcha', $_GET['rand']) ;
exit();
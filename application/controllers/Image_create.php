<?php
class Image_create extends CI_Controller {
    function __construct() {
        parent::__construct();
    }

    function crop($ratio,$filename) {
        $tmp = "././upload/product/".$filename;

        $fileext = explode(".",$tmp);
        $fileext = strtolower(end($fileext));

        switch($fileext) {
            case 'jpg' :
            case 'jpeg' :
                $image = imagecreatefromjpeg($tmp);
                break;
            case 'png' :
                $image = imagecreatefrompng($tmp);
                break;
            default :
                die($tmp);
        }

        if($ratio != "original") {
            $getratio = explode("x",$ratio);

            list($w,$h) = getimagesize($tmp);
            if(($w / $h) < ($getratio[0] / $getratio[1])) {
                $rw = ($w * $getratio[1]) / $getratio[0];
                $image = imagecrop($image, [
                    "x" => 0,
                    "y" => ($h - $rw) / 2,
                    "width" => $w,
                    "height" => $rw
                ]);
            } else {
                $rw = ($h * $getratio[0]) / $getratio[1];
                $image = imagecrop($image, [
                    "x" => ($w - $rw) / 2,
                    "y" => 0,
                    "width" => $rw,
                    "height" => $h
                ]);
            }
        }

        header('Content-Type: image/jpeg');
        imagejpeg($image,NULL,80);
        imagedestroy($image);
    }

    function crop_slider($ratio,$filename) {
        $tmp = "././upload/slider/".$filename;

        $fileext = explode(".",$tmp);
        $fileext = strtolower(end($fileext));

        switch($fileext) {
            case 'jpg' :
            case 'jpeg' :
                $image = imagecreatefromjpeg($tmp);
                break;
            case 'png' :
                $image = imagecreatefrompng($tmp);
                break;
            default :
                die($tmp);
        }

        if($ratio != "original") {
            $getratio = explode("x",$ratio);

            list($w,$h) = getimagesize($tmp);
            if(($w / $h) < ($getratio[0] / $getratio[1])) {
                $rw = ($w * $getratio[1]) / $getratio[0];
                $image = imagecrop($image, [
                    "x" => 0,
                    "y" => ($h - $rw) / 2,
                    "width" => $w,
                    "height" => $rw
                ]);
            } else {
                $rw = ($h * $getratio[0]) / $getratio[1];
                $image = imagecrop($image, [
                    "x" => ($w - $rw) / 2,
                    "y" => 0,
                    "width" => $rw,
                    "height" => $h
                ]);
            }
        }

        header('Content-Type: image/jpeg');
        imagejpeg($image,NULL,80);
        imagedestroy($image);
    }
}
<?php
namespace Lib;
class Captcha
{
    private $captha_w;
    private $captha_H;

    public function __construct($width = 80, $height = 32)
    {
        $this->captha_w = $width;
        $this->captha_h = $height;
    }

    //生产随机字符
    private function generalCode()
    {
        $charset = '2345678abcdefhijkmnpqrstuvwxyzABCDEFGHJKLMNPQRTUVWXY';
        $code = '';
        $max = strlen($codeSet);
        for($i=1; $i<=4; $i++) {
            $index = rand(0, $max - 1);
            $code.=$codeset[$index];
        }
        $_SESSION['code'] = $code;  //保存到会话中
        return $code;
    }

    //创建验证码
    public function entry()
    {
        $code = $this->generalCode();
        $path = './captcha/captcha_bg'.rand(1, 5).'.jpg';
        $img = imagecreatefromjpeg($path);
        
        $font = 5;      
        $x = (imagesx($img) - imagefontwidth($font)*strlen($code)) / 2;         
        $y = (imagesy($img) - imagefontheight($font)) / 2;
        $color = imagecolorallocate($img, 255, 0, 0);
        imagestring($ima, $font, $x, $y, $code, $color);
        
        header('content-type:image/gif');
        imagegif($img); 
    }

    public function check($code)
    {
        return strtoupper($code) == strtoupper($_SESSION['code']);
    }

}
<?php
namespace Lib;

class Image
{
    public function thumb($src_path, $prefix='small_', $w=200, $h=200, $flag = false)
    {
        $dst_img = imagecreatetruecolor($w, $h);
        
        $src_img = imagecreatefromjpeg($src_path);
     
        $src_w = imagesx($src_img);
        $src_h = imagesy($src_img);
        imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $w, $h, $src_w, $src_h);
        $filename = basename($src_path);
        $foldername = substr(dirname($src_path), -10);
        $dst_path = "{$foldername}/{$prefix}{$filename}";
        $save_path = dirname($src_path).'/'.$prefix.$filename;
        imagejpeg($img, $save_path); 

        return $dst_path;
    }
}

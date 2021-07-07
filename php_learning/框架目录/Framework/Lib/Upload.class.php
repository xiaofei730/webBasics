<?php
namespace Lib;

class Upload
{
    private $path;      //上传的路径
    private $size;      //上传的大小
    private $type;      //允许上传的类型
    private $error;     //保存错误信息

    public function __construct($path, $size, $type)
    {
        $this->path = $path;
        $this->size = $size;
        $this->type = $type;
    }

    public function getError()
    {
        return $this->error;
    }

    public function uploadOne($files)
    {
        if ($this->checkError($file)) {
            $foldername = date('Y-m-d');            //文件夹名称
            $folderpath = $this->path.$foldername;
            if (!is_dir($folderpath)) {
                mkdir($folderpath);
            }
            $filename = uniqid('', true).strrchr($files['name'], '.');
            $filepath = "$folderpath/$filename";
            if (move_uploaded_file($files['tmp_name'], $filepath)) {
                return "{$foldername}/{$filename}";
            } else {
                $this->error = '上传失败<br>';
                return false;
            }
        } 

        return false;
    }


    private function checkError($files)
    {
        if($files['error'] != 0) {
            switch ($file['error']) {
                case 1:
                    $this->error = '文件大小超过了php.ini中允许的最大值，最大值是'.ini_get('upload_max_filesize');
                    return false;
                case 2:
                    $this->error = '文件大小超过了表单允许的最大值';
                    return false;
                case 3:
                    $this->error = '只有部分文件上传';
                    return false;
                case 4:
                    $this->error = '没有文件上传';
                    return false;
                case 6:
                    $this->error = '找不到临时文件';
                    return false;
                case 7:
                    $this->error = '文件写入失败';
                    return false;
                default:
                    $this->error = '未知错误';
                    return false;
            }
        }

        $info = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($info, $_FILES['face']['tmp_name']);
        // $allow = array('image/jpeg', 'image/png', 'image/git');
        if (!in_array($mime, $this->type)) { 
            $this->error = '只能上传'.implode(',', $this->type).'格式';
            return false;
        }


        // $size = 123456789;
        if ($file['size'] > $this->size) {
            $this->error = '文件大小不能超过'.number_format($size/1024, 1).'K';
            return false;
        }

        if (!is_uploaded_file($file['tmp_name'])) {
            $this->error = '文件不是HTTP POST上传的<br>';
            return false;
        }

        return true;
    }

}










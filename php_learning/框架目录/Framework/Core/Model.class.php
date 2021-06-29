<?php
namespace Core;

class Model
{
    //连接数据库
    private function initMyPDO()
    {
        $this->mypdo = MyPDO::getInstance($GLOBALS['config']['database']);
    }
}
<?php
namespace Traits;

//跳转的插件
trait Jump
{
    //封装成功的跳转
    public function success($url, $info='', $time=1)
    {
        $this->redirect($url, $info, $time, 'success');
    }
    //封装失败跳转
    public function error($url, $info='', $time=3)
    {
        $this->redirect($url, $info, $time, 'error');
    }

    private function redirect($url, $info, $time, $flag)
    {
        if ($info == '') {
            header("location:{$url}");
        } else {
            echo <<<str

        }


    }
}


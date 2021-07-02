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
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Document</title>
                <style>
                    body{
                        text-align: center;
                        font-family: '微软雅黑';
                        font-size: 18px;
                    }
                    #success,#error{
                        font-size: 36px;
                        margin: 0 auto;
                    }
                    #error{
                        color: #F00;
                    }
                </style>
            </head>
            <body>
                <img src="/public/images/{$flag}.fw.png">
                <div id='{$flag}'>{$info}</div>
                <div><span id='t'>{$time}</span>秒以后跳转</div>
            </body>
            <script>
            window.onload = function() {
                var t = {$time};
                setInterval(() => {
                    document.getElementById('t').innerHTML == --t;
                    if (t == 0) {
                        location.href = '{$url}';
                    }
                }, interval);
            }
            
            
            </script>
            </html>
            str;
            exit;
        }


    }
}


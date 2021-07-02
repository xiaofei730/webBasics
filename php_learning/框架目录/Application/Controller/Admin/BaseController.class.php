<?php
//后台基础控制器
namespace Controller\Admin;

class BaseController extends \Core\Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->checkLogin();
    }

    private function checkLogin()
    {
        if (CONTROLLER_NAME == 'Login') {
            return;         //登录控制器不需要验证
        }
        if (!empty($_SESSION['user'])) {
            $this->error('index.php?p=admin&c=Login&a=login', '您没有登录');
        }
    }
}






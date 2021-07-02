<?php
namespace Controller\Admin;


class LoginController extends BaseController
{
    //登录
    public function loginAction()
    {
        if ($empty($_POST)) {
            $model = new \Model\UserModel();
            if ($info = $model->getUSerByNameAndPwd($_POST['username'], $_POST['password'])) {
                $_SESSION['user'] = $info;      //将用户信息保存到会话中
                $model->updateLoginInfo();
                $this->success('index.php?p=Admin&c=Admin&a=admin', '登录成功');   
            } else {
                $this->error('index.php?p=admin&c=Login&a=login', '登录失败，请重新登录');
            }
        }
        require __VIEW__.'login.html';
    }

    public function registerAction()
    {
        if (!empty($_POST)) {
            $data['user_name'] = $_POST['username'];
            $data['user_pwd'] = md5(md5($_POST['password']).$GLOBALS['config']['app']['key']);
            $model = \Core\Model('user');
            if ($model->insert($data)) {
                $this->success('index.php?p=Admin&c=Login&a=login', '注册成功，您可以去登录了');   
            } else {
                $this->error('index.php?p=admin&c=Login&a=register', '注册失败，请重新注册');
            }
        }

        require __VIEW__.'register.html';
    }

    public function checkUserAction()
    {
        $model = new \Model\USerModel();
       echo $model->isExists($_GET['username']);      //不用return，因为echo会添加在响应体
    }
}
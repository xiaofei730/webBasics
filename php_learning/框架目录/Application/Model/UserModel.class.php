<?php
namespace Model;

class UserModel extends \Core\Model
{
    public function isExists($name)
    {
        $info = $this->select(['username' => $name]);
        return !empty($info) ? 0 : 1;
    }

    public function getUserByNameAndPwd($name, $pwd)
    {
        $cond = array(
            'user_name' => $name,
            'user_pwd'  => md5(md5($pwd).$GLOBALS['config']['app']['key'])
        );

        $info = $this->select($cond);
        if (!empty($info)) {
            return $info[0];
        } else {
            return array();
        }
    }

    //更新登录信息
    public function updateLoginInfo()
    {
        $_SESSION['user']['user_login_ip'] = ip2long($_SERVER['REMOTE_ADDR']);
        $_SESSION['user']['user_login_time'] = time();
        $_SESSION['user']['user_login_count'] = ++$_SESSION['user']['count'];
        $model = new \Core\Model('user');
        return (bool)$model->update($_SESSION['user']);
    }
}
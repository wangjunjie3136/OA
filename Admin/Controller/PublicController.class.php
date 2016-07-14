<?php
namespace Admin\Controller;

use Think\COntroller;
use Think\Verify;

class PublicController extends Controller
{
    public function login()
    {
        $this->display();
    }
    public function captcha()
    {
        $cfg = array(
            'fontSize'  =>  10,              // 验证码字体大小(px)
            'useCurve'  =>  false,            // 是否画混淆曲线
            'useNoise'  =>  false,            // 是否添加杂点
            'length'    =>  4,
            'imageH'    =>  38,
            'imageW'    =>  70,
            'fontttf'   =>  '4.ttf',// 验证码位数
        );
        $verify = new Verify($cfg);
        $verify->entry();
    }
    public function logOk()
    {
        $post = I('post.');
        $verify = new Verify();
        if(!$verify->check($post['captcha'])){
            $this->error('验证码错误',U('login'),3);
            exit();
        }
        $model = D('user');
        $sum = $model->where(array(
                    'username' => $post['username'],
                    'password' => $post['password'],
                ))->find();
        if(!$sum) {
            $this->error('账号或密码错误',U('login'),3);
            exit();
        }
        session('user_name',$sum['username']);
        session('user_id',$sum['id']);
        session('role_id',$sum['role_id']);
        $this->success('登录成功',U('Index/index'),3);
    }
}
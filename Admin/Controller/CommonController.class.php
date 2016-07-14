<?php
/**
 * Created by PhpStorm.
 * User: 王俊杰
 * Date: 2016/6/25
 * Time: 14:57
 */
namespace Admin\Controller;
use Think\Controller;
class CommonController extends Controller
{
    public function _initialize()
    {

    	$user_id = session('user_id');
        if(empty($user_id)){
            $url = U('Public/login');

            $script = "<script>window.top.location.href='$url';</script>";
            echo $script;exit;
        }

        //访问的控制器名称
        $cName = strtolower(CONTROLLER_NAME);
        //访问的控制器方法名
        $aName = strtolower(ACTION_NAME);
        //提取权限配置信息
        $auths = C('RBAC_AUTHs');
        //提取用户权限值
        $role_id = session('role_id');
        //提取当前用户权限
        $auth = $auths['auth'.$role_id];
        //判断是否有权限
        if($role_id != 1){
            if(!in_array($cName . '/*' ,$auth) && !in_array($cName . '/' . $aName , $auth)){
                $this->error('您没有此权限',U('Index/home'),3);exit;
            }
        }

    }

}
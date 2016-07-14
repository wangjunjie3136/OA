<?php
namespace Admin\Controller;

use Think\Controller;

class EmailController extends CommonController
{
    //发送信件
    public function send()
    {
        $model = M('User');
        $data = $model->select();
        $this->assign('data',$data);
        $this->display();
    }
    //发送OK
    public function sendOk()
    {
        $post = I('post.');

        if($_FILES['file']['size'] > 0){
            $cfg = array('rootPath' => WORKING_PATH . UPLOAD_ROOT_PATH,);
            $upload = new \Think\Upload($cfg);

            $info = $upload->uploadOne($_FILES['file']);
            if($info){
                $post['file'] = UPLOAD_ROOT_PATH . $info['savepath'] . $info['savenaem'];
                $post['hasfile'] = 1;
                $post['filename'] = $info['savename'];
            }
        }
        $model = M('Email');
        $post['from_id'] = session('user_id');
        $post['addtime'] = time();
        if($model->add($post)){
            $this->success('发送成功',U('sendbox'),3);
        }else{
            $this->error('发送失败',U('send'),3);
        }
    }
    //发件箱
    public function sendbox()
    {
        $model = M('Email');
        $data = $model->field('t1.*, t2.truename')
            ->table('tp_email as t1, tp_user as t2')
            ->where('t1.to_id=t2.id and t1.from_id='.session("user_id"))
            ->select();
        $this->assign('data',$data);
        $this->display();
    }
    //收件箱
    public function recbox()
    {
        $model = M('Email');
        $data = $model
            ->field('t1.*,t2.truename')
            ->table('tp_email as t1,tp_user as t2')
            ->where('t1.from_id=t2.id and t1.to_id='.session('user_id'))
            ->select();
        $this->assign('data',$data);
        $this->display();
    }
    //下载
    public function download()
    {

    }
    //查看
    public function getContent()
    {
        $id = I('get.id');
        $model = M('Email');
        $model->save(array(
            'id' => $id,
            'isread' => 1,
        ));
        $data = $model->where('to_id='.session('user_id'))->find($id);
        echo $data['content'];

    }
    public function getMsgCount()
    {
        if(IS_AJAX){
            $model = M('Email');
            $count = $model->where("isread = 0 and to_id=".session('user_id'))->count();
            echo $count;
        }else{
            echo '非法操作';
        }

    }

}
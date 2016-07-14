<?php
namespace Admin\Controller;

use Think\Controller;

class DocController extends CommonController
{
    public function showList()
    {
        $model = M('Doc');
        $data = $model->select();
        $this->assign('data',$data);
        $this->display();
    }
    public function add()
    {
        $this->display();
    }
    public function addOk()
    {
        $post = I('post.');
        if($_FILES['file']['size']>0){
            $fig = array(
                'rootPath' => WORKING_PATH.UPLOAD_ROOT_PATH
            );
            $upload = new \Think\Upload($fig);
            $info = $upload->uploadOne($_FILES['file']);
            if($info){
                $post['filepath'] = UPLOAD_ROOT_PATH.$info['savepath'].$info['savename'];
                $post['filename'] = $info['savename'];
                $post['hasfile'] = 1;
            }
        }

        $post['addtime'] = time();
        $model = M('Doc');
        if($model->add($post)){
            $this->success('添加成功',U('showList'),3);
        }else{
            $this->error('添加失败',U('add'),3);
        }
    }
    public function edit()
    {
        $id = I('get.id');

        $model = M('Doc');
        $data = $model->find($id);
        $this->assign('data',$data);
        $this->display();
    }
    public function editOk()
    {
        $post = I('post.');
        if($_FILES['file']['size']>0){
            $cfg = array(
                'rootPath' => WORKING_PATH.UPLOAD_ROOT_PATH,
            );
            $upload = new \Think\Upload($cfg);
            $info = $upload->uploadOne($_FILES['file']);
            if($info){
                $post['filepath'] = UPLOAD_ROOT_PATH.$info['savepath'].$info['savename'];
                $post['filename'] = $info['savename'];
                $post['hasfile'] = 1;
            }
        }
        $model = M('Doc');
        if($model->save($post)){
            $this->success('修改成功',U('showList'),3);
        }else{
            $this->error('修改失败',U('edit',array('id' => $post['id'])),3);
        }

    }
    public function del()
    {
        $ids = I('get.ids');
        $model = M('Doc');
        if($model -> delete($ids)){
            $this->success('删除成功',U('showList'),3);
        }else{
            $this->success('删除失败',U('showList'),3);
        }
    }
}
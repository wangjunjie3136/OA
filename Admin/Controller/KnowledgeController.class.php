<?php
/**
 * Created by PhpStorm.
 * User: 王俊杰
 * Date: 2016/6/24
 * Time: 10:28
 */
namespace Admin\Controller;

use Think\Controller;

class KnowledgeController extends CommonController
{
    //添加
    public function add()
    {
        $this->display();
    }
    //添加成功
    public function addOk()
    {
        $post = I('post.');
        if($_FILES['thumb']['size']>0){
            $cfg = array(
                 'rootPath' => WORKING_PATH . UPLOAD_ROOT_PATH,
            );
            $upload = new \Think\Upload($cfg);
            $info = $upload->uploadOne($_FILES['thumb']);
            if($info){
                $post['picture'] = UPLOAD_ROOT_PATH . $info['savepath'] . $info['savename'];
                $img = new \Think\Image();
                $im = WORKING_PATH.$post['picture'];
                $img -> open($im);
                $img -> thumb(100,100);
                $th =  WORKING_PATH . UPLOAD_ROOT_PATH . $info['savepath'] . 'thumb_' .  $info['savename'];
                $img -> save($th);
                $post['thumb'] = UPLOAD_ROOT_PATH . $info['savepath'] . 'thumb_' .  $info['savename'];
            }
        }
        $post['addtime'] = time();
        $model = M('Knowledge');
        if($model->add($post)){
            $this->success('添加成功',U('showList'),3);
        }else{
            $this->error('添加失败',U('add',3));
        }
    }
    //展示列表
    public function showList()
    {
        $model = M("Knowledge");
        $data = $model->select();
        $this->assign('data',$data);
        $this->display();
    }
    //编辑
    public function edit()
    {
        $id = I('get.id');
        $model = M('knowledge');
        $data = $model->find($id);
        $this->assign('data',$data);
        $this->display();
    }
    //编辑成功
    public function editOk()
    {
        $post = I('post.');
        if($_FILES['thumb']['size']>0){
           $cfg = array('rootPath'=>WORKING_PATH . UPLOAD_ROOT_PATH);
            $upload = new \Think\Upload($cfg);
            $info = $upload->uploadOne($_FILES['thumb']);
            if($info){
                $post['picture'] = UPLOAD_ROOT_PATH . $info['savepath'] . $info['savename'];
                $im = new \Think\Image();
                $img = WORKING_PATH . $post['picture'];
                $im->open($img);
                $im->thumb(100,100);
                $prc = WORKING_PATH . UPLOAD_ROOT_PATH . $info['savepath'] . 'thumb_' . $info['savename'];
                $im->save($prc);
                $post['thumb'] = UPLOAD_ROOT_PATH . $info['savepath'] . 'thumb_' . $info['savename'];
            }
        }
        $model = M('Knowledge');
        if($model->save($post)){
            $this->success('修改成功',U('showList'),3);
        }else{
            $this->error('修改失败',U('edit',array('id'=>$post['id'])),3);
        }

    }
    //删除
    public function del(){
        $ids = I('get.ids');
        $model = M('Knowledge');
        if($model->delete($ids)){
            $this->success('删除成功',U('showList'),3);
        }else{
            $this->success('删除失败',U('showList'),3);
        }
    }
}
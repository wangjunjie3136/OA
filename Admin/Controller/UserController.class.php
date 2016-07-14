<?php
namespace Admin\Controller;

use Think\Controller;

class UserController extends CommonController
{
    public function showList()
    {
        $model = M('User');
        $count =$model->count();
        $page = new \Think\Page($count,2);
        $show = $page->show();
        $data = $model->alias('t1')
            ->join('left join tp_dept as t2 on t1.dept_id=t2.id')
            ->field('t1.*,t2.name as deptname')
            ->group('t1.id')
            ->limit($page->firstRow,$page->listRows)
            ->select();
        $this->assign(array(
            'data' => $data,
            'show' => $show,
        ));
        $this->display();
    }
    public function add()
    {
        $model = M('Dept');
        $data = $model->select();
        load('@/tree');
        $data = getTree($data);
        $this->assign(array(
            'data'=>$data
        ));
        $this->display();
    }
    public function addOk()
    {
        $model = M('User');
        $_POST['addtime'] = time();
        $model->create();
        if($model->add()){
            $this->success('添加成功',U('showList'),3);
        }else{
            $this->error('添加失败',U('add'),3);
        };

    }
    public function del()
    {
        $ids = I('get.ids');
        $model = M('user');
        if($model->delete($ids)){
            $this->success('添加成功',U('showList'),3);
        }else{
            $this->success('添加失败',U('showList'),3);
        }
    }
    public function edit()
    {
        $id = I('get.id');
        $usermodel = M('User');
        $data = $usermodel->find($id);
        $deptmodel = M('Dept');
        $arr = $deptmodel->select();
        load('@/tree');
        $arr = getTree($arr);
        $this->assign(array(
            'arr' => $arr,
            'data' => $data,
        ));
        $this->display();
    }
    public function editOk()
    {
        $post = I('post.');
        if(!$post['password']){
            unset($post['password']);
        }
        $model = M('User');
        if($model->save($post)){
            $this->success('修改成功',U('showList'),3);
        }else{
            $this->error('修改失败',U('edit',array(
                'id' => $post['id']
            )),3);
        }
    }
}
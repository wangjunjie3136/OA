<?php
/**
 * Created by PhpStorm.
 * User: 王俊杰
 * Date: 2016/6/20
 * Time: 15:38
 */
namespace Admin\Controller;
use Think\Controller;

class DeptController extends CommonController
{
    public function showList()
    {
        $model = M(Dept);
        $data = $model
            ->join('left join tp_dept as a on a.id = tp_dept.pid')
            ->field('tp_dept.*,a.name as username')
            ->select();
        load('@/tree');
        $data = getTree($data);
        $this->assign('data',$data);
        $this->display();
    }
    public function add()
    {
        $model = M('Dept');
        $data = $model->select();
        load('@/tree');
        $data = getTree($data);
        $this->assign('data',$data);
        $this->display();
    }
    public function addOk()
    {
        $post = I('post.');
        if(!$post['name']){
            $this->error('添加失败',U('add'),3);
            exit();
        }
        $model = M('Dept');
        if($model->add($post)){
            $this->success('添加成功',U('showList'),3);
        }else{
            $this->error('添加失败',U('add'),3);
        }
    }
    public function del(){
        $str = I('get.ids');
        $model = M('Dept');
        if($model->delete($str)){
            $this->success('删除成功',U('showList'),3);
        }else{
            $this->error('删除失败',U('showList',3));
        }


    }
    public function edit(){
        $id = I('get.id');
        $model = M('Dept');
        $data = $model->find($id);
        $arr = $model->select();
        load('@/tree');
        $arr = getTree($arr);
        $this->assign(array(
            'data' => $data,
            'arr' => $arr,
        ));
        $this->display();
    }
    public function editOk()
    {
        $post = I('post.');
        $model = M('dept');
        if($model->save($post)){
            $this->success('修改成功',U('showList'),3);
        }else{
            $this->error('修改失败',U('edit',array(
                'id' => $post['id']
            )),3);
        }
    }
}
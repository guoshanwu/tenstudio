<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2018 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 老猫 <thinkcmf@126.com>
// +----------------------------------------------------------------------
namespace app\back\controller;

use cmf\controller\AdminBaseController;
use think\Db;

class SetmealController extends AdminBaseController
{

    /**
     * 套餐列表
     */
    public function index(){
        $setmeal = Db::name('ten_setmeal')->where('status', 1)->order('sort desc, id asc')->select()->toArray();
        $this->assign('info', $setmeal);

        return $this->fetch();
    }

    /**
     * 添加
     */
    public function add(){
        if ($this->request->isPost()){
            $data = $this->request->param();
            $result = Db::name('ten_setmeal')->insert($data);
            if ($result){
                $this->success('添加成功', url('index'));
            }else{
                $this->error('添加失败,请联系呜哥');
            }
        }
        return $this->fetch();
    }

    /**
     * 编辑
     */
    public function edit($id){
        $info = Db::name('ten_setmeal')->find($id);
        if (empty($info)){
            $this->error('订单不存在');
        }
        $this->assign('info', $info);
        if ($this->request->isPost()){
            $data = $this->request->post();
            $result = Db::name('ten_setmeal')->where('id', $data['id'])->update($data);
            if ($result){
                $this->success('修改成功', url('index'));
            }else{
                $this->error('修改失败,请重试');
            }
        }
        return $this->fetch();
    }

    /**
     * 删除
     */
    public function delete($id){
        if (empty($id)){
            $this->error('id不能为空');
        }
        $result = Db::name('ten_setmeal')->where('id', $id)->setField('status', 0);
        if ($result){
            $this->success('删除成功', url('index'));
        }else{
            $this->error('删除失败');
        }
    }


}

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

class OrderController extends AdminBaseController
{


    /**
     *套餐
     */
    public function getSetmeal(){
        $setmeal = Db::name('ten_setmeal')->where('status', 1)->order('sort desc')->select()->toArray();
        return $setmeal;
    }

    /*
     * 订单列表
     */
    public function lists($status){
        if ($this->request->isPost()){
            $search = $this->request->param();
            $where = $this->search($search);
            $this->assign('search', $where);

        }
        //订单状态
        $where['status'] = $status;
        $order = Db::name('ten_order')->where($where)->order('order_time desc')->paginate();
        //订单数量
        $count = Db::name('ten_order')->where($where)->count();
        //套餐
        $new_meal = array();
        foreach ($this->getSetmeal() as $key => $value){
            $new_meal[$value['id']] = $value['name'];
        }
        $this->assign([
            'result' => $order,
            'page' => $order->render(),
            'meal' => $this->getSetmeal(),
            'setmeal' => $new_meal,
            'count' => $count,
            'action' => request()->action(),
        ]);
    }

    /**
     * 条件查询
     */
    public function search($data){
        //姓名
        $where = array();
        if (!empty($data['name'])){
             $where['name'] = ['like', '%'.$data['name'].'%',];
        }
        //套餐
        if (!empty($data['setmeal_id'])){
            $where['setmeal_id'] = $data['setmeal_id'];
        }
        //下单时间
        if (!empty($data['add_time_start']) && !empty($data['add_time_end'])) {
            $start_time = $data['add_time_start'];
            $end_time = $data['add_time_end'];
            $where['add_time'] = ['between', "$start_time,$end_time"];
        } else {
            if (!empty($data['add_time_start'])) {
                $where['add_time'] = ['egt', $data['add_time_start']];
            }
            if (!empty($data['add_time_end'])) {
                $where['add_time'] = ['elt', $data['add_time_end']];
            }
        }
        //拍摄时间
        if (!empty($data['order_time_start']) && !empty($data['order_time_end'])) {
            $start_time = $data['order_time_start'];
            $end_time = $data['order_time_end'];
            $where['order_time'] = ['between', "$start_time,$end_time"];
        } else {
            if (!empty($data['order_time_start'])) {
                $where['order_time'] = ['egt', $data['order_time_start']];
            }
            if (!empty($data['order_time_end'])) {
                $where['order_time'] = ['elt', $data['order_time_end']];
            }
        }
        return $where;
    }



    /**
     * 添加订单
     */
    public function add($action){
        //套餐
        $this->assign('setmeal', $this->getSetmeal());
        $this->assign('action', $action);
        if ($this->request->isPost()){
            $data = $this->request->param();
            $data['order_time'] = $this->setTime($data['order_time']);      //拍摄时间
            $data['user_id'] = session('ADMIN_ID');
            unset($data['action']);
            $result = Db::name('ten_order')->insert($data);
            if ($result){
                $this->success('订单添加成功', url($action));
            }else{
                $this->error('订单添加失败');
            }
        }

        return $this->fetch();
    }

    /**
     * 修改
     */
    public function edit($action, $id){
        $order = Db::name('ten_order')->find($id);
        if (empty($order)){
            $this->error('订单不存在');
        }
        $this->assign([
            'info' => $order,
            'setmeal' => $this->getSetmeal(),   //套餐
            'action' => $action,
        ]);
        if ($this->request->isPost()){
            $data = $this->request->post();
            $data['order_time'] = $this->setTime($data['order_time']);      //拍摄时间
            $data['send_photo_time'] = $this->setTime($data['send_photo_time']);    //发送照片日期
            $data['opt_photo_time'] = $this->setTime($data['opt_photo_time']);      //选相日期
            $data['ps_photo_time'] = $this->setTime($data['ps_photo_time']);        //精修时间
            $data['lower_factory_time'] = $this->setTime($data['lower_factory_time']);  //下厂时间
            $data['update_time'] = date('Y-m-d H:i:s', time()); //最后更新时间
            $data['user_id'] = session('ADMIN_ID');
            unset($data['action']);
            $result = Db::name('ten_order')->where('id', $data['id'])->update($data);
            if ($result){
                $this->success('更新成功', url($action));
            }else{
                $this->error('更新失败,请重试');
            }
        }

        return $this->fetch();
    }

    /**
     *
     */
    public function setTime($time){
        if (empty($time)){
            return '0000-00-00 00:00:00';
        }else{
            return $time;
        }
    }

    /**
     * 未完成
     */
    public function hang(){
        $this->lists(0);
        return $this->fetch('lists');
    }


    /**
     * 已完成
     */
    public function complete(){
        $this->lists(1);
        return $this->fetch('lists');
    }





}

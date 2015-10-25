<?php
namespace Home\Controller;
use Think\Controller;
class AddressController extends Controller {
    public function index(){
        $names = D('category')->where('PID = 1')->select();//父ID

        $this->assign('names',$names);
        $this->display(); // 输出模板
    }


    public function card(){
        $names = D('category')->where('PID = 1')->select();//父ID

        $this->assign('names',$names);
        $this->display(); // 输出模板
    }

    public function ref(){
        $names = D('category')->where('PID = 1')->select();//父ID

        $this->assign('names',$names);
        $this->display(); // 输出模板
    }
    public function free(){
        $names = D('category')->where('PID = 1')->select();//父ID


        $this->assign('names',$names);

        $this->display(); // 输出模板
    }

    public function shopmust(){
        $this->free();
    }

    public function back(){
        $this->free();
    }
    public function email(){
        $this->free();
    }
}
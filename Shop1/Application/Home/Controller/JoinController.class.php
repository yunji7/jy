<?php
namespace Home\Controller;
use Think\Controller;
class JoinController extends Controller {
    public function index(){
        $names = D('category')->where('PID = 1')->select();//父ID

        $this->assign('names',$names);
        $this->display(); // 输出模板
    }
}
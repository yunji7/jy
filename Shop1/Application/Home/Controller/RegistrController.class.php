<?php
namespace Home\Controller;
use Think\Controller;
class RegistrController extends Controller {
    public function index(){
        $this->display();
    }

    public function registr(){

        $S['user'] = $_POST['user'];
        $data = D("user")->where($S)->find();

        if(empty($data)){
            D("user")->add($_POST);
            $_SESSION['user']['id']= $S['user'];
            redirect(__MODULE__.'/Index');
        }else{
            echo "以有用户名";
        }
    }



}
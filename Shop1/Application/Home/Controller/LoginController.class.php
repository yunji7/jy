<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function index(){

//        echo 1;
//        var_dump($_SESSION);
//        var_dump($_COOKIE);




        $this->display();
    }
    public function login(){


        /**
         * 验证码
         */
        $Verify =     new \Think\Verify();

        /**
         * 如果验证码成功
         */

        if($Verify ->check( $_POST['verify'] )){


            /**
             * 账号密码是否正确
             */
            $judge['Id'] = $_POST['id'];
            $judge['Password'] =$_POST['password'];
            $fine = D("back")->where($judge)->find();



            if(!empty($fine))
            {
                $_SESSION['user'] =  $fine;
               echo 'cg';
            }else{
//                $_SESSION['user'] =  1;
               echo "pass";
            }


        }else{
            echo 'no';
        }



    }



    /**
     * 生成验证码
     */
    public function verify()
    {
        $config =    array(
            'fontSize'    =>    30,    // 验证码字体大小
            'length'      =>    3,     // 验证码位数
            'useNoise'    =>    false, // 关闭验证码杂点
        );
        $Verify =     new \Think\Verify($config);
        $Verify->entry();


    }



}
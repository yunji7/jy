<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
//        $_SESSION = array();
//        var_dump($_COOKIE);
//        var_dump($_SESSION);



        $this->assign("id",$_SESSION['user']['id']);
        $names = D('category')->where('PID = 1')->select();//父ID




//        var_dump($names);

        /**
         * 调试
         */
//        $like['cate']  = array('like','%10,%');
//        $data = D('commodity')->where($like)->limit(3)->select();
//


//        $like['cate']  = array('like','%'.$names[0]['id'].',%'); //模糊查询
//
//        var_dump($like);


        $reg = "/\/ueditor\/php\/uploadshop\/.*.jpg/U";
        foreach ($names as & $key) {
           $like['cate']  = array('like','%,'.$key['id'].',%'); //模糊查询

//            var_dump($like);
            $key['cate'] = D('commodity')->where($like)->limit(3)->select();


            //用正则把图片搞定
            foreach ( $key['cate'] as &$kkey) {
                preg_match($reg,$kkey['editorvalue'],$kkey['editorvalue']);
            }

        }

//        var_dump($names);

        $this->assign('names',$names);//注入


//        var_dump($names[0]);
//        var_dump($names[0]['cate']);

		$this->display();

    }

    public function yee(){
        $skey=null;
//        var_dump($_GET);
        if(!empty($_GET['cate'])){
            $like['cate']  = array('like','%,'.$_GET['cate'].',%');
            $skey = D('commodity')->where($like)->select();

            $reg = "/\/ueditor\/php\/uploadshop\/.*.jpg/U";
            foreach ($skey as &$kkey) {
                preg_match($reg,$kkey['editorvalue'],$kkey['editorvalue']);
            }

            $id['id'] = $_GET['cate'];
            $cate = D('category')->where($id)->find();
            $this->assign('cate',$cate);
        }else if (!empty($_GET['search'])){



//            var_dump($_GET['search']);
                $like['tittle']  = array('like','%'.$_GET['search'].'%');
//            var_dump($like);
                $skey = D('commodity')->where($like)->select();

//            var_dump($skey);
                $reg = "/\/ueditor\/php\/uploadshop\/.*.jpg/U";
                foreach ($skey as &$kkey) {
                    preg_match($reg,$kkey['editorvalue'],$kkey['editorvalue']);
                }

                $id['id'] = $_GET['cate'];
                $cate = D('category')->where($id)->find();
                $this->assign('cate',$cate);

        }





//var_dump($skey);

        $names = D('category')->where('PID = 1')->select();//父ID
        $this->assign('names',$names);//注入
        $this->assign("skey",$skey);
        $this->display();
    }



     public function details(){

         $names = D('category')->where('PID = 1')->select();//父ID

         $myid['myid'] = $_GET['myid'];
         $var = D('commodity')->where($myid)->find();

         $reg = "/\/ueditor\/php\/uploadshop\/.*.jpg/U";

         preg_match_all($reg,$var['editorvalue'],$var['photo']);

         $regx = "/,+/";

         $arr = preg_split($regx,$var['cate']);

         //空元素
         $arr = array_filter($arr);

         $sss = null;
         foreach ($arr as $key) {
             $sss[] = D('category')->where('id='.$key)->find();
         }


         /**
          * 找出父类做导航
          */
         $regx = "/[0-9]+/U";

         preg_match($regx,$var['cate'],$dh);



         $if['id']=$dh[0];

         $dhh = D('category')->where($if)->select();

//         var_dump($dhh);



         $this->assign('card', __MODULE__.'/Address/card');
         $this->assign('taobao',$var['taobao']);
         $this->assign('sss',$sss);
         $this->assign("var",$var);
         $this->assign('names',$names);//注入
         $this->display();
     }
}
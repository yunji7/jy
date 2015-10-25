<?php
	namespace Admin\Controller;

	use Think\Controller;

	class CContentController extends Controller
	{


		public $values = array();
		public $cl     = array();
		public $ys     = array();
		public function index()
		{
			$this->display();
		}



		/**
		 * 商品表列
		 */
		public function product_list()
		{
			/**
			 * 分类
			 */
			$category = D('category')->select();
			$this->assign('catagory', $category);

			$commodity = D('commodity')->select();

			/**
			 * 正则匹配第一个图片
			 */
			$pattern  = '/\/ueditor\/php\/uploadshop\/.*.jpg/U';
			foreach ($commodity as &$key) {
				preg_match($pattern,$key['editorvalue'],$key['img']);
//				 var_dump($key);
			}

			$this->assign('commodity', $commodity);

//			var_dump($commodity);
//			echo $commodity[0]['editorvalue'][0];

//var_dump($x);
//			var_dump($commodity);
//			var_dump($commodity);

			$this->display();
		}





		/**
		 * 创建 和 编辑
		 */
		public function product_details()
		{


			if(!empty($_GET)){
				$data  =  D("commodity")->where($_GET)->select();


				$check = preg_split('/,/',$data[0]['cate']);

				/**
				 * 去除空数组
				 */
				$data[0]['cate']=array_filter($check);


				$this->assign("data",$data[0]);

//				var_dump($data);
			}else{

			   $id = 'YQ' . rand(100000, 999999);//编号

				/**
				 * 判断ID是否重复
				 */
				$x['myid']=$id;
				$if  = D("commodity")->where($x)->find();
				if(!empty($if)){
					return;
				}

			    $this->assign("myid", $id);

			}
//
//			var_dump($data);

			$this->recursion(1,$this->values);
			$this->assign("list", $this->values);
			$this->recursion(13,$this->cl);
			$this->assign("cl", $this->cl);
			$this->recursion(30,$this->ys);
			$this->assign("ys", $this->ys);
			$this->display();
		}

		/**
		 *
		 */
		public function x_upload(){


			$i['myid']=$_POST['myid'];
			$data  = D("commodity")->where($i)->select();


			/**
			 * 分类数组合并
			 */

//			var_dump($_POST);
			$sum = null;
			foreach ($_POST['cate'] as $key) {
				$sum = ','.$sum.$key.',';
			}

			$_POST['cate']=$sum;

//var_dump($_POST);

//			var_dump($data);
			if(!empty($data))
			{
				D("commodity")->where($i)->save($_POST);
			}else{
							D("commodity")->add($_POST);
			}

			/**
			 * 跳转
			 */
			$this->redirect('CContent/product_list');
		}


		/**
		 * 资讯中心
		 */
		public function editable_table()
		{
			$data  = D('news')->select();

			$this->assign("data",$data);
//			var_dump($data);
			$this->display();
		}

		/**
		 * editable_table2填写
		 */
		public function  editable_table2(){
			$key['pid'] = 55;
			$data = D('category')->where($key)->select();
//			var_dump($data);
			$this->assign("C_list",$data);
			$this->display();
		}

		/**
		 * 资讯提交
		 */
		public function e_updata(){

			$safe['cate']    = $_POST['select'];
			$safe['content'] = $_POST['editorValue'];
			$safe['tittle'] = $_POST['tittle'];

			D('news')->add($safe);
		}






		/**
		 * 分类
		 */
		public function category()
		{

			$data = D('category')->select();

			$this->recursion(0,$this->values);

			$this->assign("list", $this->values);
			$this->assign('tables', $data);
			$this->display();
		}




		/**
		 * 递归 分类
		 */
		public function recursion($pid = 0,&$value, $nbsp = '')
		{

			$where['pid'] = $pid;
			$data = D('category')->where($where)->select();
			foreach ($data as $key) {

				/**
				 *  深度
				 */
				$temporary[] = $nbsp . $key['names'];
				$temporary[] = $key['id'];
				$value[] = $temporary;
				$kk = $nbsp . '「一';


				$this->recursion($key['id'],$value, $kk);
				$temporary = null;
			}
		}

		/**
		 * 删除分类
		 */
		public function del()
		{

//			var_dump($_GET);

//			echo 'alert("不能删除")';

//			D('category')->where($_GET)->delete();

			$this->redirect('CContent/category');
		}


		/**
		 * 分类添加
		 */
		public function cate()
		{


			$data['pid'] = $_POST['cate'];
			$data['names'] = $_POST['name'];


			D('category')->add($data);


			/**
			 * 跳转
			 */
			$this->redirect('CContent/category');

		}


		/**
		 * 首页
		 */
		public function main()
		{

			$X['操作系统'] = php_uname();

			$X['运行环境'] = $_SERVER['SERVER_SOFTWARE'];
			$X['剩余空间'] = disk_free_space('/') / 1024 / 1024 / 1024;
			$X['剩余空间'] = sprintf("%.2f G空间", $X['剩余空间']);


			$this->assign("data", $X);
			$this->display();
		}


	}
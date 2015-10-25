<?php
	namespace Home\Controller;

	use Think\Controller;

	class PublicxController extends Controller
	{
		public function index()
		{
			$Model = D('commodity');
			$result = $Model->field('tittle,editorvalue,ppay')->select();
			foreach ($result as & $key) {


				preg_match("/\/ueditor\/php\/uploadshop\/.*.jpg/U", $key['editorvalue'],  $re);
				$key['editorvalue'] = $re[0];
			}


//			foreach ($result as $key ) {
				$data1['goods']='http:/localhost'.$result[0]['editorvalue'];
				$data1['synopsis']=$result[0]['tittle'];
				$data1['price']=$result[0]['ppay'];
				$data[] = $data1;
//			}

			$sy['goods'] ='http:/localhost/ueditor/php/uploadshop/image/20150527/1432712094259524.jpg';
			$sy['synopsis'] ='吉祥美丽碧玺胸针(吊坠)';
			$sy['price'] ='780';
//    		var_dump($data);
			json_encode ( $sy );

//			var_dump($x);
//			echo $data;
// 				var_dump(json_decode($s));
//			json_encode ( $data );
		}


	}
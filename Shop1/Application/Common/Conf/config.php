<?php

	return array(

		'TMPL_L_DELIM'          =>  '<{',  // 模板引擎普通标签开始标记
		'TMPL_R_DELIM'          =>  '}>',  // 模板引擎普通标签结束标记
		'DB_TYPE'               =>  'mysql',     // 数据库类型
		'DB_HOST'               =>  'localhost', // 服务器地址
		'DB_NAME'               =>  'ly358148_1',          // 数据库名
		'DB_USER'               =>  'god',      // 用户名
		'DB_PWD'                =>  'god',          // 密码
		'DB_PREFIX'             =>  'x_',     // 数据库表前缀
		'SHOW_PAGE_TRACE' =>false,
		'URL_CASE_INSENSITIVE' =>true, //大小写不敏感

//		'URL_MODEL'=>2,
//
//		ly358148
//32ee19a3f1036e

		/**
		 * 模板中的常量
		 */
		'TMPL_PARSE_STRING' => array(
			'__LINK__'    => __ROOT__.'/Public/Link',
			'__LINKK__'    => '123',
			//		'__LINK__'    => __ROOT__.'/Public/Link',

		),
	);

<?php
/**
 * 路由配置文件
 */
if(!defined("APP_NAME")){
	if(strtolower(APP_MODEL) == 'debug'){
		die('Not allowed');
	}else{
		exit;
	}
}

$config['route'] = array(
	//'url路径'=>'模块路径:方法'
	'p/:phone'						=> 'default/welcome:register',
	'default'						=> 'default/welcome:index',
	'404'							=> 'default/welcome:index',
);

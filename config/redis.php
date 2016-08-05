<?php
/**
 * Redis缓存配置文件
 */
if(!defined("APP_NAME")){
	if(strtolower(APP_MODEL) == 'debug'){
		die('Not allowed');
	}else{
		exit;
	}
}

$config['redis'] = array(
	//'url路径'=>'模块路径:方法'
	'enable' => true, //使用redis缓存
	'host' => '121.41.21.58', //主机
	'port' => 6379, //端口号
	'password' => 'rubyphp', //密码
	'expire' => 300, //过期时间（秒）
	'database' => 7, //redis缓存使用的数据库
);
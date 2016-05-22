<?php
/**
 * MySQL配置文件
 * 支持主从同步
 */
if(!defined("APP_NAME")){
	if(strtolower(APP_MODEL) == 'debug'){
		die('Not allowed');
	}else{
		exit;
	}
}

$config['mysql'] = array(
	//'url路径'=>'模块路径:方法'
	'enable' => true, //开启状态
	'prefix' => 'gc_', //表前缀
	'master' => array(
		'host' => '121.41.21.58', //主机
		'port' => '3306', //端口
		'username' => 'fanghailiang', //用户名
		'password' => 'fanghailiang', //密码
		'database' => 'rubyphp', //数据库
	),
	'slaver' => array(
		'host' => '121.41.21.58', //主机
		'port' => '3306', //端口
		'username' => 'fanghailiang', //用户名
		'password' => 'fanghailiang', //密码
		'database' => 'rubyphp', //数据库
	),
);

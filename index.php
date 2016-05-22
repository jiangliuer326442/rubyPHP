<?php 
/**
 * PHP入口文件
 */
//应用名称
define("APP_NAME","rubyPHP");
//开发状态（debug/production）
define("APP_MODEL","DEBUG");
//加载公共函数文件
require_once("function/common.php");
//加载路由配置文件
require_once("config/route.php");
//加载mysql配置文件
require_once('config/mysql.php');
//加载redis配置文件
require_once('config/redis.php');
//加载模板配置文件
require_once("config/tpl.php");

//根据url加载PHP模块（控制器）
$request_url = str_replace("/index.php/","",$_SERVER['PHP_SELF']);
$model_url = ( empty($request_url) || empty($config['route'][$request_url]) ) ? $config['route']['default'] : $config['route'][$request_url];
if(!strstr($model_url, ":")){
	if(strtolower(APP_MODEL) == 'debug'){
		die('URL PARAM ERROR');
	}else{
		exit;
	}
}
list($file_path,$method_name) = explode(":", $model_url);
if(strstr($file_path,"/")){
	$class_name = ucwords(substr($file_path, strrpos($file_path,"/")+1));
}else{
	$class_name = ucwords($file_path);
}
if(!file_exists("controller/".$file_path.".php")){
	if(strtolower(APP_MODEL) == 'debug'){
		die('CONTROLLER NOT EXISTS');
	}else{
		exit;
	} 
}
/**
 * 控制器基类
 * 在控制器基类中处理模型和视图的基本解析
 */
require_once("controller/controller.php");
require_once("controller/".$file_path.".php");
if(!class_exists($class_name)){
	if(strtolower(APP_MODEL) == 'debug'){
		die('CLASS NOT EXISTS');
	}else{
		exit;
	} 
}
$controller = new $class_name();
if(!is_callable(array($controller , $method_name))){
	if(strtolower(APP_MODEL) == 'debug'){
		die('METHOD NOT EXISTS');
	}else{
		exit;
	} 
}
//调用控制器
$controller->$method_name();
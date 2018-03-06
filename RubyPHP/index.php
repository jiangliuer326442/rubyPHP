<?php 
//应用名称
define("APP_NAME","SVNTOOL");
//开发状态（debug/production）
define("APP_MODEL","DEBUG");
if(strtolower(APP_MODEL) == 'debug'){
	ini_set("display_errors", "On");
	error_reporting(E_ALL | E_STRICT);
}
define('CONTROLLER','controller');
define('MODEL','model');
//加载公共函数文件
require_once("function/common.php");
//加载路由配置文件
require_once("config/route.php");
//加载模板配置文件
require_once("config/tpl.php");
//家在第三方类库
require_once("vendor/autoload.php");

//判断是否是cli模式
//解析路由
$model_url = "";
$my_routes = array();

if(is_cli()){
	if(count($argv)>=2){
		$model_url = 'scripts/'.$argv[1];
		if(count($argv)>2){
			for($i=2; $i<count($argv); $i++){
				$tmp_arr = explode("=", $argv[$i]);
				$my_routes[$tmp_arr[0]] = $tmp_arr[1];
				unset($tmp_arr);
			}
		}
	}	
}else{
	//根据url加载PHP模块（控制器）
	$request_url = str_replace("/index.php/","",$_SERVER['PHP_SELF']);
	$request_url = explode('.', str_replace_once( "/", "", $request_url))[0];
	if($request_url == "") $request_url = "default";
	foreach($config['route'] as $url => $model){
		//完全匹配路由
		if(!strstr($url, ":")){
			if($url == $request_url){
				$model_url = $model;
				break;
			}
		}else{
			$url_arr = explode("/", $url);
			$request_url_arr = explode("/", $request_url);
			if(count($url_arr) == count($request_url_arr)){
				foreach($url_arr as $key => $val){
					if(!strstr($val, ":")){
						if($val != $request_url_arr[$key]){
							break;
						}
					}else{
						$my_routes[substr($val, 1)] = $request_url_arr[$key];
					}
					if($key+1 == count($url_arr)){
						$model_url = $model;
						break;
					}
				}
			}
		}
	}
}
if(!strstr($model_url, ":")){
	$model_url = $config['route']['404'];
}
list($file_path,$method_name) = explode(":", $model_url);
if(strstr($file_path,"/")){
	$class_name = ucwords(substr($file_path, strrpos($file_path,"/")+1));
}else{
	$class_name = ucwords($file_path);
}
if(!file_exists(CONTROLLER."/".$file_path.".php")){
	if(strtolower(APP_MODEL) == 'debug'){
		die('CONTROLLER NOT EXISTS:'.CONTROLLER."/".$file_path.".php");
	}else{
		exit;
	} 
}
/**
 * 控制器基类
 * 在控制器基类中处理模型和视图的基本解析
 */
require_once(CONTROLLER."/controller.php");
require_once(CONTROLLER."/".$file_path.".php");
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

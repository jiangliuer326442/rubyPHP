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
//加载第三方类库
require_once("vendor/autoload.php");
//加载报错处理类
require_once("libs/Exception/ExitException.php");

$param = getopt('p:r:q');

if(isset($param['p'])){
	//swoole方式运行
	define("MODE", "SWOOLE");
}else{
	define("MODE", "CLI");
}

function swoole_exit($msg = ""){
    //php-fpm的环境
    if (MODE=="CLI"){
        exit($msg);
    }
    //swoole的环境
    else{
		throw new Swoole\Exception\ExitException($msg);
    }
}

function dispatch($model_url, $request = NULL, $response = NULL){
	global $config;
	if(!strstr($model_url, ":")){
		$model_url = $config['route']['404'];
		if(MODE == "CLI"){
			$model_url = "scripts/".$model_url;
		}
	}
	list($file_path,$method_name) = explode(":", $model_url);
	if(strstr($file_path,"/")){
		$class_name = ucwords(substr($file_path, strrpos($file_path,"/")+1));
	}else{
		$class_name = ucwords($file_path);
	}
	if(!file_exists(CONTROLLER."/".$file_path.".php")){
		swoole_exit('CONTROLLER NOT EXISTS:'.CONTROLLER."/".$file_path.".php");
	}
	/**
	 * 控制器基类
	 * 在控制器基类中处理模型和视图的基本解析
	 */
	require_once(CONTROLLER."/controller.php");
	require_once(CONTROLLER."/".$file_path.".php");
	if(!class_exists($class_name)){
		swoole_exit('CLASS NOT EXISTS');
	}
	$controller = new $class_name($request, $response);
	if(!is_callable(array($controller , $method_name))){
		swoole_exit('METHOD NOT EXISTS');
	}
	//调用控制器
	$controller->$method_name();
}

//加载视图
require_once('view/view.php');
$view = new View();

if(MODE == "SWOOLE"){
	$port = $param['p'];
	require_once("libs/server.php");
	new Server($port);
}

//判断是否是cli模式
//解析路由
$model_url = "";
$my_routes = array();

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

dispatch($model_url);

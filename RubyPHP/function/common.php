<?php
require_once("template.php");
require_once("strstr.php");
require_once("array.php");
require_once("number.php");

/**
 * 公共函数文件
 */
if(!defined("APP_NAME")){
	if(strtolower(APP_MODEL) == 'debug'){
		die('Not allowed');
	}else{
		exit;
	}
}

/**
 * 记录日志
 * $content string 日志内容
 * $end_flg bool 是否截断程序执行
 */
function wlog($content, $file = "log.txt", $end_flg = false){
	$trace = debug_backtrace();
	file_put_contents($file,(date('Y-m-d H:i:s',time())).' '.$trace[0]['args'][0]." ".$trace[0]['file'].":".$trace[0]['line']."\r\n",FILE_APPEND | LOCK_EX );
	if($end_flg) exit;
}

/*
验证手机号
*/
function is_mobile( $text ) {
    $search = '/^0?1[3|4|5|6|7|8][0-9]\d{8}$/';
    if ( preg_match( $search, $text ) ) {
        return ( true );
    } else {
        return ( false );
    }
}

/*
判断当前的运行环境是否是cli模式
*/
function is_cli(){
    return preg_match("/cli/i", php_sapi_name()) ? true : false;
}

/*移动端判断*/
function isMobile($ua){ 
        $clientkeywords = array ('nokia',
            'sony',
            'ericsson',
            'mot',
            'samsung',
            'htc',
            'sgh',
            'lg',
            'sharp',
            'sie-',
            'philips',
            'panasonic',
            'alcatel',
            'lenovo',
            'iphone',
            'ipod',
            'blackberry',
            'meizu',
            'android',
            'netfront',
            'symbian',
            'ucweb',
            'windowsce',
            'palm',
            'operamini',
            'operamobi',
            'openwave',
            'nexusone',
            'cldc',
            'midp',
            'wap',
            'mobile'
            ); 
        // 从HTTP_USER_AGENT中查找手机浏览器的关键字
        if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($ua)))
        {
            return true;
        } 
    return false;
} 

/**
 * Mysql执行原生语句
 * @param $sql 标准sql语句
 * @param $prefix 表前缀（若与系统配置相同，可不写）
 * @return $result 执行sql语句的返回信息
 */
function mysql_execute($sql, $prefix = ''){
	require_once(FRAMEWORK.'model/mysql.php');
	$mysql = new Mysql();
	$result = $mysql->mysql_query($sql, $prefix);
	return $result;
}

/**
 *  ThinkPHP S方法
 *  设置和获取缓存
 */
function S($key, $value = null, $expire = 120){
	require_once("config/redis.php");
	global $config;
	$redis_connect = new Redis();
	$redis_connect->connect($config['redis']['host'],$config['redis']['port']);
	$redis_connect->auth($config['redis']['password']);
	$redis_connect->select($config['redis']['database']);
	if($value == null){
		return $redis_connect->get($key);
	}else{
		$redis_connect->set($key,$value);
		$redis_connect->expire($key, $expire);
	}
}

/**
 * ThinkPHP A方法
 * $model_path 模块路径 格式 model/to/path:functionname
 */
function A($model_path){
	list($controller_path, $method_name) = explode(":", $model_path);
	$class_name = ucwords(substr($controller_path, strrpos($controller_path,"/")+1));
	require_once(CONTROLLER.'/'.$controller_path.'.php');
	if(!class_exists($class_name)){
		if(strtolower(APP_MODEL) == 'debug'){
			die('CLASS NOT EXISTS');
		}else{
			exit;
		} 
	}
	return $class_name::$method_name();
}

/**
 * ThinkPHP D方法
 * $model_name 模块名称
 */
function D($model_name, $request = null, $response = null){
	if(file_exists(MODEL.'/'.$model_name.'.php')){
		require_once(MODEL.'/'.$model_name.'.php');
	}else{
		require_once(FRAMEWORK.'model/'.$model_name.'.php');
	}
	$arr = explode("/",$model_name);
	$class_name = ucwords(end($arr));
	return new $class_name($request, $response);
}

/**
 * ThinkPHP M方法
 * @param $tb_name 表名称
 * @param $prefix 表前缀（若与系统配置相同，可不写）
 * @return $db_instance 数据库模型实例，可用该实例执行select(),find(),where(),limit()方法等
 */
function M($tb_name, $prefix = ''){
	require_once(FRAMEWORK.'model/mysql_tool.php');
	$db_instance = Mysql_tool::setTable($tb_name, $prefix);
	return $db_instance;
}

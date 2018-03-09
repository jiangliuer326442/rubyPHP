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
判断当前的运行环境是否是cli模式
*/
function is_cli(){
    return preg_match("/cli/i", php_sapi_name()) ? true : false;
}

/*移动端判断*/
function isMobile(){ 
    // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
    if (isset ($_SERVER['HTTP_X_WAP_PROFILE']))
    {
        return true;
    } 
    // 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
    if (isset ($_SERVER['HTTP_VIA']))
    { 
        // 找不到为flase,否则为true
        return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
    } 
    // 脑残法，判断手机发送的客户端标志,兼容性有待提高
    if (isset ($_SERVER['HTTP_USER_AGENT']))
    {
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
        if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT'])))
        {
            return true;
        } 
    } 
    // 协议法，因为有可能不准确，放到最后判断
    if (isset ($_SERVER['HTTP_ACCEPT']))
    { 
        // 如果只支持wml并且不支持html那一定是移动设备
        // 如果支持wml和html但是wml在html之前则是移动设备
        if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html'))))
        {
            return true;
        } 
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
	global $mysql;
	$result = $mysql->mysql_query($sql, $prefix);
	return $result;
}

/**
 *  ThinkPHP S方法
 *  设置和获取缓存
 */
function S($key, $value = null, $expire = 120){
	global $redis_connect;
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
function D($model_name){
	if(file_exists(MODEL.'/'.$model_name.'.php')){
		require_once(MODEL.'/'.$model_name.'.php');
	}else{
		require_once(FRAMEWORK.'model/'.$model_name.'.php');
	}
	$arr = explode("/",$model_name);
	$class_name = ucwords(end($arr));
	return new $class_name;
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


function ip() {
    //strcasecmp 比较两个字符，不区分大小写。返回0，>0，<0。
    if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
        $ip = getenv('HTTP_CLIENT_IP');
    } elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
        $ip = getenv('HTTP_X_FORWARDED_FOR');
    } elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
        $ip = getenv('REMOTE_ADDR');
    } elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    $res =  preg_match ( '/[\d\.]{7,15}/', $ip, $matches ) ? $matches [0] : '';
	return $res;
}

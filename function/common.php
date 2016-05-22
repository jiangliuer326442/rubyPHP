<?php
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
 * Mysql执行原生语句
 * @param $sql 标准sql语句
 * @param $prefix 表前缀（若与系统配置相同，可不写）
 * @return $result 执行sql语句的返回信息
 */
function mysql_execute($sql, $prefix = ''){
	require_once('model/mysql.php');
	$mysql = new Mysql();
	$result = $mysql->mysql_query($sql, $prefix);
	return $result;
}

/**
 * ThinkPHP M方法
 * @param $tb_name 表名称
 * @param $prefix 表前缀（若与系统配置相同，可不写）
 * @return $db_instance 数据库模型实例，可用该实例执行select(),find(),where(),limit()方法等
 */
function M($tb_name, $prefix = ''){
	require_once('model/mysql_tool.php');
	$db_instance = Mysql_tool::setTable($tb_name, $prefix);
	return $db_instance;
}

/**
 * ThinkPHP I方法
 * @param $key 表单参数
 * @param $method post、get、all提交方式
 * @return $value 参数值
 */
function I($key, $method='all'){
	if($method == 'post'){
		return $_POST[$key];
	}
	if($method == 'get'){
		return $_GET[$key];
	}
	return empty($_POST[$key])?$_GET[$key]:$_POST[$key];
}
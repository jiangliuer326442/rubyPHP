<?php
/**
 * 模板配置文件
 */
if(!defined("APP_NAME")){
	if(strtolower(APP_MODEL) == 'debug'){
		die('Not allowed');
	}else{
		exit;
	}
}

$config['tmpl'] = array(
	//'url路径'=>'模块路径:方法'
	'prefix' => 'html', //模板文件后缀
	'left_delimiter' => '{:', //模板左标签
	'right_delimiter' => '}', //模板右标签
);
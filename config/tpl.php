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
	'is_cache' => true, //是否生成模板缓存
	'cache_limit' => 3600, //模板缓存时间（秒）
	'left_delimiter' => '{:', //模板左标签
	'right_delimiter' => '}', //模板右标签
	'is_compresshtml' => true, //是否压缩html
);
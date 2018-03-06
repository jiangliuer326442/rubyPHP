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
 * 删除数组中制定value的元素
 **/
function array_remove($val, $array){
	unset($array[array_search($val, $array)]);
	return $array;
}

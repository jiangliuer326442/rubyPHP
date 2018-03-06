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
 *  Looks for the first occurence of $needle in $haystack
 * and replaces it with $replace.
 */
function str_replace_once($needle, $replace, $haystack) {
	$pos = strpos($haystack, $needle);
	if ($pos === false) {
		// Nothing found
		return $haystack;
	}
	return substr_replace($haystack, $replace, $pos, strlen($needle));
}

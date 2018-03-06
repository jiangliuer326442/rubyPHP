<?php
const STATIC_HOST = 'http://svntool.companyclub.cn';
const STATIC_PATH = '/static/';

function importCss($path){
	$path = $path['path'];
	$css_path = STATIC_HOST.STATIC_PATH.$path.'.css';
	//文件哈希值
	$version = hash_file('md5', '.'.str_replace(STATIC_HOST,"",$css_path));
	echo "<link href=\"".$css_path."?".$version."\" rel=\"stylesheet\">";
}

function importJs($path){
	$path = $path['path'];
	$js_path = STATIC_HOST.STATIC_PATH.$path.'.js';
	//文件哈希值
	$version = hash_file('md5', '.'.str_replace(STATIC_HOST,"",$js_path));
	echo "<script type=\"text/javascript\" src=\"".$js_path."?".$version."\"></script>";
}

function importStatic($path){
	$path = $path['path'];
	$img_path = STATIC_HOST.STATIC_PATH.$path;
	echo $img_path;
}

?>
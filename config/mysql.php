<?php
/**
 * MySQL�����ļ�
 * ֧������ͬ��
 */
if(!defined("APP_NAME")){
	if(strtolower(APP_MODEL) == 'debug'){
		die('Not allowed');
	}else{
		exit;
	}
}

global $config;

$config['mysql'] = array(
	'prefix' => '',
	'master' => array(
		'host' => '',
		'port' => '',
		'username' => '',
		'password' => '',
		'database' => '',
	),
	'slaver' => array(
		'host' => '',
		'port' => '',
		'username' => '',
		'password' => '',
		'database' => '',
	),
);

<?php
require_once(FRAMEWORK.'libs/message/RonglianSDK.php');

//加载短信配置文件 
require_once("config/message.php");

class Message{
	private $rest;
	
	public function __construct(){
		global $config;
		$accountSid = $config['message']['ronglian_ACCOUNT_SID'];
		$accountToken = $config['message']['ronglian_AUTH_TOKEN'];
		$appId = $config['message']['ronglian_AppID'];
		//请求地址
		//沙盒环境（用于应用开发调试）：sandboxapp.cloopen.com
		//生产环境（用户应用上线使用）：app.cloopen.com
		$serverIP='app.cloopen.com';


		//请求端口，生产环境和沙盒环境一致
		$serverPort='8883';

		//REST版本号，在官网文档REST介绍中获得。
		$softVersion='2013-12-26';
		$this->rest = new REST($serverIP,$serverPort,$softVersion);
		$this->rest->setAccount($accountSid,$accountToken);
		$this->rest->setAppId($appId);
	}

	public function sendTemplateSMS($to,$datas,$tempId){
		$result = $this->rest->sendTemplateSMS($to,$datas,$tempId);
		if($result == NULL ) {
			return false;
		}
		if($result->statusCode!=0) {
			return false;
		}else{
			return true;
		}
	}
}

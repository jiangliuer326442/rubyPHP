<?php
use Gaoming13\WechatPhpSdk\Api;

//加载短信配置文件 
include "config/share.php";

class Share{
	private $api;

	public function __construct(){
		global $config;
		$appId = $config['share']['wx']['app_id'];
		$appSecret = $config['share']['wx']['app_secret'];
		$this->api = new Api(
			array(
				'appId' => $appId,
				'appSecret'	=> $appSecret,
				'get_access_token' => function(){
					// 用户需要自己实现access_token的返回
					S("_access_token");
				},
				'save_access_token' => function($token){
					// 用户需要自己实现access_token的保存
					S("_access_token", $token, 7200);
				},
				'get_jsapi_ticket' => function(){
					// 可选：用户需要自己实现jsapi_ticket的返回（若使用get_jsapi_config，则必须定义）
					S("_jsapi_ticket");
				},
				'save_jsapi_ticket' => function($jsapi_ticket){
					// 可选：用户需要自己实现jsapi_ticket的保存（若使用get_jsapi_config，则必须定义）
					S("_jsapi_ticket", $jsapi_ticket, 7200);
				}
			)
		);
	}

	/**
	 * 微信分享功能调用接口
	 * $url 发起分享的当前页面的url
	 **/
	public function share($url){
		$result = $this->api->get_jsapi_config($url);
		return $result;
	}

}

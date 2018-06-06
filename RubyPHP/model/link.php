<?php
require_once(FRAMEWORK.'libs/link/ShortURL/AutoLoader.php');

//加载短信配置文件 
require_once("config/link.php");

class Link{
	private $api;	

	public function __construct(){
		global $config;
		$apikey = $config['link']['x3me']['apikey'];
		$secretkey = $config['link']['x3me']['secretkey'];
		$config = new \ShortURL\Config($apikey, $secretkey);
		$this->api = new \ShortURL\API($config);
	}

	public function addurl($url){
		$params= new \ShortURL\Model\addModel();
		$params->setLongurl($url);
		$api_result = $this->api->add($params);
		return $api_result['data']['short_url'];
	}
}

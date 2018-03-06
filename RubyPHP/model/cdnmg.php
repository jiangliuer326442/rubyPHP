<?php
//加载短信配置文件 
include "config/upload.php";

use Qiniu\Auth;
use \Qiniu\Cdn\CdnManager;

/**
 * cdn刷新处理
 */
class Cdnmg{
	private $auth = null;
	
	public function __construct(){
		global $config;
		$accessKey = $config['upload']['qiniu_ACCESS_KEY'];
		$secretKey  = $config['upload']['qiniu_SECRET_KEY'];
		$this->auth = new Auth($accessKey, $secretKey);
	}

	public function refresh($urls = array()){
		$cdnManager = new CdnManager($this->auth);
		list($refreshResult, $refreshErr) = $cdnManager->refreshUrls($urls);
		return $refreshResult;
	}
}

<?php
//加载短信配置文件 
include "config/upload.php";

use Qiniu\Auth;
use Qiniu\Storage\UploadManager;

class Upload{
	private $uptoken = null;
	
	public function __construct(){
		global $config;
		$accessKey = $config['upload']['qiniu_ACCESS_KEY'];
		$secretKey  = $config['upload']['qiniu_SECRET_KEY'];
		$bucket = $config['upload']['qiniu_bucketname'];
		$auth = new Auth($accessKey, $secretKey);

		$this->uptoken = $auth->uploadToken($bucket, null, 3600);
	}

	public function upload($filePath, $prefix = ''){
		global $config;
		$uploadMgr = new UploadManager();
		list($ret, $err) = $uploadMgr->putFile($this->uptoken, $prefix."_".date("YmdHis").".".pathinfo($filePath)['extension'], $filePath);
		return 'http://'.$config['upload']['qiniu_host']."/".$ret['key'];
	}
}

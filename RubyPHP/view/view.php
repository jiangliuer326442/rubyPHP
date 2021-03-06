<?php
class View{
	private $smarty;
	
	function __construct() {
		global $config;
        require_once(FRAMEWORK.'libs/smarty/Smarty.class.php');
		$this->smarty = new Smarty;
		$this->smarty->register_function('importCss','importCss');  
		$this->smarty->register_function('importJs','importJs');  
		$this->smarty->register_function('importStatic','importStatic');  
		$this->smarty->template_dir = 'view/';
		$this->smarty->compile_dir = FRAMEWORK.'cache/';
		$this->smarty->cache_lifetime = '3600';
		if(strtolower(APP_MODEL) == 'debug'){
			$this->smarty->clear_all_cache();
		}
		$this->smarty->left_delimiter = $config['tmpl']['left_delimiter'];
		$this->smarty->right_delimiter = $config['tmpl']['right_delimiter'];
    }
	
	//Ϊģ��������
	public function assign($key, $value){
		$this->smarty->assign($key,$value);
	}
	
	//����json���
	public function return_json($status, $info, $data, $response){
		$result['status'] = $status;
		$result['info'] = $info;
		$result['data'] = $data;
		if(MODE == "CLI"){
			header('content-type:application/json;charset=utf8');
			swoole_exit(json_encode($result));
		}else{
			$response->header("content-type", "application/json;charset=utf8");
			$response->end(json_encode($result));
		}
	}
	
	//����ģ���ļ�
	public function display($file_path, $response){
		global $config;
		if(MODE == "CLI"){
			$this->smarty->display($file_path.".".$config['tmpl']['prefix']);
		}else{
			$response->header("Content-Type", "text/html;charset=utf-8");
			$response->end($this->smarty->fetch($file_path.".".$config['tmpl']['prefix']));
		}
	}
}

<?php
class Controller{
	private $view;
	
	public function __construct(){
		//加载视图
		require_once('view/view.php');
		$this->view = new View();
	}
	
	//返回json数据
	public function return_json($status, $info, $data){
		$this->view->return_json($status, $info, $data);
	}
	
	//为模板分配变量
	public function assign($key, $value){
		$this->view->assign($key, $value);
	}
	
	//调用模板文件
	public function display($file_path,$prefix = null,$cache = ''){
		$this->view->display($file_path, $prefix, $cache);
	}
}
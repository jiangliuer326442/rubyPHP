<?php
class Controller{
	private $view = null;
	
	public function __construct(){
		require_once(FRAMEWORK.'view/view.php');
		$this->view = new View();
	}
	
	//����json���
	public function return_json($status, $info, $data = array()){
		$this->view->return_json($status, $info, $data);
		exit;
	}
	
	//Ϊģ��������
	public function assign($key, $value){
		$this->view->assign($key, $value);
	}
	
	//����ģ���ļ�
	public function display($file_path,$prefix = null,$cache = ''){
		$this->view->display($file_path, $prefix, $cache);
	}
}

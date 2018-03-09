<?php
class Controller{
	protected $request = null;
	protected $response = null;
	
	public function __construct($request, $response){
		$this->request = $request;
		$this->response = $response;
	}
	
	//����json���
	protected function return_json($status, $info, $data = array()){
		global $view;
		$view->return_json($status, $info, $data);
		exit;
	}
	
	//Ϊģ��������
	protected function assign($key, $value){
		global $view;
		$view->assign($key, $value);
	}
	
	//����ģ���ļ�
	protected function display($file_path){
		global $view;
		$view->display($file_path, $this->response);
	}

	/**
	 * ThinkPHP I方法
	 * @param $key 表单参数
	 * @param $method post、get、all提交方式
	 * @return $value 参数值
	 */
	protected function I($key, $method='', $func = 'trim'){
		global $my_routes;
		$result = "";
		if($method == 'post'){
			$result = isset($this->request->post[$key])?$this->request->post[$key]:"";
		}else if($method == 'get'){
			$result = isset($this->request->get[$key])?$this->request->get[$key]:"";
		}else{
			$result = empty($this->request->post[$key])? (isset($this->request->get[$key])?$this->request->get[$key]:""):$this->request->post[$key];
		}
		if(empty($result) && $my_routes){
			$result = $my_routes[$key];
		}
		return $func($result);
	}

}

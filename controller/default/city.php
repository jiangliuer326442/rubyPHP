<?php
class City extends Controller{
	
	public function index(){
		$rs = M('comment')->select();
		$this->return_json(200,'获取评论列表成功',$rs);
	}
	
	public function add(){
		$data['name'] = I('name');
		$data['city'] = I('city');
		$data['pwd'] = I('pwd');
		$result = M('users')->add($data);
		echo $result;
	}
}
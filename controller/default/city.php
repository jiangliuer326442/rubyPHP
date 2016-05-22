<?php
class City extends Controller{
	
	public function index(){
		$rs = M('users')->field('name,city,pwd')->where('id>0')->limit('3')->select();
		//$rs = mysql_execute("select name,city,pwd from users where id>0 limit 3");
		$this->return_json(200,'获取城市列表成功',$rs);
	}
	
	public function add(){
		$data['name'] = I('name');
		$data['city'] = I('city');
		$data['pwd'] = I('pwd');
		$result = M('users')->add($data);
		echo $result;
	}
}
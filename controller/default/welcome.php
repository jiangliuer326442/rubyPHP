<?php
class Welcome extends Controller{
	public function index(){
		$this->assign('title','欢迎使用rubyPHP');
		$this->assign('world','感谢您使用rubyPHP开发框架');
		$this->display('index');
	}
}
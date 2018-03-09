<?php

class Welcome extends Controller {

	public function index(){
		S("age", 12, 120);
		$age = S("age");
		$info = M("admin_users")->find($this->I("id"));
		$this->assign("age", $age);
		$this->assign("user", $info['realname']);
		$this->assign("title", "RubyPHP");
		$this->display("index");
	}

}

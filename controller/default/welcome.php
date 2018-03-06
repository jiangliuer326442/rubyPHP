<?php

class Welcome extends Controller {

	public function index(){
		$this->assign("title", "RubyPHP");
		$this->display("index");
	}

}

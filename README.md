# RubyPHP
## Hello World
1. 引入框架
index.php:
```
define("FRAMEWORK", __DIR__."/RubyPHP/");

require(FRAMEWORK."index.php");
```
2. 配置路由
config.route.php
```
$config['route'] = array(
	'default'						=> 'default/welcome:index',
);
```
3. 创建控制器
controller/default/welcome.php
```
class Welcome extends Controller {
	public function index(){
		$this->assign("title", "RubyPHP");
		$this->display("index");
	}
}
```
4. 创建视图
vide/index.html
```
你好，{:$title}
```
5. 运行
default是默认路由，因此浏览器直接打开到该目录即可运行
6. cli模式运行
吧原来的控制器移到scripts目录下
controller/scripts/default/welcome.php
```
class Welcome extends Controller {
	public function index(){
		$this->assign("title", "RubyPHP");
		$this->display("index");
	}
}
```
命令行运行：php index.php default/welcome:index
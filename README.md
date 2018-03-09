# RubyPHP
## 什么是swoole?
swoole是PHP的一个插件，[点击以下链接](https://www.w3cschool.cn/swoole/swoole-install.html)安装，区别于普通PHP的地方在于：类的实例化不必等到每次请求的时候创建，mysql和redis使用长连接，不必每次请求的时候再去创建。在高并发的场景下可与java相媲美。
## 开始旅程
1. 引入框架
将RubyPHP文件夹放在服务器上的任意目录，如：/data/user/fanghailiang/swoole/文件夹中，在项目入口文件引入框架
index.php:
```
define("FRAMEWORK","/data/user/fanghailiang/swoole/RubyPHP/");
require(FRAMEWORK."index.php");
```
2. 配置路由
路由是设置url路径和控制器中的模块、方法的对应关系，default代表根路由，RubyPHP支持正则路由
config/route.php
```
$config['route'] = array(
	'default'						=> 'default/welcome:index',
);
```
3. 配置数据库连接
之所以配置两个mysql连接，是因为本框架支持mysql主从分离
config/mysql.php
```
global $config;

$config['mysql'] = array(
	'prefix' => '',
	'master' => array(
		'host' => '',
		'port' => '',
		'username' => '',
		'password' => '',
		'database' => '',
	),
	'slaver' => array(
		'host' => '',
		'port' => '',
		'username' => '',
		'password' => '',
		'database' => '',
	),
);
```
config/redis.php
```
global $config;
$config['redis'] = array(
	//'url路径'=>'模块路径:方法'
	'enable' => true, //使用redis缓存
	'host' => '127.0.0.1', //主机
	'port' => 6379, //端口号
	'password' => '', //密码
	'expire' => 300, //过期时间（秒）
	'database' => 7, //redis缓存使用的数据库
);
```
5. 创建控制器
controller/default/welcome.php
不用写注释了，完全是[ThinkPHP](http://document.thinkphp.cn/manual_3_2.html)的语法，唯一改动的是I方法变成了$this->I的形式
```
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
```
4. 创建视图
使用[Smarty](https://www.yiibai.com/smarty/)的语法规则，分界符默认为{:}
vide/index.html
```
{:$user}你好,您的年龄是{:$age},欢迎来到{:$title}
```
## 项目运行
1. swoole运行
命令行输入：php index.php -p 9501，-p指定使用的端口
nginx 设置反向代理
```
server                                                                                                                                                                      
    {   
        listen 80; 
        #listen [::]:80;
        server_name swoole.fanghailiang.companyclub.cn ;

        include none.conf;
    
        location / { 
            proxy_pass http://localhost:9501;
        }   
    }
```
url输入 http://swoole.fanghailiang.companyclub.cn/?id=4即可访问
2. cli模式运行
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
## 相关问题
1. 如何在后台运行？
nohup php index.php -p 9501 &
2. mysql或redis长连接被中断如何处理？
解决思路是捕捉长连接失败的异常，然后重新建立长连接。待后续版本补足这个缺点。
--------------------------------------------------
广告：
[卡拉布同事圈](http://www.companyclub.cn/downloadapp?_s=github)--企业信息分享平台，同事相处更简单
--------------------------------------------------
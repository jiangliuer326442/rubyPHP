<?php 
/**
 * 框架所在目录
 * 可以把框架放在服务器上的任何地方，引入该目录即可，因此可以多个项目共用
 * 但是该目录需要设置允许php访问
 */
define("FRAMEWORK", __DIR__."/RubyPHP/");

require(FRAMEWORK."index.php");

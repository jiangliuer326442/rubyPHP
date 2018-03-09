<?php /* Smarty version 2.6.30, created on 2018-03-06 10:27:29
         compiled from companyclub_pc.html */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
	<!-- 删除默认的苹果工具栏和菜单栏 -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <!-- 在web app应用下状态条（屏幕顶部条）的颜色 -->
  <meta name="apple-mobile-web-app-status-bar-style" content="black" />
  <!-- 禁止了把数字转化为拨号链接 -->
  <meta name="format-detection" content="telephone=no">
`<meta name="wlhlauth" content="651afc1535248905c191b531d97bd818"/>
	<meta http-equiv=”X-UA-Compatible” content=”IE=edge,chrome=1″/>
  <title><?php echo $this->_tpl_vars['title']; ?>
</title>
  <meta name="keywords" content="<?php echo $this->_tpl_vars['keywords']; ?>
">
  <meta name="description" content="<?php echo $this->_tpl_vars['description']; ?>
">

  <!-- 新 Bootstrap 核心 CSS 文件 -->
  <link href="<?php echo $this->_tpl_vars['bower_path']; ?>
bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<!-- 新 animate CSS3 核心文件 -->
	<link rel="stylesheet" href="<?php echo $this->_tpl_vars['base_path']; ?>
library/animate/animate.min.css">
  <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
  <script src="<?php echo $this->_tpl_vars['bower_path']; ?>
jquery/jquery.min.js"></script>
  <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
  <script src="<?php echo $this->_tpl_vars['bower_path']; ?>
bootstrap/dist/js/bootstrap.min.js"></script>
	<link href="<?php echo $this->_tpl_vars['base_path']; ?>
tongshiquan/club_iconfont.css?v=20170907" rel="stylesheet">
</head>
<body>

  <div class="wrap" id="app" style="max-width:1200px; margin: 0 auto;"></div>

  <script src="<?php echo $this->_tpl_vars['base_path']; ?>
tongshiquan/lib.js?version=171023"></script>
  <script src="<?php echo $this->_tpl_vars['base_path']; ?>
tongshiquan/javascript/main-0c084cf6dd4a9bb2ac61.js"></script>
	<div id="background" style="position: fixed; right: 0; bottom: 0; min-width: 100%; min-height: 100%; width: auto; height: auto; z-index: -100; background: url(http://cdn.companyclub.cn/tongshiquan/bg/1.jpg) no-repeat; background-size: cover;"> </div>
	<div id="background_sub" style="opacity: 0; position: fixed; right: 0; bottom: 0; min-width: 100%; min-height: 100%; width: auto; height: auto; z-index: -100; background: url(http://cdn.companyclub.cn/tongshiquan/bg/1.jpg) no-repeat; background-size: cover;"> </div>   
  <script type="text/javascript">
	var which_bg = true,i = 1;
	window.setInterval(function(){
		//产生1到5的随机数
		var image_id = ++i;
		if(which_bg){
			$("#background_sub").css("background-image","url(<?php echo $this->_tpl_vars['base_path']; ?>
tongshiquan/bg/"+image_id+".jpg)");
			$("#background").stop().animate({opacity: '0'},800);  
			$("#background_sub").stop().animate({opacity: '1'},800); 
		}else{
			$("#background").css("background-image","url(<?php echo $this->_tpl_vars['base_path']; ?>
tongshiquan/bg/"+image_id+".jpg)");
			$("#background_sub").stop().animate({opacity: '0'},800);  
			$("#background").stop().animate({opacity: '1'},800); 
		}
		if(i%5==0) i = 1;
		which_bg = !which_bg
	}, 7000); 
  </script>
</body>
</html>
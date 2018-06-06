<?php /* Smarty version 2.6.30, created on 2018-03-10 22:58:44
         compiled from post.html */ ?>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
		<!-- 删除默认的苹果工具栏和菜单栏 -->
		<meta name="apple-mobile-web-app-capable" content="yes">
		<!-- 在web app应用下状态条（屏幕顶部条）的颜色 -->
		<meta name="apple-mobile-web-app-status-bar-style" content="black" />
		<!-- 禁止了把数字转化为拨号链接 -->
		<meta name="format-detection" content="telephone=no">
		<meta http-equiv=”X-UA-Compatible” content=”IE=edge,chrome=1″/>
		<!-- 新 Bootstrap 核心 CSS 文件 -->
		<link href="<?php echo $this->_tpl_vars['bower_path']; ?>
bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
		<!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
		<script src="<?php echo $this->_tpl_vars['bower_path']; ?>
jquery/jquery.min.js"></script>
		<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
		<script src="<?php echo $this->_tpl_vars['bower_path']; ?>
bootstrap/dist/js/bootstrap.min.js"></script>
		<title><?php echo $this->_tpl_vars['article']['title']; ?>
</title>
		<style>
			.article{
				padding: 20px 15px 15px;
				margin-bottom: 7em;
			}
			.article h2{
				margin-bottom: 10px;
				line-height: 1.4;
				font-weight: 400;
				font-size: 24px;
			}
			.article .content{
				font-size: 15px;
			}
			.article .content p{
				text-align: left;
				margin-left: 16px;
				margin-right: 16px;
				line-height: 1.8em;
				overflow: hidden;
				text-indent: 0px !important;
			}
			.article .content p img{
				margin: 1.5em auto;
				max-width: 100% !important;
				height: auto !important;
			}
			.software{
				height: 6em;
				color: #333;
				background-color: #FFF5F6;
				position: fixed;
				bottom: 0;
				width: 100%;
				display: flex;
				padding: 10px;
			}
			.software .logo{
				width: 4em;
				height: 100%;
			}
			.software .logo img{
				width: 100%;
				height: auto;
			}
			.software .desc{
				display: flex;
				flex-direction: column;
				margin-left: 1em;
			}
			.software .desc h2{
				font-size: 1.5em;
				line-height: 1.5;
				font-weight: bold;
				margin: 0;	
			}
			.software .desc p{
				font-size: 1.2em;
			}
			.software .button{
				margin: .4em 1em;
				flex: 1;
			}
			.software .button input{
				width: 100%;
				height: 2.4em;
				font-size: 1.2em;
				background-color: #F9678B;
				color: #fff;
			}
		</style>
	</head>
	<body>
		<div class="article">
			<h2><?php echo $this->_tpl_vars['article']['title']; ?>
</h2>
			<div class="content">
				<?php echo $this->_tpl_vars['article']['content']; ?>

			</div>
		</div>
		<a class="software" href="/downloadapp?_s=postshare">
			<div class="logo">
				<img src="http://cdn.companyclub.cn/tongshiquan/tongshiquan.jpg" />
			</div>
			<div class="desc">
				<h2>卡拉布同事圈</h2>
				<p>公司信息分享平台</p>
			</div>
			<div class="button">
				<input type="button" value="点击下载" />
			</div>
		</div>
		<script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
		<script type="text/javascript">
			wx.config({
				appId: '<?php echo $this->_tpl_vars['share_conf']['appId']; ?>
', // 必填，公众号的唯一标识
				timestamp: <?php echo $this->_tpl_vars['share_conf']['timestamp']; ?>
, // 必填，生成签名的时间戳
				nonceStr: '<?php echo $this->_tpl_vars['share_conf']['nonceStr']; ?>
', // 必填，生成签名的随机串
				signature: '<?php echo $this->_tpl_vars['share_conf']['signature']; ?>
',// 必填，签名
				jsApiList: ['onMenuShareTimeline', 'onMenuShareAppMessage'] // 必填，需要使用的JS接口列表
			});
			wx.ready(function(){
				wx.onMenuShareTimeline({
					title: '卡拉布-<?php echo $this->_tpl_vars['article']['title']; ?>
', // 分享标题
					link: '<?php echo $this->_tpl_vars['share_conf']['url']; ?>
', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
					imgUrl: 'http://cdn.companyclub.cn/tongshiquan/tongshiquan.jpg', // 分享图标
					success: function () {
						// 用户确认分享后执行的回调函数
						alert('分享成功');
					},
					cancel: function () {
						alert('分享取消');
					}
				})
			});
		</script>
	</body>
</html>
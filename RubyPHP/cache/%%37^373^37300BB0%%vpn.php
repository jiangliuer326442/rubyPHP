<?php /* Smarty version 2.6.30, created on 2018-03-06 12:33:55
         compiled from admin/vpn */ ?>
<div class="panel panel-primary" style="width: 300px;">
	<div class="panel-heading">
		<h3 class="panel-title">
			获取VPN密码
		</h3>
	</div>
	<div class="panel-body">
		<div class="alert alert-warning" style="display: none;">
			<a href="#" class="close" data-dismiss="alert">
				&times;
			</a>
			<strong></strong>
		</div>
		<div class="alert alert-success" style="display: none;">
			<a href="#" class="close" data-dismiss="alert">
				&times;
			</a>
			<strong></strong>
		</div>
		<form role="form">
			<h3>获取VPN密码</h3>
			<div class="form-group">
				<label for="username">用户名</label>
				<input type="text" class="form-control" id="username" placeholder="您姓名的拼音">
			</div>
			<div class="form-group">
				<label for="codes">验证码</label>
				<div class="form-row" style="display: flex;">
					<input type="number" class="form-control" id="codes" style="margin-right: 10px;" placeholder="4位数字">
					<button type="button" class="btn btn-primary">获取验证码</button>
				</div>
			</div>
		</form>
	</div>
	<div class="panel-footer">
		<button style="display: block; margin: 0 auto; width: 100px;" type="button" class="btn btn-success">提交</button>

	</div>
</div>
<script>
	$(function(){
		$(".btn-primary").click(function(){
			var username = $("#username").val();
			$(".btn-primary").attr("disabled", true);
			$(".btn-primary").addClass("disabled");
			$.ajax({
				url: "<?php echo $this->_tpl_vars['admin']; ?>
vpn/sendmsg",
				method: "post",
				data: {username: username},
				success: function(result){
					if(result.status != 200){
						$(".btn-primary").attr("disabled", false);
						$(".btn-primary").removeClass("disabled");
						$(".alert-warning strong").text(result.info);
						$(".alert-warning").fadeIn();
						$(".alert-success").fadeOut();
						setTimeout(function(){
							$(".alert-warning").fadeOut();
						}, 3000);
					}else{
						$(".alert-success strong").html("短信发送成功");
						$(".alert-success").fadeIn();
						$(".alert-warning").fadeOut();
						var total = 20;
						$timers = setInterval(function(){
							$(".btn-primary").text("剩余"+total+"秒");
							total--;
						}, 1000);
						setTimeout(function(){
							window.clearInterval($timers);
							$(".btn-primary").attr("disabled", false);
							$(".btn-primary").removeClass("disabled");
							$(".btn-primary").text("获取验证码");
						}, total*1000);
					}
				}
			});
		})
		$(".btn-success").click(function(){
			var username = $("#username").val();
			var codes = $("#codes").val();
			$.ajax({
				method: "post",
				data: {action: "checkcodes", username: username, codes: codes},
				success: function(result){
					if(result.status == 200){
						$.ajax({
							method: "post",
							data: {action: "loginsuccess", username: username}
						});
						$(".alert-success strong").html("<p style='font-size: 1.1em; margin: 20px;'>您的vpn登陆账户用户名：<i style='color: red;'>"+result.data.username+"</i><br />密码：<i style='color: red;'>"+result.data.password+"</i></p>");
						$(".alert-success").fadeIn();
						$(".alert-warning").fadeOut();
					}else{
						$(".alert-warning strong").text(result.info);
						$(".alert-warning").fadeIn();
						$(".alert-success").fadeOut();
						setTimeout(function(){
							$(".alert-warning").fadeOut();
						}, 3000);
					}
				}
			});
		
		});
	});
</script>
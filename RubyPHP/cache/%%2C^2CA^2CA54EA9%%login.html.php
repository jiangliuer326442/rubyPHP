<?php /* Smarty version 2.6.30, created on 2018-03-06 10:58:42
         compiled from admin/login.html */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/common_header", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</head>

<body>
<div class="ch-container">
    <div class="row">
        
    <div class="row">
        <div class="col-md-12 center login-header">
            <h2>卡拉布--管理后台</h2>
        </div>
        <!--/span-->
    </div><!--/row-->

    <div class="row">
        <div class="well col-md-5 center login-box">
            <div class="alert alert-info" id="msg">
                请输入用户名和密码
            </div>
            <form class="form-horizontal">
                <fieldset>
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>
                        <input type="text" id="username" class="form-control" placeholder="用户名" autocomplete="off">
                    </div>
                    <div class="clearfix"></div><br>

                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
                        <input type="password" id="password" class="form-control" placeholder="密码">
                    </div>
                    <div class="clearfix"></div>

                    <div class="input-prepend">
                        <label class="remember" for="remember"><input type="checkbox" id="remember"> 记住我</label>
                    </div>
                    <div class="clearfix"></div>

                    <p class="center col-md-5">
                        <button id="login" type="button" class="btn btn-primary" data-loading-text="正在登录...">登陆</button>
                    </p>
                </fieldset>
            </form>
        </div>
        <!--/span-->
    </div><!--/row-->
</div><!--/fluid-row-->

</div><!--/.fluid-container-->

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/common_js", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<script type="text/javascript">
	$("#login").click(function(){
		$(this).button('loading').queue(function() {
			var username = $("#username").val();
			var password = $("#password").val();
			if(username == ""){
				$(this).button('reset');
				showerror("用户名不能为空");
			}
			if(password == ""){
				$(this).button('reset');
				showerror("密码不能为空");
			}
			$.ajax({
			    url: server+"admin/login?",              //请求地址
			    type: "POST",                       //请求方式
			    data: {username:username,password:password},        //请求参数
			    success: function(res){
					const {status, info, data} = res;
			    	if(status == 200){
			    		var token = data.token;
			    		var userid = data.userid;
						$.cookie('admin_userid', userid);
						$.cookie('admin_token', token);
			    		window.location.href="/admin";
			    		
			    	}else{
			    		$(this).button('reset');
			    		showerror(info);
			    	}
			    }.bind(this)
			});
		});
	});
	var showerror = function(msg){
		$("#msg").removeClass("alert-info").addClass("alert-danger").html(msg);
	}
</script>
</body>
</html>
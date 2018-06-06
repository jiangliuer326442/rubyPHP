<?php /* Smarty version 2.6.30, created on 2018-03-10 20:50:59
         compiled from admin/role_edit */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'in_array', 'admin/role_edit', 37, false),)), $this); ?>
<!-- content starts -->
<div>
	<ul class="breadcrumb">
		<li>
			<a href="/admin">首页</a>
		</li>
		<li>
			<a href="javascript:;">设置权限组</a>
		</li>
	</ul>
</div>
<div class=" row">
	<div class="box col-md-12">
		<div class="box-inner">
			<div class="box-header well" data-original-title="">
				<h2><i class="glyphicon glyphicon-lock"></i>设置权限组</h2>
			</div>
			<div class="box-content">
				<form role="form" onsubmit="return false;" class="form-horizontal col-sm-8">
					<div class="form-group">
						<label for="" class="col-sm-2 control-label">名称</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="rolename" value="<?php echo $this->_tpl_vars['role']['rolename']; ?>
">
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-2 control-label">描述</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="remark" value="<?php echo $this->_tpl_vars['role']['remark']; ?>
">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="list_role">权限</label>
						<div class="controls col-sm-10">
							<select id="list_role" multiple class="form-control" data-rel="chosen">
							<?php $_from = $this->_tpl_vars['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['row']):
?>
								<option value="<?php echo $this->_tpl_vars['row']['id']; ?>
" <?php if (((is_array($_tmp=$this->_tpl_vars['row']['id'])) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['role']['list']) : in_array($_tmp, $this->_tpl_vars['role']['list']))): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['row']['remark']; ?>
</option>
							<?php endforeach; endif; unset($_from); ?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button id="role_edit" class="btn btn-primary">确认修改</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!--/span-->
</div>
<!-- content ends -->
<script type="text/javascript">
	$("#role_edit").click(function(){
		var rolename = $("#rolename").val();
		var remark = $("#remark").val();
		if(rolename == ""){
			noty({text: "权限组名称为空", layout: "center", timeout: 3000, type: "error"});
			return false;
		}
		var role_arr = $("#list_role").val();
		if(role_arr == null){
			noty({text: "该权限组无任何权限", layout: "center", timeout: 3000, type: "error"});
			return false;
		}
		$.ajax({
			type: "POST",                       //请求方式
			data: {  rolename: rolename, remark: remark, tran: role_arr.join(",") },        //请求参数
			success: function (res) {
				const {status, info, data} = res;
				if(status == 200){
					window.location.href = "<?php echo $this->_tpl_vars['admin']; ?>
role_list";
				}else{
					noty({text: info, layout: "center", timeout: 5000, type: "error"});
				}
				return false;
			}
		});
		return false;
	});
</script>
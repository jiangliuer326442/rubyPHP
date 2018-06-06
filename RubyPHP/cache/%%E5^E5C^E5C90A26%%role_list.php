<?php /* Smarty version 2.6.30, created on 2018-03-10 20:50:55
         compiled from admin/role_list */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cat', 'admin/role_list', 8, false),)), $this); ?>
<!-- content starts -->
<div>
	<ul class="breadcrumb">
		<li>
			<a href="/admin">首页</a>
		</li>
		<li>
			<a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['admin'])) ? $this->_run_mod_handler('cat', true, $_tmp, 'role_list') : smarty_modifier_cat($_tmp, 'role_list')); ?>
">权限组列表</a>
		</li>
	</ul>
</div>
<div class="row">
	<div class="box col-md-12">
		<div class="box-inner">
			<div class="box-header well" data-original-title="">
				<h2><i class="glyphicon glyphicon-lock"></i> 权限组列表</h2>

				<div class="box-icon">
					<a href="#" class="btn btn-minimize btn-round btn-default"><i
							class="glyphicon glyphicon-chevron-up"></i></a>
					<a href="#" class="btn btn-close btn-round btn-default"><i
							class="glyphicon glyphicon-remove"></i></a>
				</div>
			</div>
			<div class="box-content">
			<?php if ($this->_tpl_vars['addrole_flg']): ?>
				<a class="btn btn-info ajax-link" href="<?php echo $this->_tpl_vars['admin']; ?>
role_add" role="button">添加权限组</a>
			<?php endif; ?>
				<table class="table table-striped table-bordered responsive">
					<thead>	
						<tr>	
							<th>ID</th>
							<th>名称</th>
							<th>描述</th>
							<th>操作</th>
						</tr>
					</thead>
					<tbody id="tbody">
					<?php $_from = $this->_tpl_vars['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['row']):
?>
						<tr>
							<td><?php echo $this->_tpl_vars['row']['id']; ?>
</td>
							<td class="center"><?php echo $this->_tpl_vars['row']['rolename']; ?>
</td>
							<td class="center"><?php echo $this->_tpl_vars['row']['remark']; ?>
</td>
							<td class="center">
							<?php if ($this->_tpl_vars['setroletrans_flg']): ?>
								<a class="btn btn-info" href="<?php echo $this->_tpl_vars['admin']; ?>
role_edit?id=<?php echo $this->_tpl_vars['row']['id']; ?>
">
									<i class="glyphicon glyphicon-edit icon-white"></i>
									设置权限
								</a>
							<?php endif; ?>
							<?php if ($this->_tpl_vars['wcroleemployee_flg']): ?>
								<a class="btn btn-primary" href="<?php echo $this->_tpl_vars['admin']; ?>
role_user?id=<?php echo $this->_tpl_vars['row']['id']; ?>
">
									<i class="glyphicon glyphicon-user icon-white"></i>
									查看成员
								</a>
							<?php endif; ?>
							<?php if ($this->_tpl_vars['rmrole_flg']): ?>
								<a class="btn btn-danger" href="<?php echo $this->_tpl_vars['admin']; ?>
role_remove?id=<?php echo $this->_tpl_vars['row']['id']; ?>
">
									<i class="glyphicon glyphicon-trash icon-white"></i>
									删除权限组
								</a>
							<?php endif; ?>
							</td>
						</tr>
					<?php endforeach; endif; unset($_from); ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<!--/span-->

</div><!--/row-->
<!-- content ends -->
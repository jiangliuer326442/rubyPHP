<?php /* Smarty version 2.6.30, created on 2018-03-10 20:32:35
         compiled from admin/employee_list */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cat', 'admin/employee_list', 8, false),)), $this); ?>
<!-- content starts -->
<div>
	<ul class="breadcrumb">
		<li>
			<a href="/admin">首页</a>
		</li>
		<li>
			<a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['admin'])) ? $this->_run_mod_handler('cat', true, $_tmp, 'employee_list') : smarty_modifier_cat($_tmp, 'employee_list')); ?>
">员工列表</a>
		</li>
	</ul>
</div>
<div class="row">
	<div class="box col-md-12">
		<div class="box-inner">
			<div class="box-header well" data-original-title="">
				<h2><i class="glyphicon glyphicon-user"></i> 员工列表</h2>

				<div class="box-icon">
					<a href="#" class="btn btn-minimize btn-round btn-default"><i
							class="glyphicon glyphicon-chevron-up"></i></a>
					<a href="#" class="btn btn-close btn-round btn-default"><i
							class="glyphicon glyphicon-remove"></i></a>
				</div>
			</div>
			<div class="box-content">
			<?php if ($this->_tpl_vars['addemployee_flg']): ?>
				<a class="btn btn-info ajax-link" href="<?php echo $this->_tpl_vars['admin']; ?>
employee_add" role="button">添加人员</a>
			<?php endif; ?>
				<table class="table table-striped table-bordered responsive">
					<thead>	
						<tr>	
							<th>ID</th>
							<th>姓名</th>
							<th>手机号</th>
							<th>权限组</th>
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
							<td class="center"><?php echo $this->_tpl_vars['row']['realname']; ?>
</td>
							<td class="center"><?php echo $this->_tpl_vars['row']['phone']; ?>
</td>
							<td class="center"><?php echo $this->_tpl_vars['row']['role']; ?>
</td>
							<td class="center">
							<?php if ($this->_tpl_vars['setemployeerole_flg']): ?>
								<a class="btn btn-info" href="<?php echo $this->_tpl_vars['admin']; ?>
employee_role?id=<?php echo $this->_tpl_vars['row']['id']; ?>
">
									<i class="glyphicon glyphicon-lock icon-white"></i>
									修改权限组
								</a>
							<?php endif; ?>
							<?php if ($this->_tpl_vars['editemployee_flg']): ?>
								<a class="btn btn-danger deletes" href="javascript:;">
									<i class="glyphicon glyphicon-trash icon-white"></i>
									修改
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
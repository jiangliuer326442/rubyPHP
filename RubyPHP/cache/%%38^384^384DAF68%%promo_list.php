<?php /* Smarty version 2.6.30, created on 2018-03-06 11:03:16
         compiled from admin/promo_list */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cat', 'admin/promo_list', 8, false),)), $this); ?>
<!-- content starts -->
<div>
	<ul class="breadcrumb">
		<li>
			<a href="/admin">首页</a>
		</li>
		<li>
			<a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['admin'])) ? $this->_run_mod_handler('cat', true, $_tmp, 'promolist') : smarty_modifier_cat($_tmp, 'promolist')); ?>
">营销活动</a>
		</li>
	</ul>
</div>
<div class="row">
	<div class="box col-md-12">
		<div class="box-inner">
			<div class="box-header well" data-original-title="">
				<h2><i class="glyphicon glyphicon-magnet"></i> 营销活动列表</h2>

				<div class="box-icon">
					<a href="#" class="btn btn-minimize btn-round btn-default"><i
							class="glyphicon glyphicon-chevron-up"></i></a>
					<a href="#" class="btn btn-close btn-round btn-default"><i
							class="glyphicon glyphicon-remove"></i></a>
				</div>
			</div>
			<div class="box-content">
				<table class="table table-striped table-bordered responsive">
					<thead>	
						<tr>	
							<th>活动名称</th>
							<th>状态</th>
							<th>方式</th>
							<th>发送量</th>
							<th>完成量</th>
							<th>操作</th>
						</tr>
					</thead>
					<tbody id="tbody">
					<?php $_from = $this->_tpl_vars['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['row']):
?>
						<tr>
							<td><?php echo $this->_tpl_vars['row']['name']; ?>
</td>
							<td class="center">
								<?php if ($this->_tpl_vars['row']['status'] == "未开始"): ?>
								<a class="label-default label" <?php if ($this->_tpl_vars['promoact_chgstatus_flg']): ?>href="<?php echo $this->_tpl_vars['admin']; ?>
chgpromostatus?id=<?php echo $this->_tpl_vars['row']['id']; ?>
" data-toggle="tooltip"title="点击开始"<?php endif; ?>><?php echo $this->_tpl_vars['row']['status']; ?>
</a>
								<?php endif; ?>
								<?php if ($this->_tpl_vars['row']['status'] == "开始"): ?>
								<a class="label-success label" <?php if ($this->_tpl_vars['promoact_chgstatus_flg']): ?>href="<?php echo $this->_tpl_vars['admin']; ?>
chgpromostatus?id=<?php echo $this->_tpl_vars['row']['id']; ?>
" data-toggle="tooltip" title="点击暂停"<?php endif; ?>><?php echo $this->_tpl_vars['row']['status']; ?>
</a>
								<?php endif; ?>
								<?php if ($this->_tpl_vars['row']['status'] == "暂停"): ?>
								<a class="label-warning label" <?php if ($this->_tpl_vars['promoact_chgstatus_flg']): ?>href="<?php echo $this->_tpl_vars['admin']; ?>
chgpromostatus?id=<?php echo $this->_tpl_vars['row']['id']; ?>
" data-toggle="tooltip" title="点击开始"<?php endif; ?>><?php echo $this->_tpl_vars['row']['status']; ?>
</a>
								<?php endif; ?>
								<?php if ($this->_tpl_vars['row']['status'] == "结束"): ?>
								<a class="label-info label" <?php if ($this->_tpl_vars['promoact_chgstatus_flg']): ?>href="<?php echo $this->_tpl_vars['admin']; ?>
chgpromostatus?id=<?php echo $this->_tpl_vars['row']['id']; ?>
" data-toggle="tooltip" title="重新开始"<?php endif; ?>><?php echo $this->_tpl_vars['row']['status']; ?>
</a>
								<?php endif; ?>
							</td>
							<td class="center">
								<?php echo $this->_tpl_vars['row']['way']; ?>

							</td>
							<td class="center">
								<?php if ($this->_tpl_vars['row']['way'] == '短信'): ?>
								<?php echo $this->_tpl_vars['row']['total_msg_num']; ?>

								<?php elseif ($this->_tpl_vars['row']['way'] == '邮件'): ?>
								<?php echo $this->_tpl_vars['row']['total_mail_num']; ?>

								<?php else: ?>
								<?php echo $this->_tpl_vars['row']['total_msg_num']; ?>
/<?php echo $this->_tpl_vars['row']['total_mail_num']; ?>

								<?php endif; ?>
							</td>
							<td class="center">
								<?php if ($this->_tpl_vars['row']['way'] == '短信'): ?>
								<?php echo $this->_tpl_vars['row']['acture_msg_num']; ?>

								<?php elseif ($this->_tpl_vars['row']['way'] == '邮件'): ?>
								<?php echo $this->_tpl_vars['row']['acture_mail_num']; ?>

								<?php else: ?>
								<?php echo $this->_tpl_vars['row']['acture_msg_num']; ?>
/<?php echo $this->_tpl_vars['row']['acture_mail_num']; ?>

								<?php endif; ?>
							</td>
							<td class="center">
							<?php if ($this->_tpl_vars['promoact_edit_flg']): ?>
								<a class="btn btn-info" href="<?php echo $this->_tpl_vars['admin']; ?>
promoedit?id=<?php echo $this->_tpl_vars['row']['id']; ?>
">
									<i class="glyphicon glyphicon-edit icon-white"></i>
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
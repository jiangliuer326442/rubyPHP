<?php /* Smarty version 2.6.30, created on 2018-03-06 10:58:51
         compiled from admin/index.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cat', 'admin/index.html', 71, false),)), $this); ?>
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
		<!-- topbar starts -->
		<div class="navbar navbar-default" role="navigation">

			<div class="navbar-inner">
				<button type="button" class="navbar-toggle pull-left animated flip">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="/admin"> <img alt="Charisma Logo" src="<?php echo $this->_tpl_vars['base_path']; ?>
img/logo20.png" class="hidden-xs" />
					<span>卡拉布同事圈</span>
				</a>

				<!-- user dropdown starts -->
				<div class="btn-group pull-right">
					<button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <i class="glyphicon glyphicon-user"></i><span class="hidden-sm hidden-xs"> <?php echo $this->_tpl_vars['realname']; ?>
</span>
                    <span class="caret"></span>
                </button>
					<ul class="dropdown-menu">
						<li>
							<a href="javascript:;" class="logout">退出</a>
						</li>
					</ul>
				</div>
				<!-- user dropdown ends -->
				<div class="btn-group pull-right theme-container animated tada">
					<button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
						<i class="glyphicon glyphicon-tint"></i><span class="hidden-sm hidden-xs"> 变更主题</span>
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu" id="themes">
						<li><a data-value="classic" href="#"><i class="whitespace"></i> Classic</a></li>
						<li><a data-value="cerulean" href="#"><i class="whitespace"></i> Cerulean</a></li>
						<li><a data-value="cyborg" href="#"><i class="whitespace"></i> Cyborg</a></li>
						<li><a data-value="simplex" href="#"><i class="whitespace"></i> Simplex</a></li>
						<li><a data-value="darkly" href="#"><i class="whitespace"></i> Darkly</a></li>
						<li><a data-value="lumen" href="#"><i class="whitespace"></i> Lumen</a></li>
						<li><a data-value="slate" href="#"><i class="whitespace"></i> Slate</a></li>
						<li><a data-value="spacelab" href="#"><i class="whitespace"></i> Spacelab</a></li>
						<li><a data-value="united" href="#"><i class="whitespace"></i> United</a></li>
					</ul>
				</div>
			</div>
		</div>
		<!-- topbar ends -->
		<div class="ch-container">
			<div class="row">

				<!-- left menu starts -->
				<div class="col-sm-2 col-lg-2">
					<div class="sidebar-nav">
						<div class="nav-canvas">
							<div class="nav-sm nav nav-stacked">

							</div>
						<?php $_from = $this->_tpl_vars['column']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['row']):
?>
							<ul class="nav nav-pills nav-stacked main-menu">
								<li class="nav-header"><?php echo $this->_tpl_vars['row']['name']; ?>
</li>
							<?php $_from = $this->_tpl_vars['row']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['row2']):
?>
								<li>
									<a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['admin'])) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['row2']['url']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['row2']['url'])); ?>
"><i class="<?php echo $this->_tpl_vars['row2']['icon']; ?>
"></i><span> <?php echo $this->_tpl_vars['row2']['name']; ?>
</span></a>
								</li>
							<?php endforeach; endif; unset($_from); ?>
							</ul>
						<?php endforeach; endif; unset($_from); ?>
						</div>
					</div>
				</div>
				<!--/span-->
				<!-- left menu ends -->

				<div id="content" class="col-lg-10 col-sm-10">
					<?php if ($this->_tpl_vars['body']): ?>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ((is_array($_tmp="admin/")) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['body']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['body'])), 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<?php endif; ?>
				</div>
				<!--/#content.col-md-0-->
			</div>
			<!--/fluid-row-->

			<footer class="row">
				<p class="col-md-9 col-sm-9 col-xs-12 text-center copyright">&copy;
					<a href="https://github.com/jiangliuer326442/" target="_blank">社会化评论系统
					</a> 
				</p>
			</footer>

		</div>
		<!--/.fluid-container-->

	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/common_js", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	
		<script type="text/javascript">

			$(".logout").on('click',null, function(){
				$.cookie('admin_userid', null);
				$.cookie('admin_token', null);
				window.location.href = "<?php echo $this->_tpl_vars['admin']; ?>
login";
			});
		</script>
	</body>

</html>
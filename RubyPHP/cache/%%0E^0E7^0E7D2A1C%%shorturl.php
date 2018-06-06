<?php /* Smarty version 2.6.30, created on 2018-03-10 20:53:31
         compiled from admin/shorturl */ ?>
<!-- content starts -->
<div>
	<ul class="breadcrumb">
		<li>
			<a href="/admin">首页</a>
		</li>
		<li>
			<a href="<?php echo $this->_tpl_vars['admin']; ?>
cdn">生成短链</a>
		</li>
	</ul>
</div>
<div class=" row">
	<div class="box col-md-12">
		<div class="box-inner">
			<div class="box-header well" data-original-title="">
				<h2><i class="glyphicon glyphicon-retweet"></i>生成短链</h2>
			</div>
			<div class="box-content">
				<form role="form" method="post" class="form-horizontal col-sm-8">
					<?php if ($this->_tpl_vars['url']): ?>
					<div class="alert alert-success">
						<a href="#" class="close" data-dismiss="alert">&times;</a>
						<strong>成功！</strong><?php echo $this->_tpl_vars['url']; ?>

					</div>
					<?php endif; ?>
					<div class="control-group">
						<label class="col-sm-3 control-label" for="version">url地址</label>
						<div class="col-sm-9">
							<input type="url" class="form-control" id="url" placeholder="http或https开头" name="url" required />
						</div>
					</div>
					<div class="control-group">
						<div class="col-sm-offset-3 col-sm-9">
							<button id="shorturl_btn" class="btn btn-primary animated rubberBand">生成</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!--/span-->
</div>
<!-- content ends -->
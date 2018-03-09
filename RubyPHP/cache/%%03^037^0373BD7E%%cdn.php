<?php /* Smarty version 2.6.30, created on 2018-03-06 12:29:30
         compiled from admin/cdn */ ?>
<!-- content starts -->
<div>
	<ul class="breadcrumb">
		<li>
			<a href="/admin">首页</a>
		</li>
		<li>
			<a href="<?php echo $this->_tpl_vars['admin']; ?>
cdn">cdn刷新</a>
		</li>
	</ul>
</div>
<div class=" row">
	<div class="box col-md-12">
		<div class="box-inner">
			<div class="box-header well" data-original-title="">
				<h2><i class="glyphicon glyphicon-retweet"></i>cdn刷新</h2>
			</div>
			<div class="box-content">
				<form role="form" method="post" class="col-sm-8">
					<div class="control-group">
						<label class="control-label" for="version">需要刷新的url列表，一行一个</label>
						<div class="controls">
							<textarea class="autogrow" name="urls" style="width: 500px; min-height: 70px;"></textarea>
						</div>
					</div>
					<div class="control-group">
						<div class="col-sm-offset-3 col-sm-9">
							<button id="refresh_btn" class="btn btn-primary animated rubberBand">刷新</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!--/span-->
</div>
<!-- content ends -->
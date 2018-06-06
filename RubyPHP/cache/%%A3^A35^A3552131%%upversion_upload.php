<?php /* Smarty version 2.6.30, created on 2018-03-10 20:49:28
         compiled from admin/upversion_upload */ ?>
<!-- content starts -->
<div>
	<ul class="breadcrumb">
		<li>
			<a href="#">首页</a>
		</li>
		<li>
			<a href="#">升级包上传</a>
		</li>
	</ul>
</div>
<div class=" row">
	<div class="box col-md-12">
		<div class="box-inner">
			<div class="box-header well" data-original-title="">
				<h2><i class="glyphicon glyphicon-retweet"></i>升级包上传</h2>
			</div>
			<div class="box-content">
				<form role="form" method="post" enctype="multipart/form-data" class="form-horizontal col-sm-8">
					<div class="form-group">
						<label for="version" class="col-sm-3 control-label">版本号</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="version" name="version" placeholder="" required />
						</div>
					</div>
					<div class="form-group">
						<label for="apk" class="col-sm-3 control-label">APK文件包</label>
						<div class="col-sm-9">
							<input type="file" id="apk" name="apk">
						</div>
					</div>
					<div class="form-group">
						<label for="wgt" class="col-sm-3 control-label">WGT资源包</label>
						<div class="col-sm-9">
							<input type="file" id="wgt" name="wgt">
						</div>
					</div>
					<div class="form-group">
						<label for="minversion" class="col-sm-3 control-label">wgt最低适配版本</label>
						<div class="col-sm-9">
							<input type="number" class="form-control" id="minversion" name="minversion" placeholder="" required />
						</div>
					</div>
					<div class="form-group">
						<label for="remark" class="col-sm-3 control-label">资源简介</label>
						<div class="col-sm-9">
							<textarea class="form-control autogrow" id="remark" name="remark" rows="3"></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-offset-3 col-sm-9">
							<input type="checkbox" id="is_force" name="is_force" value="1"> 强制更新
						</label>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-9">
							<button id="wgt_uploader" class="btn btn-primary animated rubberBand">上传</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!--/span-->
</div>
<!-- content ends -->
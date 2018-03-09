<?php /* Smarty version 2.6.30, created on 2018-03-06 10:58:58
         compiled from admin/upversion_list */ ?>
<!-- content starts -->
<div>
	<ul class="breadcrumb">
		<li>
			<a href="/admin">首页</a>
		</li>
		<li>
			<a href="<?php echo $this->_tpl_vars['admin']; ?>
upversion_list">升级包列表</a>
		</li>
	</ul>
</div>
<div class="row">
	<div class="box col-md-12">
		<div class="box-inner">
			<div class="box-header well" data-original-title="">
				<h2><i class="glyphicon glyphicon-retweet"></i> 升级包列表</h2>

				<div class="box-icon">
					<a href="#" class="btn btn-minimize btn-round btn-default"><i
							class="glyphicon glyphicon-chevron-up"></i></a>
					<a href="#" class="btn btn-close btn-round btn-default"><i
							class="glyphicon glyphicon-remove"></i></a>
				</div>
			</div>
			<div class="box-content">
			<?php if ($this->_tpl_vars['upversion_flg']): ?>
				<a class="btn btn-info ajax-link" href="<?php echo $this->_tpl_vars['admin']; ?>
upversion_upload" role="button">上传升级包</a>
			<?php endif; ?>
				<table class="table table-striped table-bordered responsive">
					<thead>	
						<tr>	
							<th>版本号</th>
							<th>APK资源包</th>
							<th>WGT资源包</th>
							<th>强制升级</th>
							<th>上传时间</th>
							<th>操作</th>
						</tr>
					</thead>
					<tbody id="tbody">
					<?php $_from = $this->_tpl_vars['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['row']):
?>
						<tr data-id="<?php echo $this->_tpl_vars['row']['id']; ?>
" data-version="<?php echo $this->_tpl_vars['row']['version']; ?>
">
							<td><?php echo $this->_tpl_vars['row']['version']; ?>
</td>
							<td class="center"><a href="<?php echo $this->_tpl_vars['row']['apk_url']; ?>
" target="_blank">点击下载</a></td>
							<td class="center"><a href="<?php echo $this->_tpl_vars['row']['wgt_url']; ?>
" target="_blank">点击下载</a></td>
							<td class="center">
								<input data-no-uniform="true" type="checkbox" <?php if ($this->_tpl_vars['row']['force'] == 1): ?>checked="checked"<?php endif; ?> class="iphone-toggle">
							</td>
							<td class="center"><?php echo $this->_tpl_vars['row']['create_time']; ?>
</td>
							<td class="center">
							<?php if ($this->_tpl_vars['dlversion_flg']): ?>
								<a class="btn btn-danger deletes" href="<?php echo $this->_tpl_vars['admin']; ?>
upversion_delete?id=<?php echo $this->_tpl_vars['row']['id']; ?>
">
									<i class="glyphicon glyphicon-trash icon-white"></i>
									删除
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

<script type="text/javascript">

function setisforce(obj,is_checked){	
	$.ajax({
	    url: server+"setversionforce.jsp?",              //请求地址
	    type: "POST",                       //请求方式
	    data: { token: gettoken(), userid: localStorage.getItem('admin_userid'), id:$(event.target).parents("tr").attr("data-id"),force:is_checked?"1":"0"},        //请求参数
	    success: function(status, info, data){
	    	if(status == 200){
	    	}else if(status == 502){
	    		noty({text: info, layout: "center", timeout: 5000, type: "error"});
	    		setTimeout('window.location.href="login.html";',5000);
	    	}else{
	    		//$(obj).attr("checked", !is_checked);
	    		noty({text: info, layout: "center", timeout: 5000, type: "error"});
	    	}
	    }
	});
}

//删除某个版本
function deletepackage (event){
	if(typeof $(event.target).parents("tr").attr("data-version") != undefined){
		Ewin.confirm({ message: "删除版本‘"+$(event.target).parents("tr").attr("data-version")+"’后，该版本将无法更新，确认删除？" }).on(function (e) {
		   if (!e) {
		    return;
		   }
			common.ajax({
			    url: server+"dlversion.jsp",              //请求地址
			    type: "POST",                       //请求方式
			    data: { token: gettoken(), userid: common.getItem('admin_userid'), id:$(event.target).parents("tr").attr("data-id")},        //请求参数
			    success: function(status, info, data){
			    	if(status == 200){
			    		$(event.target).parents("tr").fadeOut();
			    	}
			    }.bind(this)
			});
		});
	}
}

</script>
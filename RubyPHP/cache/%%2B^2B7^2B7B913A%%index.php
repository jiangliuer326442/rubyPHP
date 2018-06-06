<?php /* Smarty version 2.6.30, created on 2018-03-19 19:22:48
         compiled from admin/index */ ?>
<div class=" row">
	<div class="col-md-3 col-sm-3 col-xs-6">
		<a data-toggle="tooltip" title="6 new members." class="well top-block" href="#">
			<i class="glyphicon glyphicon-user blue"></i>
			<div>注册用户</div>
			<div><?php echo $this->_tpl_vars['user_count']; ?>
</div>
			<span class="notification"><?php echo $this->_tpl_vars['today_user_count']; ?>
</span>
		</a>
	</div>
	<div class="col-md-3 col-sm-3 col-xs-6">
		<a data-toggle="tooltip" title="4 new pro members." class="well top-block" href="#">
			<i class="glyphicon glyphicon-star green"></i>
			<div>企业数</div>
			<div><?php echo $this->_tpl_vars['company_count']; ?>
</div>
		</a>
	</div>
</div>
<div class="row">
	<div class="box col-md-12">
		<div class="box-inner">
			<div class="box-header well">
				<h2><i class="glyphicon glyphicon-info-sign"></i> 推广统计</h2>
				<div class="box-icon">
					<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
					<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
					<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
				</div>
			</div>
			<div class="box-content">
				<div id="sincos" class="center" style="height:300px"></div>
					<p id="hoverdata">Mouse position at (<span id="x">0</span>, <span id="y">0</span>). <span id="clickdata"></span></p>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="<?php echo $this->_tpl_vars['base_path']; ?>
bower_components/flot/excanvas.min.js"></script>
<script src="<?php echo $this->_tpl_vars['base_path']; ?>
bower_components/flot/jquery.flot.js"></script>
<script src="<?php echo $this->_tpl_vars['base_path']; ?>
bower_components/flot/jquery.flot.pie.js"></script>
<script src="<?php echo $this->_tpl_vars['base_path']; ?>
bower_components/flot/jquery.flot.stack.js"></script>
<script src="<?php echo $this->_tpl_vars['base_path']; ?>
bower_components/flot/jquery.flot.resize.js"></script>

<script type="text/javascript">
if ($("#sincos").length) {
    var log_list = []

	<?php $_from = $this->_tpl_vars['promo_log_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['index'] => $this->_tpl_vars['row']):
?> 
        log_list.push([<?php echo $this->_tpl_vars['index']; ?>
, <?php echo $this->_tpl_vars['row']['num']; ?>
]);
	<?php endforeach; endif; unset($_from); ?>

    var plot = $.plot($("#sincos"),
        [
            { data: log_list, label: "点击量"}
        ], {
            series: {
                lines: { show: true  },
                points: { show: true }
            },
            grid: { hoverable: true, clickable: true, backgroundColor: { colors: ["#fff", "#eee"] } },
            colors: ["#539F2E", "#3C67A5"]
        });

    function showTooltip(x, y, contents) {
        $('<div id="tooltip">' + contents + '</div>').css({
            position: 'absolute',
            display: 'none',
            top: y + 5,
            left: x + 5,
            border: '1px solid #fdd',
            padding: '2px',
            'background-color': '#dfeffc',
            opacity: 0.80
        }).appendTo("body").fadeIn(200);
    }

    var previousPoint = null;
    $("#sincos").bind("plothover", function (event, pos, item) {
        $("#x").text(pos.x.toFixed(2));
        $("#y").text(pos.y.toFixed(2));

        if (item) {
            if (previousPoint != item.dataIndex) {
                previousPoint = item.dataIndex;

                $("#tooltip").remove();
                var x = item.datapoint[0].toFixed(2),
                    y = item.datapoint[1].toFixed(2);

                showTooltip(item.pageX, item.pageY,
                    item.series.label + " of " + x + " = " + y);
            }
        }
        else {
            $("#tooltip").remove();
            previousPoint = null;
        }
    });


    $("#sincos").bind("plotclick", function (event, pos, item) {
        if (item) {
            $("#clickdata").text("You clicked point " + item.dataIndex + " in " + item.series.label + ".");
            plot.highlight(item.series, item.datapoint);
        }
    });
}
</script>
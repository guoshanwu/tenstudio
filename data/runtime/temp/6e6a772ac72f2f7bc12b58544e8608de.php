<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:44:"themes/admin_simpleboot3/back\order\add.html";i:1535257002;s:88:"E:\phpStudy\PHPTutorial\WWW\tenstudio\public\themes\admin_simpleboot3\public\header.html";i:1529968519;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <!-- Set render engine for 360 browser -->
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- HTML5 shim for IE8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <![endif]-->


    <link href="/themes/admin_simpleboot3/public/assets/themes/<?php echo cmf_get_admin_style(); ?>/bootstrap.min.css" rel="stylesheet">
    <link href="/themes/admin_simpleboot3/public/assets/simpleboot3/css/simplebootadmin.css" rel="stylesheet">
    <link href="/static/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        form .input-order {
            margin-bottom: 0px;
            padding: 0 2px;
            width: 42px;
            font-size: 12px;
        }

        form .input-order:focus {
            outline: none;
        }

        .table-actions {
            margin-top: 5px;
            margin-bottom: 5px;
            padding: 0px;
        }

        .table-list {
            margin-bottom: 0px;
        }

        .form-required {
            color: red;
        }
    </style>
    <script type="text/javascript">
        //全局变量
        var GV = {
            ROOT: "/",
            WEB_ROOT: "/",
            JS_ROOT: "static/js/",
            APP: '<?php echo \think\Request::instance()->module(); ?>'/*当前应用名*/
        };
    </script>
    <script src="/themes/admin_simpleboot3/public/assets/js/jquery-1.10.2.min.js"></script>
    <script src="/static/js/wind.js"></script>
    <script src="/themes/admin_simpleboot3/public/assets/js/bootstrap.min.js"></script>
    <script>
        Wind.css('artDialog');
        Wind.css('layer');
        $(function () {
            $("[data-toggle='tooltip']").tooltip({
                container:'body',
                html:true,
            });
            $("li.dropdown").hover(function () {
                $(this).addClass("open");
            }, function () {
                $(this).removeClass("open");
            });
        });
    </script>
    <?php if(APP_DEBUG): ?>
        <style>
            #think_page_trace_open {
                z-index: 9999;
            }
        </style>
    <?php endif; ?>
</head>
<body>
<div class="wrap js-check-wrap">
	<ul class="nav nav-tabs">
		<li><a href="javascript:history.back(-1)">订单列表</a></li>
		<li class="active"><a>添加订单</a></li>
		<!--<li><a  href="<?php echo url('nav/edit'); ?>" ><?php echo lang('ADMIN_NAV_EDIT'); ?></a></li>-->
	</ul>
	<form method="post" class="form-horizontal js-ajax-form margin-top-20" action="<?php echo url(request()->action()); ?>">
		<input type="hidden" name="action" value="<?php echo $action; ?>">
		<div class="form-group">
			<label class="col-sm-2 control-label"><span class="form-required">*</span>客户姓名:</label>
			<div class="col-md-6 col-sm-10">
				<input type="text" class="form-control" name="name" value="" required>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">宝宝性别:</label>
			<div class="col-md-6 col-sm-10">
				<label class="radio-inline">
					<input type="radio" name="sex" value="1" checked> 男
				</label>
				<label class="radio-inline">
					<input type="radio" name="sex" value="2"> 女
				</label>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">电话号码:</label>
			<div class="col-md-6 col-sm-10">
				<input type="text" class="form-control" name="tel" value="">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">宝宝年龄:</label>
			<div class="col-md-6 col-sm-10">
				<input type="text" class="form-control" name="age" value="">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">套餐:</label>
			<div class="col-md-6 col-sm-10">
				<select name="setmeal_id" class="form-control">
					<?php if(is_array($setmeal) || $setmeal instanceof \think\Collection || $setmeal instanceof \think\Paginator): $i = 0; $__LIST__ = $setmeal;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
						<option value="<?php echo $vo['id']; ?>"><?php echo $vo['name']; ?></option>
					<?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">下单时间:</label>
			<div class="col-md-6 col-sm-10">
				<input type="text" class="form-control js-bootstrap-datetime" name="add_time" required>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">拍摄时间:</label>
			<div class="col-md-6 col-sm-10">
				<input type="text" class="form-control js-bootstrap-datetime" name="order_time">
			</div>
		</div>
		<!--<div class="form-group">-->
			<!--<label class="col-sm-2 control-label">发相日期:</label>-->
			<!--<div class="col-md-6 col-sm-10">-->
				<!--<input type="text" class="form-control js-bootstrap-datetime" name="send_photo_time">-->
			<!--</div>-->
		<!--</div>-->
		<!--<div class="form-group">-->
			<!--<label class="col-sm-2 control-label">选相日期:</label>-->
			<!--<div class="col-md-6 col-sm-10">-->
				<!--<input type="text" class="form-control js-bootstrap-datetime" name="opt_photo_time">-->
			<!--</div>-->
		<!--</div>-->
		<!--<div class="form-group">-->
			<!--<label class="col-sm-2 control-label">下厂日期:</label>-->
			<!--<div class="col-md-6 col-sm-10">-->
				<!--<input type="text" class="form-control js-bootstrap-datetime" name="lower_factory_time">-->
			<!--</div>-->
		<!--</div>-->
		<!--<div class="form-group">-->
			<!--<label class="col-sm-2 control-label">通知客户取相:</label>-->
			<!--<div class="col-md-6 col-sm-10">-->
				<!--<label class="radio-inline">-->
					<!--<input type="radio" name="is_notice" value="0" checked> 否-->
				<!--</label>-->
				<!--<label class="radio-inline">-->
					<!--<input type="radio" name="is_notice" value="2"> 是-->
				<!--</label>-->
			<!--</div>-->
		<!--</div>-->
		<!--<div class="form-group">-->
			<!--<label class="col-sm-2 control-label">已签收:</label>-->
			<!--<div class="col-md-6 col-sm-10">-->
				<!--<label class="radio-inline">-->
					<!--<input type="radio" name="status" value="0" checked> 否-->
				<!--</label>-->
				<!--<label class="radio-inline">-->
					<!--<input type="radio" name="status" value="2"> 是-->
				<!--</label>-->
			<!--</div>-->
		<!--</div>-->
		<div class="form-group">
			<label class="col-sm-2 control-label">备注:</label>
			<div class="col-md-6 col-sm-10">
				<textarea name="remark" style="width: 100%; height: 200px;"></textarea>
			</div>
		</div>
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-primary js-ajax-submit"><?php echo lang("SAVE"); ?></button>
			<a class="btn btn-default" href="/back/order">返回</a>
		</div>
	</form>

</div>
<script src="/static/js/admin.js"></script>
</body>
</html>
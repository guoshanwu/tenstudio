<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:46:"themes/admin_simpleboot3/back\order\lists.html";i:1535256949;s:88:"E:\phpStudy\PHPTutorial\WWW\tenstudio\public\themes\admin_simpleboot3\public\header.html";i:1529968519;}*/ ?>
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
<div class="wrap">
    <ul class="nav nav-tabs">
        <li class="active"><a href="<?php echo url(request()->action()); ?>">订单列表</a></li>
        <?php if($action == 'hang'): ?>
            <li><a href="<?php echo url('add', ['action'=>$action]); ?>">添加订单</a></li>
        <?php endif; ?>
    </ul>
    <div class="margin-top-20">总订单数量: <span style="margin-left: 10px;" class="text-success"><?php echo $count; ?></span></div>
    <form class="well form-inline margin-top-20" method="post" action="<?php echo url(request()->action()); ?>">
        <input type="text" class="form-control" name="name" style="width: 120px;"
               value="<?php echo (isset($name) && ($name !== '')?$name:''); ?>" placeholder="客户姓名...">
        套餐:
        <select class="form-control" name="setmeal_id" style="width: 140px;">
            <option value="">全部</option>
            <?php if(is_array($meal) || $meal instanceof \think\Collection || $meal instanceof \think\Paginator): $i = 0; $__LIST__ = $meal;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <option value="<?php echo $vo['id']; ?>"><?php echo $vo['name']; ?></option>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </select> &nbsp;&nbsp;
        下单时间:
        <input type="text" class="form-control js-bootstrap-datetime" name="add_time_start"
               value="<?php echo (isset($add_time_start) && ($add_time_start !== '')?$add_time_start:''); ?>"
               style="width: 140px;" autocomplete="off"> -
        <input type="text" class="form-control js-bootstrap-datetime" name="add_time_end"
               value="<?php echo (isset($add_time_end) && ($add_time_end !== '')?$add_time_end:''); ?>"
               style="width: 140px;" autocomplete="off"> &nbsp;
        拍摄时间:
        <input type="text" class="form-control js-bootstrap-datetime" name="order_time_start"
               value="<?php echo (isset($order_time_start) && ($order_time_start !== '')?$order_time_start:''); ?>"
               style="width: 140px;" autocomplete="off"> -
        <input type="text" class="form-control js-bootstrap-datetime" name="order_time_end"
               value="<?php echo (isset($order_time_end) && ($order_time_end !== '')?$order_time_end:''); ?>"
               style="width: 140px;" autocomplete="off"> &nbsp;&nbsp;
        <input type="submit" class="btn btn-primary" value="搜索"/>
        <a class="btn btn-danger" href="<?php echo url(request()->action()); ?>">清空</a>
    </form>
    <form method="post" class="js-ajax-form margin-top-20">
        <table class="table table-hover table-bordered table-list">
            <thead>
            <tr>
                <th>客户姓名</th>
                <th>电话号码</th>
                <th>套餐</th>
                <th>下单日期</th>
                <th>拍摄时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
                <?php if(is_array($result) || $result instanceof \think\Collection || $result instanceof \think\Paginator): if( count($result)==0 ) : echo "" ;else: foreach($result as $key=>$vo): ?>
                    <tr>
                        <td><?php echo $vo['name']; ?></td>
                        <td><?php echo $vo['tel']; ?></td>
                        <td><?php echo $setmeal[$vo['setmeal_id']]; ?></td>
                        <td><?php echo $vo['add_time']; ?></td>
                        <td><?php echo showTime($vo['order_time']); ?></td>
                        <td>
                            <a href="<?php echo url('edit',array('action'=>$action,'id'=>$vo['id'])); ?>" class="btn btn-sm btn-info"><?php echo lang('EDIT'); ?></a>
                            <!--<a href="<?php echo url('delete',array('id'=>$vo['id'])); ?>" class="js-ajax-delete btn btn-sm btn-danger"><?php echo lang('DELETE'); ?></a>-->
                        </td>
                    </tr>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
        </table>
    </form>
    <ul class="pagination"><?php echo (isset($page) && ($page !== '')?$page:''); ?></ul>
</div>
<script src="/static/js/admin.js"></script>
</body>
</html>
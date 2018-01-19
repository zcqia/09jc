<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:55:"C:\wamp64\www/./application/admin\view\login\login.html";i:1516350158;}*/ ?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>09剧场后台管理 - 登录</title>
    <meta name="keywords" content="H+后台主题,后台bootstrap框架,会员中心主题,后台HTML,响应式后台">
    <meta name="description" content="H+是一个完全响应式，基于Bootstrap3最新版本开发的扁平化主题，她采用了主流的左右两栏式布局，使用了Html5+CSS3等现代技术">

    <link rel="shortcut icon" href="favicon.ico"> <link href="/public/static/H+/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="/public/static/H+/css/font-awesome.css?v=4.4.0" rel="stylesheet">

    <link href="/public/static/H+/css/animate.css" rel="stylesheet">
    <link href="/public/static/H+/css/style.css?v=4.1.0" rel="stylesheet">
    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->
    <script>if(window.top !== window.self){ window.top.location = window.location;}</script>
</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen  animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name">09</h1>

            </div>
            <h3></h3>

            <form class="m-t" role="form" action="index.html">
                <div class="form-group">
                    <input type="name" id="name" name="name" class="form-control" placeholder="用户名" required="">
                </div>
                <div class="form-group">
                    <input type="password" id="password" name="password" class="form-control" placeholder="密码" required="">
                </div>
                <button onClick="article_save();" type="button" class="btn btn-primary block full-width m-b">登 录</button>

            </form>
        </div>
    </div>

    <!-- 全局js -->
    <script src="/public/static/H+/js/jquery.min.js?v=2.1.4"></script>
    <script src="/public/static/H+/js/bootstrap.min.js?v=3.3.6"></script>
    <script type="text/javascript" src="/public/static/lib/layer/2.4/layer.js"></script>


<script type="text/javascript">
function article_save(){
    $.ajax({
        type: 'POST',
        url: "<?php echo url('admin/login/login_data'); ?>",
        data: {name:$('#name').val(),password:$('#password').val()},
        dataType: 'json',
        success: function(data){
            if(data == 0){
                layer.msg('用户名或密码错误!',{icon:1,time:1000});
            }else{
                layer.msg('登录成功!',{icon:1,time:1000});
                window.location.href="<?php echo url('admin/index/index'); ?>";
            }
        },
        error:function(data){
            layer.msg('登录失败!',{icon:2,time:1000});
        },
    }); 
}
</script>
</body>
</html>

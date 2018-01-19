<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:56:"C:\wamp64\www/./application/admin\view\weichat\show.html";i:1516355233;}*/ ?>
﻿<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link rel="Bookmark" href="/favicon.ico" >
<link rel="Shortcut Icon" href="/favicon.ico" />
<!--[if lt IE 9]>
<script type="text/javascript" src="/public/static/lib/html5shiv.js"></script>
<script type="text/javascript" src="/public/static/lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="/public/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/public/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/public/static/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/public/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/public/static/h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="/public/static/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>管理员列表</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 微信公众号 <span class="c-gray en">&gt;</span> 演出排期 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="cl pd-5 bg-1 bk-gray mt-0"> <span class="l"><a href="javascript:;" onclick="admin_add('添加','<?php echo url('admin/weichat/show_add'); ?>','800','500')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加</a></span> </div>
	<table class="table table-border table-bordered table-bg">
		<thead>
			<tr class="text-c">
				<th width="60">演出剧照</th>
				<th width="100">演出标题</th>
				<th width="">演出时间</th>
				<th width="">演出人员</th>
				<th width="400">演出简介</th>
				<th width="80">操作</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($data as $v): ?>
			<tr class="text-l">
				<td><img style="width:100%" src="<?php $re=explode('|',$v['show_img_path']);echo $re[0]; ?>"></td>
				<td><?php echo $v['show_title']; ?></td>
				<td><?php echo $v['show_time']; ?></td>
				<td><?php echo $v['shower_name']; ?></td>
				<td id="jianjie" style="cursor: pointer;"><span style="display:block;float:left;" id="desc"><?php if(strlen($v['show_describe']) > 87){
								  $str=$v['show_describe'];
								  $str=mb_substr($str,0,19,'utf-8'); 
								  if(substr($str,strlen($str)-3,strlen($str)) == '。'){
									 echo substr($str,0,strlen($str)-3).'...';
								  }else if(substr($str,strlen($str)-1,strlen($str)) == '?'){
									 echo substr($str,0,strlen($str)-1).'...';
								  }else{
								     echo $str.'...';
								  }
						  		}else{
								  echo $v['show_describe'];
						  		}
						  ?></span><span id="more" style="color:white;display:block;float:right;">更多</span></td>
				<td class="td-manage text-c"><a title="删除" href="javascript:;" onclick="admin_del(this,'<?php echo $v['show_id']; ?>')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
			</tr>
	 	<input type="hidden" id="show_desc" name="show_desc" value="<?php echo $v['show_describe']; ?>">
	 	<input type='hidden' id="str3" value="0">
	 	<?php endforeach; ?>
		</tbody>
	</table>
</div>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/public/static/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/public/static/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/public/static/h-ui/js/H-ui.min.js"></script> 
<script type="text/javascript" src="/public/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/public/static/lib/My97DatePicker/4.8/WdatePicker.js"></script> 
<script type="text/javascript" src="/public/static/lib/datatables/1.10.0/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="/public/static/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">
var str=$('#desc').text();
var str2=$('#show_desc').val();
var str3=$('#str3').val();

if(str.substr(str.length-3,3) == '...'){
	$('#more').css('color','rgb(102, 126, 206)');
}

$('#more').click(function(){
	$('#more').remove();
	$('#desc').text(str2);
});

$('#jianjie').click(function(){
	if($('#str3').val() == '0'){
		$('#more').remove();
		$('#desc').text(str2);
		$('#str3').val(1);
	}else{
		$('#desc').text(str);
		$('#str3').val(0);
	}
});


/*
	参数解释：
	title	标题
	url		请求的url
	id		需要操作的数据id
	w		弹出层宽度（缺省调默认值）
	h		弹出层高度（缺省调默认值）
*/
/*管理员-增加*/
function admin_add(title,url,w,h){
	layer_show(title,url,w,h);
}
/*管理员-删除*/
function admin_del(obj,show_id){
	layer.confirm('确认要删除吗？',function(index){
		$.ajax({
			type: 'POST',
			url: "<?php echo url('admin/weichat/show_del_data'); ?>",
			dataType: 'json',
			data: {show_id:show_id},
			success: function(data){
				$(obj).parents("tr").remove();
				layer.msg('已删除!',{icon:1,time:1000});
			},
			error:function(data) {
				layer.msg('删除失败!',{icon:2,time:1000});
			},
		});		
	});
}

/*管理员-编辑*/
function admin_edit(title,url,id,w,h){
	layer_show(title,url,w,h);
}
/*管理员-停用*/
function admin_stop(obj,id){
	layer.confirm('确认要停用吗？',function(index){
		//此处请求后台程序，下方是成功后的前台处理……
		
		$(obj).parents("tr").find(".td-manage").prepend('<a onClick="admin_start(this,id)" href="javascript:;" title="启用" style="text-decoration:none"><i class="Hui-iconfont">&#xe615;</i></a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">已禁用</span>');
		$(obj).remove();
		layer.msg('已停用!',{icon: 5,time:1000});
	});
}

/*管理员-启用*/
function admin_start(obj,id){
	layer.confirm('确认要启用吗？',function(index){
		//此处请求后台程序，下方是成功后的前台处理……
		
		
		$(obj).parents("tr").find(".td-manage").prepend('<a onClick="admin_stop(this,id)" href="javascript:;" title="停用" style="text-decoration:none"><i class="Hui-iconfont">&#xe631;</i></a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
		$(obj).remove();
		layer.msg('已启用!', {icon: 6,time:1000});
	});
}
</script>
</body>
</html>
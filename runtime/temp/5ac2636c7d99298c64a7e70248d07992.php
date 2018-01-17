<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:75:"C:\wamp64\www\09juchang\public/../application/weichat\view\index\index.html";i:1516153087;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<!-- 移动端屏幕的缩放,使用设备的宽度作为视图宽度并禁止初始的缩放 -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>09剧场</title>
	<link href="/static/weichat/css/master.css" rel="stylesheet" type="text/css">
	<link href="/static/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
</head>
<body>
	<!-- <div class="nav_mob"><span>09剧场</span></div> -->
	<div class="main_mob">
		<!-- <div id="focus" class="pic_mob"><img src="/static/weichat/img/big_img_mob.jpg"><img src="/static/weichat/img/big_img_mob2.jpg"></div>
		<div class="change_pic"><div></div><div></div><div></div></div> -->
		<?php foreach($data as $v): ?>
		<div class="show_mob">
			<div class="show_img click_detail">
				<input type="hidden" value="<?php echo $v['show_id']; ?>">
				<input type="hidden" value="<?php echo $v['shower_name']; ?>"><img src="<?php echo $v['show_img_path']; ?>"></div>
			<div class="show_content click_detail">
				<div><span><b><?php echo $v['show_title']; ?></b></span></div>
				<div>主演:<?php if(strlen($v['shower_name']) > 26){
								  $str=$v['shower_name'];
								  $str=mb_substr($str,0,10,'utf-8'); 
								  if(substr($str,strlen($str)-1,strlen($str)) == ','){
									 echo substr($str,0,strlen($str)-1).'...';
								  }else{
								     echo $str.'...';
								  }
						  		}else{
								  echo $v['shower_name'];
						  		}
						  ?></div>
				<div>场次:<?php 
					if(substr($v['show_time'],5,1) == 0){
						if(substr($v['show_time'],8,1) == 0){
							echo substr($v['show_time'],6,1).'月'.substr($v['show_time'],9,1).'日'.substr($v['show_time'],10,6);
						}else{
							echo substr($v['show_time'],6,1).'月'.substr($v['show_time'],8,2).'日'.substr($v['show_time'],10,6);
						}
					}else{
						if(substr($v['show_time'],8,1) == 0){
							echo substr($v['show_time'],5,2).'月'.substr($v['show_time'],9,1).'日'.substr($v['show_time'],10,6);
						}else{
							echo substr($v['show_time'],5,2).'月'.substr($v['show_time'],8,2).'日'.substr($v['show_time'],10,6);
						}
					} 
					?></div>
				<input type="hidden" value="<?php echo $v['show_id']; ?>">
				<input type="hidden" value="<?php echo $v['shower_name']; ?>">
			</div>
			<div class="show_button">
			<input type="hidden" value="<?php echo $v['show_id']; ?>"><input type="hidden" value="<?php echo $v['shower_name']; ?>"><span>取票</span></div>
		</div>
		<?php endforeach; ?>
	</div>
</body>
	<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
	<script type="text/javascript">
		$('.show_button').click(function(){
			var show_id=$(this).find('input').eq(0).val();
			var shower_name=$(this).find('input').eq(1).val();
			location.href="<?php echo url('weichat/index/shop_cart'); ?>/show_id/"+show_id+"/shower_name/"+shower_name;
		});
		$('.click_detail').click(function(){
			var show_id=$(this).find('input').eq(0).val();
			var shower_name=$(this).find('input').eq(1).val();
			location.href="<?php echo url('weichat/index/buytail'); ?>/show_id/"+show_id+"/shower_name/"+shower_name;
		});

		//将script写在最底部避免js阻塞页面加载
		var index=0;//当前显示的第几张图，默认开始为0；
		var mg=$("#focus");//将焦点图储存为一个变量方便调用节省下载调用查询时间。
		var len=mg.children('img').length;//焦点图图片数量
		
 //alert(len);
		function play(n){
			//alert(1);
			mg.children('img').eq(n).fadeIn(200).siblings("img").fadeOut(200);
		//eq表示第几个标签里面的n就是代表的第几个img标签是从0开始数的。这里用siblings而不是先hide全部在fadein，siblings代表的是除开当前标签以外的所有同级标签。使用siblings来处理这样的情况速度会比你老师写的快很多倍。简单来讲siblings就是除开当前显示的这个以外的所有统计图片全部fadeOut
		}
		 
		setInterval(function(){
			play(index);
			index++;
			if(index == len){
				index=0;
			}
		},3000);
	</script>
</html>
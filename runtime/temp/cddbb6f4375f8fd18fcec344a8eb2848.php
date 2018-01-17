<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:75:"C:\wamp64\www\09juchang\public/../application/weichat\view\buy\buylist.html";i:1515378551;}*/ ?>
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
	<div class="main_mob">
		<?php foreach($data as $v): ?>
		<div class="show_mob">
			<div class="show_img"><img src="<?php echo $v['show_img_path']; ?>"></div>
			<div class="show_content3">
				<div><span><b><?php echo $v['show_title']; ?></b></span></div>
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
			</div>
			<div class="show_button2"><span>2</span></div>
			<div class="show_min"><span>–</span></div>
			<div class="show_max"><span>+</span></div>
		</div>
		<?php endforeach; ?>
		<div class="footer_buy_mob2">
			<div>已选 (2)</div>
			<div>取票</div>
		</div>
	</div>
</body>
</html>
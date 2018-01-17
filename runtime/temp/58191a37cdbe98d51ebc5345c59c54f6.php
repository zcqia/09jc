<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:63:"C:\wamp64\www\09juchang/./application/weichat\view\buy\buy.html";i:1515464447;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<!-- 移动端屏幕的缩放,使用设备的宽度作为视图宽度并禁止初始的缩放 -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>09剧场</title>
	<link href="/09juchang/static/weichat/css/master.css" rel="stylesheet" type="text/css">
	<link href="/09juchang/static/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
</head>
<body>
	<!-- <div class="nav_mob"><span>09剧场</span></div> -->
	<div class="main_mob">
		<div class="pic_mob"><img src="/09juchang/static/weichat/img/big_img_mob.jpg"><div></div><div></div><div></div></div>
		<?php foreach($data as $v): ?>
		<div class="show_mob">
			<div class="show_img"><img src="<?php echo $v['show_img_path']; ?>"></div>
			<div class="show_content">
				<div><span><b><?php echo $v['show_title']; ?></b></span></div>
				<div>主演:<?php echo $v['shower_name']; ?></div>
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
			<input type="hidden" value="<?php echo $v['show_id']; ?>"><input type="hidden" value="<?php echo $v['shower_name']; ?>"><span>购票</span></div>
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
		$('.show_content').click(function(){
			var show_id=$(this).find('input').eq(0).val();
			var shower_name=$(this).find('input').eq(1).val();
			location.href="<?php echo url('weichat/index/buytail'); ?>/show_id/"+show_id+"/shower_name/"+shower_name;
		});
	</script>
</html>
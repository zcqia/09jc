<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:79:"C:\wamp64\www\09juchang\public/../application/weichat\view\buy\transaction.html";i:1515462733;}*/ ?>
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
		<?php $i=0; foreach($data as $v): ?>
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
					<div><span style="color:rgb(180,180,180)">取票号:</span><span><b><?php echo $v['order_number']; ?></b></span></div>
			</div>
			<input class="order_number" type="hidden" value="<?php echo $v['order_number']; ?>">
			<div class="show_right">退票</div>
		</div><?php $i++; endforeach; ?>
	</div>
</body>
	<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
	<script type="text/javascript">
		$('.show_right').click(function(){
			var order_number=$(this).siblings('.order_number').val();
			var obj=$(this);
			$.ajax({
				type: 'POST',
				url: '<?php echo url('weichat/buy/transaction_del'); ?>',
				dataType: 'json',
				data: {order_number:order_number},
				success: function(data){
					obj.parents('.show_mob').remove();
				},
				error:function(data) {
					console.log(data.msg);
				},
			});
		});
	</script>
</html>
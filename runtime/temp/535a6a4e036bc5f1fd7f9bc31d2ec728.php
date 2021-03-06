<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:79:"C:\wamp64\www\09juchang\public/../application/weichat\view\index\shop_cart.html";i:1515580716;}*/ ?>
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
			<div class="show_img click_detail"><img src="<?php echo $v['show_img_path']; ?>"></div>
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
			</div>
			<div class="show_button2"><span><?php echo $count[$i]['num']; ?></span></div>
			<div class="show_min"><span>–</span></div>
			<div class="show_max"><span>+</span></div>
			<div class="show_del"><span>删除</span></div>
			<input class="show_id" type="hidden" value="<?php echo $v['show_id']; ?>">
			<input class="shower_name" type="hidden" value="<?php echo $v['shower_name']; ?>">
		</div><?php $i++; endforeach; ?>
		<div class="footer_buy_mob2">
			<div>已选 (<span>0</span>)</div>
			<div>选票</div>
			<div>取票</div>
		</div>
	</div>
</body>
	<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
	<script type="text/javascript">
		$('.footer_buy_mob2 div:eq(2)').click(function(){
			location.href="<?php echo url('weichat/index/transaction'); ?>";
		});
		$('.show_del').click(function(){
			var show_id=$(this).siblings('.show_id').val();
			var obj=$(this);
			$.ajax({
				type: 'POST',
				url: '<?php echo url('weichat/index/shop_cart_del'); ?>',
				dataType: 'json',
				data: {show_id:show_id},
				success: function(data){
					obj.parents('.show_mob').remove();

					var num=0;
					for(var i=0;i<$('.show_button2').length;i++){
						num+=parseInt($('.show_button2 span:eq('+i+')').html());
					}
					$('.footer_buy_mob2 div:eq(0) span').html(num);
				},
				error:function(data) {
					console.log(data.msg);
				},
			});		
		});
		
		
		var num=0;
		for(var i=0;i<$('.show_button2').length;i++){
			num+=parseInt($('.show_button2 span:eq('+i+')').html());
		}
		$('.footer_buy_mob2 div:eq(0) span').html(num);

		$('.show_min').click(function(){
			//var ticket_num=$(this).prev().find('span').html();
			var show_id=$(this).siblings('.show_id').val();
			var obj=$(this);
			$.ajax({
				type: 'POST',
				url: '<?php echo url('weichat/index/shop_cart_min'); ?>',
				dataType: 'json',
				data: {show_id:show_id},
				success: function(data){
					var ticket_num=obj.prev().find('span').html();
					if(ticket_num-1 <1){
						obj.parents('.show_mob').remove();
					}else{
						obj.prev().find('span').html(ticket_num-1);
					}

					var num=0;
					for(var i=0;i<$('.show_button2').length;i++){
						num+=parseInt($('.show_button2 span:eq('+i+')').html());
					}
					$('.footer_buy_mob2 div:eq(0) span').html(num);
				},
				error:function(data) {
					console.log(data.msg);
				},
			});
		});

		$('.show_max').click(function(){
			//var ticket_num=$(this).prev().find('span').html();
			var show_id=$(this).siblings('.show_id').val();
			var shower_name=$(this).siblings('.shower_name').val();
			var obj=$(this);
			$.ajax({
				type: 'POST',
				url: '<?php echo url('weichat/index/shop_cart_max'); ?>',
				dataType: 'json',
				data: {show_id:show_id,shower_name:shower_name},
				success: function(data){
					var ticket_num=obj.siblings('.show_button2').find('span').html();
					obj.siblings('.show_button2').find('span').html(parseInt(ticket_num)+1);

					var num=0;
					for(var i=0;i<$('.show_button2').length;i++){
						num+=parseInt($('.show_button2 span:eq('+i+')').html());
					}
					$('.footer_buy_mob2 div:eq(0) span').html(num);
				},
				error:function(data) {
					console.log(data.msg);
				},
			});
		});

		$('.click_detail').click(function(){
			var show_id=$(this).siblings('.show_id').val();
			var shower_name=$(this).siblings('.shower_name').val();
			location.href="<?php echo url('weichat/index/buytail'); ?>/show_id/"+show_id+"/shower_name/"+shower_name;
		});

		$('.footer_buy_mob2 div:eq(1)').click(function(){
			location.href="<?php echo url('weichat/index/index'); ?>";
		});
	</script>
</html>
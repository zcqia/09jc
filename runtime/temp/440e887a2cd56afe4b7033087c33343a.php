<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:59:"C:\wamp64\www/./application/weichat\view\index\buytail.html";i:1516368455;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<!-- 移动端屏幕的缩放,使用设备的宽度作为视图宽度并禁止初始的缩放 -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>09剧场</title>
	<link href="/public/static/weichat/css/master.css" rel="stylesheet" type="text/css">
	<link href="/public/static/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
</head>
<body style="background: rgb(243, 243, 244)">
	<!-- <div class="nav_mob2"><span>水墨中国</span></div> -->
	<!-- <div class="back"><span class="glyphicon glyphicon-chevron-left"></span></div> -->
	<div class="main_mob">
		<div class="show_mob2">
			<div class="show_img2"><img src="<?php echo $data[0]['show_img_path']; ?>"></div>
			<div class="show_content2">
				<div><span><b><?php echo $data[0]['show_title']; ?></b></span></div>
				<div id="zhuyan"><span id="zhuyan1">主演:<?php if(strlen($shower_name) > 30){
								  $str=$shower_name;
								  $str=mb_substr($str,0,12,'utf-8'); 
								  if(substr($str,strlen($str)-3,strlen($str)) == '。'){
									 echo substr($str,0,strlen($str)-3).'...';
								  }else if(substr($str,strlen($str)-1,strlen($str)) == '?'){
									 echo substr($str,0,strlen($str)-1).'...';
								  }else{
								     echo $str.'...';
								  }
						  		}else{
								  echo $shower_name;
						  		}
						  ?></span><span id="more3">更多</span></div>
				<div>场次:<?php 
					if(substr($data[0]['show_time'],5,1) == 0){
						if(substr($data[0]['show_time'],8,1) == 0){
							echo substr($data[0]['show_time'],6,1).'月'.substr($data[0]['show_time'],9,1).'日'.substr($data[0]['show_time'],10,6);
						}else{
							echo substr($data[0]['show_time'],6,1).'月'.substr($data[0]['show_time'],8,2).'日'.substr($data[0]['show_time'],10,6);
						}
					}else{
						if(substr($data[0]['show_time'],8,1) == 0){
							echo substr($data[0]['show_time'],5,2).'月'.substr($data[0]['show_time'],9,1).'日'.substr($data[0]['show_time'],10,6);
						}else{
							echo substr($data[0]['show_time'],5,2).'月'.substr($data[0]['show_time'],8,2).'日'.substr($data[0]['show_time'],10,6);
						}
					} 
					?></div>
				<div id="jianjie"><span id="desc">简介:<?php if(strlen($data[0]['show_describe']) > 87){
								  $str=$data[0]['show_describe'];
								  $str=mb_substr($str,0,29,'utf-8'); 
								  if(substr($str,strlen($str)-3,strlen($str)) == '。'){
									 echo substr($str,0,strlen($str)-3).'...';
								  }else if(substr($str,strlen($str)-1,strlen($str)) == '?'){
									 echo substr($str,0,strlen($str)-1).'...';
								  }else{
								     echo $str.'...';
								  }
						  		}else{
								  echo $data[0]['show_describe'];
						  		}
						  ?></span><span id="more">更多</span></div>
			</div>
			<input type='hidden' id="str" value="简介:<?php echo $data[0]['show_describe']; ?>">
			<input type='hidden' id="str2" value="0">
			<input type='hidden' id="str3" value="主演:<?php echo $shower_name; ?>">
			<input type='hidden' id="str4" value="0">
		</div>
		<!-- <div class="pic_mob2" style="background:white"><img class="blur" src="<?php echo $data[0]['show_img_path']; ?>"></div> -->
		<div class="shower_pic_mob">
			<div><span><b>演职人员</b></span><span id="more2">更多</span></div>
			<div id="pic">
				<?php foreach($shower as $c): ?>
				<div><img src="<?php echo $c['img_path']; ?>"><span><?php echo $c['shower_name']; ?></span><span>导演</span></div>
				<?php endforeach; ?>
			</div>
		</div>
		<div class="user_say_mob">
			<div><span><b>短评</b></span></div>
			<?php foreach($user as $t): ?>
			<div class="user_say_mob1"><div><img src="<?php echo $t['user_img_path']; ?>"></div><div><span><?php echo $t['user_name']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span><?php echo $t['say_time']; ?></span></span><span><?php echo $t['say_content']; ?></span></div></div>
			<?php endforeach; ?>
		</div>
		<div class="footer_buy_mob"><div style="background:rgb(102, 126, 206)"><input type="hidden" value="<?php echo $data[0]['show_id']; ?>"><input type="hidden" value="<?php echo $shower_name; ?>"><!-- <img class="blur2" src="<?php echo $data[0]['show_img_path']; ?>"> --><span style="color:white">取票</span></div></div>
	</div>
</body>
	<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
	<script type="text/javascript">
		$('.footer_buy_mob div').click(function(){
			var show_id=$(this).find('input').eq(0).val();
			var shower_name=$(this).find('input').eq(1).val();
			location.href="<?php echo url('weichat/index/shop_cart'); ?>/show_id/"+show_id+"/shower_name/"+shower_name;
		});

		var str=$('#desc').text();
		var str2=$('#str').val();
		var str3=$('#str3').val();
		var str4=$('#zhuyan span:eq(0)').text();
		if(str.substr(str.length-3,3) == '...'){
			$('#more').css('color','rgb(102, 126, 206)');
		}
		if(str4.substr(str4.length-3,3) == '...'){
			$('#more3').css('color','rgb(102, 126, 206)');
		}

		$('#more').click(function(){
			$('#more').remove();
			$('#desc').text(str2);
		});

		$('#more3').click(function(){
			$('#more3').remove();
			$('#zhuyan1').text(str3);
		});

		$('#zhuyan').click(function(){
			if($('#str4').val() == '0'){
				$('#more3').remove();
				$('#zhuyan1').text(str3);
				$('#str4').val(1);
			}else{
				$('#zhuyan1').text(str4);
				$('#zhuyan1').append("<span id='more3'>更多</span>");
				$('#more3').css('color','rgb(102, 126, 206)');
				$('#str4').val(0);
			}
		});

		$('#jianjie').click(function(){
			if($('#str2').val() == '0'){
				$('#more').remove();
				$('#desc').text(str2);
				$('#str2').val(1);
			}else{
				$('#desc').text(str);
				$('#desc').append("<span id='more'>更多</span>");
				$('#more').css('color','rgb(102, 126, 206)');
				$('#str2').val(0);
			}
		});

		$('#more2').click(function(){
			if($(this).text() == '收起'){
				$(this).text('更多');
				$('#pic').css('overflow','hidden');
			}else{
				$('#pic').css('overflow','visible');
				$(this).text('收起');
			}
		});

	</script>
</html>
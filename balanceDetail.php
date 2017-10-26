<?php
	require_once "php/forbidEnter.php";
?>
<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<title></title>
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
		<link rel="stylesheet" type="text/css" href="css/reset.css" />
		<script src="js/campatibility.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/jquery-1.12.4min.js" type="text/javascript" charset="utf-8"></script>

		<!-- Demo styles -->
		<style>
			html,
			body {
				position: relative;
				height: 100%;
				font-size: 10px;
			}
			
			.header {
				width: 100%;
			}
			
			.header div {
				width: 90%;
				height: 0.7rem;
				margin-left: 5%;
				line-height: 0.7rem;
				border-bottom: 0.01rem solid #8a8a8a;
			}
			
			.header .pageItem {
				width: 100%;
				height: 0.6rem;
				text-align: center;
				text-indent: -0.3rem;
				font-size: 0.3rem;
				line-height: 0.6rem;
				margin: 0;
				color: #e98f36;
			}
			
			.header .pageItem img {
				width: 0.4rem;
				height: 0.4rem;
				margin-top: 0.15rem;
				float: left;
				margin-left: 0.15rem;
			}
		</style>
	</head>

	<body>
		<div class="wrap">
			<div class="header">
				<div class="pageItem"><p class="back" style="width: 1.2rem;float: left;">返回</p><p style="width: 2rem;float: left;margin-left: 1.2rem;">余额明细</p></div>
			</div>
			<div class="footer">

			</div>
		</div>

	</body>
	<script>
		$(".wrap").innerWidth(window.innerWidth);
		$(".wrap").innerHeight(window.innerHeight);
		$(".header").innerHeight(0.06 * window.innerHeight);
		$(".footer").innerHeight(0.94 * window.innerHeight);
		//		事件
		$(".pageItem .back")[0].addEventListener('touchstart', back, false);

		function back(e) {
			history.go(-1);
		}
		
		
		
	</script>

</html>
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
			.footer img{
				width: 90%;
				margin-left: 5%;
			}
			.footer p{
				width: 90%;
				margin-left: 5%;
				text-indent: 2em;
				font-size: 0.2rem;
			}
		</style>
	</head>

	<body>
		<div class="wrap">
			<div class="header">
				<div class="pageItem"><p class="back" style="width: 1.2rem;float: left;">返回</p><p style="width: 2rem;float: left;margin-left: 1.2rem;">食品安全</p></div>
			</div>
			<div class="footer">
				<img src="img/0231fb8d-4470-4fe2-8894-023b6a7f559d.png"/>
				<p>柏慧燕都公司建厂30年，一直致力于生产健康食品，保证消费者食用安全，2012年建成投产，引进欧洲先进生产线，公司的检测中心同时配备先进的检测设备，在原有基础上增加检验检测人员，保证产成品的检测符合食品行业相关标准。</p>
				<img src="img/5f32f5a9-c85d-44d4-8cb4-9d98962239dc.jpg" alt="" />
				<p>公司从原料进厂到产品出厂都要经过检验，化验室拥有生物安全柜、超净化工作台、全自动定氮仪、全自动脂肪测定仪、消解仪、分光光度计、旋光仪、纸箱抗压仪、酶标仪等先进的检验设备，公司检验人员均是食品相关专业毕业并且具备检验员资格证书，检验检测过程按照食品行业相关标准进行，确保检验结果准确无误。</p>
				<img src="img/2eeda58f-1139-47cb-9699-f8f3964bf5ca.jpg" alt="" />
				<p>公司整个管理和生产过程按照ISO9001和ISO22000体系要求运行，从使用合格原料做起，产品生产的各个工序均有检验控制点，其中的重要工序设有关键控制点，各检验工序层层把关，保证了出厂产品的合格性。</p>
				<p>总之，柏慧燕都公司按照食品行业相关法律法规和食品行业标准进行生产经营和检验检测活动，确保给广大消费者提供安全放心的食品。</p>
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
			window.location.href = "userPage.php";
		}
	</script>

</html>
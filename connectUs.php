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
		
		.footer img {
			width: 90%;
			margin-left: 5%;
		}
		
		.footer p {
			width: 90%;
			margin-left: 5%;
			font-size: 0.2rem;
		}
		
		.footer .connectClassify {
			color: #c1392b;
			font-size: 0.23rem;
		}
	</style>
</head>

<body>
	<div class="wrap">
		<div class="header">
			<div class="pageItem"><p class="back" style="width: 1.2rem;float: left;">返回</p><p style="width: 2rem;float: left;margin-left: 1.2rem;">联系我们</p></div>
		</div>
		<div class="footer">
			<img src="img/0231fb8d-4470-4fe2-8894-023b6a7f559d.png" />
			<p class="connectClassify">辽宁柏慧燕都食品有限公司</p>
			<p>肉制品加工厂地址：辽宁朝阳龙翔大街102号</p>
			<p>生猪屠宰厂地址：辽宁朝阳经济技术开发区长江路六段3号</p>
			<p>客服热线：400-6510-858</p>
			<p>24小时肉制品销售热线：86-0421-3813988 3813088</p>
			<p>24小时冷鲜肉销售热线：86-0421-3816388 3818811</p>
			<p>QQ：1273880934 1402077065</p>
			<p>E-mail:bh@baihuiyandu.cn
				<a href="http://www.baihuiyandu.cn">http://www.baihuiyandu.cn</a>
			</p>
			<p class="connectClassify">肉制品加工厂销售部联系电话：</p>
			<p>阜盘地区：颜经理 15142290873</p>
			<p>辽南地区：母经理 15840281877</p>
			<p>西北片区：闫经理 18604918666</p>
			<p>辽西地区：都经理 15142290827</p>
			<p>吉黑地区：陈经理 15942160188</p>
			<p>速冻片区：姚经理 15142290861</p>
			<p>沈阳地区：宋经理 18642012410</p>
			<p>加盟连锁：朱经理 15142290895</p>
			<p>北京地区：沈经理 13811332441</p>
			<p>赤峰、通辽：陈经理 13795036226</p>
			<p class="connectClassify">生猪屠宰厂销售部联系电话：</p>
			<p>朝阳、内蒙区域：李经理 15142290831</p>
			<p>辽北区域：易经理 15142290855</p>
			<p>河北区域：陈经理   15142290833</p>
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
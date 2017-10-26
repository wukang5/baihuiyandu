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
			.header div span{
				height: 0.4rem;
				float: left;
				text-indent: 0.1rem;
				font-size: 0.2rem;
			}
			.header div img{
				width: 0.4rem;
				height: 0.4rem;
				margin-top: 0.1rem;
				float: right;
			}
			.header .pageItem{
				width: 100%;
				height: 0.6rem;
				text-align: center;
				font-size: 0.3rem;
				line-height: 0.6rem;
				margin: 0;
				color: #e98f36;
			}
			.loginOut{
				width: 5rem;
				height: 0.6rem;
				margin: 1rem auto;
				line-height: 0.6rem;
				border-radius: 0.5rem;
				font-size: 0.3rem;
				background-color: #e98f36;
				color: white;
				text-align: center;
			}
			.footer{
				width: 100%;
				display: flex;
				background-color: ghostwhite;
				justify-content: space-around;
				border-top: gray solid 0.01rem;
			}
			.footer div{
				width: 0.6rem;
				height: 0.6rem;
				text-align: center;
			}
			.footer div img{
				width: 0.4rem;
			}
			.footer div p {
				font-size: 0.15rem;
				color: #8a8a8a;
				text-align: center;
			}
		</style>
	</head>

	<body>
		<div class="wrap">
			<div class="header">
				<div class="pageItem">我的主页</div>
				<div class="username"><span>测试</span><img src="img/right.png" alt="" /></div>
				<div class="foodSafe"><span>食品安全</span><img src="img/right.png" alt="" /></div>
				<div class="connectUs"><span>联系我们</span><img src="img/right.png" alt="" /></div>
				<p class="loginOut">退出登录</p>
			</div>
			<div class="footer">
				<div class="orderPage"><img src="img/dingdan1.png" alt="" /><p>订单</p></div>
				<div class="accountChecking"><img src="img/duizhang1.png" alt="" /><p>对帐</p></div>
				<div class="userPage"><img src="img/wode1.png" alt="" /><p style="color: black;">我的</p></div>
			</div>
		</div>

	</body>
	<script>
		$(".wrap").innerWidth(window.innerWidth);
		$(".wrap").innerHeight(window.innerHeight);
		$(".header").innerHeight(0.93 * window.innerHeight);
		$(".footer").innerHeight(0.068 * window.innerHeight);
		$(".username span")[0].innerHTML = (sessionStorage.getItem("ccusname"));
//		事件
		$(".accountChecking")[0].addEventListener('touchstart', accountChecking, false);

		function accountChecking(e) {
			window.location.href = "accountChecking.php";
		}
		$(".username")[0].addEventListener('touchstart',username,false);
		function username(e){
			window.location.href = "myAccount.php";
		}
		$(".foodSafe")[0].addEventListener('touchstart',foodSafe,false);
		function foodSafe(e){
			window.location.href = "foodSafe.php";
		}
		$(".connectUs")[0].addEventListener('touchstart',connectUs,false);
		function connectUs(e){
			window.location.href = "connectUs.php";
		}
		$(".loginOut")[0].addEventListener('touchstart',loginOut,false);
		function loginOut(e){
			$.post("php/clearSession.php", {sessionInfo: "loginout"}, function(data) {
				
			})
			sessionStorage.clear();
			window.location.href = "index.php";
		}
		
		$(".orderPage")[0].addEventListener('touchstart',orderPage,false);
		function orderPage(e){
			window.location.href = "orderPage.php";
		}
		
	</script>

</html>
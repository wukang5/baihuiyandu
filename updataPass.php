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
			
			input {
				width: 100%;
				height: 0.6rem;
				margin-top: 0.1rem;
				border: 0 solid white;
				border-bottom: 0.01rem solid #8a8a8a;
				text-indent: 0.2rem;
			}
			
			.loginOut {
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
		</style>
	</head>

	<body>
		<div class="wrap">
			<div class="header">
				<div class="pageItem"><p class="back" style="width: 1.2rem;float: left;">返回</p><p style="width: 2rem;float: left;margin-left: 1.2rem;">修改密码</p></div>
				<input type="text" class="oldPass" placeholder="旧的密码" /><br />
				<input type="password" class="newPass" placeholder="新的密码" /><br />
				<input type="password" class="confirmPass" placeholder="确认新密码" /><br />
				<p class="loginOut">确认修改</p>
			</div>
		</div>
		</div>

	</body>
	<script src="js/efid.js" type="text/javascript" charset="utf-8"></script>
	<script>
		$(".wrap").innerWidth(window.innerWidth);
		$(".wrap").innerHeight(window.innerHeight);
		$(".header").innerHeight(0.94 * window.innerHeight);
		$(".footer").innerHeight(0.06 * window.innerHeight);
//		console.log(sessionStorage.getItem("loginPass"));
//		console.log(sessionStorage.getItem("loginCode"));

		//		事件
		$(".pageItem .back")[0].addEventListener('touchstart', back, false);

		function back(e) {
			window.location.href = "myAccount.php";
		}
		$(".loginOut")[0].addEventListener('touchstart', loginOut, false);

		function loginOut(e) {
			if($(".oldPass").val() != sessionStorage.getItem("loginPass")) {
				alert("您输入的原密码错误");
			}else if($(".newPass").val() != $(".confirmPass").val()) {
				alert("您两次输入的密码不一致");
			} else {
				var context = '<?xml version="1.0" encoding="utf-8"?><ufinterface efserverid="'+efid+'" eftype="EFsql" sqlstr="UPDATE Customer SET cCusDefine2=\''+$(".newPass").val()+'\'  WHERE cCusCode = \''+sessionStorage.getItem("loginCode")+'\'" proc="Update" efdebug="1" ></ufinterface>';
				$.post("php/inventory.php", {
					context: context
				}, function(str) {
					var xmlStrDoc = null;
					if(window.DOMParser) { // Mozilla Explorer 
						parser = new DOMParser();
						xmlStrDoc = parser.parseFromString(str, "text/xml");
					} else { // Internet Explorer 
						xmlStrDoc = new ActiveXObject("Microsoft.XMLDOM");
						xmlStrDoc.async = "false";
						xmlStrDoc.loadXML(str);
					}
					console.log(xmlStrDoc)
					if(xmlStrDoc.getElementsByTagName('ufinterface')[0].getAttribute("succeed") == "1") {
						alert("修改成功");
						window.location.href = "index.php";
					}
				});
				
			}

		}
	</script>

</html>
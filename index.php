<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<title></title>
		<link rel="stylesheet" type="text/css" href="css/reset.css" />
		<script src="js/jquery-1.12.4min.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/campatibility.js" type="text/javascript" charset="utf-8"></script>
		<style type="text/css">
			html {
				font-size: 10px;
			}
			
			.wrap .login {
				width: 100%;
				height: 100%;
				text-align: center;
				overflow: hidden;
			}
			.wrap .login .logo1{
				width: 2.5rem;
				text-align: center;
				margin-top: 0.5rem;
			}
			
			.wrap .login .code,
			.wrap .login .passWord {
				width: 5rem;
				text-align: center;
				margin: 0.4rem auto 0;
				position: relative;
			}
			
			.wrap .login .code {
				margin-top: 0.7rem;
			}
			
			.wrap .login span {
				font-size: 0.4rem;
			}
			
			.wrap .login input {
				text-indent: 0.8rem;
				font-size: 0.3rem;
				width: 5rem;
				height: 0.6rem;
				border: 0.01rem solid gainsboro;
				border-radius: 0.5rem;
			}
			
			.wrap .login .clearInp {
				width: 0.4rem;
				position: absolute;
				left: 0.25rem;
				top: 0.125rem;
			}
			
			.wrap .login .showPass {
				width: 0.45rem;
				position: absolute;
				left: 0.25rem;
				top: 0.08rem;
			}
			
			.wrap .login .adminBtn {
				width: 5rem;
				height: 0.6rem;
				margin: 0.6rem auto;
				line-height: 0.6rem;
				border-radius: 0.5rem;
				font-size: 0.3rem;
				background-color: #e98f36;
				color: white;
			}
			.logobox{
				width: 2rem;
				height: 0.8rem;
				float: right;
				margin-right: 0.2rem;
				margin-top: 2rem;
			}
			.logobox .logo{
				width: 2rem;
			}
			.phone{
				width: 2rem;
				height: 0.3rem;
				font-size: 0.23rem;
				color: #e6000e;
			}
		</style>
	</head>

	<body>		
		<div class="wrap">
			<div class="login">
				<img class="logo1" src="img/logo.png" alt="" />
				<div class="code">
					<input class="ccode" type="text" placeholder="请输入账号" />
					<img class="clearInp" src="img/zhanghao.png" alt="" />
				</div>
				<div class="passWord">
					<input class="pass" type="password" placeholder="请输入密码" />
					<img class="showPass" src="img/mima.png" />
				</div>
				<div class="rememberBox" style="text-align: right;padding-right: 1rem;margin-top: 0.1rem;">
					<input type="checkbox" name="" id="remember_me" value="" style="width: 0.35rem; height: 0.35rem;" /><span style="font-size: 0.28rem;">记住密码</span>
				</div>
				<p class="adminBtn">登录</p>
				<div class="logobox">
					<img class="logo" src="img/logo/logo.png"/>
					<p class="phone">Tel:400-6342-008</p>
				</div>
				
			</div>
		</div>
	</body>
	<script src="js/efid.js" type="text/javascript" charset="utf-8"></script>
	<script type="text/javascript">
		var checkBox = document.querySelector("#remember_me");
		window.onload = function() {
			if (localStorage.getItem("checkEl") == "true") {
				document.querySelector(".ccode").value = localStorage.getItem("code");
				document.querySelector(".pass").value = localStorage.getItem("pass");
				document.querySelector("#remember_me").checked = localStorage.getItem("checkEl");
			}
		}
		var checkBox = document.querySelector("#remember_me");
		window.onload = function() {
			if (localStorage.getItem("checkEl") == "true") {
				document.querySelector(".ccode").value = localStorage.getItem("code");
				document.querySelector(".pass").value = localStorage.getItem("pass");
				document.querySelector("#remember_me").checked = localStorage.getItem("checkEl");
			}
		}

		$(".wrap").innerWidth(window.innerWidth);
		$(".wrap").innerHeight(window.innerHeight);
		$(".welcome").css({
			"line-height": window.innerHeight + "px"
		});
		$(".clearInp").click(function() {
			$(".ccode").val("");
		});
		var pass = $(".pass")[0];
		$(".showPass").click(function() {
			if(pass.type == "password") {
				$(".pass").attr({
					type: "text"
				});
				$(".showPass").attr({
					src: "img/showPass.png"
				});
			} else {
				$(".pass").attr({
					type: "password"
				});
				$(".showPass").attr({
					src: "img/hidePass.png"
				})
			}
		});
		//		登录状态切换函数
		function onLogin () {
			$(".adminBtn").html("登录中...")
			$("input").attr({
				disabled:"disabled"
			});
		}
		function outLogin () {
			$(".adminBtn").html("登录")
			$("input").removeAttr("disabled");
		}
		$(".adminBtn")[0].addEventListener('touchstart', adminBtn, false);

		function adminBtn(e) {
			if ($(".adminBtn").html()=="登录") {
				onLogin();
				var context = '<?xml version="1.0" encoding="utf-8"?><ufinterface  efserverid="'+efid+'" eftype="EFsql" sqlstr="select * from Customer where cCusCode=\'' + $(".ccode").val() + '\' and cCusDefine2=\'' + $(".pass").val() + '\'" proc="Query" efdebug="1"  ></ufinterface>';
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
					if(xmlStrDoc.getElementsByTagName('ufinterface')[0].getAttribute("succeed") == 1) {
						sessionStorage.setItem("ccusname", xmlStrDoc.getElementsByTagName('head')[0].childNodes[0].getAttribute("cCusName"));
						sessionStorage.setItem("ccuscode", xmlStrDoc.getElementsByTagName('head')[0].childNodes[0].getAttribute("cCusCode"));
						sessionStorage.setItem("priceGrade", xmlStrDoc.getElementsByTagName('head')[0].childNodes[0].getAttribute("iCostGrade"));
						sessionStorage.setItem("loginCode", xmlStrDoc.getElementsByTagName('head')[0].childNodes[0].getAttribute("cCusCode"));
						sessionStorage.setItem("loginPass", xmlStrDoc.getElementsByTagName('head')[0].childNodes[0].getAttribute("cCusDefine2"));
						sessionStorage.setItem("cInvoiceCompany", xmlStrDoc.getElementsByTagName('head')[0].childNodes[0].getAttribute("cInvoiceCompany"));//开票单位
						$.post("php/session.php", {code: $(".ccode").val()}, function(data) {
								window.location.href = "orderPage.php";
						});
					} else {
						alert("账号或密码错误");
						outLogin();
					}
				});
				if(checkBox.checked) {
					localStorage.setItem("code", $(".ccode").val());
					localStorage.setItem("pass", $(".pass").val());
					localStorage.setItem("checkEl", checkBox.checked);
				} else {
					localStorage.setItem("code", "");
					localStorage.setItem("pass", "");
					localStorage.setItem("checkEl", "");
				}
			} else{
				
			}
			
		}
		
	</script>

</html>
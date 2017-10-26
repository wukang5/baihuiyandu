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
		<link rel="stylesheet" type="text/css" href="css/publicCss.css"/>
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

			.header .pageItem{
				width: 100%;
				height: 0.6rem;
				text-align: center;
				font-size: 0.3rem;
				line-height: 0.6rem;
				margin: 0;
				color: #e98f36;
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
				<p class="goback" style=" display:none;width: 1.2rem;position: absolute;left: 0.2rem;top:0rem;font-size: 0.3rem;line-height: 0.6rem;color: #e98f36;">
					返回
				</p>
				<!--<div class="pageItem" style="border-bottom: #e98f36 solid 0.01rem;">对帐列表</div>
				<div class="kplist" style="width:auto;height: 93%;margin-left: 0;margin-top: 0.2rem;">
					<div class="dhDateBox" style="margin-left: 0;">
						<span>开票日期</span><input class="dhDate" type="date" name="" id="" value="" />
					</div>
					<div class="pageBtn">
						<p class="lastPage" style="width: 4.5rem;margin-left: 1rem;">查询</p>
					</div>
					<div class="footBox" style="height: 84%;">
						
					</div>	
				</div>
				<div class="neworderform" style="display: none;">
					<div class="neworderheader" style="width:auto;height: 94%;margin-left: 0;">
						<div class="neworderdiv customer">
							<span>发票号：</span><span class="customerName"></span>
						</div>
						<div class="neworderdiv dhDate">
							<span>开票日期：</span><input disabled="disabled" type="date" name="" id="" value="" />
						</div>
						<div class="neworderdiv detail" style="height: 1rem;">
							<span>总数量</span><span class="num">0</span>&nbsp;&nbsp;&nbsp;<span>总金额</span><span>¥</span><span class="jine">0.00</span><br /><span>返利总额：</span><span>¥</span><span class="zongfanli">0.00</span>
						</div>
						<div class="neworderfooter">
							<div class="footerWindow"></div>
						</div>
					</div>
				</div>-->
				功能优化中，请期待...
			</div>
			
			<div class="footer">
				<div class="orderPage"><img src="img/dingdan1.png" alt="" /><p>订单</p></div>
				<div class="accountChecking"><img src="img/duizhang.png" alt="" /><p style="color: black;">对帐</p></div>
				<div class="userPage"><img src="img/wode.png" alt="" /><p>我的</p></div>
			</div>
		</div>
	</body>
	<script src="js/efid.js" type="text/javascript" charset="utf-8"></script>
	<script>
		$(".wrap").innerWidth(window.innerWidth);
		$(".wrap").innerHeight(window.innerHeight);
		$(".header").innerHeight(0.926 * window.innerHeight);
		$(".footer").innerHeight(0.068 * window.innerHeight);
//		事件
		$(".userPage")[0].addEventListener('touchstart', userPage, false);
		function userPage(e) {
			window.location.href = "userPage.php";
		}
		$(".orderPage")[0].addEventListener('touchstart',orderPage,false);
		function orderPage(e){
			window.location.href = "orderPage.php";
		}
		
//		发票部分
//		$(".lastPage")[0].addEventListener('touchstart', allfp, false);
//		function allfp(e) {
//			pageCtl();
//		}
//		var SBVIDArr = [];
//		function pageCtl() {
//			$(".mylist").remove();
//			var sbvid = '<?xml version="1.0" encoding="utf-8"?><ufinterface  efserverid="'+efid+'" eftype="EFsql" sqlstr="select * from SaleBillVouch where cDefine10 = \''+sessionStorage.getItem("ccusname")+'\' AND ddate=\'' + $(".dhDateBox .dhDate").val() + '\'" proc="Query" efdebug="1"  ></ufinterface>';
//			$.post("php/inventory.php", {
//				context: sbvid
//			}, function(str) {
//				var xmlStrDoc = null;
//				if(window.DOMParser) { // Mozilla Explorer 
//					parser = new DOMParser();
//					xmlStrDoc = parser.parseFromString(str, "text/xml");
//				} else { // Internet Explorer 
//					xmlStrDoc = new ActiveXObject("Microsoft.XMLDOM");
//					xmlStrDoc.async = "false";
//					xmlStrDoc.loadXML(str);
//				}
////				console.log(xmlStrDoc);
//				console.log(xmlStrDoc.getElementsByTagName('ufinterface')[0].childNodes.length);
//				if (xmlStrDoc.getElementsByTagName('ufinterface')[0].childNodes.length==0) {
//					alert("无对帐信息。");
//				} else{
//					for (var i=0;i<xmlStrDoc.getElementsByTagName('head')[0].childNodes.length;i++) {
//						SBVIDArr.push(xmlStrDoc.getElementsByTagName('head')[0].childNodes[i].getAttribute("SBVID"));
//						var kpStr = '<?xml version="1.0" encoding="utf-8"?><ufinterface efserverid="'+efid+'" eftype="EFsql" sqlstr="select * from IA_wtSale where SBVID = \''+xmlStrDoc.getElementsByTagName('head')[0].childNodes[i].getAttribute("SBVID")+'\'" orderbyfilename = "ddate" proc="Query" efdebug="1"  ></ufinterface>';
//						$.post("php/inventory.php", {
//							context: kpStr
//						}, function(str) {
//							var xmlStrDoc1 = null;
//							if(window.DOMParser) { // Mozilla Explorer 
//								parser = new DOMParser();
//								xmlStrDoc1 = parser.parseFromString(str, "text/xml");
//							} else { // Internet Explorer 
//								xmlStrDoc1 = new ActiveXObject("Microsoft.XMLDOM");
//								xmlStrDoc1.async = "false";
//								xmlStrDoc1.loadXML(str);
//							}
//							var kpDate = xmlStrDoc1.getElementsByTagName('head')[0].childNodes[0].getAttribute("ddate").substr(0,10);
//							$(".kplist .footBox").append("<div class='mylist'><p>" + xmlStrDoc1.getElementsByTagName('head')[0].childNodes[0].getAttribute("csbvcode") + "</p><p>" +kpDate + "</p></div>");
//						});
//					}
//				}
//			});
//		}
			
		$(".goback")[0].addEventListener('touchstart', back, false);

		function back(e) {
			
			$(".neworderform").css({
				display:"none"
			});
			$(".goback").css({
				display:"none"
			});
			$(".kplist").css({
				display:"block"
			});
		}
	</script>

</html>



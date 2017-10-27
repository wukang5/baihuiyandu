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
		<script src="js/efid.js" type="text/javascript" charset="utf-8"></script>
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

			.pageItem{
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
			.queryTime{
				width: 100%;
				text-align: center;
				font-weight: bold;
				color: red;
				font-size: 0.3rem;
				margin-top: 4rem;
				display: none;
			}
		</style>
	</head>

	<body>
		<div class="wrap">
			<div class="header">
				<p class="goback" style=" display:none;width: 1.2rem;position: absolute;left: 0.2rem;top:0rem;font-size: 0.3rem;line-height: 0.6rem;color: #e98f36;">
					返回
				</p>
				<div class="pageItem" style="border-bottom: #e98f36 solid 0.01rem;">对帐列表</div>
				<div class="content">
					<div class="kplist" style="width:auto;height: 93%;margin-left: 0;margin-top: 0.2rem;">
						<div class="dhDateBox" style="margin-left: 0;padding: 0.1rem;">
							<span>开票日期</span><input class="dhDate" type="date" name="" id="" value="" />
						</div>
						<div class="pageBtn" style="overflow: hidden;">
							<p class="lastPage">上一页</p>
							<p class="nextPage">下一页</p>
						</div>
						<p class="queryFp" style="width: 4.5rem;height: 0.45rem;font-size: 0.25rem;border: 0.01rem solid black;box-shadow: gray 0.03rem 0.03rem;text-align: center;line-height: 0.45rem;border-radius: 0.08rem;margin: 0.3rem auto 0.1rem;">查询</p>
						<div class="footBox" style="height: 5rem;">
							
						</div>
						<p class="pageNum" style="text-align: center;display: none; font-size: 0.25rem;"></p>
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
					</div>
				</div>
				<div class="queryTime"></div>
			</div>
			
			<div class="footer" >
				<div class="orderPage"><img src="img/dingdan1.png" alt="" /><p>订单</p></div>
				<div class="accountChecking"><img src="img/duizhang.png" alt="" /><p style="color: black;">对帐</p></div>
				<div class="userPage"><img src="img/wode.png" alt="" /><p>我的</p></div>
			</div>
		</div>
		
	</body>
	<script>
		$(".wrap").innerWidth(window.innerWidth);
		$(".wrap").innerHeight(window.innerHeight);
		$(".header").innerHeight(0.926 * window.innerHeight);
		$(".footer").innerHeight(0.07 * window.innerHeight);
//		事件
		$(".userPage")[0].addEventListener('touchstart', userPage, false);
		function userPage(e) {
			window.location.href = "userPage.php";
		}
		$(".orderPage")[0].addEventListener('touchstart',orderPage,false);
		function orderPage(e){
			window.location.href = "orderPage.php";
		}
		var now = new Date();
		var day = ("0" + now.getDate()).slice(-2);
		var month = ("0" + (now.getMonth() + 1)).slice(-2);
		var today = now.getFullYear() + "-" + (month) + "-" + (day);
		$(".dhDateBox .dhDate").val(today);
//		发票部分
		var pages;
		var pagesNum;
		$(".queryFp")[0].addEventListener('touchstart', allfp, false);
		function allfp(e) {
			$(".kplist .footBox .mylist").remove();
			pageCtl(1);
		}
		
		$(".lastPage")[0].addEventListener('touchstart', lastpage, false);

		function lastpage(e) {
			$(".kplist .footBox .mylist").remove();
			pages = Number(sessionStorage.getItem("pages"));
			if(pages > 1) {
				pages = pages - 1;
			}
			pageCtl(pages);
		}
		$(".nextPage")[0].addEventListener('touchstart', nextpage, false);

		function nextpage(e) {
			$(".kplist .footBox .mylist").remove();
			pages = Number(sessionStorage.getItem("pages"));
			pagesNum = Number(sessionStorage.getItem("pagesNum"));
			if(pages < pagesNum) {
				pages = pages + 1;
			}
			pageCtl(pages);
		}
		var SBVIDArr = [];
		function pageCtl(pagenumber) {
			$(".pageNum").css({
				display:"block"
			});
			$(".kplist .footBox .mylist").remove();
			var sbvid = '<?xml version="1.0" encoding="utf-8"?><ufinterface  efserverid="'+efid+'" eftype="EFsql" pagenumer="'+pagenumber+'" pagesize="5" sqlstr="select * from SaleBillVouch where cDefine10 = \''+sessionStorage.getItem("ccusname")+'\' AND ddate=\'' + $(".dhDateBox .dhDate").val() + '\'" proc="Query" efdebug="1"  ></ufinterface>';
			$.post("php/inventory.php", {
				context: sbvid
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
				console.log(xmlStrDoc);
				if (xmlStrDoc.getElementsByTagName('ufinterface')[0].getAttribute("succeed") == 1) {
					var kpDate = xmlStrDoc.getElementsByTagName('head')[0].childNodes[0].getAttribute("dDate").substr(0,10);
//					SBVIDArr.push(xmlStrDoc.getElementsByTagName('head')[0].childNodes[i].getAttribute("SBVID"));
					sessionStorage.setItem("pages", xmlStrDoc.getElementsByTagName("voucher")[0].getAttribute("pagenumer"));
					$(".pageNum").html("第"+xmlStrDoc.getElementsByTagName("voucher")[0].getAttribute("pagenumer")+"页/共"+xmlStrDoc.getElementsByTagName("voucher")[0].getAttribute("pages")+"页");
					sessionStorage.setItem("pagesNum", xmlStrDoc.getElementsByTagName("voucher")[0].getAttribute("pages"));
					for (var i=0;i<xmlStrDoc.getElementsByTagName('head')[0].childNodes.length;i++) {
						$(".kplist .footBox").append("<div class='mylist'><p style='display:none;'>"+ xmlStrDoc.getElementsByTagName('head')[0].childNodes[i].getAttribute("SBVID") +"</p><p>" + xmlStrDoc.getElementsByTagName('head')[0].childNodes[i].getAttribute("cSBVCode") + "</p><p>" +kpDate + "</p></div>");
						toOrder();						
					}
				}else{
					alert("本日无发票。");
				}
				
			});
		}

		function toOrder() {
			var mylist = document.querySelectorAll(".footBox .mylist");
			for(var i = 0; i < mylist.length; i++) {
				mylist[i].onclick = function() {
					$(".listBox").remove();
					$(".neworderform").css({
						display:"block"
					});
					$(".goback").css({
						display:"block"
					});
					$(".kplist").css({
						display:"none"
					});
					$(".customer .customerName")[0].innerText = this.children[1].innerHTML;
					$(".dhDate input").val(this.children[2].innerHTML);
					var kpStr = '<?xml version="1.0" encoding="utf-8"?><ufinterface efserverid="'+efid+'" eftype="EFsql" sqlstr="select * from SaleBillVouchs  where SBVID = \''+this.children[0].innerHTML+'\' " proc="Query" efdebug="1"  ></ufinterface>';
					$.post("php/inventory.php", {
						context: kpStr
					}, function(str) {
						var xmlStrDoc1 = null;
						if(window.DOMParser) { // Mozilla Explorer 
							parser = new DOMParser();
							xmlStrDoc1 = parser.parseFromString(str, "text/xml");
						} else { // Internet Explorer 
							xmlStrDoc1 = new ActiveXObject("Microsoft.XMLDOM");
							xmlStrDoc1.async = "false";
							xmlStrDoc1.loadXML(str);
						}
						var sumCount = 0;
						var sumJiashui = 0;
						var sumFanli = 0;
//						var kpDate = xmlStrDoc1.getElementsByTagName('head')[0].childNodes[0].getAttribute("ddate").substr(0,10);
						for (var i=0;i<xmlStrDoc1.getElementsByTagName('head')[0].childNodes.length;i++) {
							$(".footerWindow").append("<div class='listBox'><p class='standard' style='width:100%;text-align: left;text-indent: 0.5rem;'>存货名称：" + xmlStrDoc1.getElementsByTagName('head')[0].childNodes[i].getAttribute("cInvName") + "</p><p class='standard' style='width:40%;text-align: left;text-indent: 0.5rem;float: left;'>数量：" + parseFloat(xmlStrDoc1.getElementsByTagName('head')[0].childNodes[i].getAttribute("iQuantity")) + "</p><p class='standard' style='width:40%;text-align: left;text-indent: 0.5rem;float: left;'>单价：¥" + parseFloat(xmlStrDoc1.getElementsByTagName('head')[0].childNodes[i].getAttribute("iTaxUnitPrice")) + "</p><p class='standard' style='width:100%;text-align: left;text-indent: 0.5rem;'>金额：¥" + parseFloat(xmlStrDoc1.getElementsByTagName('head')[0].childNodes[i].getAttribute("iSum")) + "</p></div>");
							sumFanli+=parseFloat(xmlStrDoc1.getElementsByTagName('head')[0].childNodes[i].getAttribute("cDefine25"));
							sumCount+=parseFloat(xmlStrDoc1.getElementsByTagName('head')[0].childNodes[i].getAttribute("iQuantity"));
							sumJiashui+=parseFloat(xmlStrDoc1.getElementsByTagName('head')[0].childNodes[i].getAttribute("iSum"));
						}
						$(".neworderheader .detail .num")[0].innerHTML = sumCount;
						$(".neworderheader .detail .zongfanli")[0].innerHTML = sumFanli.toFixed(2);
						$(".neworderheader .detail .jine")[0].innerHTML = sumJiashui.toFixed(2);
					});
					
				}
			}
		}
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
		
		var time = now.getHours();
		//		获取开放时间
		$.get("php/timeQuery.php", function(data) {
			var timeStr = JSON.parse(data);
			var startTime = timeStr[0].startTime;
			var endTime = timeStr[0].endTime;
			if(time > startTime && time < endTime){
//				console.log("不能对账");
				$(".content").css({
					display:"none"
				});
				$(".queryTime").css({
					display:"block"
				});
				$(".queryTime")[0].innerHTML = "对账时间为"+endTime+":00到次日"+startTime+":00之间";
			}
			
		});
	</script>

</html>



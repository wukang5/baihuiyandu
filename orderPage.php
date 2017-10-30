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
				font-size: 10px;
			}
			
			.header {
				width: 100%;
				background-color: white;
			}
			
			.header .headMenu {
				width: 100%;
				height: 0.6rem;
				text-align: center;
				line-height: 0.6rem;
				font-size: 0.25rem;
				color: #8a8a8a;
			}
			
			.header .headMenu .newOrder {
				width: 50%;
				height: 0.6rem;
				float: left;
				color: #e98f36;
				border-bottom: #e98f36 solid 0.01rem;
			}
			
			.header .headMenu .orderList {
				width: 50%;
				height: 0.6rem;
				float: left;
				border-bottom: #8a8a8a solid 0.01rem;
			}
			
			.footer {
				width: 100%;
				display: flex;
				background-color: ghostwhite;
				justify-content: space-around;
				border-top: gray solid 0.01rem;
			}
			
			.footer div {
				width: 0.6rem;
				height: 0.6rem;
				text-align: center;
			}
			
			.footer div img {
				width: 0.4rem;
			}
			
			.footer div p {
				font-size: 0.15rem;
				color: #8a8a8a;
				text-align: center;
			}
			
			.adInfo {
				width: 100%;
				height: 100%;
				background-color: transparent;
				position: absolute;
				top: 0;
				z-index: 500;
				display: none;
			}
			
			.reminder {
				width: 4rem;
				height: 3rem;
				background-color: #e2e2e2;
				border-radius: 0.2rem;
				font-size: 0.3rem;
				position: absolute;
				top: 50%;
				left: 50%;
				margin-top: -2rem;
				margin-left: -2rem;
				z-index: 1000;
			}
			
			.reminder p {
				text-align: center;
				line-height: 1.2rem;
			}
			
			.reminder img {
				width: 1.5rem;
			}
		</style>
	</head>

	<body>
		<div class="adInfo">
			<div class="reminder">
				<p>正在<span class="btnType">保存</span>，请您耐心等待...</p>
				<p><img src="img/wait.gif"/></p>
			</div>
		</div>
		<div class="wrap">
			<div class="header">
				<div class="headMenu">
					<div class="newOrder">新建订单</div>
					<div class="orderList">订单列表</div>
				</div>
			</div>
			<div class="neworderform">
				<div class="neworderheader">
					<div style="height: 0.5rem;margin-top: 0.1rem;">
						<div class="neworderbtn save">保存</div>
						<div class="ordertime" style="color: red; font-weight: bold;float: left;margin-left: 0;display: none;">00</div>
						<div class="neworderbtn check" style="display: none;">审核</div>
					</div>
					<div class="neworderdiv customer">
						<span>客户：</span><span class="customerName">客户名</span>
					</div>
					<div class="neworderdiv balance">
						<span>客户余额：</span><span class="money"></span>
					</div>
					<div class="neworderdiv balance">
						<span>信用额度：</span><span class="creditMoney"></span>
					</div>
					<div class="neworderdiv balance">
						<span>已占用金额：</span><span class="UseingMoney">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;&nbsp;&nbsp;
						<span>可用余额：</span><span class="balanceMoney">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
					</div>
					<div class="neworderdiv jgcBalance">
						<span>加工厂返利余额：</span><span class="money"></span>
					</div>
					<div class="neworderdiv tzcBalance">
						<span>屠宰厂返利余额：</span><span class="money"></span>
					</div>
					<div class="neworderdiv balance">
						<p class="remarkName">备注：</p><p class="remark"></p>
					</div>
					<div class="neworderdiv dhDate">
						<span>单据日期：</span><input disabled="disabled" type="date" name="" id="" value="" />
					</div>
					
					<div class="neworderdiv detail" style="margin-top: 0.4rem;">
						<span>总数量</span><span class="num">0</span> <span>总金额</span><span>¥</span><span class="jine">0.00</span>
						<div class="neworderbtn addInventory">添加存货</div>
					</div>
				</div>
				<div class="neworderfooter">
					<div class="footerWindow"></div>
				</div>
				<!--添加备注页面-->
				<div class="addRemark">
					<textarea name="remark" rows="10" cols="40"></textarea>
					<div class="neworderbtn remarkBtn">添加备注</div>
				</div>
				<div class="seachWrap">
					<div class="selectGoods">
						<p>选择存货</p>
						<div class="search">
							<input type="text" name="" id="" value="" />
							<p class="searchBtn">搜索</p>
						</div>
						<div class="foodTrain">
							<div class="collect">

							</div>
						</div>
						<div class="btnBox">
							<p class="sure">确定</p>
						</div>
					</div>
				</div>
				<div class="reviseWrap">
					<div class="reviseCount">
						<div class="countBox">
							<p>数量</p>
							<input type="tel" name="" id="" value="" />
						</div>
						<div class="reviseBtnBox btnBox">
							<p class="numsure">确定</p>
							<p class="numcancel">取消</p>
						</div>
					</div>
				</div>
				<div class="reviseWrap1">
					<div class="reviseCount1">
						<p class='goodInfo' style="width: 100%;text-align: left;text-indent: 0.5rem;">品名</p>
						<p class='goodInfo'>商品号</p>
						<p style="width: 0.2rem;position: absolute;top: 0.4rem;left: 3.6rem;">¥</p>
						<p class='goodInfo'>单价</p>
						<div class="countBox1">
							<p>数量</p>
							<input style="width: 4.5rem" type="tel" name="" id="" value="" />
						</div>
						
						<div class="reviseBtnBox1 btnBox">
							<p class="numsure1">确定</p>
							<p class="numcancel1">取消</p>
						</div>
					</div>
				</div>
			</div>
			<div class="orderlistform" style="display: none;">
				<div class="headBox">
					<select class="checkSelect" name="">
						<option value="all" selected="selected">所有</option>
						<option value="nockeck">未审核</option>
						
						<option value="checked">已审核</option>
					</select>
					<div class="dhDateBox">
						<span>单据日期</span><input class="dhDate" type="date" name="" id="" value="" />
					</div>
					<div class="pageBtn">
						<p class="lastPage">上一页</p>
						<p class="nextPage">下一页</p>
					</div>
				</div>
				<div class="footBox">

				</div>
				<p class="pageNum" style="text-align: center;display: none; font-size: 0.25rem;"></p>
			</div>
			<div class="footer">
				<div class="orderPage"><img src="img/dingdan.png" alt="" />
					<p style="color: black;">订单</p>
				</div>
				<div class="accountChecking"><img src="img/duizhang1.png" alt="" /><p>对帐</p></div>
				<div class="userPage"><img src="img/wode.png" alt="" />
					<p>我的</p>
				</div>
			</div>
		</div>
	</body>
	<script src="js/efid.js" type="text/javascript" charset="utf-8"></script>
	<script src="js/publicJs.js" type="text/javascript" charset="utf-8"></script>
	<script>
		$(".footer").innerHeight(0.068 * window.innerHeight);
		$(".neworderform").innerHeight(0.86 * window.innerHeight);
		$(".neworderheader").innerHeight(0.37 * window.innerHeight);
		$(".neworderfooter").innerHeight(0.37 * window.innerHeight);
		$(".orderlistform").innerHeight(0.86 * window.innerHeight);
		$(".headBox").innerHeight(0.20 * window.innerHeight);
		$(".footBox").innerHeight(0.55 * window.innerHeight);
		
		//信用额度
		$(".creditMoney")[0].innerText = sessionStorage.getItem("creditMoney");
		//客户余额
		$(".money")[0].innerText = sessionStorage.getItem("money");
		//已占用金额
		$(".UseingMoney")[0].innerText = sessionStorage.getItem("UseingMoney");
		//可用余额
		$(".balanceMoney")[0].innerText = sessionStorage.getItem("balanceMoney");
		//加工厂返利余额
		$(".jgcBalance .money")[0].innerText = sessionStorage.getItem("jgcBalance");
		//屠宰场返利余额
		$(".tzcBalance .money")[0].innerText = sessionStorage.getItem("tzcBalance");
		//		事件
		$(".accountChecking")[0].addEventListener('touchstart', accountChecking, false);

		function accountChecking(e) {
			window.location.href = "accountChecking.php";
		}
		$(".userPage")[0].addEventListener('touchstart', userPage, false);

		function userPage(e) {
			window.location.href = "userPage.php";
		}
//		点击添加备注
		$(".remark")[0].addEventListener('touchstart', remark, false);

		function remark(e) {
			$(".addRemark").css({
				display:"block"
			});
			$("textarea").val($(".remark").html());
		}
		$(".remarkBtn")[0].addEventListener('touchstart', remarkBtn, false);

		function remarkBtn(e) {
			$(".addRemark").css({
				display:"none"
			});
			$(".remark").html($("textarea").val());
			
		}
		
		
		//		新建订单
		var issave = true;//判断能否保存
		$(".newOrder")[0].addEventListener('touchstart', newOrder, false);

		function newOrder(e) {
			$(".newOrder").css({
				color: "#e98f36",
				"border-bottom": "#e98f36 solid 0.01rem"
			})
			$(".neworderform").css({
				display: "block"
			})
			$(".orderList").css({
				color: "#8a8a8a",
				"border-bottom": "#8a8a8a solid 0.01rem"
			})
			$(".orderlistform").css({
				display: "none"
			})
		}
		var now = new Date();
		var day = ("0" + now.getDate()).slice(-2);
		var month = ("0" + (now.getMonth() + 1)).slice(-2);
		var today = now.getFullYear() + "-" + (month) + "-" + (day);
		$(".dhDateBox .dhDate").val(today);
		
		
		
		$(".reviseWrap .numcancel")[0].addEventListener('touchstart', numcancel, false);

		function numcancel(e) {
			$(".reviseWrap").css({
				display: "none"
			});
			$(".reviseWrap input").val("");
			$(".reviseCount .goodInfo").remove();
			$(".reviseCount .priceInfo").remove();
		}
		var count = 0;
		var $inputwrapper = $('.countBox');
	    $inputwrapper.find('input').on('input propertychange',function() {
			var result = $(this).val();
	        count = result;
	    });
	    $(".reviseWrap .numsure")[0].addEventListener('touchstart', numsure, false);
		function numsure(e) {
			if ($(".reviseCount .priceInfo")[0]!==undefined) {
				issave = true;
				$(".reviseWrap input").val("");
				var allPEl = document.querySelectorAll(".reviseCount .goodInfo");
				var aPrice = $(".reviseCount .priceInfo")[0].innerHTML;
				$(".reviseWrap").css({
					display: "none"
				});
				if(count != 0) {
					$(".footerWindow").append("<div class='listBox'><p class='standard' style='width: 4rem;text-align: left;text-indent: 0.5rem;'>" + allPEl[0].innerHTML + "</p><p style='width:0.2rem;position:absolute;right:2.5rem;'>¥</p><p class='price' style='width: 1rem;margin-left: 0.4rem;text-align: left;'>" + aPrice + "</p><p class='goodName'>" + allPEl[1].innerHTML + "</p><p class='count'>" + count + "</p><p class='delList' style='width:0.8rem;height:0.4rem;font-size:0.25rem;border: 0.01rem solid black;position: absolute;top: 0.25rem;right: 0.2rem;line-height: 0.4rem;'>删除</p></div>");
				} else {
					alert("商品数量不能为0");
				}
				$(".reviseCount .goodInfo").remove();
				$(".reviseCount .priceInfo").remove();
			}
		}

		$(".sure")[0].addEventListener('touchstart', sure, false);

		function sure(e) {
			$(".seachWrap").css({
				display: "none"
			});
			var lists = document.querySelectorAll(".listBox");
			var goodInfoEl = document.querySelectorAll(".reviseWrap1 .goodInfo");
			
			var index;
			for(var i = 0; i < lists.length; i++) {
				lists[i].onclick = function() {
					index = $(this).index();
					$(".reviseWrap1").css({
						display: "block"
					});
					goodInfoEl[0].innerHTML = this.children[0].innerHTML;
					goodInfoEl[1].innerHTML = this.children[3].innerHTML;
					goodInfoEl[2].innerHTML = this.children[2].innerHTML;
					$(".reviseWrap1 input").val(this.children[4].innerHTML);
				}
			}

			function addFun() {
				var sumPrice = 0;
				var count = 0;
				for(var i = 0; i < lists.length; i++) {
					count = count + parseFloat(lists[i].children[4].innerHTML);
					sumPrice = sumPrice + parseFloat(lists[i].children[4].innerHTML) * parseFloat(lists[i].children[2].innerHTML);
				}
				$(".neworderheader .detail .num")[0].innerHTML = count;
//				console.log(sumPrice);
				$(".neworderheader .detail .jine")[0].innerHTML = sumPrice.toFixed(2);
//				console.log($(".neworderheader .detail .jine")[0].innerHTML)
			}
			addFun();
			$(".reviseWrap1 .numcancel1")[0].addEventListener('touchstart', numcancel1, false);
			function numcancel1(e) {
				$(".reviseWrap1").css({
					display: "none"
				})
			}
			$(".reviseWrap1 .numsure1")[0].addEventListener('touchstart', numsure1, false);

			function numsure1(e) {
				issave = true;
				if($(".reviseWrap1 input").val() != 0) {
					$(".reviseWrap1").css({
						display: "none"
					});
					var newCount = document.querySelectorAll(".count");
					newCount[index].innerHTML = $(".reviseWrap1 input").val();
				} else {
					alert("商品数量不能为0");
				}
				addFun();
			}
			var delListEl = document.querySelectorAll(".delList");
			for (var i=0;i<delListEl.length;i++) {
				delListEl[i].addEventListener('touchstart', delList, false);
				function delList (e) {
					e.preventDefault();
					this.parentNode.remove();
					var lists = document.querySelectorAll(".listBox");
					var sumPrice = 0;
					var count = 0;
					for(var i = 0; i < lists.length; i++) {
						count = count + parseFloat(lists[i].children[4].innerHTML);
						sumPrice = sumPrice + parseFloat(lists[i].children[4].innerHTML) * parseFloat(lists[i].children[2].innerHTML);
					}
					$(".neworderheader .detail .num")[0].innerHTML = count;
					$(".neworderheader .detail .jine")[0].innerHTML = sumPrice.toFixed(2);
				}
			}
		}
		function timeCtl () {
			var time = now.getHours();
			//		获取开放时间
			$.get("php/timeQuery.php", function(data) {
				var timeStr = JSON.parse(data);
				var startTime = timeStr[0].startTime;
				var endTime = timeStr[0].endTime;
				if(time < startTime || time >= endTime){
					$(".check").css({
						display:"none"
					});
					$(".ordertime").css({
						display:"block"
					});
					$(".ordertime")[0].innerHTML = "订货时间为"+startTime+":00-"+endTime+":00之间";
				}
			});
		}
		$(".save")[0].addEventListener('touchstart', save, false);

		function save(e) {
				if($(".footerWindow")[0].innerHTML == "") {
					alert("您没有选择任何商品");
				} else {
//					if ($(".balance .balanceMoney")[0].innerText>0 && Math.abs($(".balance .balanceMoney")[0].innerText) > $(".neworderheader .detail .jine")[0].innerHTML && $(".footerWindow")[0].innerHTML != "") {
							if (issave == true) {
								$(".adInfo").css({
									display:"block"
								});
								$(".btnType").html("保存");
								issave = false;
								var lists = document.querySelectorAll(".listBox");
								var t_ccuscode = sessionStorage.getItem("ccuscode");
								var t_ccusname = sessionStorage.getItem("ccusname");
								var cCusCode = sessionStorage.getItem("ccuscode");
								var context1 = '<?xml version="1.0" encoding="utf-8"?><ufinterface efserverid="'+efid+'" eftype="EFXYKZ003" sqlstr="  insert * from inventory " proc="ADD" efdebug="1" ><voucher cardnumber="EFXYKZ003" ccardname="" xmlns:z="EF"><head><VoucherFieldDescription   ddate="单据日期" cmaker="制单人" cmakerddate="制单日期" vt_id="单据默认模板号" cvouchtype="cvouchtype" t_ccuscode="客户编码" t_ccusname="客户名称" /><z:row xmlns:z="#RowsetSchema" ddate="' + today + 'T00:00:00" cmaker="手机订单审核" cmakerddate="' + today + 'T00:00:00" vt_id="131397" cvouchtype="EFXYKZ003" t_ccuscode="' + t_ccuscode + '" t_ccusname="' + t_ccusname + '" cCusCode="' + cCusCode + '" str70="' + $(".remark").html() + '"/></head><body><VoucherFieldDescription b_cinvcode="存货编码" b_cinvname="存货名称" b_float1="数量" b_float2="单价" b_float3="金额"/>';
								var context2 = "";
								for(var i = 0; i < lists.length; i++) {
									context2 = context2 + '<z:row xmlns:z="#RowsetSchema"  b_cinvcode="' + lists[i].children[3].innerHTML + '" b_cinvname="' + lists[i].children[0].innerHTML + '" b_float1="' + lists[i].children[4].innerHTML + '" b_float2="' + lists[i].children[2].innerHTML + '" b_float3="' + lists[i].children[2].innerHTML * lists[i].children[4].innerHTML + '" />';
								}
								var context = context1 + context2 + '</body></voucher></ufinterface>';
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
									if(xmlStrDoc.getElementsByTagName('ufinterface')[0].getAttribute("succeed") == "1") {
										$(".adInfo").css({
											display:"none"
										});
										alert("保存成功");
										timeCtl();
										$(".check").css({
											display: "block"
										});
										
										$(".headMenu .newOrder")[0].innerHTML = "审核订单";
									}
								});
							} else{
								alert("该订单已保存");
							}
//					} else {
//						alert("余额不足，无法保存订单。");
//					}
				}
		}
		//		获取最新订单
		$(".check")[0].addEventListener('touchstart', check, false);

		function check(e) {
//			if ($(".balance .balanceMoney")[0].innerText>0 && Math.abs($(".balance .balanceMoney")[0].innerText) > $(".neworderheader .detail .jine")[0].innerHTML && $(".footerWindow")[0].innerHTML != "") {
				$(".adInfo").css({
					display:"block"
				});
				$(".btnType").html("审核");
				var context = '<?xml version="1.0" encoding="utf-8"?><ufinterface  efserverid="'+efid+'" eftype="EFsql" proc="Query" efdebug="1" sqlstr="SELECT TOP 1 [id] FROM [UFDATA_'+efid+'_2015].[dbo].[V_EF_XYbase] WHERE cvouchtype=\'EFXYKZ003\' AND t_ccuscode=\'' + sessionStorage.getItem("ccuscode") + '\' order by id desc"></ufinterface>';
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
					var newcontext = '<?xml version="1.0" encoding="utf-8"?><ufinterface efserverid="'+efid+'" eftype="EFXYKZ003" proc="Query" efid="' + xmlStrDoc.getElementsByTagName('head')[0].childNodes[0].getAttribute("id") + '" efdebug="0"></ufinterface>';
					$.post("php/inventory.php", {
						context: newcontext
					}, function(str) {
						var newXmlStrDoc = null;
						if(window.DOMParser) { // Mozilla Explorer 
							parser = new DOMParser();
							newXmlStrDoc = parser.parseFromString(str, "text/xml");
						} else { // Internet Explorer 
							newXmlStrDoc = new ActiveXObject("Microsoft.XMLDOM");
							newXmlStrDoc.async = "false";
							newXmlStrDoc.loadXML(str);
						}
						newXmlStrDoc.getElementsByTagName('ufinterface')[0].setAttribute("proc", "Verify");
						newXmlStrDoc.getElementsByTagName('ufinterface')[0].setAttribute("ddate", newXmlStrDoc.getElementsByTagName('head')[0].childNodes[0].getAttribute("ddate").substring(0,10));
						var oSerializer = new XMLSerializer();
						var sXML = oSerializer.serializeToString(newXmlStrDoc);
						var sXML = '<?xml version="1.0" encoding="utf-8" ?>' + sXML;
						$.post("php/inventory.php", {
							context: sXML
						}, function(str) {
							var checkXmlStrDoc = null;
							if(window.DOMParser) { // Mozilla Explorer 
								parser = new DOMParser();
								checkXmlStrDoc = parser.parseFromString(str, "text/xml");
							} else { // Internet Explorer 
								checkXmlStrDoc = new ActiveXObject("Microsoft.XMLDOM");
								checkXmlStrDoc.async = "false";
								checkXmlStrDoc.loadXML(str);
							}
							if(checkXmlStrDoc.getElementsByTagName('ufinterface')[0].getAttribute("succeed") == "1") {
								$(".adInfo").css({
									display:"none"
								});
								alert("审核成功");
								window.location.href = "orderPage.php";
							}else{
								$(".adInfo").css({
									display:"none"
								});
								alert("审核失败");
							}
						});
					});
				});
				
//			} else {
//				alert("余额不足，无法审核订单。");
//			}
			
		}
		//				订单列表
		$(".orderList")[0].addEventListener('touchstart', orderList, false);

		function orderList(e) {
			$(".newOrder").css({
				color: "#8a8a8a",
				"border-bottom": "#8a8a8a solid 0.01rem"
			})
			$(".neworderform").css({
				display: "none"
			})
			$(".orderList").css({
				color: "#e98f36",
				"border-bottom": "#e98f36 solid 0.01rem"
			})
			$(".orderlistform").css({
				display: "block"
			})
		}
		
		//		上一页/下一页控制
		var dateFun = 0;
		pageCtl(1);
		var pages;
		var pagesNum;
		$(".lastPage")[0].addEventListener('touchstart', lastpage, false);

		function lastpage(e) {
			$(".footBox .mylist").remove();
			pages = Number(sessionStorage.getItem("pages"));
			if(pages > 1) {
				pages = pages - 1;
			}
			if (dateFun == 0) {
				pageCtl(pages);
			} else{
				dateQuery(pages);
			}
		}
		$(".nextPage")[0].addEventListener('touchstart', nextpage, false);

		function nextpage(e) {
			$(".footBox .mylist").remove();
			pages = Number(sessionStorage.getItem("pages"));
			pagesNum = Number(sessionStorage.getItem("pagesNum"));
			if(pages < pagesNum) {
				pages = pages + 1;
			}
			if (dateFun == 0) {
				pageCtl(pages);
			} else{
				dateQuery(pages);
			}
		}
		function pageCtl(pagenumber) {
			$(".pageNum").css({
				display:"block"
			});
			$(".footBox .mylist").remove();
			var context = '<?xml version="1.0" encoding="utf-8"?><ufinterface  efserverid="'+efid+'" eftype="EFsql" pagenumer="' + pagenumber + '" pagesize="5" proc="Query" efdebug="1" sqlstr="SELECT id,ddate,t_ccuscode,t_ccusname,cverifier, ccode FROM V_EF_XYbase WHERE ddate=\'' + $(".dhDateBox .dhDate").val() + '\' AND cvouchtype=\'EFXYKZ003\' AND t_ccuscode=\'' + sessionStorage.getItem("ccuscode") + '\'" orderbyfilename = "ccode"></ufinterface>';
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
				if (xmlStrDoc.getElementsByTagName('ufinterface')[0].getAttribute("succeed") == 1) {
					sessionStorage.setItem("pages", xmlStrDoc.getElementsByTagName("voucher")[0].getAttribute("pagenumer"));
					$(".pageNum").html("第"+xmlStrDoc.getElementsByTagName("voucher")[0].getAttribute("pagenumer")+"页/共"+xmlStrDoc.getElementsByTagName("voucher")[0].getAttribute("pages")+"页");
					sessionStorage.setItem("pagesNum", xmlStrDoc.getElementsByTagName("voucher")[0].getAttribute("pages"));
					for(var i = 0; i < xmlStrDoc.getElementsByTagName('head')[0].childNodes.length; i++) {
						var check = "";
						if(xmlStrDoc.getElementsByTagName('head')[0].childNodes[i].getAttribute("cverifier") == null) {
							check = "未审核";
						} else {
							check = "已审核";
						}
						var dateStr = xmlStrDoc.getElementsByTagName('head')[0].childNodes[i].getAttribute("ddate").slice(0, 10);
						$(".footBox").append("<div class='mylist'><p class='listCode'>" + xmlStrDoc.getElementsByTagName('head')[0].childNodes[i].getAttribute("ccode") + "</p><p class='date'>" + dateStr + "</p><p class='customerName'>" + xmlStrDoc.getElementsByTagName('head')[0].childNodes[i].getAttribute("t_ccusname") + "</p><p class='state'>" + check + "</p><p class='listId' style='display: none;'>" + xmlStrDoc.getElementsByTagName('head')[0].childNodes[i].getAttribute("id") + "</p></div>");
					}
					toOrder();
					var footBox = document.querySelectorAll(".footBox");
					var mylist = document.querySelectorAll(".mylist");
					for(var i = mylist.length - 1; i >= 0; i--) {
						$(".footBox").append(mylist[i]);
					}
				}
				
			});
		}
		//		审核/未审核查询
		$(".checkSelect").change(function() {
			var state = document.querySelectorAll(".state");
			var mylist = document.querySelectorAll(".mylist");
			switch($(".checkSelect").val()) {
				case "all":
					for(var i = 0; i < mylist.length; i++) {
						mylist[i].style.display = "block";
					}
					break;
				case "checked":
					for(var i = 0; i < state.length; i++) {
						if(state[i].innerHTML == "未审核") {
							state[i].parentElement.style.display = "none";
						} else {
							state[i].parentElement.style.display = "block";
						}
					}
					break;
				case "nockeck":
					for(var i = 0; i < state.length; i++) {
						if(state[i].innerHTML == "已审核") {
							state[i].parentElement.style.display = "none";
						} else {
							state[i].parentElement.style.display = "block";
						}
					}
					break;
				default:
					break;
			}
		});
		
		//		日期查询
		function dateQuery (pagenumber) {
			$(".pageNum").css({
				display:"block"
			});
			$(".footBox .mylist").remove();
			var context = '<?xml version="1.0" encoding="utf-8"?><ufinterface  efserverid="'+efid+'" eftype="EFsql"  pagenumer="' + pagenumber + '" pagesize="5" sqlstr="SELECT id, t_ccuscode,t_ccusname,cverifier, ccode,ddate FROM V_EF_XYbase WHERE cvouchtype=\'EFXYKZ003\' AND t_ccuscode=\'' + sessionStorage.getItem("ccuscode") + '\' AND ddate=\'' + $(".dhDateBox .dhDate").val() + '\'" proc="Query" efdebug="1"  ></ufinterface>';
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
				if(xmlStrDoc.getElementsByTagName('ufinterface')[0].getAttribute("succeed") == "1") {
					sessionStorage.setItem("pages", xmlStrDoc.getElementsByTagName("voucher")[0].getAttribute("pagenumer"));
					$(".pageNum").html("第"+xmlStrDoc.getElementsByTagName("voucher")[0].getAttribute("pagenumer")+"页/共"+xmlStrDoc.getElementsByTagName("voucher")[0].getAttribute("pages")+"页");
					sessionStorage.setItem("pagesNum", xmlStrDoc.getElementsByTagName("voucher")[0].getAttribute("pages"));
					for(var i = 0; i < xmlStrDoc.getElementsByTagName('head')[0].childNodes.length; i++) {
						var check = "";
						if(xmlStrDoc.getElementsByTagName('head')[0].childNodes[i].getAttribute("cverifier") == null) {
							check = "未审核";
						} else {
							check = "已审核";
						}
						var dateStr = xmlStrDoc.getElementsByTagName('head')[0].childNodes[i].getAttribute("ddate").slice(0, 10);
						$(".footBox").append("<div class='mylist'><p class='listCode'>" + xmlStrDoc.getElementsByTagName('head')[0].childNodes[i].getAttribute("ccode") + "</p><p class='date'>" + dateStr + "</p><p class='customerName'>" + xmlStrDoc.getElementsByTagName('head')[0].childNodes[i].getAttribute("t_ccusname") + "</p><p class='state'>" + check + "</p><p class='listId' style='display: none;'>" + xmlStrDoc.getElementsByTagName('head')[0].childNodes[i].getAttribute("id") + "</p></div>");
					}
					toOrder();
				} else {
					alert("该日期无订单");
					pageCtl(pagenumber);
				}
			});
		}
		$(".dhDateBox .dhDate").change(function() {
			dateFun = 1;
			dateQuery(1);
		});

		function toOrder() {
			var mylist = document.querySelectorAll(".footBox .mylist");
			for(var i = 0; i < mylist.length; i++) {
				mylist[i].onclick = function() {
					var ccode = this.children[0].innerHTML;
					sessionStorage.setItem("listcode", ccode);
					sessionStorage.setItem("listId", this.children[4].innerHTML);
					sessionStorage.setItem("isChecked", this.children[3].innerHTML);
					window.location.href = "checkOrder.php";
				}
			}
		}
	</script>

</html>
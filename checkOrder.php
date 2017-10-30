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
				font-size: 10px;
			}
			
			.header {
				width: 100%;
			}
			
			.header div {
				width: 90%;
				height: 0.6rem;
				margin-left: 5%;
				line-height: 0.6rem;
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
				<div class="pageItem"><p class="back" style="width: 1.2rem;float: left;">返回</p><p style="width: 2rem;float: left;margin-left: 1.2rem;">审核订单</p></div>
			</div>
			<div class="neworderform">
				<div class="neworderheader">
					<div class="headerBtn" style="height: 0.5rem;margin-top: 0.1rem;">
						<div class="neworderbtn save">保存</div>
						<div class="ordertime" style="color: red; font-weight: bold;float: left;margin-left: 0;display: none;">00</div>
						<div class="neworderbtn check">审核</div>
					</div>
					<div class="neworderdiv customer">
						<span>客户：</span><span class="customerName"></span>
					</div>
					<div class="neworderdiv cCode">
						<span>订单号：</span><span class="ccodeName"></span>
					</div>
					<div class="neworderdiv balance">
						<p class="remarkName">备注：</p><p class="remark"></p>
					</div>
					<div class="neworderdiv dhDate">
						<span>单据日期：</span><input disabled="disabled" type="date" name="" id="" value="" />
					</div>
					<div class="neworderdiv detail">
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
		</div>
	</body>
	<script src="js/efid.js" type="text/javascript" charset="utf-8"></script>
	<script src="js/publicJs.js" type="text/javascript" charset="utf-8"></script>
	<script>
		$(".neworderform").innerHeight(0.935 * window.innerHeight);
		$(".neworderheader").innerHeight(0.2 * window.innerHeight);
		$(".neworderfooter").innerHeight(0.62 * window.innerHeight);
		var now = new Date();
		var time = now.getHours();
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
		timeCtl();
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
		//		事件
		if(sessionStorage.getItem("isChecked") == "已审核") {
			$(".headerBtn").css({
				display:"none"
			});
			$(".addInventory").css({
				display:"none"
			});
			
		}
		$(".ccodeName").html(sessionStorage.getItem("listcode"));
		var issave = false//判断能否保存
		var context = '<?xml version="1.0" encoding="utf-8"?><ufinterface  efserverid="'+efid+'" eftype="EFsql" pagenumer="1" pagesize="200" sqlstr="SELECT ccode,t_ccuscode,cverifier, ddate,b_cinvcode,b_cinvname,b_float1,b_float2,str70 FROM V_List_EF_XYbase WHERE cvouchtype=\'EFXYKZ003\' AND ccode=\'' + sessionStorage.getItem("listcode") + '\'" proc="Query" efdebug="1"  ></ufinterface>';
		$.ajaxSettings.async = false;
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
			$(".remark").html(xmlStrDoc.getElementsByTagName('head')[0].childNodes[0].getAttribute("str70"));
			for(var i = 0; i < xmlStrDoc.getElementsByTagName('head')[0].childNodes.length; i++) {
				$(".footerWindow").append("<div class='listBox'><p class='goodName' style='width: 3.5rem;text-align: left;text-indent: 0.3rem;'>" + xmlStrDoc.getElementsByTagName('head')[0].childNodes[i].getAttribute("b_cinvname") + "</p><p style='width:0.2rem;position:absolute;right:2.3rem;'>¥</p><p class='price' style='width: 2rem;'>" + parseFloat(xmlStrDoc.getElementsByTagName('head')[0].childNodes[i].getAttribute("b_float2")) + "</p><p class='standard'>" + xmlStrDoc.getElementsByTagName('head')[0].childNodes[i].getAttribute("b_cinvcode") + "</p><p class='count'>" + parseFloat(xmlStrDoc.getElementsByTagName('head')[0].childNodes[i].getAttribute("b_float1")) + "</p><p class='delList' style='width:0.8rem;height:0.4rem;font-size:0.3rem;border: 0.01rem solid black;position: absolute;top: 0.25rem;right: 0.2rem;line-height: 0.4rem;'>删除</p></div>");
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
			var listBox = document.querySelectorAll(".listBox");
			var oldCount = 0;
			var oldAllPrice = 0;
			for(var i = 0; i < listBox.length; i++) {
				oldCount = oldCount + parseFloat(listBox[i].children[2].innerText);
				oldAllPrice = oldAllPrice + parseFloat(listBox[i].children[2].innerHTML) * parseFloat(listBox[i].children[4].innerHTML);
			}
			$(".neworderheader .detail .num")[0].innerHTML = oldCount;
			$(".neworderheader .detail .jine")[0].innerHTML = Math.floor(oldAllPrice * 100) / 100;
			$(".dhDate input").val(xmlStrDoc.getElementsByTagName('head')[0].childNodes[0].getAttribute("ddate").substring(0, 10));
			updataCount();
		});
		$.ajaxSettings.async = true;
		var index;
		function updataCount () {
			var lists = document.querySelectorAll(".listBox");
			var goodInfoEl = document.querySelectorAll(".reviseWrap1 .goodInfo");
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
					sumPrice = sumPrice + parseFloat(lists[i].children[2].innerHTML) * parseFloat(lists[i].children[4].innerHTML);
				}
				$(".neworderheader .detail .num")[0].innerHTML = count;
				$(".neworderheader .detail .jine")[0].innerHTML = sumPrice.toFixed(2);
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
		}
		$(".pageItem .back")[0].addEventListener('touchstart', back, false);

		function back(e) {
			window.location.href = "orderPage.php";
		}
		
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
					$(".footerWindow").append("<div class='listBox'><p class='standard' style='width: 4rem;text-align: left;text-indent: 0.3rem;'>" + allPEl[0].innerHTML + "</p><p style='width:0.2rem;position:absolute;right:2rem;'>¥</p><p class='price' style='width: 1rem;margin-left: 0.4rem;text-align: left;'>" + aPrice + "</p><p class='goodName'>" + allPEl[1].innerHTML + "</p><p class='count'>" + count + "</p><p class='delList' style='width:0.8rem;height:0.4rem;font-size:0.3rem;border: 0.01rem solid black;position: absolute;top: 0.25rem;right: 0.2rem;line-height: 0.4rem;'>删除</p></div>");
				} else {
					alert("商品数量不能为0");
				}
				$(".reviseCount .goodInfo").remove();
				$(".reviseCount .priceInfo").remove();
			}
		}

		$(".sure")[0].addEventListener('touchstart', sure, false);

		function sure(e) {
//			$(".allFood").remove();
			$(".search input").val("");
			$(".seachWrap").css({
				display: "none"
			});
			updataCount();
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
		
		var isCheck = 0;// 判断运行哪个审核
		$(".save")[0].addEventListener('touchstart', save, false);
		function save(e) {
			if($(".footerWindow")[0].innerHTML == "") {
				alert("您没有选择任何商品");
			} else {
//				if ($(".balance .balanceMoney")[0].innerText>0 && Math.abs($(".balance .balanceMoney")[0].innerText) > $(".neworderheader .detail .jine")[0].innerHTML && $(".footerWindow")[0].innerHTML != "") {
					isCheck = 1;
					if (issave == false) {
						alert("该订单已保存。");
					} else{
						$(".adInfo").css({
							display:"block"
						});
						$(".btnType").html("保存");
						issave = false;
						var now = new Date();
						var day = ("0" + now.getDate()).slice(-2);
						var month = ("0" + (now.getMonth() + 1)).slice(-2);
						var today = now.getFullYear() + "-" + (month) + "-" + (day);
						$(".dhDate input").val(today);
						var lists = document.querySelectorAll(".listBox");
						var t_ccuscode = sessionStorage.getItem("ccuscode");
						var t_ccusname = sessionStorage.getItem("ccusname");
						var cCusCode = sessionStorage.getItem("ccuscode");
						var context1 = '<?xml version="1.0" encoding="utf-8"?><ufinterface efserverid="'+efid+'" eftype="EFXYKZ003" sqlstr="  insert * from inventory " proc="ADD" efdebug="1" ><voucher cardnumber="EFXYKZ003" ccardname="" xmlns:z="EF"><head><VoucherFieldDescription   ddate="单据日期" cmaker="制单人" cmakerddate="制单日期" vt_id="单据默认模板号" cvouchtype="cvouchtype" t_ccuscode="客户编码" t_ccusname="客户名称" /><z:row xmlns:z="#RowsetSchema" ddate="' + today + 'T00:00:00" cmaker="手机订单审核" cmakerddate="' + today + 'T00:00:00" vt_id="131397" cvouchtype="EFXYKZ003" t_ccuscode="' + t_ccuscode + '" t_ccusname="' + t_ccusname + '" cCusCode="' + cCusCode + '" str70="' + $(".remark").html() + '"/></head><body><VoucherFieldDescription b_cinvcode="存货编码" b_cinvname="存货名称" b_float1="数量" b_float2="单价" b_float3="金额"/>';
						var context2 = "";
						for(var i = 0; i < lists.length; i++) {
							context2 = context2 + '<z:row xmlns:z="#RowsetSchema"  b_cinvcode="' + lists[i].children[3].innerHTML + '" b_cinvname="' + lists[i].children[0].innerHTML + '" b_float1="' + lists[i].children[4].innerHTML + '" b_float2="' + lists[i].children[2].innerHTML + '" b_float3="' + lists[i].children[2].innerHTML * lists[i].children[4].innerHTML + '"/>';
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
								alert("保存成功");
								$(".adInfo").css({
									display:"none"
								});
								//						window.location.href = "checkOrder.html";
							}
						});
					}
				
					$(".check")[0].addEventListener('touchstart', check, false);
					function check(e) {
//									console.log(1);
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
										alert("审核成功");
										$(".adInfo").css({
											display:"none"
										})
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
					}
//				} else {
//					alert("余额不足，无法保存订单。");
//				}
			}
		}
		
		$(".check")[0].addEventListener('touchstart', check, false);

		function check(e) {
			if(isCheck == 0) {
//				if ($(".balance .balanceMoney")[0].innerText>0 && Math.abs($(".balance .balanceMoney")[0].innerText) > $(".neworderheader .detail .jine")[0].innerHTML && $(".footerWindow")[0].innerHTML != "") {
//					console.log(2);
					$(".adInfo").css({
						display:"block"
					});
					$(".btnType").html("审核");
					var newcontext = '<?xml version="1.0" encoding="utf-8"?><ufinterface efserverid="'+efid+'" eftype="EFXYKZ003" proc="Query" efid="' + sessionStorage.getItem("listId") + '" efdebug="0"></ufinterface>';
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
//						console.log(newXmlStrDoc.getElementsByTagName('head')[0].childNodes[0].getAttribute("ddate").substring(0,10));
						newXmlStrDoc.getElementsByTagName('ufinterface')[0].setAttribute("proc", "Verify");
						newXmlStrDoc.getElementsByTagName('ufinterface')[0].setAttribute("ddate", newXmlStrDoc.getElementsByTagName('head')[0].childNodes[0].getAttribute("ddate").substring(0,10));
//						console.log(newXmlStrDoc);
						var oSerializer = new XMLSerializer();
						var sXML = oSerializer.serializeToString(newXmlStrDoc);
						var sXML = '<?xml version="1.0" encoding="utf-8" ?>' + sXML;
//						console.log(sXML);
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
//							console.log(checkXmlStrDoc);
							if(checkXmlStrDoc.getElementsByTagName('ufinterface')[0].getAttribute("succeed") == "1") {
								alert("审核成功");
								$(".adInfo").css({
									display:"none"
								});
								window.location.href = "orderPage.php";
							}else{
								$(".adInfo").css({
									display:"none"
								});
								alert("审核失败");
							}
						});
					});
//				} else {
//					alert("余额不足，无法审核订单。");
//				}
			}
		}
	</script>

</html>
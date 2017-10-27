$(".wrap").innerWidth(window.innerWidth);
$(".wrap").innerHeight(window.innerHeight);
$(".header").innerHeight(0.06 * window.innerHeight);
$(".customerName")[0].innerText = sessionStorage.getItem("ccusname");

var now = new Date();
var day = ("0" + now.getDate()).slice(-2);
var month = ("0" + (now.getMonth() + 1)).slice(-2);
var today = now.getFullYear() + "-" + (month) + "-" + (day);
var foodsIndex;

var xyedSum = 0; //信用额度
if(!sessionStorage.creditMoney || sessionStorage.creditMoney == "") {

	var xyed = '<?xml version="1.0" encoding="utf-8"?><ufinterface  efserverid="' + efid + '" eftype="EFsql" sqlstr="select iCusCreLine from Customer where isnull(cCusCode,\'\') = \'' + sessionStorage.getItem("cInvoiceCompany") + '\'" proc="Query" efdebug="1"  ></ufinterface>';

	$.post("php/inventory.php", {
		context: xyed
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
		xyedSum = xmlStrDoc.getElementsByTagName('head')[0].childNodes[0].getAttribute("icuscreline");
		$(".creditMoney")[0].innerText = parseFloat(xyedSum).toFixed(2);
		sessionStorage.setItem("creditMoney", parseFloat(xyedSum).toFixed(2));
		if(xmlStrDoc.getElementsByTagName('ufinterface')[0].getAttribute("succeed") == "1") {
			xxyeFun();
		}
	});
}

function xxyeFun() {
	//信用余额
	var farsum = 0;
	var fDLSum = 0;
	var fBLSum = 0;
	if(!sessionStorage.money || !sessionStorage.UseingMoney || !sessionStorage.balanceMoney || sessionStorage.money == "" || sessionStorage.UseingMoney == "" || sessionStorage.balanceMoney == "") {

		var xyye = '<?xml version="1.0" encoding="utf-8"?><ufinterface  efserverid="' + efid + '" eftype="EFsql" sqlstr="select farsum,fDLSum,fBLSum from SA_CreditSum where isnull(cCusCode,\'\') = \'' + sessionStorage.getItem("cInvoiceCompany") + '\'" proc="Query" efdebug="1"  ></ufinterface>';

		$.post("php/inventory.php", {
			context: xyye
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
			var farsum = xmlStrDoc.getElementsByTagName('head')[0].childNodes[0].getAttribute("farsum");
			var fDLSum = xmlStrDoc.getElementsByTagName('head')[0].childNodes[0].getAttribute("fdlsum");
			var fBLSum = xmlStrDoc.getElementsByTagName('head')[0].childNodes[0].getAttribute("fblsum");

			$(".money")[0].innerText = parseFloat(-1 * farsum - fBLSum).toFixed(2);
			sessionStorage.setItem("money", parseFloat(-1 * farsum - fBLSum).toFixed(2));
			$(".UseingMoney")[0].innerText = parseFloat(fDLSum).toFixed(2);
			sessionStorage.setItem("UseingMoney", parseFloat(fDLSum).toFixed(2));
			$(".balanceMoney")[0].innerText = parseFloat(-1 * farsum - fBLSum - fDLSum + parseFloat(xyedSum)).toFixed(2);
			sessionStorage.setItem("balanceMoney", parseFloat(-1 * farsum - fBLSum - fDLSum + parseFloat(xyedSum)).toFixed(2));
		});
	}
}
if(!sessionStorage.jgcBalance || !sessionStorage.jgcBalance) {
	//加工厂返利余额
	$.ajaxSettings.async  =  true;
	var JGCrebate;
	var context1 = '<?xml version="1.0" encoding="utf-8"?><ufinterface  efserverid="' + efid + '" eftype="EFsql" sqlstr="select  sum(isnull(b_float1,0)) as b_float1  from V_List_EF_XYbase where cvouchtype=\'EFCYBH001\' and isnull(cverifier,\'\')!=\'\' and isnull(b_ccuscode,\'\')=\'' + sessionStorage.getItem("cInvoiceCompany") + '\' and isnull(b_cdepcode,\'\')=\'01020202\'" proc="Query" efdebug="1"  ></ufinterface>';
	$.post("php/inventory.php", {
		context: context1
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
		JGCrebate = xmlStrDoc.getElementsByTagName('head')[0].childNodes[0].getAttribute("b_float1");
		var context2 = '<?xml version="1.0" encoding="utf-8"?><ufinterface  efserverid="' + efid + '" eftype="EFsql" sqlstr="select sum(isnull(Cast(cdefine25 as numeric(16,2)),0)) as aa from SaleBillVouchZT inner join SaleBillVouchZW  on SaleBillVouchZT.sbvid=SaleBillVouchZW.sbvid where ccuscode=\'' + sessionStorage.getItem("cInvoiceCompany") + '\' and cdepcode=\'01020202\'" proc="Query" efdebug="1"  ></ufinterface>';
		$.post("php/inventory.php", {
			context: context2
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
			$(".jgcBalance .money")[0].innerText = (JGCrebate - xmlStrDoc.getElementsByTagName('head')[0].childNodes[0].getAttribute("aa")).toFixed(2);
			sessionStorage.setItem("jgcBalance", (JGCrebate - xmlStrDoc.getElementsByTagName('head')[0].childNodes[0].getAttribute("aa")).toFixed(2));
		});
	});
	$.ajaxSettings.async  =  false;
}
if(!sessionStorage.tzcBalance || sessionStorage.tzcBalance == "") {
	$.ajaxSettings.async  =  true;
	var TZCrebate;
	var context3 = '<?xml version="1.0" encoding="utf-8"?><ufinterface  efserverid="' + efid + '" eftype="EFsql" sqlstr="select  sum(isnull(b_float1,0)) as b_float1  from V_List_EF_XYbase where cvouchtype=\'EFCYBH001\' and isnull(cverifier,\'\')!=\'\' and isnull(b_ccuscode,\'\')=\'' + sessionStorage.getItem("cInvoiceCompany") + '\' and isnull(b_cdepcode,\'\')=\'01020905\'" proc="Query" efdebug="1"  ></ufinterface>';
	$.post("php/inventory.php", {
		context: context3
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
		TZCrebate = xmlStrDoc.getElementsByTagName('head')[0].childNodes[0].getAttribute("b_float1");
		var context4 = '<?xml version="1.0" encoding="utf-8"?><ufinterface  efserverid="' + efid + '" eftype="EFsql" sqlstr="select sum(isnull(Cast(cdefine25 as numeric(16,2)),0)) as aa from SaleBillVouchZT inner join SaleBillVouchZW  on SaleBillVouchZT.sbvid=SaleBillVouchZW.sbvid where ccuscode=\'' + sessionStorage.getItem("cInvoiceCompany") + '\' and cdepcode=\'010200905\'" proc="Query" efdebug="1"  ></ufinterface>';
		$.post("php/inventory.php", {
			context: context4
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
			$(".tzcBalance .money")[0].innerText = (TZCrebate - xmlStrDoc.getElementsByTagName('head')[0].childNodes[0].getAttribute("aa")).toFixed(2);
			sessionStorage.setItem("tzcBalance", (TZCrebate - xmlStrDoc.getElementsByTagName('head')[0].childNodes[0].getAttribute("aa")).toFixed(2));
		});
	});
	$.ajaxSettings.async  =  false;
}
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

//定时缓存函数
var MyLocalStorage = {
	Cache: {
		/** 
		 * 总容量5M 
		 * 存入缓存，支持字符串类型、json对象的存储 
		 * 页面关闭后依然有效 ie7+都有效 
		 * @param key 缓存key 
		 * @param stringVal 
		 * @time 数字 缓存有效时间（秒） 默认60s  
		 * 注：localStorage 方法存储的数据没有时间限制。第二天、第二周或下一年之后，数据依然可用。不能控制缓存时间，故此扩展 
		 * */
		put: function(key, stringVal, time) {
			try {
				if(!localStorage) {
					return false;
				}
				if(!time || isNaN(time)) {
					time = 60;
				}
				var cacheExpireDate = (new Date() - 1) + time * 1000;
				var cacheVal = {
					val: stringVal,
					exp: cacheExpireDate
				};
				localStorage.setItem(key, JSON.stringify(cacheVal)); //存入缓存值  
			} catch(e) {}
		},
		/**获取缓存*/
		get: function(key) {
			try {
				if(!localStorage) {
					return false;
				}
				var cacheVal = localStorage.getItem(key);
				var result = JSON.parse(cacheVal);
				var now = new Date() - 1;
				if(!result) {
					return null;
				} //缓存不存在  
				if(now > result.exp) { //缓存过期  
					this.remove(key);
					return "";
				}
				return result.val;
			} catch(e) {
				this.remove(key);
				return null;
			}
		},
		/**移除缓存，一般情况不手动调用，缓存过期自动调用*/
		remove: function(key) {
			if(!localStorage) {
				return false;
			}
			localStorage.removeItem(key);
		},
		/**清空所有缓存*/
		clear: function() {
			if(!localStorage) {
				return false;
			}
			localStorage.clear();
		}
	} //end Cache  
}

//点击添加存货
$(".addInventory")[0].addEventListener('touchstart', addInventory, false);

function addInventory(e) {
	$(".seachWrap").css({
		display: "block"
	});
	$(".allFood").remove();
	//		渲染收藏的商品
	$(function() {
		if(localStorage.getItem("mystr") != null) {
			var foodsStr = localStorage.getItem("mystr");
			var foodsdata = JSON.parse(foodsStr);
			for(var i = 0; i < foodsdata.length; i++) {
				$(".collect").append("<div class='allFood'><p class='goodInfo' style='width: 80%;text-align: left;text-indent: 0.5rem;'>" + foodsdata[i].foodsname + "</p><p class='goodInfo'>" + foodsdata[i].foodscode + "</p><p class='goodInfo'>" + foodsdata[i].foodsGuige + "</p></div>");
			}
			var foodLists = document.querySelectorAll(".allFood");
			var timeOutEvent = 0;
			$(function() {
				for(var i = 0; i < foodLists.length; i++) {
					foodLists[i].addEventListener('touchstart', longstart, false);

					function longstart() {
						//							长按删除收藏
						foodsIndex = $(this).index();
						timeOutEvent = setTimeout(function(e) {
							timeOutEvent = 0;
							mystr = localStorage.getItem("mystr");
							myobj = JSON.parse(mystr);
							myobj.splice(foodsIndex, 1);
							mystr = JSON.stringify(myobj);
							localStorage.setItem("mystr", mystr);
							foodLists[foodsIndex].remove();
							alert("删除成功");
						}, 500);
						e.preventDefault();
					}
					foodLists[i].addEventListener('touchmove', longmove, false);

					function longmove() {
						clearTimeout(timeOutEvent);
						timeOutEvent = 0;
					}
					foodLists[i].addEventListener('touchend', longend, false);

					function longend() {
						//							点击加订单
						clearTimeout(timeOutEvent);
						if(timeOutEvent != 0) {
							foodsId = this.children[1].innerHTML;
							var context = '<?xml version="1.0" encoding="utf-8" ?><ufinterface efserverid="' + efid + '" eftype="EFsql" sqlstr="select cCusDefine5 from customer where ccusCode = \'' + sessionStorage.getItem("ccuscode") + '\'" proc="Query" efdebug="1" />';
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
								if(xmlStrDoc.getElementsByTagName('head')[0].childNodes[0].getAttribute("ccusdefine5") != null) {
									var context = '<?xml version="1.0" encoding="utf-8" ?><ufinterface efserverid="' + efid + '" eftype="EFsql" pagesize = "1000" sqlstr="select top 1 iprice as price,* from PriceJustify where ccusproperty1 = \'' + xmlStrDoc.getElementsByTagName('head')[0].childNodes[0].getAttribute("ccusdefine5") + '\' and cInvCode=\'' + foodsId + '\' and \'' + today + '\'&gt;=dstartdate and \'' + today + '\'&lt;ISNULL(denddate,\'2099-12-31\') order by dstartdate desc" proc="Query" efdebug="1" />';
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
										$(".reviseCount").append("<p style='width: 0.2rem;position: absolute;top: 0.8rem;left: 3.2rem;'>¥</p><p class='priceInfo' style='position: absolute;top: 0.8rem;left: 3.3rem;'>" + parseFloat(xmlStrDoc.getElementsByTagName('head')[0].childNodes[0].getAttribute("price")) + "</p>");
									});
								} else {
									var context = '<?xml version="1.0" encoding="utf-8"?><ufinterface  efserverid="' + efid + '" eftype="EFsql" pagesize = "1000" sqlstr="select cCusCode from PriceJustify where cInvCode = \'' + foodsId + '\'" proc="Query" efdebug="1"  ></ufinterface>';
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
										var isExist = false;
										for(var i = 0; i < xmlStrDoc.getElementsByTagName('head')[0].childNodes.length; i++) {
											if(xmlStrDoc.getElementsByTagName('head')[0].childNodes[i].getAttribute("ccuscode") == sessionStorage.getItem("ccuscode")) {
												isExist = true;
											}
										}
										if(isExist == false) {
											switch(sessionStorage.getItem("priceGrade")) {
												case "1":
													var context = '<?xml version="1.0" encoding="utf-8"?><ufinterface  efserverid="' + efid + '" eftype="EFsql" sqlstr="select top 1 iNInvCost1 as price,* from [PriceJustify] where cInvCode = \'' + foodsId + '\' and \'' + today + '\'&gt;=dstartdate and \'' + today + '\'&lt;ISNULL(denddate,\'2099-12-31\') and iNInvCost1 is not null and ccusproperty1 is null  order by dstartdate desc" proc="Query" efdebug="1"  ></ufinterface>';
													break;
												case "2":
													var context = '<?xml version="1.0" encoding="utf-8"?><ufinterface  efserverid="' + efid + '" eftype="EFsql" sqlstr="select top 1 iNInvCost2 as price,* from [PriceJustify] where cInvCode = \'' + foodsId + '\' and \'' + today + '\'&gt;=dstartdate and \'' + today + '\'&lt;ISNULL(denddate,\'2099-12-31\') and iNInvCost2 is not null and ccusproperty1 is null  order by dstartdate desc" proc="Query" efdebug="1"  ></ufinterface>';
													break;
												case "3":
													var context = '<?xml version="1.0" encoding="utf-8"?><ufinterface  efserverid="' + efid + '" eftype="EFsql" sqlstr="select top 1 iNInvCost3 as price,* from [PriceJustify] where cInvCode = \'' + foodsId + '\' and \'' + today + '\'&gt;=dstartdate and \'' + today + '\'&lt;ISNULL(denddate,\'2099-12-31\') and iNInvCost3 is not null and ccusproperty1 is null  order by dstartdate desc" proc="Query" efdebug="1"  ></ufinterface>';
													break;
												case "4":
													var context = '<?xml version="1.0" encoding="utf-8"?><ufinterface  efserverid="' + efid + '" eftype="EFsql" sqlstr="select top 1 iNInvCost4 as price,* from [PriceJustify] where cInvCode = \'' + foodsId + '\' and \'' + today + '\'&gt;=dstartdate and \'' + today + '\'&lt;ISNULL(denddate,\'2099-12-31\') and iNInvCost4 is not null and ccusproperty1 is null  order by dstartdate desc" proc="Query" efdebug="1"  ></ufinterface>';
													break;
												case "5":
													var context = '<?xml version="1.0" encoding="utf-8"?><ufinterface  efserverid="' + efid + '" eftype="EFsql" sqlstr="select top 1 iNInvCost5 as price,* from [PriceJustify] where cInvCode = \'' + foodsId + '\' and \'' + today + '\'&gt;=dstartdate and \'' + today + '\'&lt;ISNULL(denddate,\'2099-12-31\') and iNInvCost5 is not null and ccusproperty1 is null  order by dstartdate desc" proc="Query" efdebug="1"  ></ufinterface>';
													break;
												case "6":
													var context = '<?xml version="1.0" encoding="utf-8"?><ufinterface  efserverid="' + efid + '" eftype="EFsql" sqlstr="select top 1 iNInvCost6 as price,* from [PriceJustify] where cInvCode = \'' + foodsId + '\' and \'' + today + '\'&gt;=dstartdate and \'' + today + '\'&lt;ISNULL(denddate,\'2099-12-31\') and iNInvCost6 is not null and ccusproperty1 is null  order by dstartdate desc" proc="Query" efdebug="1"  ></ufinterface>';
													break;
												case "7":
													var context = '<?xml version="1.0" encoding="utf-8"?><ufinterface  efserverid="' + efid + '" eftype="EFsql" sqlstr="select top 1 iNInvCost7 as price,* from [PriceJustify] where cInvCode = \'' + foodsId + '\' and \'' + today + '\'&gt;=dstartdate and \'' + today + '\'&lt;ISNULL(denddate,\'2099-12-31\') and iNInvCost7 is not null and ccusproperty1 is null  order by dstartdate desc" proc="Query" efdebug="1"  ></ufinterface>';
													break;
												case "8":
													var context = '<?xml version="1.0" encoding="utf-8"?><ufinterface  efserverid="' + efid + '" eftype="EFsql" sqlstr="select top 1 iNInvCost8 as price,* from [PriceJustify] where cInvCode = \'' + foodsId + '\' and \'' + today + '\'&gt;=dstartdate and \'' + today + '\'&lt;ISNULL(denddate,\'2099-12-31\') and iNInvCost8 is not null and ccusproperty1 is null  order by dstartdate desc" proc="Query" efdebug="1"  ></ufinterface>';
													break;
												case "9":
													var context = '<?xml version="1.0" encoding="utf-8"?><ufinterface  efserverid="' + efid + '" eftype="EFsql" sqlstr="select top 1 iNInvCost9 as price,* from [PriceJustify] where cInvCode = \'' + foodsId + '\' and \'' + today + '\'&gt;=dstartdate and \'' + today + '\'&lt;ISNULL(denddate,\'2099-12-31\') and iNInvCost9 is not null and ccusproperty1 is null  order by dstartdate desc" proc="Query" efdebug="1"  ></ufinterface>';
													break;
												case "10":
													var context = '<?xml version="1.0" encoding="utf-8"?><ufinterface  efserverid="' + efid + '" eftype="EFsql" sqlstr="select top 1 iNInvCost10 as price,* from [PriceJustify] where cInvCode = \'' + foodsId + '\' and \'' + today + '\'&gt;=dstartdate and \'' + today + '\'&lt;ISNULL(denddate,\'2099-12-31\') and iNInvCost10 is not null and ccusproperty1 is null  order by dstartdate desc" proc="Query" efdebug="1"  ></ufinterface>';
													break;
												default:
													break;
											}
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
												$(".reviseCount").append("<p style='width: 0.2rem;position: absolute;top: 0.8rem;left: 3.2rem;'>¥</p><p class='priceInfo' style='position: absolute;top: 0.8rem;left: 3.3rem;'>" + parseFloat(xmlStrDoc.getElementsByTagName('head')[0].childNodes[0].getAttribute("price")) + "</p>");
											});
										} else {
											var context = '<?xml version="1.0" encoding="utf-8"?><ufinterface  efserverid="' + efid + '" eftype="EFsql" sqlstr="select a.cCusCode,a.iCostGrade,b.cInvCode,b.iPrice as price,b.dstartdate,b.denddate from Customer a left join PriceJustify b on a.cCusCode=b.cCusCode where b.cInvCode=\'' + foodsId + '\' and a.cCusCode=\'' + sessionStorage.getItem("ccuscode") + '\'" proc="Query" efdebug="1"  ></ufinterface>';
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
												$(".reviseCount").append("<p style='width: 0.2rem;position: absolute;top: 0.8rem;left: 3.2rem;'>¥</p><p class='priceInfo' style='position: absolute;top: 0.8rem;left: 3.3rem;'>" + parseFloat(xmlStrDoc.getElementsByTagName('head')[0].childNodes[0].getAttribute("price")) + "</p>");
											});
										}
									});
								}
							});
							$(".reviseWrap").css({
								display: "block"
							});
							$(".reviseCount").prepend("<p class='goodInfo' style='width:100%;'>" + this.children[0].innerHTML + "</p><p class='goodInfo'>" + this.children[1].innerHTML + "</p><p class='goodInfo'>" + this.children[2].innerHTML + "</p>");
						}
						return false;
					}
				}
			});
		}
	});
}

//点击搜索按钮搜索存货
$(".searchBtn")[0].addEventListener('touchstart', searchBtn, false);

function searchBtn(e) {
	$(".allFood").remove();
	getFoodsList();

}

function getFoodsList() {
	try {
		var searchInfo = $(".search input").val();
		var foodsCache = MyLocalStorage.Cache.get("foodsListCache");
		if(foodsCache == null) {
			//			缓存为空执行代码块
			if(searchInfo == "") {
				//				搜索栏为空执行代码块
				var context = '<?xml version="1.0" encoding="utf-8" ?><ufinterface efserverid="' + efid + '" eftype="EFsql" pagesize="1000" sqlstr="select cInvCode,cInvName,cInvStd,iInvLSCost from inventory WHERE cInvCode LIKE \'2%\' AND ISNULL(dEDate,\'\')=\'\' AND cInvDefine3=\'是\'" proc="Query" efdebug="1" />';
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
					var xmlStrDocString = creatXmlString(xmlStrDoc);
					MyLocalStorage.Cache.put("foodsListCache", xmlStrDocString, 1 * 24 * 60 * 60);
					for(var i = 0; i < xmlStrDoc.getElementsByTagName('head')[0].childNodes.length; i++) {
						$(".collect").append("<div class='allFood'><p class='goodInfo' style='width: 96%;text-align: left; text-indent: 0.3rem;'>" + xmlStrDoc.getElementsByTagName('head')[0].childNodes[i].getAttribute("cinvname") + "</p><p class='goodInfo'>" + xmlStrDoc.getElementsByTagName('head')[0].childNodes[i].getAttribute("cinvcode") + "</p><p class='goodInfo'>" + xmlStrDoc.getElementsByTagName('head')[0].childNodes[i].getAttribute("cinvstd") + "</p><img src='img/shoucang.png'></div>");
					}
					addCollect();
				});
			} else {
				//				搜索栏不为空的代码块
				searchFoods(searchInfo);
				addCollect();
			}
		} else {
			//			缓存不为空执行代码块
			if(searchInfo == "") {
				//				搜索栏为空的代码块
				var foodsXml = createXmlObj(foodsCache);
				for(var i = 0; i < foodsXml.getElementsByTagName('head')[0].childNodes.length; i++) {
					$(".collect").append("<div class='allFood'><p class='goodInfo' style='width: 96%;text-align: left; text-indent: 0.3rem;'>" + foodsXml.getElementsByTagName('head')[0].childNodes[i].getAttribute("cinvname") + "</p><p class='goodInfo'>" + foodsXml.getElementsByTagName('head')[0].childNodes[i].getAttribute("cinvcode") + "</p><p class='goodInfo'>" + foodsXml.getElementsByTagName('head')[0].childNodes[i].getAttribute("cinvstd") + "</p><img src='img/shoucang.png'></div>");
				}
				addCollect();
			} else {
				//				搜索栏不为空的代码块
				searchFoods(searchInfo);
				addCollect();
			}
		}
	} catch(e) {
		alert("商品缓存已过期,请重新点击搜索按钮.");
	}
}

//xml对象与xml字符串转换函数
function createXmlObj(str) {　　
	if(document.all) { //IE浏览器  
		　　
		var xmlDoc = new ActiveXObject("Microsoft.XMLDOM");
		xmlDoc.async = false;　　
		xmlDoc.loadXML(str);　　
		return xmlDoc;　　
	}　　
	else { //非IE浏览器  
		return new DOMParser().parseFromString(str, "text/xml");
	}
}

function creatXmlString(xmlObj) {
	var oSerializer = new XMLSerializer();
	var xmlStr = oSerializer.serializeToString(xmlObj);
	return xmlStr;
}

//添加收藏函数
function addCollect() {
	var foodLists = document.querySelectorAll(".allFood");
	var foodsObj = [];

	//				判断localstorage中是否有mystr
	if(localStorage.getItem("mystr") == null) {
		var mystr = JSON.stringify(foodsObj);
		localStorage.setItem("mystr", mystr);
	} else {
		$(function() {
			mystr = localStorage.getItem("mystr");
			myobj = JSON.parse(mystr);
			for(var i = 0; i < myobj.length; i++) {
				for(var j = 0; j < foodLists.length; j++) {
					if(myobj[i].foodscode == foodLists[j].childNodes[1].innerHTML) {
						foodLists[j].childNodes[3].style.display = "block";
					}
				}
			}
		});
	}
	var timeOutEvent = 0;
	$(function() {
		for(var i = 0; i < foodLists.length; i++) {
			foodLists[i].addEventListener('touchstart', longstart, false);

			function longstart() {
				//							长按加收藏
				foodsIndex = $(this).index();
				var isaddCollect = false; //判断收藏中有没有
				timeOutEvent = setTimeout(function(e) {
					timeOutEvent = 0;
					mystr = localStorage.getItem("mystr");
					myobj = JSON.parse(mystr);
					for(var i = 0; i < myobj.length; i++) {
						if(myobj[i].foodscode == foodLists[foodsIndex].childNodes[1].innerHTML) {
							isaddCollect = true;
						}
					}
					if(isaddCollect !== true) {
						myobj.push({
							"foodscode": foodLists[foodsIndex].childNodes[1].innerHTML,
							"foodsname": foodLists[foodsIndex].childNodes[0].innerHTML,
							"foodsGuige": foodLists[foodsIndex].childNodes[2].innerHTML
						});
						mystr = JSON.stringify(myobj);
						localStorage.setItem("mystr", mystr);
						foodLists[foodsIndex].childNodes[3].style.display = "block";
						alert("收藏成功");
					} else {
						alert("您已添加至收藏");
					}
				}, 500);
			}
			foodLists[i].addEventListener('touchmove', longmove, false);

			function longmove() {
				clearTimeout(timeOutEvent);
				timeOutEvent = 0;
			}
			foodLists[i].addEventListener('touchend', longend, false);
			var foodsId;

			function longend() {
				//							点击加订单
				clearTimeout(timeOutEvent);
				if(timeOutEvent != 0) {
					foodsId = this.children[1].innerHTML;
					$(".reviseWrap").css({
						display: "block"
					});
					$(".reviseCount").prepend("<p class='goodInfo' style='width:100%;'>" + this.children[0].innerHTML + "</p><p class='goodInfo'>" + this.children[1].innerHTML + "</p><p class='goodInfo'>" + this.children[2].innerHTML + "</p>");
				}
				return false;
			}
		}
	});
}
//搜索商品函数
function searchFoods(searchInfo) {
	var context = '<?xml version="1.0" encoding="utf-8" ?><ufinterface efserverid="' + efid + '" eftype="EFsql" sqlstr="select cInvCode,cInvName,cInvStd,iInvLSCost from inventory WHERE cInvName LIKE \'%' + searchInfo + '%\' AND cInvCode LIKE \'2%\' AND ISNULL(dEDate,\'\')=\'\'  AND cInvDefine3=\'是\'" proc="Query" efdebug="1" />';
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
		for(var i = 0; i < xmlStrDoc.getElementsByTagName('head')[0].childNodes.length; i++) {
			$(".collect").append("<div class='allFood'><p class='goodInfo' style='width: 96%;text-align: left; text-indent: 0.3rem;'>" + xmlStrDoc.getElementsByTagName('head')[0].childNodes[i].getAttribute("cinvname") + "</p><p class='goodInfo'>" + xmlStrDoc.getElementsByTagName('head')[0].childNodes[i].getAttribute("cinvcode") + "</p><p class='goodInfo'>" + xmlStrDoc.getElementsByTagName('head')[0].childNodes[i].getAttribute("cinvstd") + "</p><img src='img/shoucang.png'></div>");
		}
		addCollect();
	});
}
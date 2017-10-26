<?php
	require_once "test.php";
	$context = $_POST["context"];
	// $soapclient = new soapclient("http://192.168.1.33/EFWebS/EFWebService.asmx?WSDL");
	// print_r($soapclient->__getFunctions()); //可调用的函数
	// print_r($soapclient->__getTypes());	//获取服务器上数据类型
	header('content-type:text/html;charset=utf-8');
	$mparam = array("Content-Type"=> "application/x-www-form-urlencoded","context"=>"{$context}");
	$mresult = $soapclient->U8WebXML($mparam);
	$mresult = get_object_vars($mresult);
	// print_r($mresult['U8WebXMLResult']);
	$xmlResult = $mresult['U8WebXMLResult']->any;
	echo $xmlResult;
?>
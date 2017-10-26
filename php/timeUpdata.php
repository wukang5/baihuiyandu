<?php
$startTime = $_POST["startTime"];
$endTime = $_POST["endTime"];
$mysqli = new mysqli("localhost:3306", "root", "", "baihuidata");
if ($mysqli -> connect_errno) {
	echo "验证";
	//			var_dump($mysqli->connect_errno);
	die($mysqli -> connect_errno);
}

$mysqli -> query("set names utf8");

$sql = "UPDATE `timetable` SET `startTime` = '$startTime',`endTime`='$endTime' WHERE `id` = '1'";
$result = $mysqli -> query($sql);
echo $result;
$mysqli -> close();
?>
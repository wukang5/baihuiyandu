<?php
$mysqli = new mysqli("localhost:3306", "root", "", "baihuidata");
if ($mysqli -> connect_errno) {
	echo "验证";
	//			var_dump($mysqli->connect_errno);
	die($mysqli -> connect_errno);
}

$mysqli -> query("set names utf8");

$sql = "SELECT * FROM `timeTable`";
$result = $mysqli -> query($sql);
$row = $result -> fetch_all(MYSQLI_ASSOC);
$str = json_encode($row);
echo $str;
$mysqli -> close();
?>
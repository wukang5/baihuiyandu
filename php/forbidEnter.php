<?php
session_start();
//var_dump($_SESSION["code"]);
if ($_SESSION["code"] == "") {
	echo "<script>
			location='index.php';
			</script>";
	exit ;
}
?>
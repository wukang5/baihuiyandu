<?php
session_start();
$code = $_POST["code"];
$_SESSION['code'] = $code;
?>
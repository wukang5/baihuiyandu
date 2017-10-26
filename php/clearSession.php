<?php
	$sessionInfo = $_POST["sessionInfo"];
	echo $sessionInfo;
		if($sessionInfo=='loginout'){
   			session_start();
			$_SESSION=array();
			session_destroy();
			exit;
		}
	?>
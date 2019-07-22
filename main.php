<?php
	$target = $_GET['target'];	 		
	require_once('./config/config.php');
	require_once('./api/libs/guid.php');
	$content="contents/{$target}.php";
    include('contents/master.php');
?>
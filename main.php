<?php
// 24 Jul 2019
// Copyright (c) 2019, Guillermo Gutierrez Morote
// Released under the GPL license
// http://www.gnu.org/copyleft/gpl.html
	$target = $_GET['target'];	 		
	require_once('./config/config.php');
	require_once('./api/libs/guid.php');
	$content="contents/{$target}.php";
    include('contents/master.php');
?>
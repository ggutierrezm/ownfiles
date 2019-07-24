<?php	
// 24 Jul 2019
// Copyright (c) 2019, Guillermo Gutierrez Morote
// Released under the GPL license
// http://www.gnu.org/copyleft/gpl.html
	require('./config/config.php');
	session_start();
	session_unset();
	session_destroy(); 	
	header("Location: {$root}");
	die();
?>
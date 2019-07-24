<?php
// 24 Jul 2019
// Copyright (c) 2019, Guillermo Gutierrez Morote
// Released under the GPL license
// http://www.gnu.org/copyleft/gpl.html
if (!isset($_SESSION)) { session_start(); }
include('libs/session.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Own files</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/ownfiles.css">
  <link href="https://fonts.googleapis.com/css?family=Karla" rel="stylesheet"> 
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/angular.min.js"></script>
  <script src="js/ownfiles.js"></script>
</head>
<body>
  <div class="header"><?php include('header.php');?></div>
  <div class="menu"><?php include('menu.php');?></div>
  <?php    
    include($content);
    $content = ''; //reset the variable
  ?>
  <div class="footer"><?php include('footer.php');?></div>
</body>
</html>

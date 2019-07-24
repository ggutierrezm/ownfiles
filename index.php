<?php
// 24 Jul 2019
// Copyright (c) 2019, Guillermo Gutierrez Morote
// Released under the GPL license
// http://www.gnu.org/copyleft/gpl.html
if (!isset($_SESSION)) { session_start(); }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Own Files</title>
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
<body ng-app="login">   
   <div class="login-form" >
      <h1>Wellcome to Own Files</h1>
      <form method="post" ng-controller="validate" ng-submit="submit()">
      <div class="form-group">
        <label for="email">Email:</label>        
        <input type="email" class="form-control login" id="email" placeholder="Enter email" name="user" ng-model="user" required>
      </div>
      <div class="form-group">        
        <label for="pwd">Password:</label>
        <input type="password" class="form-control login" id="pwd" placeholder="Enter password" name="password" ng-model="password" required>
      </div>      
      <div class="checkbox">
          <a href="register.php" class="btn-link">Register</a>        
      </div>
      <input type="submit" value="Login">
      <div ng-show="hasErrors"><span class="glyphicon glyphicon-alert"></span> {{message}}</div>
  </form>
</div>
</body>
</html>

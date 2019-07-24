<?php
// 24 Jul 2019
// Copyright (c) 2019, Guillermo Gutierrez Morote
// Released under the GPL license
// http://www.gnu.org/copyleft/gpl.html
$connection_string = "mysql:host=$connection_host;dbname=$connection_dbname;charset=$connection_charset";
$db = new PDO($connection_string, $connection_user, $connection_password);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
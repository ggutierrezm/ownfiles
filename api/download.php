<?php
// 24 Jul 2019
// Copyright (c) 2019, Guillermo Gutierrez Morote
// Released under the GPL license
// http://www.gnu.org/copyleft/gpl.html
require('./libs/headers.php');
require_once('../config/config.php');
require_once('./libs/dbconnection.php');
require_once('./libs/session.php');

$name = $_POST['name'];
$link = "https://{$_SERVER['HTTP_HOST']}{$root}/uploads/{$user_uid}/{$name}";
http_response_code(200);
echo json_encode(array('message', 'success', 'link' => $link));
?>

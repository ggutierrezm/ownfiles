<?php
require('./libs/headers.php');
require_once('../config/config.php');
require_once('./libs/dbconnection.php');
require_once('./libs/session.php');

$name = $_POST['name'];
$link = "https://{$_SERVER['HTTP_HOST']}{$root}/uploads/{$user_uid}/{$name}";
http_response_code(200);
echo json_encode(array('message', 'success', 'link' => $link));
?>

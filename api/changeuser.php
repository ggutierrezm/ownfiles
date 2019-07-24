<?php
// 24 Jul 2019
// Copyright (c) 2019, Guillermo Gutierrez Morote
// Released under the GPL license
// http://www.gnu.org/copyleft/gpl.html
require('./libs/headers.php');
require_once('../config/config.php');
require_once('./libs/dbconnection.php');
require_once('./libs/session.php');

$user = $_POST['user'];
$handle = $db->prepare('UPDATE ' .$connection_prefix. 'users SET user = :user WHERE user_uid = :user_uid AND session_id = :session_id AND session_token = :session_token');
$device_id = -1;
$handle->execute(array(':user' => $user,  ':user_uid' => $user_uid, ':session_id' => $session_id, ':session_token' => $session_token));

http_response_code(200);
echo json_encode(array('message', 'success'));
?>

<?php
require('./libs/headers.php');
require_once('../config/config.php');
require_once('./libs/dbconnection.php');
require_once('./libs/session.php');

$password = $_POST['password'];
$hash =  password_hash($password, PASSWORD_DEFAULT);
$handle = $db->prepare('UPDATE ' .$connection_prefix. 'users SET password = :password WHERE user_uid = :user_uid AND session_id = :session_id AND session_token = :session_token'); 
$handle->execute(array(':password' => $hash, ':user_uid' => $user_uid, ':session_id' => $session_id, ':session_token' => $session_token));

http_response_code(200);
echo json_encode(array('message', 'success'));
?>

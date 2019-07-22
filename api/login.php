<?php
require('./libs/headers.php');
require_once('../config/config.php');
require_once('./libs/dbconnection.php');
require_once('./libs/guid.php');

$user = $_POST['user'];
$password = $_POST['password'];

$handle = $db->prepare('SELECT id, password, user_uid FROM ' .$connection_prefix. 'users WHERE user = :user'); 
$user_id = -1;
$handle->execute(array(':user' => $user));
$result = $handle->fetchAll();
foreach ($result as $row)
{
  $user_id = (int)$row['id'];
  $db_pasword = $row['password'];
  $user_uid = $row['user_uid'];  
}
if ($user_id == -1)
{
  http_response_code(400);
  echo json_encode(array('message', 'User doesn\'t exists', $user) );
  exit;
}
if (password_verify($password, $db_pasword))
{	
	$session_id = guid();
	$session_token = guid();
	$session_expire = new DateTime();
	$session_expire->modify("+10 minutes");
	
	session_start();
	$_SESSION['user'] = $user_uid;
	$_SESSION['id'] = $session_id;
	$_SESSION['token'] = $session_token;
	$handle = $db->prepare('UPDATE '.$connection_prefix.'users SET session_id = :session_id, session_token = :session_token, session_expire = :session_expire WHERE user_uid = :user_uid');
	$handle->execute(array(':session_id' => $session_id, ':session_token' => $session_token, ':session_expire' => date_format($session_expire, 'Y-m-d H:i:s'), ':user_uid' => $user_uid));
	http_response_code(200);
	echo json_encode(array('message', 'success'));
	return;
}
else
{
	http_response_code(401);
	echo json_encode(array('message', 'Wrong password'));
	exit;
}
?>

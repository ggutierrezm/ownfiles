<?php
require('./libs/headers.php');
require_once('../config/config.php');
require_once('./libs/dbconnection.php');
require_once('./libs/guid.php');

$user = $_POST['user'];
$password = $_POST['password'];

$handle = $db->prepare('SELECT id FROM ' .$connection_prefix. 'users WHERE user = :user'); 
$user_id = -1;
$handle->execute(array(':user' => $user));
$result = $handle->fetchAll();
foreach ($result as $row)
{
  $user_id = (int)$row['id'];  
}
if ($user_id != -1)
{
  http_response_code(400);
  echo json_encode(array('message', 'User already exists', $user) );
  return;
}

$user_uid = guid();
$session_token = guid();
$session_id = guid();
$session_expire = new DateTime();
$session_expire->modify("+10 minutes");
$expire = date_format($session_expire, 'Y-m-d H:i:s');
$hash =  password_hash($password, PASSWORD_DEFAULT);
$handle = $db->prepare('INSERT INTO ' .$connection_prefix. 'users (user, password, user_uid, session_id, session_token, session_expire) VALUES (:user, :password, :user_uid, :session_id, :session_token, :session_expire)'); 

$handle->execute(array(':user' => $user, 
	':password' => $hash, 
	':user_uid' => $user_uid, 
	':session_id' => $session_id, 
	':session_token' => $session_token, 
	':session_expire' => $expire));
$user_id = $db->lastInsertId();

if (!isset($_SESSION)) { session_start(); }
$_SESSION['user'] = $user_uid;
$_SESSION['id'] = $session_id;
$_SESSION['token'] = $session_token;


http_response_code(200);
echo json_encode(array('message', 'success'));

?>

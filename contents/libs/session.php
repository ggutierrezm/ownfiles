<?php
$user_uid = $_SESSION['user'];
$session_id = $_SESSION['id'];
$session_token = $_SESSION['token'];
$connection_string = "mysql:host={$connection_host};dbname={$connection_dbname};charset={$connection_charset}";
$db = new PDO($connection_string, $connection_user, $connection_password);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$handle = $db->prepare('SELECT id, session_expire FROM ' .$connection_prefix. 'users WHERE user_uid = :user_uid AND session_id = :session_id AND session_token = :session_token'); 
$user_id = -1;
$handle->execute(array(':user_uid' => $user_uid, ':session_id' => $session_id, ':session_token' => $session_token));
$result = $handle->fetchAll();
foreach ($result as $row)
{
  $user_id = (int)$row['id'];
  $session_expire = $row['session_expire'];

}
$current_time = date("Y-m-d H:i:s", gmmktime());
if ($user_id == -1 || ($session_expire < $current_time ))
{    
  $session_id = guid();
  $session_token = guid();
  $handle = $db->prepare('UPDATE '.$connection_prefix.'users SET session_token = :session_token, session_id = :session_id WHERE user_uid = :user_uid');
  $handle->execute(array(':session_token' => $session_token, ':session_id' => $session_id, ':user_uid' => $user_uid));
  header("Location: {$root}/index.php"); 
}
else
{  
  $new_session_expire = new DateTime();
  $new_session_expire->modify("+10 minutes");  
  $session_token = guid();  
  $handle = $db->prepare('UPDATE '.$connection_prefix.'users SET session_token = :session_token, session_expire = :session_expire WHERE user_uid = :user_uid AND session_id = :session_id');
  $handle->execute(array(':session_token' => $session_token, ':session_expire' => date_format($new_session_expire, 'Y-m-d H:i:s'), ':user_uid' => $user_uid, ':session_id' => $session_id));
  $_SESSION['token'] = $session_token;  
}
?>
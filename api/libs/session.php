<?php
// 24 Jul 2019
// Copyright (c) 2019, Guillermo Gutierrez Morote
// Released under the GPL license
// http://www.gnu.org/copyleft/gpl.html
$user_uid = $_SESSION['user'];
$session_id = $_SESSION['id'];
$session_token = $_SESSION['token'];
$handle = $db->prepare('SELECT id FROM ' .$connection_prefix. 'users WHERE user_uid = :user_uid AND session_id = :session_id AND session_token = :session_token'); 
$user_id = -1;
$handle->execute(array(':user_uid' => $user_uid, ':session_id' => $session_id, ':session_token' => $session_token));
$result = $handle->fetchAll();
foreach ($result as $row)
{
  $user_id = (int)$row['id'];
}
if ($user_id == -1)
{
  http_response_code(400);
  echo json_encode(array('message', 'User doesn\'t exists'));
  exit;
}
?>

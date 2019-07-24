<?php
// 24 Jul 2019
// Copyright (c) 2019, Guillermo Gutierrez Morote
// Released under the GPL license
// http://www.gnu.org/copyleft/gpl.html
$user_uid = $_POST['user_uid'];
$handle = $db->prepare('SELECT id FROM ' .$connection_prefix. 'users WHERE user_uid = :user_uid'); 
$user_id = -1;
$handle->execute(array(':user_uid' => $user_uid));
$result = $handle->fetchAll();
foreach ($result as $row)
{
  $user_id = (int)$row['id'];
}

if ($user_id == -1)
{
  http_response_code(400);
  echo json_encode(array('message', 'User doesn\'t exists'));
  return;
}
?>
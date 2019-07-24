<?php
// 24 Jul 2019
// Copyright (c) 2019, Guillermo Gutierrez Morote
// Released under the GPL license
// http://www.gnu.org/copyleft/gpl.html
require('./libs/headers.php');
require_once('../config/config.php');
require_once('./libs/dbconnection.php');
require_once('./libs/session.php');

$target_dir = '../uploads/' . $user_uid . '/';
$source_file = $_FILES["file"]["tmp_name"];
$name = basename($_FILES['file']['name']);
$creation = date("Y-m-d H:i:s", gmmktime());
$target_file = $target_dir . $name;
$link = "https://{$_SERVER['HTTP_HOST']}{$root}/uploads/{$user_uid}/{$name}";

$handle = $db->prepare('SELECT id FROM ' .$connection_prefix. 'files WHERE user_id = :user_id AND name = :name'); 
$handle->execute(array(
  ':user_id' => $user_id,
  ':name' => $name,
));
$id = -1;
$result = $handle->fetchAll();
foreach ($result as $row)
{
  $id = (int)$row['id'];  
}
if ($id != -1)
{
  http_response_code(400);
  echo json_encode(array('message', 'File already exists', $user) );
  return;
}

mkdir($target_dir);
$result = move_uploaded_file($source_file, $target_file);
$handle = $db->prepare('INSERT INTO ' .$connection_prefix. 'files (user_id, name, creation, link) VALUES (:user_id, :name, :creation, :link)'); 
$handle->execute(array(
  ':user_id' => $user_id, 
  ':name' => $name,
  ':creation' => $creation, 
  ':link' => $link
));
//file_put_contents("../uploads/post.log", print_r($_POST, true));
http_response_code(200);
echo json_encode(array('message', 'success', $source_file, $target_file, $result));
?>

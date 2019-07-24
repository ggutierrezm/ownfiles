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

$handle = $db->prepare('DELETE FROM ' .$connection_prefix. 'files WHERE user_id = :user_id AND name = :name');
$handle->execute(array(':user_id' => $user_id, ':name' => $name));
$filename = '../uploads/' . $user_uid . '/' . $name;
unlink($filename);
http_response_code(200);
echo json_encode(array('message', 'success'));
?>

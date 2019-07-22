<?php
require('./libs/headers.php');
require_once('../config/config.php');
require_once('./libs/dbconnection.php');
require_once('./libs/session.php');

$handle = $db->prepare('SELECT link, name, creation FROM ' .$connection_prefix. 'files WHERE user_id = :user_id');
$device_id = -1;
$handle->execute(array(':user_id' => $user_id));
$result = $handle->fetchAll();
$devices_arr=array();    
$devices_arr['files']=array();
foreach ($result as $row)
{
  array_push($devices_arr['files'],array('link' => $row['link'], 'name' => $row['name'], 'creation' => $row['creation']));
}

http_response_code(200);
echo json_encode($devices_arr);
?>

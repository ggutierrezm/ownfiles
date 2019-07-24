<?php
// 24 Jul 2019
// Copyright (c) 2019, Guillermo Gutierrez Morote
// Released under the GPL license
// http://www.gnu.org/copyleft/gpl.html
require('./libs/headers.php');
require_once('../config/config.php');
require_once('./libs/dbconnection.php');
require_once('./libs/deviceuser.php');

$ip = $_POST['ip'];
$mac = $_POST['mac'];
$device = $_POST['device'];
$session_id = $_POST['session_id'];
$previous_token = $_POST['previous_token'];
$session_token = $_POST['session_token'];

$handle = $db->prepare('UPDATE ' .$connection_prefix. 'devices SET session_token = :session_token, last_seen = :last_seen WHERE user_id = :user_id AND mac = :mac AND ip = :ip AND devide = :device AND session_id = :session_id AND session_token = :previous_token');
}
$time = date("Y-m-d H:i:s", gmmktime());
$handle->execute(array(':session_token'=>$session_token, ':last_seen'=>$time, ':user_id'=>$user_id, ':mac'=>$mac, ':ip'=>$ip, ':device'=>$device, ':session_id'=>$session_id, ':previous_token'=>$previous_token));
http_response_code(200);
echo json_encode(array('message','success'));
?>

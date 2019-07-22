<?php
$user_uid = $_SESSION['user'];
$session_id = $_SESSION['id'];
$session_token = $_SESSION['token'];
echo "user: {$user_uid} ";
echo "session_id: {$session_id} ";
echo "session_token: {$session_token}";
?>
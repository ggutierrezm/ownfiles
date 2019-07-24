<?php
// 24 Jul 2019
// Copyright (c) 2019, Guillermo Gutierrez Morote
// Released under the GPL license
// http://www.gnu.org/copyleft/gpl.html
$user_uid = $_SESSION['user'];
$session_id = $_SESSION['id'];
$session_token = $_SESSION['token'];
echo "user: {$user_uid} ";
echo "session_id: {$session_id} ";
echo "session_token: {$session_token}";
?>
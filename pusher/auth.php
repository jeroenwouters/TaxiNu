<?php 
require('pusher.php');
$pusher = new Pusher("b075ffa0df361cc21bda", "17a6ffffc58bce5ca5c6", 34875);
echo $pusher->socket_auth($_POST['channel_name'], $_POST['socket_id']);

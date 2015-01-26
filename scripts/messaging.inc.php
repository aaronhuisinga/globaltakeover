<?php
// Simple script to update the message count for the user. Takes an AJAX request, and spits back a result.
require_once('../members/config.php');

$res=$mysqli->query("SELECT COUNT(*) FROM `pmessages` WHERE `touser` = '$_POST[pID]' AND `unread` = 'unread'");
$row=$res->fetch_array();
echo $row[0];
exit();
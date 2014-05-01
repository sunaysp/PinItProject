<?php

include_once 'connection.php';

if(isSet($_POST['last_pid']))
{
$lastid=mysql_real_escape_string($_POST['last_pid']);
include('load_pin.php');
}
?>

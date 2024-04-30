<?php 

session_start();
session_unset();
session_destroy();

header("Location: /ReadersZone/login.php");
exit;
?>
<?php
session_start();
$isChating = false;
if(!isset($_SESSION['UserName']) || empty($_SESSION['UserName'])){
    echo '<script>location.href = \'/ReadersZone/index.php\';</script>';
}
?>
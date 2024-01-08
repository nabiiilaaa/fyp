<?php
session_start();
if(!isset($_SESSION['UserName']) || empty($_SESSION['UserName'])){
    echo '<script>location.href = \'/ReadersZone/index.php\';</script>';
}
?>
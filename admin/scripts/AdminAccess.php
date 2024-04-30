<?php
session_start();
if(!isset($_SESSION['UserName']) || empty($_SESSION['UserName'])) {
   header("location: index.php");
} else if(!isset($_SESSION['accessType']) || empty($_SESSION['accessType'])) {
   header("location: index.php");
} else if (isset($_SESSION['accessType']) != "admin") {
   header("location: index.php");
}

?>
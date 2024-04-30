<?php
	$UserName = $_GET["UserName"];
	$Password = $_GET["Password"];
	require_once("dbController.php");
	require_once('./../chat/database_connection.php');
	$db_handle = new DBController();
	$myquery = "SELECT * FROM Users WHERE (UserName='$UserName' OR Email='$UserName') AND Password='$Password' AND userType = 'user'";
	$myresult = mysqli_query($db_handle->conn,$myquery);
    $num = mysqli_num_rows($myresult);
	if($num > 0)
	{
		$row=mysqli_fetch_array($myresult);
		session_start();
		$_SESSION['UserId'] = $row['Id'];
		$_SESSION['UserName'] = $row['UserName'];
		$_SESSION['Email'] = $row['Email'];

		$sub_query = "INSERT INTO login_details (UserId) VALUES ('".$row['Id']."')";
		$statement = $connect->prepare($sub_query);
		$statement->execute();
		$_SESSION['login_details_id'] = $connect->lastInsertId();
		echo "true";
	}
	else
		echo "In-Valid Username or Password";
?>

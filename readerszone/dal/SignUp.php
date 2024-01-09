<?php
	$UserName = $_GET["UserName"];
	$Password = $_GET["Password"];
	$Email = $_GET["Email"];

	//Checking for Empty Fields
	if(empty($UserName) || empty($Password) || empty($Email)){
		echo "Please fill all Fields";
		return;
	}

	//Checking So No one can SignUp as Admin
	if($UserName == "admin"){
		echo "OOPS! You Can't Create Account As Admin";
		return;
	}

    //PHP
	require_once("dbController.php");
	$db_handle = new DBController();
	$myquery = "SELECT * FROM users WHERE UserName='$UserName' OR Email='$Email'";
	$myresult = mysqli_query($db_handle->conn,$myquery);
    $num = mysqli_num_rows($myresult);
	if($num > 0)
		echo "Username Already Exist";
	else{
		$myquery = "INSERT INTO Users(UserName, Password, Email) VALUES('$UserName','$Password','$Email')";
		if(mysqli_query($db_handle->conn,$myquery))
			echo "Registered sucessfully";
		else
			echo mysqli_error($db_handle->conn);
	}
?>
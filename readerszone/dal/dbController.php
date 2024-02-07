<?php
class DBController {
	private $host = "localhost";
	private $user = "root";
	private $password = "";
	private $database = "readerszone";
	public $conn;
	
	function __construct() {
		$this->conn = $this->connectDB();
	}
	
	function connectDB() {
		$conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
		return $conn;
	}
	
	function runQueryNoReturn($query) {
		$result = mysqli_query($this->conn,$query);
		return $result;
	}

	function runQuery($query) {
		$result = mysqli_query($this->conn,$query);
		while($row=mysqli_fetch_assoc($result)) {
			$resultset[] = $row;
		}		
		if(!empty($resultset))
			return $resultset;
	}
	
	function numRows($query) {
		$result  = mysqli_query($this->conn,$query);
		$rowcount = mysqli_num_rows($result);
		return $rowcount;	
	}

	function addUserRating($userId, $bookId, $rating)
	{
		if($this->userRating($userId, $bookId, null) == null) {
			$sql = "INSERT INTO reviews (userId, bookId, rating) VALUES ('$userId', '$bookId', '$rating')";
			$this->runQueryNoReturn($sql);
		} else {
			$sql = "UPDATE reviews SET rating = '$rating' WHERE userId = '$userId' AND bookId = '$bookId'";
			$this->runQueryNoReturn($sql);
		}
	}

	function removeUserRating($userId, $bookId)
	{
		$sql = "DELETE FROM reviews WHERE userId = '$userId' AND bookId = '$bookId'";
		$this->runQueryNoReturn($sql);
	}

	function userRating($userId, $bookId, $default)
	{
		$sql = "SELECT * FROM reviews WHERE userId = '$userId' AND bookId = '$bookId'";
		$result = $this->runQuery($sql);
		if (!empty($result)) {
			foreach($result as $key=>$value) {
				return $result[$key]["Rating"];
			}
		}
		else {
			return $default;
		}
	}

	function avgRating($bookId, $default)
	{
		$sql = "SELECT * FROM reviews WHERE bookId = '$bookId'";
		$result = $this->runQuery($sql);
		$average = $default;
		if (!empty($result)) {
			$average = 0;
			foreach($result as $key=>$value) {
				$average += $result[$key]["Rating"];
			}
			$average /= $this->totalRating($bookId);
		}
		return $average;
	}

	function totalRating($bookId)
	{
		$sql = "SELECT rating FROM reviews WHERE bookId = '$bookId'";
		return $this->numRows($sql);
	}
}
?>
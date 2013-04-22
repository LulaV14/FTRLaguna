<?php

session_start();
require_once('conexion.php');
$connect = new Connection();
$connect->connectDB();

//if(isset($_GET['m'])){
	$message = $_GET['m'];
	$iconID = $_GET['i'];
	$userID = $_SESSION['userid'];
	$dates = date("Y-m-d H:i:s");

	echo "Mensaje:".$message."<br/>Icon:".$IconID."<br/>UserID:".$userID."<br/>$dates";

	$sql = "INSERT INTO Feeling(Message, ID_User, ID_Icon, Dates) 
			VALUES('$message', '$userID', '$iconID', '$dates')";

	if(mysql_query($sql)){
		echo "Posted correctly . . .";
	} else{
		echo "Error while posting . . .";
	}
//}

?>
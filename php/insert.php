<?php 
include("user.php");
$cnn = new Connection();
$cnn->connectDB();
if (isset($_POST['email']))
{
	$user = $_POST["email"];
	$pass = $_POST["password"];
	$name=$_POST["name"];
	$lastname = $_POST["lastname"];
	$sex = $_POST["sex"];
	$birthday = $_POST["birthday"];
	$career = $_POST["career"];
	$city = $_POST["state"];
	$NASAP = $_POST["nasaprog"];
	$degree = $_POST["degree"];
	$query1 = "(select `ID` from `City` where `District` = '".$city."' limit 1)";
	$query2 = "(select `ID_NASAProg` from `NASAProg` where `Name` = '".$NASAP."' limit 1)";
	$query3 = "(select `ID_Degree` from `Degree` where `Name` = '".$degree."' limit 1)";
	$query = "INSERT INTO `Users`(`Name`, `Email`, `Password`, `Birthday`, `Gender`, `Career`, `ID_City`, `ID_NASAProg`, `ID_Degree`) VALUES ('".$name." ".$lastname."','".$user."','".$pass."','".$birthday."','".$sex."','".$degree."',".$query1.",".$query2.",".$query3.")";
	 if(filter_var($user, FILTER_VALIDATE_EMAIL)) { 
	     $res = mysql_query($query);}
	 else {
	 	header('Location: ../registro.php');
	 	exit();
	 }
     if ($res) 
	 {
	 	$usr = new User();
	 	$usr->validateUser($user, $pass);
	 	header('Location: ../index3.php');
	 	exit();
	 }
}
 ?>
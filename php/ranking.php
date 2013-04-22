<?php
include("conexion.php");
$cnn = new Connection();
$cnn->connectDB();
//Insert a new like or dislike depending on the contents of the message posted and the date
if (isset($_GET["value"]) /*&& $_SESSION['status'] == 'authorized'*/)
{
  $value = $_GET["value"];
  $message = $_GET["message"];
  $date=$_GET["date"];
  $user = $_SESSION["userid"];
  $fquery = "(SELECT `ID_Feeling` FROM `Feeling` WHERE `Message` = '$message' and `Dates` = '$date')";
  $query = "INSERT INTO `Ranking`(`Rank`, `ID_User`, `ID_Feeling`, `Dates`) VALUES ('$value',$user,$fquery,CURDATE())";
  $res = mysql_query($query);
  header('Location: ../index3.php');
  exit();
}
  ?>
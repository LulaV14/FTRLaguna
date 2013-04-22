<?php

//session_start();
require_once('constants.php');

 class Connection{

 	private $conn;

 	function connectDB(){
 		$conn = mysql_connect(DB_SERVER, DB_USER, DB_PASS);
 		if(!$conn){ die('Could not connect to the server . . .'); }

 		$selectdb=mysql_select_db(DB_NAME);
 		if(!$selectdb){ die('Could not connect to the database'); }
 	}

 	function verifyUser($email, $pass){
 		$query="SELECT * FROM Users WHERE Email = '".$email."' AND Password = '".$pass."' LIMIT 1";

 		if($return = mysql_query($query)){

 			while($line = mysql_fetch_array($return, MYSQL_ASSOC)){
 			foreach ($line as $valid) {
 				return $valid;
 			}
 		}

 			//return true;
 		}
 	}

 }

?>
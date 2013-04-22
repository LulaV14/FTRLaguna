<?php

require('conexion.php');

class User{

	function validateUser($email, $pass){
		$connection = new Connection();
		$connection->connectDB();
		$valid=$connection->verifyUser($email, $pass);

		if(isset($valid)){
			$_SESSION['status']='authorized';
			$_SESSION['userid']=$valid;
			header("location: ../admin.php");
		}else{ return "Incorrect Username and/or Password . . . <br/>'$email' <br/>'$pass'"; }
	}

	function logOut(){
		if(isset($_SESSION['status'])){
			unset($_SESSION['status']);
			unset($_SESSION['userid']);

			if(isset($_COOKIE[session_name()])){
				setcookie(session_name(), '', time() - 1000);
				session_destroy();
			}
		}
	}

	function confirmUser(){
		session_start();
		if($_SESSION['status']!='authorized'){ header("location: index3.php"); }
	}

}

?>
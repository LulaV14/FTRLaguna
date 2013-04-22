<?php

session_start();
require_once('user.php');

$user = new User();

if(isset($_GET['status']) AND $_GET['status'] == 'loggedout'){
	$user->logOut();
}

if($_POST AND !empty($_POST['email']) AND !empty($_POST['password']) ){
	$response=$user->validateUser($_POST['email'], $_POST['password']);
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>
	<h1>Login</h1><br/>
	<form method="post" action="">
		<input type="email" name="email" placeholder="Email . . ."/><br/>
		<input type="password" name="password" placeholder="Password . . ."/><br/>
		<input type="submit" name="submit" value="Login"/>
	</form>
	<?php if(isset($response)) echo "<h4>".$response."</h4>"; ?>
</body>
</html>
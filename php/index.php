<?php
session_start();
require_once('user.php');
$user = new User();
$user->confirmUser();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Index</title>
</head>
<body>
	<h1>Index</h1><br/>
	<h4>Loggeado</h4><br/><br/>

	<h2>User:<?php echo $_SESSION['userid']; ?></h2>

	<a href="login.php?status=loggedout">Log Out</a><br/>
	<a href="mensaje.php?<?php echo htmlspecialchars(SID); ?>">Post a Message</a>
</body>
</html>
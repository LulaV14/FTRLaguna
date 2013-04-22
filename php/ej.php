<?php

require_once('conexion.php');
$conex = new Connection();
$conex->connectDB();


echo 'ejemplo';
echo '<br/>';
 		echo $query="SELECT ID_User FROM Users WHERE Email = 'ejemplo@ej.com' AND Password = '12345' LIMIT 1";
echo '<br/>';
 		echo $r=mysql_query($query);
echo '<br/>';
 		while($line = mysql_fetch_array($r, MYSQL_ASSOC)){
 			foreach ($line as $col) {
 				echo $col;
 			}
 		}


 ?>
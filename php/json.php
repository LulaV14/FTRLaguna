<?php

require_once('conexion.php');
$cone = new Connection();
$cone->connectDB();

$sql = "SELECT f.Message, i.Name, p.Latitude, p.Longitude FROM Feeling f
		JOIN Icon i ON f.ID_Icon = i.ID_Icon JOIN Users u ON u.ID_User = f.ID_User
		JOIN City c ON c.ID = u.ID_City JOIN Country cc ON cc.Code = c.CountryCode
		JOIN Positions p ON p.IsoCode = cc.Code2";

		if($lu = mysql_query($sql)){


 			while($line = mysql_fetch_array($lu, MYSQL_ASSOC)){
 				//echo $line['Longitude']."<br/>";

 				//Make json
 				/*$data = array(
 					(object)array(
 						'title' => $line['Message'],
 						'description' => $line['Name'],
 						'iconos' => "train",
 						'position' => array((float)$line['Latitude'], (float)$line['Longitude'])
 					),
 				);*/

 				//echo json_encode($data);

				$output[]=$line;

 			}

 			print(json_encode($output));
		}
 			echo "<br/><br/><br/>";

$data = array(
	(object)array(
		'title' => 'Ejemplo Mensaje',
		'icon' => 'http://cdn2.iconfinder.com/data/icons/lin/24/1.png',
		'position' => array(23.0001, -102.0001)
		),
	);

//var_dump($data);

$json = json_encode($data);

//echo $json;

?>
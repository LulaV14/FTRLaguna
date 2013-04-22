<?php

session_start();
require_once('conexion.php');
$connect = new Connection();
$connect->connectDB();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Mensaje</title>
	<script type="text/javascript">
	function sendPost(){
		var element = document.getElementById("opciones");
		var strIcon = element.options[element.selectedIndex].value;
		var msj = document.getElementById('message').value;

		alert('Icon:'+strIcon+'\nMsj:'+msj);

        if (strIcon=="" || msj==""){
         document.getElementById("txtAlerta").innerHTML='agrega un mensaje';
         return;
        } if (window.XMLHttpRequest){
          // code for IE7+, Firefox, Chrome, Opera, Safari
          xmlhttp=new XMLHttpRequest();
        } else {
          // code for IE6, IE5
          xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }

      xmlhttp.onreadystatechange=function(){
        if (xmlhttp.readyState==4 && xmlhttp.status==200){
            document.getElementById("txtAlerta").innerHTML=xmlhttp.responseText;
        }
      }

      xmlhttp.open("GET","saveMsg.php?m="+msj+"&i="+strIcon,true);
      xmlhttp.send();
  	} 
	</script>
</head>
<body>
	<h1>Mensaje</h1><br/>
	<div id="txtAlerta"></div>
	<!--<form>-->
		<input id="message" type="text" name="message" placeholder="Mensaje . . ." /><br/>
		<select id="opciones" name="icon[]">
			<option value="">Selecciona un icono:</option>
			<?php
				$result=mysql_query("SELECT ID_Icon, Name FROM Icon");
				while($line = mysql_fetch_array($result, MYSQL_ASSOC)){
					echo "<option value='$line[ID_Icon]'>$line[Name]</option>";
				}
			?>
		</select><br/>
		<input type="submit" name="submit" value="Post" onclick="sendPost();" />
	<!--</form>-->
</body>
</html>
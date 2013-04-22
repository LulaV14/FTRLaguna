<?php
include("conexion.php");
$cnn = new Connection();
$cnn->connectDB();
$country=$_GET['country'];
$query="SELECT distinct`District` FROM `City` where `CountryCode` = (SELECT `Code` FROM `Country` where `Name` = '".$country."') order by `District`";
$result=mysql_query($query);

?>
<select name="state">
  <? while($row=mysql_fetch_array($result)) { ?>
    <?php echo "<option> ".$row['District']."</option>"; ?>	
  <? } ?>
</select>
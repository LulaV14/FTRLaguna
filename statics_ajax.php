<?php
echo 'ej';
include('php/conexion.php');
$con = new Connection();
$con->connectDB();

  if(isset($_GET['f'])){

    $feeling = $_GET['f'];
    $country = $_GET['c'];
    $gender = $_GET['g'];
    $degree = $_GET['d'];
    $nasa = $_GET['n'];


echo '<script type="text/javascript">

  var center = null;
  var map = null;
  var currentPopup;
  var bounds = new google.maps.LatLngBounds();
 
 function addMarker(lat, lng, info, img) {
 var pt = new google.maps.LatLng(lat, lng);
 bounds.extend(pt);
 var icon = new google.maps.MarkerImage(img,
  new google.maps.Size(32, 32), new google.maps.Point(0, 0),
  new google.maps.Point(16, 32));
 var marker = new google.maps.Marker({
 position: pt,
 icon: icon,
 map: map
 });
 var popup = new google.maps.InfoWindow({
 content: info,
 maxWidth: 300
 });
 google.maps.event.addListener(marker, "click", function() {
 if (currentPopup != null) {
 currentPopup.close();
 currentPopup = null;
 }
 popup.open(map, marker);
 currentPopup = popup;
 });
 google.maps.event.addListener(popup, "closeclick", function() {
 map.panTo(center);
 currentPopup = null;
 });
 }
 function initMap() {
 map = new google.maps.Map(document.getElementById("map"), {
 center: new google.maps.LatLng(0, 0),
 zoom: 120,
 mapTypeId: google.maps.MapTypeId.ROADMAP,
 mapTypeControl: false,
 mapTypeControlOptions: {
 style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR
 },
 navigationControl: true,
 navigationControlOptions: {
 style: google.maps.NavigationControlStyle.SMALL
 }
 });';
 




 $query = mysql_query("SELECT f.Message, i.Name, i.Link, p.Latitude, p.Longitude FROM Feeling f
    JOIN Icon i ON f.ID_Icon = i.ID_Icon JOIN Users u ON u.ID_User = f.ID_User
    JOIN City c ON c.ID = u.ID_City JOIN Country cc ON cc.Code = c.CountryCode
    JOIN Positions p ON p.IsoCode = cc.Code2 JOIN Degree d ON u.ID_Degree = d.ID_Degree JOIN NASAProg n ON n.ID_NASAProg = u.ID_NASAProg
    WHERE i.Name LIKE '%$feeling%' AND cc.Name LIKE '%$country%' AND u.Gender LIKE '%$gender%' AND d.Name LIKE '%$degree%' AND n.Name LIKE '%$nasa%'");

 //echo ('<script type="text/javascript">');
 echo "\n";
 while ($row = mysql_fetch_array($query, MYSQL_ASSOC)){

  //Feeling Info
  $name=$row['Name'];
  $lat=rand($row['Latitude']-2, $row['Latitude']+2);
  $lon=rand($row['Longitude']-2, $row['Longitude']+2);
  $desc=$row['Message'];
  $img=$row['Link'];
  echo ("addMarker($lat, $lon,'<b>$name</b><br/>$desc', '$img');\n");
 }
 
 echo ('center = bounds.getCenter();');
 echo ('map.fitBounds(bounds);');

 echo'}
 </script>';

 //echo ('</script>');
}
 ?>
<?
$dbname            ='spaceapp_bd'; //Name of the database
$dbuser            ='spaceapp_user'; //Username for the db
$dbpass            ='12345.xx.1'; //Password for the db
$dbserver          ='localhost'; //Name of the mysql server

$dbcnx = mysql_connect ("$dbserver", "$dbuser", "$dbpass");
mysql_select_db("$dbname") or die(mysql_error());
?>
<html>
 <head>
 <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
 <title>Google Map API V3 with markers</title>
 <style type="text/css">
 body { font: normal 10pt Helvetica, Arial; }
 #map { width: 950px; height: 300px; border: 0px; padding: 0px; }
 </style>
 <script src="http://maps.google.com/maps/api/js?v=3&sensor=false" type="text/javascript"></script>
 <script type="text/javascript">
 /*function addImage(str){
 	var icon = new google.maps.MarkerImage(str,
 	new google.maps.Size(32, 32), new google.maps.Point(0, 0),
 	new google.maps.Point(16, 32));
 }*/
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
 });
 <?
 $query = mysql_query("SELECT f.Message, i.Name, i.Link, p.Latitude, p.Longitude FROM Feeling f
		JOIN Icon i ON f.ID_Icon = i.ID_Icon JOIN Users u ON u.ID_User = f.ID_User
		JOIN City c ON c.ID = u.ID_City JOIN Country cc ON cc.Code = c.CountryCode
		JOIN Positions p ON p.IsoCode = cc.Code2");
 while ($row = mysql_fetch_array($query)){
 	//Feeling Image
	
 	//echo("addImage('$img');");

 	//Feeling Info
 	$name=$row['Name'];
 	$lat=rand($row['Latitude']-2, $row['Latitude']+2);
 	$lon=rand($row['Longitude']-2, $row['Longitude']+2);
 	$desc=$row['Message'];
 	$img=$row['Link'];
 	echo ("addMarker($lat, $lon,'<b>$name</b><br/>$desc', '$img');\n");
 }
 ?>
 center = bounds.getCenter();
 map.fitBounds(bounds);

 }
 </script>
 </head>
 <body onload="initMap()" style="margin:0px; border:0px; padding:0px;">
 <div id="map"></div>
 </html>
<?php include 'header.php'; ?>

      <div class="container">


      <div class="jumbotron">
        <div class="row-fluid">
          <div class="span10">
            <h1>Share your NASA experience with the world.</h1>
            <p class="lead">RFTLaguna is a place to freely share your opinions and experiences about the NASA Education program. Also, you can get a pulse on the program's participants.</p>
          </div>
          <?php
            if(!isset($_SESSION['status'])){
              echo '<div class="span2">';
              echo '<a class="btn btn-large btn-success ntop40" href="register.php">Register</a>';
              echo '</div>';
            }else{
              echo '<div class="span2">';
              echo '<a class="btn btn-large btn-danger ntop40" href="admin.php">Share a Feeling</a>';
              echo '</div>';
            }
          ?>
        </div>
        
      </div>

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
 <div id="map"></div>

        
      <div class="row ncolums">
        <div class="span4">
          <h3>Why register?</h3>
          <p>Because  by joining this network I can get a real sense of community, kind of like exchanging messages behind the teachers back during class. Communication isn't so much of an exchange of information, rather its an exchange of ideas, feelings, and impressions.</p>
          <p><a class="btn btn-success" href="#">Register &raquo;</a></p>
        </div>
        <div class="span4">
          <h3>Why should I use this service?</h3>
          <p>This is a great service to use while taking this courses. It allows me to live the social side of NASA, not only the academic and scientific one. It provides the support I need, plus it allows me to let off some steam and focus effectively.</p>
          <p><a class="btn btn-warning" href="statics.php">View statics &raquo;</a></p>
       </div>
        <div class="span4">
          <h3>Be part of this community.</h3>
          <p>Find and share helpful impressions and some insight from other classmates. Encourage other people with your own experience.</p>
<div class="fb-like" data-href="https://www.facebook.com/NASA" data-send="false" data-width="380" data-show-faces="true"></div>
        </div>
      </div>

      </div>

      <div id="push"></div>
    </div>

<?php include 'footer.php'; ?>
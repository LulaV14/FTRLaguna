<?php include('header.php'); ?>

<script type="text/javascript">

//AJAX
function searchFeelings(){
    if (window.XMLHttpRequest){
          // code for IE7+, Firefox, Chrome, Opera, Safari
          xmlhttp=new XMLHttpRequest();
        } else {
          // code for IE6, IE5
          xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }

      xmlhttp.onreadystatechange=function(){
        if (xmlhttp.readyState==4 && xmlhttp.status==200){
            document.getElementById("change").innerHTML=xmlhttp.responseText;
        }
      }

      xmlhttp.open("GET","statics_ajax.php?f="+feeling+"&c="+country+"&g="+gender+"&d="+degree+"&n="+nasa,true);
      xmlhttp.send();
    } 

var feeling = "";
var country = "";
var gender = "";
var degree = "";
var nasa = "";

function changeFeeling(str){
  if(str!="")
    feeling = str;
  searchFeelings();
}
function changeCountry(str){
  if(str!="")
    country = str;
  searchFeelings();
}
function changeGender(str){
  if(str!="")
    gender = str;
  searchFeelings();
}
function changeDegree(str){
  if(str!="")
    degree = str;
  searchFeelings();
}
function changeNASA(str){
  if(str!="")
    nasa = str;
  searchFeelings();
}
</script>

      <div class="container">
       
      <div class="row ncolums">
        <div class="span2">
          <h3>Feeling</h3>
          <div class="row-fluid">
            <div class="span12">
                <select name="Gender" class="span12" onchange="changeFeeling(this.value);">
                <option value="" selected="selected" >Select Feeling</option> 
                <?php Options("SELECT `Name` FROM `Icon` order by `Name`") ?> </Select>
            </div>
          </div>
        </div>

               <div class="span2">
          <h3>Country</h3>
          <div class="row-fluid">
            <div class="span12">
                <select name="Gender" class="span12" onchange="changeCountry(this.value);">
                <option value="" selected="selected" >Select Country</option> 
                <?php Options("SELECT distinct`District` FROM `City` where `CountryCode` = 'USA' order by `District`") ?> </Select>
            </div>
          </div>
        </div>

        <div class="span2">
          <h3>Gender</h3>
          <div class="row-fluid">
            <div class="span12">
                <select name="Gender" class="span12" onchange="changeGender(this.value);">
                <option value="" selected="selected" >Select Gender</option> 
                <option value="Female">Female</option> 
                <option value="Male">Male</option>
                </select>
            </div>
          </div>
        </div>

                <div class="span3">
          <h3>Academic Degree</h3>
          <div class="row-fluid">
            <div class="span12">
                <select name="Gender" class="span12" onchange="changeDegree(this.value);">
                <option value="" selected="selected" >Select Degree</option> 
                <?php Options("SELECT `Name` FROM `Degree` order by `Name`") ?> </Select>
            </div>
          </div>
        </div>

                <div class="span3">
          <h3>NASA Program</h3>
          <div class="row-fluid">
            <div class="span12">
                <select name="Gender" class="span12" onchange="changeNASA(this.value);">
                <option value="" selected="selected" >Select Program</option> 
                <?php Options("SELECT `Name` FROM `NASAProg` order by `Name`") ?> </Select>
            </div>
          </div>
        </div>

      </div>


<!--<script type="text/javascript">

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
 //Codigo php faltante
 }
 </script>-->
<div id="change"></div>

 <div id="map"></div>


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

      <div id="push"></div>
    </div>

<?php include 'footer.php'; ?>
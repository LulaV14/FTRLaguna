<?php include '../header.php'; ?>

      <div class="container">

        <div class="well ntop">

          <div class="row-fluid">

              <div id="infolikes" class="span8">
                <div class="page-header">
                  <h2 id="message">Este es un mensaje largo expresando un sentimiento...  </h2>
                </div>
                
              <p class="pull-left"><img src="http://cdn1.iconfinder.com/data/icons/lin/32/7.png" onClick="like('l')"> 0 
                <img src="http://cdn1.iconfinder.com/data/icons/lin/32/10.png" onClick="like('d')"> 0 </p>
              <p class="pull-right">0000-00-00 00:00:00</p>

              </div>

              <div class="span4">
                


 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
  <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
  <script>
    $(function() { // onload handler
      var melbourne = new google.maps.LatLng(25.5428443,-103.4067861);
      var mapOptions = {
        zoom:      3,
        center:    melbourne,
        mapTypeId: google.maps.MapTypeId.ROADMAP
      }

      var map = new google.maps.Map($("#map_canvas")[0], mapOptions);

      var currentPlace = null;
      var info = $('#placeDetails');
      var infolike = $('#infolikes');
      var icons = {
        'train':          'http://cdn2.iconfinder.com/data/icons/lin/32/7.png',
        'train-selected': 'http://cdn1.iconfinder.com/data/icons/lin/32/8.png'
      }


      $.getJSON('../places.json', function(places) {
        $(places).each(function() {
          var place = this;
          var marker = new google.maps.Marker({
            position: new google.maps.LatLng(place.position[0], place.position[1]),
            map:      map,
            title:    place.title,
            icon:     icons['train']
          });

          google.maps.event.addListener(marker, 'click', function() {
            var hidingMarker = currentPlace;
            var slideIn = function(marker) {
              $('h1', info).text(place.title);
              $('p',  info).text(place.description);
              $('h2', infolikes).text(place.description);

              info.animate({right: '0'});
            }

            marker.setIcon(icons['train-selected']);

            if (currentPlace) {
              currentPlace.setIcon(icons['train']);

              info.animate(
                { right: '-320px' },
                { complete: function() {
                  if (hidingMarker != marker) {
                    slideIn(marker);
                  } else {
                    currentPlace = null;
                  }
                }}
              );
            } else {
              slideIn(marker);
            }
            currentPlace = marker;
          });
        });
      });
    });

function like(value)
{
  var ghead = document.getElementsByTagName('h2')[0];
  var message = ghead.childNodes.item(0).data;
  var date = document.getElementsByTagName('p')[3].childNodes.item(0).data;
  var strURL="ranking.php?value="+value+"&message="+message+"&date="+date;
    if (window.XMLHttpRequest){
         req=new XMLHttpRequest();
    } else {
         req=new ActiveXObject("Microsoft.XMLHTTP");}
    if (req){
        req.onreadystatechange = function(){
             if (req.readyState == 4 ){
                 if (req.status == 200){
                    document.getElementById('state').innerHTML=req.responseText;
                } else {
                     alert("There was a problem while using XMLHTTP:\n" + req.statusText);
                   }
              }
          }
       req.open("GET", strURL, true);
       req.send(null);
   }
}
  </script>

  <div class='map'>
    <div id='map_canvas' style='height:250px; width: 100%'></div>
    <div id='placeDetails'>
      <h1></h1>
      <p></p>
    </div>
  </div>



               
              </div>
              
          </div>

        </div>

      
      </div>

      <div id="push"></div>
    </div>

<?php include '../footer.php'; ?>
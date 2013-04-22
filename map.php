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
      var icons = {
        'train':          'http://cdn2.iconfinder.com/data/icons/lin/32/7.png',
        'train-selected': 'http://cdn1.iconfinder.com/data/icons/lin/32/8.png'
      }


      $.getJSON('places.json', function(places) {
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
  </script>

  <div class='map'>
    <div id='map_canvas' style='height:500px; width: 100%'></div>
    <div id='placeDetails'>
      <h1></h1>
      <p></p>
    </div>
  </div>
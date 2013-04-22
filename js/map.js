    $(function() { // onload handler
      var melbourne = new google.maps.LatLng(25.544048383426034, -103.45552682876587);
      var mapOptions = {
        zoom:      12,
        center:    melbourne,
        mapTypeId: google.maps.MapTypeId.ROADMAP
      }

      var map = new google.maps.Map($("#map_canvas")[0], mapOptions);

        var places =
        [
          {
            "title": "Flinders St Station",
            "description": "This is a pretty major train station.",
            "position": [
              -37.818078,
              144.966811
            ]
          },
          {
            "title": "Southern Cross Station",
            "description": "Did you know it used to be called Spencer St Station?",
            "position": [
              -37.818358,
              144.952417
            ]
          }
        ]

      var currentPlace = null;
      var info = $('#placeDetails');
      var icons = {
        'train':          'http://cdn1.iconfinder.com/data/icons/lin/24/7.png',
        'train-selected': 'http://cdn1.iconfinder.com/data/icons/lin/24/8.png'
      }


      $.getJSON('http://spaceapps.ninjas.mx/php/json.php', function(places) {
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
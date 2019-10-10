<style>

    .pac-controls label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
    }

    #input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 400px;
    }

    #input:focus {
        border-color: #4d90fe;
    }
    
</style>
<input id="input" class="controls" type="text" placeholder="Search Box">
<div id="map" style="width: 100%; height: 400px;"></div>
<div class="m-t-small">
    <input type="hidden" value="@if(isset($item->latitude)) {{$item->latitude}} @endif" name="latitude" id="latitude" style="width: 100px">
    <input type="hidden" value="@if(isset($item->longitude)) {{$item->longitude}} @endif" name="longitude" id="longitude" style="width: 100px">

</div>
<script>

    function initAutocomplete() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: @if(isset($item->latitude)) {{$item->latitude}} @else 30.0618 @endif,
                lng: @if(isset($item->longitude)) {{$item->longitude}} @else 31.3282 @endif},
            zoom: 16,
            mapTypeId: 'roadmap'
        });


        // Create the search box and link it to the UI element.
        var input = document.getElementById('input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
            searchBox.setBounds(map.getBounds());
        });

        var markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
            var places = searchBox.getPlaces();

            if (places.length == 0) {
                return;
            }

            // Clear out the old markers.
            markers.forEach(function(marker) {
                marker.setMap(null);
            });
            markers = [];

            // For each place, get the icon, name and location.
            var bounds = new google.maps.LatLngBounds();
            places.forEach(function(place) {
                if (!place.geometry) {
                    console.log("Returned place contains no geometry");
                    return;
                }
                var icon = {
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(25, 25)
                };

                // Create a marker for each place.
                markers.push(new google.maps.Marker({
                    map: map,
                    icon: icon,
                    title: place.name,
                    position: place.geometry.location
                }));

                if (place.geometry.viewport) {
                    // Only geocodes have viewport.
                    bounds.union(place.geometry.viewport);
                } else {
                    bounds.extend(place.geometry.location);
                }
            });
            map.fitBounds(bounds);
        });





        //move marker on click
        google.maps.event.addListener(map, 'click', function(event) {
            marker.setMap(null);
            // marker2.setMap(null);
            marker = new google.maps.Marker({
                position :event.latLng,
                draggable: true
            });
            marker.setMap(map);
            moveBus(marker);
        });
        var marker2, infoWindow;
        infoWindow = new google.maps.InfoWindow;
        // Try HTML5 geolocation.

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var pos = {
                    lat: @if(isset($item->latitude)) {{$item->latitude}} @else position.coords.latitude @endif,
                    lng: @if(isset($item->longitude)) {{$item->longitude}} @else position.coords.longitude @endif
                };
                map.setCenter(pos);

                marker2 = new google.maps.Marker({position:pos, map: map,draggable: true});
                marker2.setMap(map);
                moveBus(marker2);
                // infoWindow.setPosition(pos);
                // infoWindow.setContent('Some text');

                infoWindow.open(map);
            }, function() {
                handleLocationError(true, infoWindow, map.getCenter());
            });
        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
        }
        var myCenter = new google.maps.LatLng(30.0618,31.3282);
        var marker = new google.maps.Marker({position:myCenter, map: map,draggable: true});
        marker.setMap(map);
        moveBus(marker);


        // Create the search box and link it to the UI element.
        var input = document.getElementById('input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_CENTER].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
            searchBox.setBounds(map.getBounds());
        });

        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
            var places = searchBox.getPlaces();
            if (places.length == 0) {
                return;
            }

            // For each place, get the icon, name and location.
            var bounds = new google.maps.LatLngBounds();
            places.forEach(function(place) {
                marker.setMap(null);
                // marker2.setMap(null);
                marker = new google.maps.Marker({
                    position: place.geometry.location
                });

                if (!place.geometry) {
                    console.log("Returned place contains no geometry");
                    return;
                }
                var markers = [];
                markers.forEach(function(marker) {
                    marker.setMap(null);
                });
                markers = [];

                var icon = {
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(25, 25)
                };

                // Create a marker for each place.
                markers.push(new google.maps.Marker({
                    map: map,
                    icon: icon,
                    title: place.name,
                    position: place.geometry.location
                }));

                marker.setMap(map);
                moveBus(marker);

                if (place.geometry.viewport) {
                    bounds.union(place.geometry.viewport);
                } else {
                    bounds.extend(place.geometry.location);
                }
            });
            map.fitBounds(bounds);
        });
    }



</script>

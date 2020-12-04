
<!DOCTYPE html>
<html>
    <head>
      <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCS-DB39Kk-Z25C5GWymVGshXIALbjXPGY&libraries=places"></script>

    </head>
    <body>
        <label for="locationTextField">Location</label>
        <input id="locationTextField" type="text" size="50">
        <div id="output" />
        <script>
            function init() {
                var input = document.getElementById('locationTextField');
                var autocomplete = new google.maps.places.Autocomplete(input);

                google.maps.event.addListener(autocomplete, 'place_changed',
                    function() {
                        var place = autocomplete.getPlace();
                        var lat = place.geometry.location.lat();
                        var lng = place.geometry.location.lng();
                        document.getElementById("output").innerHTML = "Lat: "+lat+"<br />Lng: "+lng;
                    }
                );
            }
            google.maps.event.addDomListener(window, 'load', init);
        </script>
    </body>
</html>

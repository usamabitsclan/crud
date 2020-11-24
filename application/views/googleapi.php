<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style>
#marker-tooltip {
 display: none;
 position:absolute;
 width: 300px;
 height: 200px;
 background-color: #ccc;
 margin: 15px;
}
</style>
   <title></title>
   <script src="http://code.jquery.com/jquery-1.10.2.min.js" type="text/javascript"></script>
   <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyA7IZt-36CgqSGDFK8pChUdQXFyKIhpMBY&sensor=true" type="text/javascript"></script>
   <script type="text/javascript">

       var map;
       var geocoder;
       var marker;
       var bord_data  = new Array();
       var latlng;
       var infowindow;

       $(document).ready(function() {
           ViewCustInGoogleMap();


       });

       function ViewCustInGoogleMap() {

           var mapOptions = {
               center: new google.maps.LatLng(18.9894117, 73.1175052),   // Coimbatore = (11.0168445, 76.9558321)
               zoom: 11,
               mapTypeId: google.maps.MapTypeId.ROADMAP
           };
           map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);

           //   data in json format

          var data = '[{ "DisplayText": "PANVEL 4:30 AM", "ADDRESS": "PANVEL", "LatitudeLongitude": " 18.9894117,73.1175052", "MarkerId": "Customer" },{ "DisplayText": "KHARGHAR 5:00 AM", "ADDRESS": "KHARGHAR", "LatitudeLongitude": "19.0361,73.0617", "MarkerId": "Customer"},{ "DisplayText": "CBD BELAPUR", "ADDRESS": "CBD BELAPUR 5:15 AM", "LatitudeLongitude": "19.0169,73.0394", "MarkerId": "Customer"},{ "DisplayText": "VASHI 5:30 AM", "ADDRESS": "VASHI", "LatitudeLongitude": "19.005198400000000000,73.0100", "MarkerId": "Customer"},{ "DisplayText": "KHANDA COLONY 4:55AM", "ADDRESS": "KHANDA COLONY", "LatitudeLongitude": " 19.005198400000000000 ,73.112831299999930000", "MarkerId": "Customer"}]';


           bord_data = JSON.parse(data);

           for (var i = 0; i < bord_data.length; i++) {
               setMarker(bord_data[i]);
           }

       }

       function setMarker(bord_data ) {
           geocoder = new google.maps.Geocoder();
           infowindow = new google.maps.InfoWindow();
           if ((bord_data ["LatitudeLongitude"] == null) || (bord_data ["LatitudeLongitude"] == 'null') || (bord_data ["LatitudeLongitude"] == '')) {
               geocoder.geocode({ 'address': bord_data ["Address"] }, function(results, status) {
                   if (status == google.maps.GeocoderStatus.OK) {
                       latlng = new google.maps.LatLng(results[0].geometry.location.lat(), results[0].geometry.location.lng());
                       marker = new google.maps.Marker({
                           position: latlng,
                           map: map,
                           draggable: false,
                           html: bord_data ["DisplayText"],
                          // icon: "images/marker/" + bord_data ["MarkerId"] + ".png"
                       });

                       google.maps.event.addListener(marker, 'mouseover', function(event) {
                           infowindow.setContent("<b>"+this.html+"</br>");
                           infowindow.setPosition(event.latLng);
                           infowindow.open(map, this);
                       });
                   }
                   else {
                       alert("error");
                   }
               });
           }
           else {
               var latlngStr = bord_data ["LatitudeLongitude"].split(",");
               var lat = parseFloat(latlngStr[0]);
               var lng = parseFloat(latlngStr[1]);
               latlng = new google.maps.LatLng(lat, lng);
               marker = new google.maps.Marker({
                   position: latlng,
                   map: map,
                   draggable: false,               // cant drag it
                   html: bord_data ["DisplayText"]    // Content display on marker click
                  //icon: "images/marker.png"       // Give ur own image
               });
               //marker.setPosition(latlng);
               //map.setCenter(latlng);
               google.maps.event.addListener(marker, 'mouseover', function(event) {
                   infowindow.setContent("<h3>"+this.html+"</h3>");
                   infowindow.setPosition(event.latLng);

                   infowindow.open(map, this);

               });
              google.maps.event.addListener(marker, 'mouseout', function(event) {
                   infowindow.setContent("<h3>"+this.html+"</h3>");
                   //infowindow.setPosition(event.latLng);

                   infowindow.close(map, this);

               });
           }
       }

   </script>
</head>
<body>
<table>
<tr>
<td>aaa</td>
<td> <div id="map-canvas" style="width: 500px; height: 500px; align:center"></div></td>
</tr>
</table>



</body>
</html>

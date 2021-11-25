<div id="map" style="width: 100%; height: 500px;"></div>
<script>
function initMap() {
   var locations = [
        <?php
           if(!empty($getAllStatus)){
                $sn = 4;
                foreach($getAllStatus as $key => $value)
                {
                    if(!empty($value['pickup_latitude']))
                    { 
                        $img_url = base_url('assest/bus_icon.png');
           
                        echo "['".$value['bus_number']."', ".$value['pickup_latitude'].", ".$value['pickup_longitude'].",'".$img_url."',  ".$sn."],";
                        $sn++;
                    }     
                } 
            }
            else
            {
              echo "[]";
            }   
        ?>
    ];
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 8,
        center: new google.maps.LatLng(<?= (!empty($latitude))?$latitude:22.7196; ?>,<?= (!empty($longitude))?$longitude:75.8577; ?>),
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    var infowindow = new google.maps.InfoWindow();
    var marker, i;
    for (i = 0; i < locations.length; i++) {
        marker = new google.maps.Marker({
            position: new google.maps.LatLng(locations[i][1], locations[i][2]),
            map: map,
            content: "1",
            title: locations[i][0],
            icon:locations[i][3]
        });
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                infowindow.setContent(locations[i][0]);
                infowindow.open(map, marker);
            }
        })(marker, i));
    }
}
</script>
<!-- <script src="https://maps.googleapis.com/maps/api/js?libraries=places&callback=initMap" async defer></script>
 -->
 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>

<!-- <script
  async
  defer
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDpfBnNOV6-8Uddif7X67gMS6I77jdXXgo&libraries=geometry,places&callback=initMap"
></script> -->
<script 
  async
  defer
  src="https://maps.googleapis.com/maps/api/js?libraries=geometry&sensor=false&key=AIzaSyDpfBnNOV6-8Uddif7X67gMS6I77jdXXgo&callback=initMap"
></script>
<!--<script-->
<!--  async-->
<!--  defer-->
<!--  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDpfBnNOV6-8Uddif7X67gMS6I77jdXXgo&callback=initMap"-->
<!--></script>-->

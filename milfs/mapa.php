<!DOCTYPE html>
<html>
<head>
<meta charset=utf-8 />
<title>Display latitude longitude on marker movement</title>

<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.3/leaflet.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.3/leaflet.css" />
<style>
  body { margin:0; padding:0; }
  #map {width: 100%;height: 280px;}
</style>
</head>
<body>



<div id='map'></div>
<?php 
        if ($_REQUEST[lat] !='') {
                $lat = $_REQUEST[lat];
        } else {
                # Default latitude for Medellín, Colombia
                $lat = "6.2463742841860";
        }
        if ($_REQUEST[lon] !='') {
                $lon = $_REQUEST[lon];
        } else {
                # Default longitude for Medellín, Colombia
                $lon = "-75.5570125579834";
        }
	if ($_REQUEST[zoom] !='') {$zoom=$_REQUEST[zoom];}else {$zoom= "16";}
	
 ?>
<script>
var map = L.map('map')
   .setView([<?php echo $lat ?>, <?php echo $lon ?>], <?php echo $zoom ?>);
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
function onLocationFound(e) {
			var radius = e.accuracy / 2;
			var marker = L.marker(e.latlng,{draggable: true}).addTo(map)
						L.circle(e.latlng, radius).addTo(map);
var mapa = window.parent.document.getElementById('<?php echo $_REQUEST[id]?>');
			
			marker.on('dragend', ondragend);
			ondragend();
			function ondragend() {
    			var m = marker.getLatLng();
    			var z = map.getZoom();
    mapa.value= m.lng+' '+m.lat+' '+z;
}

									}

function onLocationError(e) {
			//alert(e.message);
                        var marker = L.marker([<?php echo $lat ?>, <?php echo $lon ?>], {draggable: true}).addTo(map);
			var mapa = window.parent.document.getElementById('<?php echo $_REQUEST[id]?>');
			marker.on('dragend', ondragend);
			ondragend();
			function ondragend() {
    			var m = marker.getLatLng();
    			var z = map.getZoom();
    mapa.value= m.lng+' '+m.lat+' '+z;
 }
		}

		map.on('locationfound', onLocationFound);
		map.on('locationerror', onLocationError);

map.locate({setView: true, maxZoom: 16});
//var lat = window.parent.document.getElementById('lat');
//var lng = window.parent.document.getElementById('lon');
//var mapa = window.parent.document.getElementById('<?php echo $_REQUEST[id]?>');

//var marker = L.marker([<?php echo $lat ?>, <?php echo $lon ?>], {draggable: true}).addTo(map);



// every time the marker is dragged, update the coordinates container
//marker.on('dragend', ondragend);

// Set the initial marker coordinate on load.
//ondragend();

/*
function ondragend() {
    var m = marker.getLatLng();
    var z = map.getZoom();

   // lat.value= m.lat;
   // lng.value= m.lng;
    mapa.value= m.lng+' '+m.lat+' '+z;
}*/
</script>


</body>
</html>
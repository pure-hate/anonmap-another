<!DOCTYPE html>
<html>
    <head>
        <title>API карт 2ГИС</title>
		
        <script src="https://maps.api.2gis.ru/2.0/loader.js?pkg=full"></script>

    </head>
    <body> 
	<script type="text/javascript">
            var map;
            DG.then(function () {
                map = DG.map('map', {
                    center: [54.98, 82.89],
                    zoom: 13
                });
				
				map.on('click', function(e) {
                    document.getElementById('form').style.visibility = "visible";
					document.getElementById('info').style.visibility = "hidden";
					document.getElementById('lat').value = e.latlng.lat;
					document.getElementById('lon').value = e.latlng.lng;
					
                });
				
				map.on('move', function(e) {
                    //document.getElementById('text').innerText = e;
                });
				
				function AddMarker(coords, clickName, clickTelegram, clickText) {
								DG.marker(coords).bindPopup(clickName).on('click', function() {
									document.getElementById('form').style.visibility = "hidden";
									document.getElementById('info').style.visibility = "visible";
                          document.getElementById('named').innerText = clickName;
						  document.getElementById('telegram').innerText = clickTelegram;
						  document.getElementById('text').innerText = clickText;
                    }).addTo(map);
				}
				


				

				
				<?php
				print "AddMarker([54.98, 82.89],'Anon 3', '@ololo', 'testtext');";
				include 'database.php';
				 ?>
				

              
            });
        </script>
        <div id="map" style="width:500px; height:400px"></div>
		<div id='info'>
	<span id="named"> </span><br>
	<span id="telegram"> </span><br>
	<span id="text"> </span>
	</div>
	<div id='form' style="visibility: hidden">
	<p>Добавить свою метку:</p>
	<form name="add_form" action="create.php" method="post">
	<input type="text" id="lat" name="lat" value="lat" style="display:none"; />
	<input type="text" id="lon" name="lon" value="lon" style="display:none"; />
	<br>
    <p>Имя:
    <input type="text" name="name" /></p>
    <p>Телеграмм
    <input type="text" name="telegram" /></p>
	<p>Текст
	<input type="text" name="text" /></p>
    <input type="submit" value="Добавить">
</form>
</div>
    </body>
</html>
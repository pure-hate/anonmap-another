<!DOCTYPE html>
<html>
    <head>
        <title>Anonmap</title>
		
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
					document.getElementById('form').style.width='100%';
					
					document.getElementById('info').style.visibility = "hidden";
					document.getElementById('info').style.width='1px';
					
					document.getElementById('lat').value = e.latlng.lat;
					document.getElementById('lon').value = e.latlng.lng;
					
                });
				
				map.on('move', function(e) {
                    //document.getElementById('text').innerText = e;
                });
				myIcon = DG.icon({
                    iconUrl: 'paket.png',
                    iconSize: [48, 48]
                });
				function AddMarker(coords, clickName, clickTelegram, clickText) {
								DG.marker(coords,{
                    icon: myIcon
                }).bindPopup(clickName).on('click', function() {
									document.getElementById('form').style.visibility = "hidden";
									document.getElementById('form').style.width='1px';
									
									document.getElementById('info').style.visibility = "visible";
									document.getElementById('info').style.width='100%';
									
                          document.getElementById('named').innerText = clickName;
						  document.getElementById('telegram').innerText = clickTelegram;
						  document.getElementById('telegram').href = "https://telegram.im/"+clickTelegram;
						  document.getElementById('text').innerText = clickText;
                    }).addTo(map);
				}

				<?php
				include 'database.php';
				 ?>
				

              
            });
        </script>
		
    <div id="map" style="width:100%; height:500px;"></div>
	

	
		<div id='info' style="display:table-cell;width:50%; word-wrap: break-word;">
			<span id="named"> </span><br>
			<a id="telegram" href="" target="_blank"></a><br>
			<span id="text" > </span>
		</div>
		
		<div id='form' style="display:table-cell; visibility: hidden; float:right;">
			<p>Добавить свою метку:</p>
			<form name="add_form" action="create.php" method="post">
			<input type="text" id="lat" name="lat" value="lat" style="display:none"; size="0"; />
			<input type="text" id="lon" name="lon" value="lon" style="display:none"; size="0"; />
			<br>
			Имя:
			<input type="text" name="name" />
			Телеграмм
			<input type="text" name="telegram" />
			Текст
			<input type="text" name="text" />
			<input type="submit" value="Добавить">
		</form>
		</div>
	

		
    </body>
</html>
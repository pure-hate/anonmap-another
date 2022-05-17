<!DOCTYPE html>
<html>
    <head>
        <title>Anonmap</title>
		<link href="style.css" rel="stylesheet" type="text/css">
        <script src="https://maps.api.2gis.ru/2.0/loader.js?pkg=full"></script>
		<script type="text/javascript" src="https://code.jquery.com/jquery-3.1.0.js"></script> 
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>


    </head>
    <body> 
	<script type="text/javascript">
            var map;
			
            DG.then(function () {
                map = DG.map('map', {
                    center: [55.75374828253524, 37.61992871761323],
                    zoom: 9
                });
				

				map.on('click', function(e) {
                    document.getElementById('form').style.visibility = "visible";
					document.getElementById('form').style.width='100%';
					
					document.getElementById('info').style.visibility = "hidden";
					document.getElementById('info').style.width='1px';
					
					document.getElementById('lat').value = e.latlng.lat;
					document.getElementById('lon').value = e.latlng.lng;
					
                });
				
				map.on('moveend', function(e) {
					
					
					DeleteAllMarkers();

					
					var bound=map.getBounds();
					
					x1b = bound.getNorthWest().lat;
					y1b = bound.getNorthWest().lng;
					x2b = bound.getSouthEast().lat;
					y2b = bound.getSouthEast().lng;
					
                         $.ajax({
					type:'post',
                    url: 'update.php',
					data:{x1:x1b, x2:x2b, y1:y1b, y2:y2b},
       
					response:'text',
                    success: function(r){
                        try {
							
                            str= JSON.parse(r);
							
							for(item in str){
								AddMarker([str[item][0],str[item][1]],str[item][2],str[item][3],str[item][4],str[item][5]);
							}
                            
                        } catch (e) {
                            alert("Ошибка:" + e);
                            console.log(e);
                        }
                    }
                });
                });
				myIcon1 = DG.icon({
                    iconUrl: 'paket.png',
                    iconSize: [48, 48]
                });
				myIcon2 = DG.icon({
                    iconUrl: '2.png',
                    iconSize: [48, 48]
                });
				myIcon3 = DG.icon({
                    iconUrl: '3.png',
                    iconSize: [48, 48]
                });
				myIcon4 = DG.icon({
                    iconUrl: '4.png',
                    iconSize: [48, 48]
                });
				myIcon5 = DG.icon({
                    iconUrl: '5.png',
                    iconSize: [48, 48]
                });
				myIcon6 = DG.icon({
                    iconUrl: '6.png',
                    iconSize: [48, 48]
                });
				myIcon7 = DG.icon({
                    iconUrl: '7.png',
                    iconSize: [48, 48]
                });
				myIcon8 = DG.icon({
                    iconUrl: '8.png',
                    iconSize: [48, 48]
                });
				icons = new Map([
				['1', myIcon1],
				['2', myIcon2],
				['3', myIcon3],
				['4', myIcon4],
				['5', myIcon5],
				['6', myIcon6],
				['7', myIcon7],
				['8', myIcon8],
					]);
				
				function DeleteAllMarkers()
				{
					for(item in map._layers.valueOf()){

					if (map._layers[item].hasOwnProperty('_latlng'))
						{map._layers[item].remove();}
					}
				}
				
				
				function AddMarker(coords, clickName, clickTelegram, clickText, icon_num) {
					let icon_temp = icons.get(icon_num);
								DG.marker(coords,{
                    icon: icon_temp
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
				DeleteAllMarkers();
				

              
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
			<label>
			<br>
			<input type="radio" name="icon" value="1" checked>
			<img src="paket.png">
			</label>
			<label>
			<input type="radio" name="icon" value="2">
			<img src="2.png">
			</label>
			<label>
			<input type="radio" name="icon" value="3">
			<img src="3.png">
			</label>
			<label>
			<input type="radio" name="icon" value="4">
			<img src="4.png">
			</label>
			<label>
			<input type="radio" name="icon" value="5">
			<img src="5.png">
			</label>
			<label>
			<input type="radio" name="icon" value="6">
			<img src="6.png">
			</label>
			<label>
			<input type="radio" name="icon" value="7">
			<img src="7.png">
			</label>
			<label>
			<input type="radio" name="icon" value="8">
			<img src="8.png">
			</label>

			<input type="submit" value="Добавить">
		</form>
		</div>
	

		
    </body>
</html>
<?php

  $con=mysqli_connect("localhost","root","","anons");

  // Check connection
  if (mysqli_connect_errno())
  {
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

	$lat = $con->real_escape_string($_POST["lat"]);
    $lon = $con->real_escape_string($_POST["lon"]);
	$name = $con->real_escape_string($_POST["name"]);
    $telegram = $con->real_escape_string($_POST["telegram"]);
    $text = $con->real_escape_string($_POST["text"]);
	
	
	    $sql = "insert into anonlist (lat, lon, name,telegram, text) values ('$lat', '$lon','$name','$telegram','$text')";
    if($con->query($sql)){
        echo "Маркер добавлен";
		echo '<script type="text/javascript">';
		echo 'window.location=document.referrer;';
		echo '</script>';
    } else{
        echo "Ошибка: " . $con->error;
    }
    $con->close();
?>
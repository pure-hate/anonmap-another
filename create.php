<?php

   $con=mysqli_connect("localhost","root","","anons");

  // Check connection
  if (mysqli_connect_errno())
  {
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
	$ip = md5($_SERVER['REMOTE_ADDR']);
	$lat = $con->real_escape_string($_POST["lat"]);
    $lon = $con->real_escape_string($_POST["lon"]);
	$name = $con->real_escape_string($_POST["name"]);
    $telegram = $con->real_escape_string($_POST["telegram"]);
    $text = $con->real_escape_string($_POST["text"]);
	
	$name = substr($name, 0, 100);
	$telegram = substr($telegram, 0, 50);
	$text = substr($text, 0, 300);
	
	if ($telegram[0]!="@")
	{
		$telegram= "@".$telegram;
	}
	
	if (is_numeric($lat) && is_numeric($lon)){
	
		$res = $con->query("SELECT name FROM anonlist WHERE ip = '$ip'");
		$count = $res->num_rows;
		echo $count;
		if ($count==0)
		{
			$sql = "insert into anonlist (lat, lon, name,telegram, text, ip) values ('$lat', '$lon','$name','$telegram','$text','$ip')";
			if($con->query($sql))
			{
				echo "Маркер добавлен";
				echo '<script type="text/javascript">';
				echo 'window.location=document.referrer;';
				echo '</script>';
			}
			else
			{
				echo "Ошибка: " . $con->error;
			}
		}
		else
		{
			$sql = "UPDATE anonlist SET lat='$lat', lon='$lon', name = '$name', telegram = '$telegram', text = '$text' WHERE ip = '$ip';";
			if($con->query($sql))
				{
					echo "Маркер перенесен";
					echo '<script type="text/javascript">';
					echo 'window.location=document.referrer;';
					echo '</script>';
				}
				else
				{
					echo "Ошибка: " . $con->error;
				}
		}
		
	}
	else
	{
		echo "Ошибка: координаты попердолены";
	}
    $con->close();
?>
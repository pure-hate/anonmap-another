
<?php

  include 'connection.php';

  $query = "select lat, lon, name, telegram, text, icon  from anonlist";

  $result = mysqli_query($con,$query);

  $rows = array();
   while($r = mysqli_fetch_assoc($result)) {
	 print "AddMarker([" .$r['lat']. ", " .$r['lon']. "],'" .$r['name']. "', '" .$r['telegram']. "', '" .$r['text']. "', '".$r['icon']. "');";
     $rows[] = $r;
  }
  //echo "var markers ='"  . json_encode($rows) . "'";
  

  mysqli_close($con);
?>
				
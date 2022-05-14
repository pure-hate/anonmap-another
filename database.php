
<?php

  $con=mysqli_connect("localhost","root","","anons");

  // Check connection
  if (mysqli_connect_errno())
  {
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

  $query = "select lat, lon, name, telegram, text  from anonlist";

  $result = mysqli_query($con,$query);

  $rows = array();
   while($r = mysqli_fetch_assoc($result)) {
	 print "AddMarker([" .$r['lat']. ", " .$r['lon']. "],'" .$r['name']. "', '" .$r['telegram']. "', '" .$r['text']. "');";
     $rows[] = $r;
  }
  //echo "var markers ='"  . json_encode($rows) . "'";
  

  mysqli_close($con);
?>
				
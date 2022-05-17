<?php
    include 'connection.php';
 
 
	$x1 = $_POST['x1'];
    $x2 = $_POST['x2'];
    $y1 = $_POST['y1'];
	$y2 = $_POST['y2'];
    $markers=mysqli_query($con, "SELECT `lat`, `lon`, `name`, `telegram`, `text`, `icon` FROM `anonlist` WHERE (lat BETWEEN '$x2' AND '$x1') AND (lon BETWEEN '$y1' AND '$y2') LIMIT 100");
    echo json_encode(($markers->fetch_all()));
?>
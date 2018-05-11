<?php

  $username = "root";
  $password = "";
  $server = "localhost";
  $database = "memelaid";

  $conn = mysqli_connect($server, $username, $password);
	mysqli_select_db($conn, $database);

  // Check connection.
  if ($conn->connect_error) die("Connection to server failed: " . $conn->connect_error);

?>

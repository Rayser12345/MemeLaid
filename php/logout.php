<?php

  header("Refresh: 3; URL=../index.php");

  session_start();
  unset($_SESSION["username"]);

  echo "Logged out successfully. Now redirecting..."

?>

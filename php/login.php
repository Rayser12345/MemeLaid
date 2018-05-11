<?php

  header("Refresh: 3; URL=../index.php");

  require "connection.php";

  $username = $_POST["username"];
  $password = $_POST["password"];

  $stmt = $conn->prepare("SELECT * FROM User WHERE usr_username=? AND usr_password=?");
  $stmt->bind_param("ss", $username, $password);


  if ($stmt->execute()) {
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
      echo "Logged in successfully. Now redirecting...";

      session_start();
      $_SESSION["username"] = $username;
    } else {
      echo "Incorrect username or password. Now redirecting...";
    }
  } else {
    echo "Log in attempt failed. Now redirecting...";
  }

  $conn->close();

?>

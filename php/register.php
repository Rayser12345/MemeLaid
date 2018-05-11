<?php

  header("Refresh: 3; URL=../index.php");

  require "connection.php";

  $username = $_POST["username"];
  $password = $_POST["password"];
  $email = $_POST["email"];

  /*
    sss -> string string string
    prepare prepares the statement.
    bind_param binds the paremetrs to the statement.
  */
  $stmt = $conn->prepare("INSERT INTO User (usr_username, usr_password, usr_email) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $username, $password, $email);

  if ($stmt->execute()) {
    echo "Successfully registered your account. You can now login. Now redirecting...";
    $_SESSION["username"] = $username;
  } else {
    echo "Registration attempt failed. Now redirecting...";
  }

  $conn->close();
?>

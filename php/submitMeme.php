<?php

  header("Refresh: 3; URL=../index.php");

  require "connection.php";

  $title = $_POST["title"];
  $channel1 = $_POST["channel1"];
  $channel2 = $_POST["channel2"];
  $channel3 = $_POST["channel3"];

  $target_dir = "../posts/";
  $target_file = $target_dir . basename($_FILES["file"]["name"]);

  // If file exists add (2).
  if (file_exists($target_file)) {
    $ext = pathinfo($target_file, PATHINFO_EXTENSION);
    $withoutExt = substr(basename($_FILES["file"]["name"]), 0, strrpos(basename($_FILES["file"]["name"]), "."));

    $target_file = $target_dir . $withoutExt . ("(2)") . "." . $ext;
  }


  // Upload file.
  if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
      echo basename($_FILES["file"]["name"]). " has been uploaded.";
  } else {
      echo "Could not upload the file to server.";
  }



  $stmt = $conn->prepare("INSERT INTO Post (post_title, post_date, post_media_path, post_author)
  VALUES (?, ?, ?, ?)");
  $stmt->bind_param("ssss", $title, now(), $target_file, $_SESSION["user"]);

  if ($stmt->execute()) {
    echo "Path sent to db.";
  } else {
    echo "Could not send path to db.";
  }

  $conn->close();

?>

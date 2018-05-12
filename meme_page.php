<?php

  session_start();

  require "../php/connection.php";

  $postId = basename($_SERVER['PHP_SELF']);
  $postId = substr($postId, 0, strrpos($postId, "."));
  $postId = (int) $postId;

  $postTitle = "";
  $postDate = "";
  $postMediaPath = "";
  $postAuthor = 0;
  $postChannel = 0;
  $postUrl = "";

  // Get info from database.

  $stmt = $conn->prepare("SELECT * FROM POST WHERE post_id=?");
  $stmt->bind_param("d", $postId);
  if ($stmt->execute()) {
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
      $row = $result->fetch_array();

      $postTitle = $row["post_title"];
      $postDate = $row["post_date"];
      $postMediaPath = $row["post_media_path"];
      $postAuthor = $row["post_author"];
      $postChannel = $row["post_chan"];
      $postUrl = $row["post_url"];
    }
  }

?>

<html>

  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <head>
    <title>Memelaid - Where memes are laid</title>

    <link rel="stylesheet" type="text/css" href="../css/style.css" />
    <link href='http://fonts.googleapis.com/css?family=Lato:400,700'
    rel='stylesheet' type='text/css'>
    <link rel="icon" href="pepe.ico">

    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/index.js"></script>
  </head>
  <body>
    <header>
      <div class="headerContent">
        <img id="navControl" class="headerElement" src="../assets/open_nav.png"
        style="cursor: pointer"/>
        <form onsubmit="" class="headerElement">
          <table class="headerElement">
            <tr>
              <td>
                <input type="text" placeholder="Search..." name="search" class="headerElement"/>
              </td>
              <td>
                <input type="submit" class="headerElement" id="search" value="Search"/>
              </td>
            </tr>
          </table>
        </form>
        <table style="float: right;">
          <tr>
            <td style="color: white">
              <?php
                if (isset($_SESSION["username"]))
                  echo "Welcome back, " . $_SESSION["username"] . "!";
              ?>
            </td>
            <td>
              <img id="changeTheme" class="headerElement" src="../assets/brush.png"
              style="cursor: pointer"/>
            </td>
          </tr>
        </table>

        <img src="../assets/message-squared.png" id="notiButton" class="headerElement" style="cursor: pointer">
      </div>
    </header>

    <!-- Meme area -->
    <div class="mainMemeContainer">
      <div class="mainMemeMediaContainer">
        <table style="width: 100%;">
          <tr style="width: 100%;">
            <td style="width: 100%; text-align: center; font-size: 3em;">
              <?php
                echo $postTitle;
              ?>
            </td>
          </tr>
        </table>
        <table style="display: inline-table; margin-left: 10%; margin-top: 10%;">
          <tr class="memeButtonWidth">
            <td>
              <button id="previousMeme" class="memeButton">Previous</button>
            </td>
          </tr>
          <tr class="memeButtonWidth">
            <td>
              <button id="dislikeMeme" class="memeButton">Dislike</button>
            </td>
          </tr>
          <tr class="memeButtonWidth">
            <td>
              <button id="reportMeme" class="memeButton">Report</button>
            </td>
          </tr>
        </table>
        <table style="float: right; display: inline-table; margin-right: 10%; margin-top: 10%;">
          <tr class="memeButtonWidth">
            <td>
              <button id="nextMeme" class="memeButton">Next</button>
            </td>
          </tr>
          <tr class="memeButtonWidth">
            <td>
              <button id="likeMeme" class="memeButton">Like</button>
            </td>
          </tr>
          <tr class="memeButtonWidth">
            <td>
              <button id="shareMeme" class="memeButton">Share</button>
            </td>
          </tr>
        </table>
        <div class="mainMemeMediaContent">
            <?php
              echo "<img src=\"$postMediaPath\" style=\"margin-left: auto; margin-right: auto; display: block; max-width:100%; max-height: 100%;\"/>"
            ?>
        </div>
      </div>
    </div>

   <div id="loginRegisterDiv" class="hidden2" style="height: 300px; top: 30%; left: 40%;">
      <form action="php/login.php" method="post" id="loginForm">
        <table style="width: 100%; height: 30%;">
            <br><br>
          <tr>
            <td style="color: white;float: right; margin-right: 3.8em">
              Username:<input required value="admin" type="text" name="username" id="usernameLogin" style="width: 62%">
            </td>
          </tr>
          <tr>
            <td style="color: white;  float: right; margin-right: 3.8em">
              Password:<input required value="admin" type="password" name="password" id="passwordLogin" style="width: 63%">
            </td>
          </tr>
          <tr>
            <td colspan="2" style="color: white">
              <input type="submit" value="Login" style="width: 60%; display: block; margin: auto;">
            </td>
          </tr>
          <tr>
            <td colspan="2" class="formLabel" style="text-align: center; color: white;">
              Or create an account below:
            </td>
          </tr>
      </form>
      <form action="php/register.php" method="post" id="registerForm">
          <tr>
            <td style="color: white; float: right; margin-right: 3.8em">
              Username: <input required type="text" name="username" id="usernameRegister" style="width: 62%;"/>
            </td>
          </tr>
          <tr>
            <td style="color: white; float: right; margin-right: 3.8em">
              Password: <input required type="password" name="password" id="passwordRegister" style="width: 63%"/>
            </td>
          </tr>
          <tr>
            <td style="color: white; float: right; margin-right: 3.8em;">
              Confirm password: <input required type="password" name="confirm" id="passwordConfirm" style="width: 50.5%"/>
            </td>
          </tr>
          <tr>
            <td style="color: white; right; margin-right: 3.8em;">
              E-mail: <input type="email" required name="email" id="emailRegister" style="width: 69.5%"/>
            </td>
          </tr>
          <tr>
            <td>
              <input type="submit" value="Register" style="width: 60%; display: block; margin: auto;"/>
            </td>
          </tr>
        </table>
      </form>
    </div>

    <!-- Submit menu?-->

    <div id="submit" class="hidden2" style="font: 1vw;">
      <form action="../php/submitMeme.php" method="post" enctype="multipart/form-data" id="submitForm">
        <table style="width: 100%;">
          <tr>
            <td style="color: yellow; font-size: 3em; text-align: center;">
              Submit Meme
            </td>
          </tr>
          <tr>
            <td style="color: white;">
              Title: <input type="text" name="title" id="memeTitle" style="float: right; width: 70%;"/>
            </td>
          </tr>
          <tr>
            <td style="color: white;">
              Channel 1:
              <?php
                echo "<select name=\"channel\" id=\"channel\" style=\"float: right; width: 70%;\" selected=\"1\">";
                echo "<option value=\"default1 \">Select channel...</option>";

                for($i = 0; $i < sizeof($channelName); $i++) {
                  echo "<option value=\"$channelName[$i]\">" . $channelName[$i] . "</option>";
                }

                echo "</select>";
              ?>

            </td>
          </tr>
          <tr>
            <td style="color: white;">
              <input name="file" type="file" id="file" accept=".jpg, .jpeg, .png, .gif, .webm, .mp4">
          </tr>
          <tr>
            <td>
              <img src="../assets/submit-placeholder.png" id="previewFile" style="display:block; width: 100%; height: auto;"/>
            </td>
          </tr>
        </table>
        <input type="submit" value="Submit" style="width: 100%;"/>
      </form>
    </div>

    <div id="nav" class="hidden">
        <div id="navContent">

          <a href="../index.php"><button class="navButton" type="button">Home</button></a>

          <!-- Only show login button if user is NOT logged in. -->
          <?php
            if (!isset($_SESSION["username"]))
              echo "<button id=\"openNavLoginRegister\" class=\"navButton\" type=\"button\">Login</button>";
          ?>

          <!-- Only show submit button if user is logged in. -->
          <?php
            if (isset($_SESSION["username"]))
              echo "<button id=\"submitButton\" class=\"navButton\" type=\"button\">Submit</button>";
          ?>

          <button class="navButton" type="button">Channels</button>

          <!-- Only show profile button if user is logged in. -->
          <?php
            if (isset($_SESSION["username"]))
              echo "<button class=\"navButton\" type=\"button\">Profile</button>";
          ?>

          <!-- Only show logout button if user is logged in. -->
          <?php
            if (isset($_SESSION["username"]))
              echo "<a href=\"../php/logout.php\"><button class=\"navButton\" type=\"button\">Logout</button></a>;"
          ?>

        </div>
      </div>

    <div id="noti" class="hidden2" style="z-index: 2">
    </div>

    <!-- Comments area -->
    <div id="commentSpace">
      <div id="comments">
          <table border="1">
            <tr>
              <td>
                Username placeholder
              </td>
            </tr>
            <tr>
              <td>
                profile pic placeholder
              </td>
              <td>
                comment placeholder
              </td>
              <td>
                reply placeholder
              </td>
              <td>
                like placeholder
              </td>
              <td>
                dislike placeholder
              </td>
            </tr>
          </table>
      </div>
    </div>
  </body>
</html>

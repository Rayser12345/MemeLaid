<?php

  session_start();

  require "php/connection.php";

  $channelName = array();
  $channelDescription = array();

  // Get channels from database.
  $stmt = $conn->prepare("SELECT * FROM Channel");
  if ($stmt->execute()) {
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
      $i = 0;
      while($row = $result->fetch_assoc()) {
        $channelName[$i] = $row["chan_name"];
        $channelDescription[$i] = $row["chan_description"];
        // echo $channelName[$i] . " - " . $channelDescription[$i] . "<br />";
        $i++;
      }
    }
  }

?>

<html>

  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <head>
    <title>Memelaid - Where memes are laid</title>

    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link href='http://fonts.googleapis.com/css?family=Lato:400,700'
    rel='stylesheet' type='text/css'>
    <link rel="icon" href="pepe.ico">

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/index.js"></script>
  </head>
  <body>
    <header>
      <div class="headerContent">
        <img id="navControl" class="headerElement" src="assets/open_nav.png"
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
              <img id="changeTheme" class="headerElement" src="assets/brush.png"
              style="cursor: pointer"/>
            </td>
          </tr>
        </table>

        <img src="assets/message-squared.png" id="notiButton" class="headerElement" style="cursor: pointer">
      </div>
    </header>

    <div id="loginRegisterDiv" class="hidden2" style="height: 40%; top: 30%; left: 40%;">
      <form action="php/login.php" method="post" id="loginForm">
        <table border="1" style="width: 100%; height: 30%;">
          <tr>
            <td colspan="2">
              <span style="font-size: 1em; color: yellow">VITOR CLEAN THIS UP</span>
            </td>
          </tr>
          <tr>
            <td style="color: white;">
              Username:
            </td>
            <td>
              <input required type="text" name="username" id="usernameLogin" style="width: 80%">
            </td>
          </tr>
          <tr>
            <td style="color: white;">
              Password:
            </td>
            <td>
              <input required type="password" name="password" id="passwordLogin" style="width: 80%">
            </td>
          </tr>
          <tr>
            <td colspan="2" style="color: white">
              <input type="submit" value="Login" style="width: 73%; display: block; margin: auto;">
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
            <td style="color: white;">
              Username: <input required type="text" name="username" id="usernameRegister"/>
            </td>
          </tr>
          <tr>
            <td style="color: white;">
              Password: <input required type="password" name="password" id="passwordRegister"/>
            </td>
          </tr>
          <tr>
            <td style="color: white;">
              Confirm password: <input required type="password" name="confirm" id="passwordConfirm" />
            </td>
          </tr>
          <tr>
            <td style="color: white;">
              E-mail: <input type="email" required name="email" id="emailRegister" />
            </td>
          </tr>
          <tr>
            <td>
              <input type="submit" value="Register" />
            </td>
          </tr>
        </table>
      </form>
    </div>

    <!--Submit menu-->
    <div id="submit" class="hidden2" style="font: 1vw;">
      <form action="php/submitMeme.php" method="post" enctype="multipart/form-data" id="submitForm">
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
                echo "<select name=\"channel1\" id=\"channel1\" style=\"float: right; width: 70%;\" selected=\"1\">";
                echo "<option value=\"default1 \">Select channel 1...</option>";

                for($i = 0; $i < sizeof($channelName); $i++) {
                  echo "<option value=\"$channelName[$i]\">" . $channelName[$i] . "</option>";
                }

                echo "</select>";
              ?>

            </td>
          </tr>
          <tr>
            <td style="color: white;">
              Channel 2:

              <?php
                echo "<select name=\"channel2\" id=\"channel2\" style=\"float: right; width: 70%;\" selected=\"1\">";
                echo "<option value=\"default2\">Select channel 2...</option>";

                for($i = 0; $i < sizeof($channelName); $i++) {
                  echo "<option value=\"$channelName[$i]\">" . $channelName[$i] . "</option>";
                }

                echo "</select>";
              ?>

            </td>
          </tr>
          <tr>
            <td style="color: white;">
              Channel 3:

              <?php
                echo "<select name=\"channel3\" id=\"channel3\" style=\"float: right; width: 70%;\" selected=\"1\">";
                echo "<option value=\"default3\">Select channel 3...</option>";

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
              <img src="assets/submit-placeholder.png" id="previewFile" style="display:block; width: 100%; height: auto;"/>
            </td>
          </tr>
        </table>
        <input type="submit" value="Submit" style="width: 100%;"/>
      </form>
    </div>

    <div id="nav" class="hidden">
        <div id="navContent">

          <a href="index.php"><button class="navButton" type="button">Home</button></a>

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
              echo "<a href=\"php/logout.php\"><button class=\"navButton\" type=\"button\">Logout</button></a>;"
          ?>

        </div>
      </div>

    <div id="noti" class="hidden2" style="z-index: 2">
    </div>

    <div id="spotlightContainer">
      <div id="spotlight">
        <table border="1">
          <tr>
            <td>
              title 1
            </td>
            <td>
              title 2
            </td>
          </tr>
          <tr>
            <td>
              thumb 1
            </td>
            <td>
              thumb 2
            </td>
          </tr>
        </table>
      </div>
    </div>

  </body>
</html>

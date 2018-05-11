$(document).ready(function() {

  // Open/close nav.
  $("#navControl").click(function() {
    if ($("#navControl").attr("src") == "assets/open_nav.png") {
      $("#nav").toggleClass("hidden");
      $("#navControl").attr("src", "assets/close_nav.png");
    } else {
      $("#nav").toggleClass("hidden");
      $("#navControl").attr("src", "assets/open_nav.png");
    }
  });

  // Change theme.
  $("#changeTheme").click(function() {
    var bg = $("body").css("background-image").split(/\//).slice(-2).join("/").slice(0, -2);

    if (bg == "assets/pop.png")
      $("body").css("background-image", "url(assets/tropical.png)");
    else if (bg == "assets/tropical.png")
      $("body").css("background-image", "url(assets/cool.png)");
    else if (bg == "assets/cool.png")
      $("body").css("background-image", "url(assets/pop.png)");
  });

  // Open/close notifications.
  $("#notiButton").click(function() {
    $("#noti").toggleClass("hidden2");
  });

  // Open/close login/register div.
  $("#openNavLoginRegister").click(function() {
    $("#loginRegisterDiv").toggleClass("hidden2");
  });

  // Open/close submit.
  $("#submitButton").click(function() {
    $("#submit").toggleClass("hidden2");
  });

  /*
  // Show Picture.
  $("#fileUpload").click(function() {
    $("#my_image").attr("src",$_GET["fileupload"]);
  });
  */

   // Open comment box.
  $("#commentButton").click(function() {
    $("#commentBox").toggleClass("hidden2");
  });

  $("#loginForm").submit(function() {

    if ($("#usernameLogin").val().length > 0 &&
        $("#passwordLogin").val().length > 0)
        return true;
    else {
      alert("Please fill in all fields!");
      return false;
    }

  });

  $("#registerForm").submit(function() {
    if ($("#usernameRegister").val().length > 0 &&
        $("#passwordRegister").val().length > 0 &&
        $("#passwordConfirm").val().length > 0 &&
        $("#emailRegister").val().length > 0) {

        // All fields have at least 1 character, check if passwords match.
        if ($("#passwordRegister").val() == $("#passwordConfirm").val())
          return true;
        else {
          alert("Passwords do not match!");
          return false;
        }
    } else {
      alert("Please fill in all fields!");
      return false;
    }
  });

  function readFile(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
        $('#previewFile').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#file").change(function() {
    readFile(this);
  });

  $("#submitForm").submit(function() {
    /*
    console.log("Title:" + $("#memeTitle").val());
    console.log("Channel 1: " + $("#channel1").val());
    console.log("Channel 2: " + $("#channel2").val());
    console.log("Channel 3: " + $("#channel3").val());
    console.log("File: " + $("#file").val());
    console.log("-------------");
    */

    if ($("#memeTitle").val().length > 0 &&
        $("#channel1").val() != "default" &&
        $("#file").val().length > 0) {

      if ($("#channel1").val() != $("#channel2").val() &&
          $("#channel1").val() != $("#channel3").val() &&
          $("#channel2").val() != $("#channel3").val()) {
            return true;
          } else {
            alert("Channels cannot be the same!");
            return false;
          }
    } else {
      alert("Please fill in all fields!");
      return false;
    }
  });

});

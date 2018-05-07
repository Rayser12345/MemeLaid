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

  // Open notifications.
  $("#notiButton").click(function(){
    $("#noti").toggleClass("hidden2");
  });

  // Open login/register div.
  $("#openNavLoginRegister").click(function() {
    $("#loginRegisterDiv").toggleClass("hidden2");
  });
    
  // Opens Submit
  $("#submitButton").click(function() {
    $("#submit").toggleClass("hidden2");
  });
    
  //Show Picture
  $("#fileUpload").click(function(){
    $("#my_image").attr("src",$_GET["fileupload"])
  });
  //tried
  
   // Opens comment box
  $("#commentButton").click(function() {
    $("#commentBox").toggleClass("hidden2");
  });
    
});

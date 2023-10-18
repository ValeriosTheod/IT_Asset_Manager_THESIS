<?php
    session_start();
    session_destroy();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/loginstyles.css" />
    <script src="https://cdn.bootcss.com/jquery/3.7.0/jquery.js"></script>
 
    <title>Login</title>
</head>
<body>

<div class="login-box">
  <h2>Login</h2>
  <form>
    <div class="user-box">
      <input id="username" type="text" name="" required="">
      <label>Username</label>
    </div>
    <div class="user-box">
      <input id="password" type="password" name="" required="">
      <label>Password</label>
    </div>
    <a id="login_bnt" onclick="return loginme();">
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      Submit
</a>
  </form>
</div>

<script>
  var input = document.getElementById("password");

  input.addEventListener("keypress", function(event) {
    // If the user presses the "Enter" key on the keyboard
    if (event.key === "Enter") {
      // Cancel the default action, if needed
      event.preventDefault();
      // Trigger the button element with a click
      document.getElementById("login_bnt").click();
    }
  });

    function loginme(){
        var usern = document.getElementById('username').value
        var passw = document.getElementById('password').value
        $.ajax({
            url: "login.php ",
            type: "POST",    
            data: {
                username: usern,
                password: passw
            },
            success: function(response) {
              console.log(response);
              window.location.replace("index.php");
              //location.reload();
              if (response == "false"){
                alert("wrong username or password");
              }
              
            },
            error: function (xhr, ajaxOptions, thrownError) {
              alert("Error exporting category");
            }
          }); 

    }


</script>
    
</body>
</html>
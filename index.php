<!DOCTYPE html>
<html lang="en">

<?php 
    session_start();
  if (!isset($_SESSION["username"]))
   {
      header("location: loginme.php");
   }
?>

<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-icons/3.0.2/iconfont/material-icons.min.css" />
  <link rel="stylesheet" href="css/table.css" />
  <link rel="stylesheet" href="css/navbar.css" />
  <link rel="stylesheet" href="css/sidebar.css" /><script src="https://cdn.bootcss.com/jquery/3.7.0/jquery.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script type="text/javascript" src="js/exportfile.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@2.2.0/fonts/remixicon.css" />
  <link rel="stylesheet" href="https://unpkg.com/css-pro-layout@1.1.0/dist/css/css-pro-layout.css" />
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&amp;display=swap" />
  <script type="text/javascript" src="https://unpkg.com/@popperjs/core@2"></script>

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        .content2 {
            padding: 20px;
            width: 700px;
            position: absolute;
            margin: 0 auto;
            top: 200px;
            right: 0;
            bottom: 0;
            left: 0;
        }

        /* Welcome page styles */
        .welcome {
            background-color: #7d84ab; /* Purple background color */
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="layout has-sidebar fixed-sidebar fixed-header">
       
        <?php require_once "sidebar.php"?>
       
        <?php require_once "start_sidebar.php"?>
                   
                    
        <div class="content2">
        <div class="welcome">
            <h1 style="color: #ffffff;">Welcome to</h1>
            <h1 style="color: #ffffff;">ASSET MANAGER</h1>
            <p style="color: #0c1e35;">Manage your IT Assets smart!</p>
            <!-- Add more content as needed -->
        </div>
    </div>    
             
        <?php require_once "end_sidebar.php"?>   


    <script type="text/javascript" src="js/sidebar.js"></script>
</body>

</html>
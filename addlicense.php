<?php
//   session_start();
//   $newURL = 'loginme.php';
//   if (!isset($_SESSION["username"]))
//   {
//     header('Location: '.$newURL);
//   }
    require_once './db/db_con.php';

    $sql = "SELECT * FROM category";
    $result = mysqli_query($conn, $sql);
    $categoryNames = array(); // Array to store category names
    $categoryIds = array();   // Array to store category IDs


    if (mysqli_num_rows($result) > 0) {
    
        $index = 0;
        while($row = mysqli_fetch_assoc($result)) {
            array_push($categoryNames, $row['cate_name']);
            array_push($categoryIds, $row['cate_id']);
        }
    }

    $sql = "SELECT * FROM status";
    $result = mysqli_query($conn, $sql);
    $statNames = array(); // Array to store category names
    $statIds = array();   // Array to store category IDs


    if (mysqli_num_rows($result) > 0) {
    
        $index = 0;
        while($row = mysqli_fetch_assoc($result)) {
            array_push($statNames, $row['stat_name']);
            array_push($statIds, $row['stat_id']);
        }
    }

    $sql = "SELECT * FROM user";
    $result = mysqli_query($conn, $sql);
    $userNames = array(); // Array to store category names
    $userIds = array();   // Array to store category IDs


    if (mysqli_num_rows($result) > 0) {
    
        $index = 0;
        while($row = mysqli_fetch_assoc($result)) {
            array_push($userNames, $row['user_username']);
            array_push($userIds, $row['user_id']);
        }
    }
    
    $sql = "SELECT * FROM license";
    $result = mysqli_query($conn, $sql);
    $licenseNames = array(); // Array to store category names
    $licenseIds = array();   // Array to store category IDs


    if (mysqli_num_rows($result) > 0) {
    
        $index = 0;
        while($row = mysqli_fetch_assoc($result)) {
            array_push($licenseNames, $row['lice_name']);
            array_push($licenseIds, $row['lice_id']);
        }
    }

    $sql = "SELECT * FROM department";
    $result = mysqli_query($conn, $sql);
    $depaNames = array(); // Array to store category names
    $depaIds = array();   // Array to store category IDs


    if (mysqli_num_rows($result) > 0) {
    
        $index = 0;
        while($row = mysqli_fetch_assoc($result)) {
            array_push($depaNames, $row['depa_name']);
            array_push($depaIds, $row['depa_id']);
        }
    }
  
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-icons/3.0.2/iconfont/material-icons.min.css" />
  <link rel="stylesheet" href="css/table.css" />
  <link rel="stylesheet" href="css/navbar.css" />
  <link rel="stylesheet" href="css/sidebar.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.4/css/bulma.min.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.1/css/all.min.css"/>
 
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@2.2.0/fonts/remixicon.css" />
  <link rel="stylesheet" href="https://unpkg.com/css-pro-layout@1.1.0/dist/css/css-pro-layout.css" />
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&amp;display=swap" />
  
        <script type="text/javascript" src="js/exportfile.js"></script>
  <script src="https://cdn.bootcss.com/jquery/3.7.0/jquery.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script type="text/javascript" src="https://unpkg.com/@popperjs/core@2"></script>
  <script src="https://cdn.jsdelivr.net/npm/bulma-calendar@6.1.19/dist/js/bulma-calendar.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bulma-calendar@6.1.19/dist/css/bulma-calendar.min.css" rel="stylesheet">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add new License</title>
  <style>
    .label, .title{
      color: #eaeaea !important;
     }
     .select{
        width: 100% !important;
     }
     select{
        width: 100% !important;
     }
    </style>
</head>
<body>


    <div class="layout has-sidebar fixed-sidebar fixed-header">
    
       <?php require_once "sidebar.php"?>
       <?php require_once "start_sidebar.php"?>

    


<div class="section">
    <?php
        if(isset($_GET['succ']) && !empty($_GET['succ'])){
            if ($_GET['succ']==1)
                echo '<a style="color:green;margin-left:40%;font-size: 25px;"> Successful import! </a> ';
        }
        
    ?>
	<div class="box" style="background-color:#f6f1f138; color:#eaeaea;">
        
    
		<!-- Form -->
		<h1 class="title">Form</h1>
     <form method="POST" action="addlicense_action.php">
		<!-- Name -->
		<div class="field">
			<label class="label">
				License Name:
			</label>
			<p class="control">
				<input 
					class="input"
					type="text"
					placeholder="Name"
                    name="name" required
				/>
			</p>
		</div>


		<!-- Category -->
		<div class="field">
			<label class="label">
				Expiration Date
			</label>
			<input name="expir" type="date">
		</div>

        <!-- Status -->
		<div class="field">
			<label class="label">
				Enabled Date
			</label>
			<input name="enabled" type="date">
		</div>

        <!-- Manufacturer -->
		<div class="field">
			<label class="label">
				Manufacturer
			</label>
			<p class="control">
				<input 
					class="input"
					type="text"
					placeholder="Manufacturer"
                    name="manufacturer" required
				/>
			</p>
		</div>

        <!-- Total -->
		<div class="field">
			<label class="label">
			    Total
			</label>
			<p class="control">
				<input 
					class="input"
					type="number"
                    step="1"
					placeholder="Total"
                    name="total"
				/>
			</p>
		</div>

        <!-- Available -->
		<div class="field">
			<label class="label">
				Available
			</label>
			<p class="control">
				<input 
					class="input"
					type="number"
                    step="1"
					placeholder="Available"
                    name="available"
				/>
			</p>
		</div>


		<!-- Button group -->
		<div class="field is-grouped">
			<p class=control>
				<button class="button is-link">Submit</button>
			</p>
			<p class="control">
				<button class="button is-text">Cancel</button>
			</p>
		</div>
        </form>
	</div>
	
</div>
   
<?php require_once "end_sidebar.php"?>   


<script type="text/javascript" src="js/sidebar.js"></script>
<script>
    // Initialize all input of type date
    var calendars = bulmaCalendar.attach('[type="date"]', options);

    // Loop on each calendar initialized
    for(var i = 0; i < calendars.length; i++) {
        // Add listener to select event
        calendars[i].on('select', date => {
            console.log(date);
        });
    }

    // To access to bulmaCalendar instance of an element
    var element = document.querySelector('#my-element');
    if (element) {
        // bulmaCalendar instance is available as element.bulmaCalendar
        element.bulmaCalendar.on('select', function(datepicker) {
            console.log(datepicker.data.value());
        });
    }
</script>
  
</body>

</html>
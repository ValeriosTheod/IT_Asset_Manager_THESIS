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
    
    $sql = "SELECT * FROM license where lice_available>=1";
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

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add new Asset</title>
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
     <form method="POST" action="addasset_action.php">
		<!-- Name -->
		<div class="field">
			<label class="label">
				Name:
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
				Category
			</label>
			<div class="control">
				<div class="select">
					<select name="category">
						<option selected="true" disabled="disabled">Select category</option>
						<?php
                            $arrlength=count($categoryNames);

                            for($i=0;$i<=$arrlength;$i++){
                                echo '<option value="'. $categoryIds[$i] . '">'.$categoryNames[$i].'</option>';  
                            }
                        ?>
					</select>
				</div>
			</div>
		</div>

        <!-- Status -->
		<div class="field">
			<label class="label">
				Status
			</label>
			<div class="control">
				<div class="select">
                    <select name="status">
						<option selected="true" disabled="disabled">Select status</option>
						<?php
                            $arrlength=count($statNames);

                            for($i=0;$i<=$arrlength;$i++){
                                echo '<option value="'. $statIds[$i] . '">'.$statNames[$i].'</option>';  
                            }
                        ?>
					</select>
				</div>
			</div>
		</div>

        <!-- Assigned to -->
		<div class="field">
			<label class="label">
				Assigned To
			</label>
			<div class="control">
				<div class="select">
                <select name="assigned">
						<option selected="true" disabled="disabled">Select Assigned User</option>
						<?php
                            $arrlength=count($userNames);

                            for($i=0;$i<=$arrlength;$i++){
                                echo '<option value="'. $userIds[$i] . '">'.$userNames[$i].'</option>';  
                            }
                        ?>
					</select>
				</div>
			</div>
		</div>

        <!-- DepartmentOwner -->
		<div class="field">
			<label class="label">
				Dep. Owner
			</label>
			<div class="control">
				<div class="select">
                    <select name="depaowner">
						<option selected="true" disabled="disabled">Select Department Owner</option>
						<?php
                            $arrlength=count($depaNames);

                            for($i=0;$i<=$arrlength;$i++){
                                echo '<option value="'. $depaIds[$i] . '">'.$depaNames[$i].'</option>';  
                            }
                        ?>
					</select>
				</div>
			</div>
		</div>

        <!-- UserOwner -->
		<div class="field">
			<label class="label">
				User Owner
			</label>
			<div class="control">
				<div class="select">
                    <select name="userowner">
						<option selected="true" disabled="disabled">Select User Owner</option>
						<?php
                            $arrlength=count($userNames);

                            for($i=0;$i<=$arrlength;$i++){
                                echo '<option value="'. $userIds[$i] . '">'.$userNames[$i].'</option>';  
                            }
                        ?>
					</select>
				</div>
			</div>
		</div>

        <!-- License Id -->
		<div class="field">
			<label class="label">
				License
			</label>
			<div class="control">
				<div class="select">
                    <select name="license">
						<option selected="true" disabled="disabled">Select License</option>
						<?php
                            $arrlength=count($licenseNames);

                            for($i=0;$i<=$arrlength;$i++){
                                echo '<option value="'. $licenseIds[$i] . '">'.$licenseNames[$i].'</option>';  
                            }
                        ?>
					</select>
				</div>
			</div>
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

  
</body>

</html>
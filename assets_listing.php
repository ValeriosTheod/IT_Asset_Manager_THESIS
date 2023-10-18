<?php
ini_set('display_errors','On');
ini_set('error_reporting',E_ALL);
  //define('__ROOT__', dirname(dirname(__FILE__)));
  session_start();
  $newURL = 'loginme.php';
  if (!isset($_SESSION["username"]))
  {
    header('Location: '.$newURL);
  }
  require_once './db/db_con.php';


  if (isset($_GET["newname"]) && isset($_GET["newlice_name"]) && isset($_GET["newuserown"]) && isset($_GET["newdepaown"]) && isset($_GET["newassigned"]) && isset($_GET["newcategory"]) && isset($_GET["newstatus"]))
  {
    // $sql = "SET FOREIGN_KEY_CHECKS=0";
    // if ($conn->query($sql) === TRUE) {
    //     echo "Foreign key checks disabled successfully.";
    // } else {
    //     echo "Error disabling foreign key checks: " . $conn->error;
    // }

    $newlice_n = $_GET["newlice_name"];
    //$newlice_n = !empty($newlice_n) ? "'$newlice_n'" : "NULL";
    
    $newuserown_n = $_GET["newuserown"];
    //$newuserown_n = !empty($newuserown_n) ? "'$newuserown_n'" : "NULL";

    $newdepaown_n = $_GET["newdepaown"];
    //$newdepaown_n = !empty($newdepaown_n) ? "'$newdepaown_n'" : "NULL";
   
    $newassigned = $_GET["newassigned"];
    //$newassigned = !empty($newassigned) ? "'$newassigned'" : "NULL";
    
    
    $sql = "UPDATE asset SET asse_model=?, cate_id=?, asse_status=?,asse_assigned_to=?, asse_depart_owner=?,asse_user_owner=?,lice_id=? WHERE asse_id=?";

    $stmt= $conn->prepare($sql);
    //echo $newlice_n;
    
    $stmt->bind_param("siiiiiii", $_GET["newname"], $_GET["newcategory"], $_GET["newstatus"],$newassigned,$newdepaown_n,$newuserown_n,$newlice_n,$_GET["indexid"]);
    if(!$stmt->execute()) echo $stmt->error;


    
   // $sql = "SET FOREIGN_KEY_CHECKS=1";
    //if ($conn->query($sql) === TRUE) {
    //    echo "Foreign key checks disabled successfully.";
    //} else {
    //    echo "Error disabling foreign key checks: " . $conn->error;
    //}

  }

  if (isset($_GET["index"]))
  {
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

    $edit_index = $_GET["index"];
  }else{
    $edit_index = -1;
  }


  //euresi selidas apo tin parametro get
  if(isset($_GET['page']) && !empty($_GET['page'])){
    $page = $_GET['page'];
  } else {
    $page = 1;
  }
  // if (isset($_GET['itemcounter']) && !empty($_GET['itemcounter'])){
  //   $itemcounter = $_GET['itemcounter']-1;
    
  // }
  $itemcounter = 10;

  //dimiourgia oriwn gia tin emfanisi apotelesmatwn xristwn apo limit1 ews limit2
  $limit1 = $itemcounter * ($page-1);
  $limit2 = $limit1 + $itemcounter;
?>
<!DOCTYPE html>
<html lang="en" style="background-color: #0c1e35;">
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-icons/3.0.2/iconfont/material-icons.min.css" />
  <link rel="stylesheet" href="css/table.css" />
  <link rel="stylesheet" href="css/navbar.css" />
  <link rel="stylesheet" href="css/sidebar.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@2.2.0/fonts/remixicon.css" />
  <link rel="stylesheet" href="https://unpkg.com/css-pro-layout@1.1.0/dist/css/css-pro-layout.css" />
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&amp;display=swap" />
  
        <script type="text/javascript" src="js/exportfile.js"></script>
  <script src="https://cdn.bootcss.com/jquery/3.7.0/jquery.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script type="text/javascript" src="https://unpkg.com/@popperjs/core@2"></script>

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Assets</title>
</head>
<body>


<div class="layout has-sidebar fixed-sidebar fixed-header">
    
       <?php require_once "sidebar.php"?>
       <?php require_once "start_sidebar.php"?>

<div class="datatable-container">
    <!-- ======= Header tools ======= -->
    <div class="header-tools">
  
      <div class="search">
        <input type="search" id="myInput" onkeyup="searchAsset()" class="search-input" placeholder="Search..." />
      </div>
      <button style="margin-left: auto;" onclick="exportme('asset')">Export</button>
    </div>
  
    <!-- ======= Table ======= -->
    <table class="datatable" id="myTable">
      <thead>
        <tr>
          <th>Asset Id</th>
          <th>Model</th>
          <th>Category</th>
          <th>Status</th>
          <th>Assigned To</th>
          <th>Department Owner</th>
          <th>User Owner</th>
          <th>Lic.Name</th>
          <th>Lic.Manufacturer</th>
          <th>Edit</th>
          <th>Delete</th>
        </tr>
      </thead>
  
      <tbody id="myBody">

      <?php
        $sql = "SELECT count(*) as total FROM asset";
        $result = mysqli_query($conn, $sql);
        $data=mysqli_fetch_assoc($result);
        //echo $data['total'];

        //$sql = "SELECT * FROM user LIMIT " . $limit1 . "," . $limit2;
        $sql = "SELECT 
        asset.asse_id, 
        asset.asse_model,	
        asset.asse_image,	
        asset.cate_id,	
        asset.asse_status,	
        asset.asse_assigned_to,	
        asset.asse_depart_owner,	
        asset.asse_user_owner,	
        asset.lice_id, 
        category.cate_name,
        status.stat_name,
        department.depa_name,
        department.depa_id,
        user.user_username,
        user.user_id,
        assigned_user.user_username as assign_user1,
        license.lice_name as licename,
        license.lice_manufacturer as liceman
        FROM asset
        LEFT JOIN category ON asset.cate_id = category.cate_id
        LEFT JOIN status ON asset.asse_status = status.stat_id
        LEFT JOIN department ON asset.asse_depart_owner = department.depa_id
        LEFT JOIN user ON asset.asse_user_owner = user.user_id
        LEFT JOIN license ON license.lice_id = asset.lice_id
        LEFT JOIN user AS assigned_user ON asset.asse_assigned_to = assigned_user.user_id";

        $result = mysqli_query($conn, $sql);

        // asse_id	asse_image	asse_model	
        // cate_id	asse_status	asse_assigned_to	
        // asse_depart_owner	asse_user_owner	lice_id 
        if (mysqli_num_rows($result) > 0) {
          // output data of each row
          $index = 0;
          while($row = mysqli_fetch_assoc($result)) {
            if ($edit_index == $index){
              echo '<td>' . $row['asse_id']. '</td>';
              echo '<td><input id="newasset_name" style="width: 100%;" class="input" type="text" value="' . $row['asse_model']. '"></td>';
              echo '<td><select id="new_gategory" name="category">
              <option selected="true" disabled="disabled"></option>';
                $arrlength=count($categoryNames);

                for($i=0;$i<=$arrlength;$i++){
                    echo '<option value="'. $categoryIds[$i] . '">'.$categoryNames[$i].'</option>';  
                }
              echo '</select></td>';
             
              echo '<td><select id="new_status" name="status">
              <option selected="true" disabled="disabled"></option>';
              $arrlength=count($statNames);

                  for($i=0;$i<=$arrlength;$i++){
                    echo '<option value="'. $statIds[$i] . '">'.$statNames[$i].'</option>';  
                  }
              echo '</select></td>';

              echo '<td><select id="new_assigned_to" name="assigned_to">
              <option selected="true" disabled="disabled"></option>';
                $arrlength=count($userNames);

                  for($i=0;$i<=$arrlength;$i++){
                    echo '<option value="'. $userIds[$i] . '">'.$userNames[$i].'</option>';  
                }
              echo '</select></td>';

              echo '<td><select id="new_depa_own" name="depa_own">
              <option selected="true" disabled="disabled"></option>';
              $arrlength=count($depaNames);

                  for($i=0;$i<=$arrlength;$i++){
                    echo '<option value="'. $depaIds[$i] . '">'.$depaNames[$i].'</option>';  
                  }
              echo '</select></td>';

              echo '<td><select id="new_user_own" name="user_own">
              <option selected="true" disabled="disabled"></option>';
                $arrlength=count($userNames);

                  for($i=0;$i<=$arrlength;$i++){
                    echo '<option value="'. $userIds[$i] . '">'.$userNames[$i].'</option>';  
                }
              echo '</select></td>';
              
             

              echo '<td><select id="newlice_name" name="lice_name">
              <option selected="true" disabled="disabled"></option>';
                $arrlength=count($licenseNames);

                for($i=0;$i<=$arrlength;$i++){
                  echo '<option value="'. $licenseIds[$i] . '">'.$licenseNames[$i].'</option>';  
                }
              echo '</select></td>';

              echo '<td></td>';
             

              echo '<td><img class="iconimg" onclick="applyRow('.$row['asse_id'].')" src="./icons/pngegg.png" alt="accept"></td>';

            } 

           

           




            if ($index <= $limit2 && $index >= $limit1){
              echo '<tr>
              <td>'.$row['asse_id'].'</td>
              <td>'.$row['asse_model'].'</td>
              <td>'.$row['cate_name'].'</td>
              <td>'.$row['stat_name'].'</td>
              <td>'.$row['assign_user1'].'</td>
              <td>'.$row['depa_name'].'</td>
              <td>'.$row['user_username'].'</td>
              <td>'.$row['licename'].'</td>
              <td>'.$row['liceman'].'</td>
              <td><img class="iconimg" onclick="editRow('.$index.')" src="./icons/pen.png" alt="edit"></td>
              <td><img class="iconimg" src="./icons/delete.png" onclick=\'deleteUser("'.$row['asse_id'].'")\' alt="edit"></td>
            
            </tr>'; 
            }else{
              echo '<tr style=display:none;">
                <td>'.$row['asse_id'].'</td>
                <td>'.$row['asse_model'].'</td>
                <td>'.$row['cate_name'].'</td>
                <td>'.$row['stat_name'].'</td>
                <td>'.$row['assign_user1'].'</td>
                <td>'.$row['depa_name'].'</td>
                <td>'.$row['user_username'].'</td>
                <td>'.$row['licename'].'</td>
                <td>'.$row['liceman'].'</td>
                <td><img class="iconimg" onclick="editRow('.$index.')" src="./icons/pen.png" alt="edit"></td>
                <td><img class="iconimg" src="./icons/delete.png" onclick="deleteUser(\"'.$row['asse_id'].'\")" alt="edit"></td>
              
              </tr>'; 

            }
          
          $index = $index+1;
          }
        } 

        mysqli_close($conn);

      ?>
      </tbody>
    </table>
  
    <!-- ======= Footer tools ======= -->
    <div class="footer-tools">
      <!-- <div class="list-items">
        Show
        <select name="itemcounter" id="n-entries" class="n-entries">
          <option value="5">5</option>
          <option value="10" selected>10</option>
          <option value="15">15</option>
        </select>
        entries
      </div> -->
  
      <div class="pages">
        <ul>
          <?php
            $pages = intdiv($data['total'], 10) + 1;
            for ($x = 1; $x <= $pages; $x++) {
              if ($x == $page){
                echo "<li><button onclick=\"window.location.href='assets_listing.php?page=".$x."'\"><span class=\"active\">".$x."</span></button></li>";
           
              }else{
              echo "<li><button onclick=\"window.location.href='assets_listing.php?page=".$x."'\">".$x."</button></li>";
              echo "\n";
              }
            }
          ?>
        </ul>
      </div>
    </div>
  </div>
  
  <script>
    // function changeItemCount(){
    //   var selectElement = document.getElementById("n-entries");
    //   window.location.href = window.location.href = "./assets_listing.php?page="+<?php echo $page ?> + '&itemcounter='+ selectElement.value ;

    // }

    function editRow(index){
        location.href = "./assets_listing.php?index=" + index;
    }

    function applyRow(index){
        var newname = document.getElementById('newasset_name').value;
        var e = document.getElementById("new_gategory");
        var newcat = e.options[e.selectedIndex].value;
       console.log(newcat);

        var e = document.getElementById("new_status");
        var newstatus = e.options[e.selectedIndex].value;
        console.log(newstatus);

        var e = document.getElementById("new_assigned_to");
        var newassigned = e.options[e.selectedIndex].value;
        console.log(newassigned);

        var e = document.getElementById("new_depa_own");
        var newdepaown = e.options[e.selectedIndex].value;
        console.log(newdepaown);

        var e = document.getElementById("new_user_own");
        var newuserown = e.options[e.selectedIndex].value;
        console.log(newuserown);

        var e = document.getElementById("newlice_name");
        var newlice_name = e.options[e.selectedIndex].value;
        console.log(newlice_name);



          location.href = "./assets_listing.php?newname=" + newname 
          + "&newcategory=" + newcat
          + "&newstatus=" + newstatus
          + "&newassigned=" + newassigned 
          + "&newdepaown=" + newdepaown 
          + "&newuserown=" + newuserown 
          + "&newlice_name=" + newlice_name 
          + "&indexid=" + index;
      
          
    }

    function deleteUser(id){
      console.log(id);
      swal.fire({
        title: '',
        text: "Are you sure you want to remove this asset?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: "deleteasset.php ",
            type: "POST",    
            data: {
                delete: id,
            },
            success: function(response) {
              console.log(response);
              alert("Asset removed");
              location.reload();
            },
            error: function (xhr, ajaxOptions, thrownError) {
              alert("Error deleting asset");
            }
          }); 
        }
    })
    }
    

    function searchAsset() {
      // Declare variables
      var input, filter, ul, li, a, i, txtValue;
      input = document.getElementById('myInput');
      filter = input.value.toUpperCase();
      table = document.getElementById("myBody");
      tr = table.getElementsByTagName("tr");

      // Loop through all table rows, and hide those who don't match the search query
      for (i = 0; i < tr.length; i++) {
        td = tr[i].innerHTML;
        
        if (td) {
          if (td.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }
        if (!filter || filter === ""){
          window.location.href = "./assets_listing.php?page="+<?php echo $page ?>;
          return;
        }
      }
    }
  </script>


<?php require_once "end_sidebar.php"?>   


<script type="text/javascript" src="js/sidebar.js"></script>

  
</body>

</html>
<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
  session_start();
  $newURL = 'loginme.php';
  if (!isset($_SESSION["username"]))
  {
    header('Location: '.$newURL);
  }
  require_once './db/db_con.php';
//newuser
          //newfirst
          //newlast
          //newrole
          //newemail
          //newdepar
          //newnotes
  if (isset($_GET["newuser"]))
  {
    $newrole = $_GET["newrole"];
    $newroleid = !empty($newrole) ? "'$newrole'" : "NULL";
    if ($newroleid == "NULL"){
      $sql = "UPDATE user SET user_username=?, firstname=?, lastname=?, user_email=?, depa_id=?, user_notes=? WHERE user_id=?";
      $stmt= $conn->prepare($sql);
      $stmt->bind_param("ssssisi", $_GET["newuser"], $_GET["newfirst"], $_GET["newlast"], $_GET["newemail"], $_GET["newdepar"], $_GET["newnotes"],$_GET["indexid"]);
      
    }
    else{
      $sql = "UPDATE user SET user_username=?, firstname=?, lastname=?,role_id=?, user_email=?, depa_id=?, user_notes=? WHERE user_id=?";
      $stmt= $conn->prepare($sql);
      $stmt->bind_param("sssisisi", $_GET["newuser"], $_GET["newfirst"], $_GET["newlast"], $_GET["newrole"], $_GET["newemail"], $_GET["newdepar"], $_GET["newnotes"],$_GET["indexid"]);
      
    }
    $stmt->execute();
  }

  if (isset($_GET["index"]))
  {
    $sql = "SELECT * FROM role";
    $result = mysqli_query($conn, $sql);
    $roleNames = array(); // Array to store category names
    $roleIds = array();   // Array to store category IDs


    if (mysqli_num_rows($result) > 0) {
        $index = 0;
        while($row = mysqli_fetch_assoc($result)) {
            array_push($roleNames, $row['role_title']);
            array_push($roleIds, $row['role_id']);
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

  //dimiourgia oriwn gia tin emfanisi apotelesmatwn xristwn apo limit1 ews limit2
  $limit1 = 10* ($page-1);
  $limit2 = $limit1 + 10;
?>
<!DOCTYPE html>
<html lang="en" style="background-color: #0c1e35;">
<head>
<meta charset="UTF-8">
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
  <title>Users</title>
</head>
<body>

<div class="layout has-sidebar fixed-sidebar fixed-header">
       
       <?php require_once "sidebar.php"?>

       <?php require_once "start_sidebar.php"?>
  
<div class="datatable-container">
    <!-- ======= Header tools ======= -->
    <div class="header-tools">
  
      <div class="search">
        <input type="search" id="myInput" onkeyup="searchUser()" class="search-input" placeholder="Search..." />
      </div>

      <button style="margin-left: auto;" onclick="exportme('user')">Export</button>
    </div>
  
    <!-- ======= Table ======= -->
    <table class="datatable" id="myTable">
      <thead>
        <tr>
          <!-- <th>Status</th> -->
          <th>Username</th>
          <th>First name</th>
          <th>Last name</th>
          <th>Role</th>
          <th>Email</th>
          <th>Department</th>
          <th>Notes</th>
          <th>Edit</th>
          <th>Delete</th>
        </tr>
      </thead>
  
      <tbody id="myBody">

      <?php
        $sql = "SELECT count(*) as total FROM user";
        $result = mysqli_query($conn, $sql);
        $data=mysqli_fetch_assoc($result);
        //echo $data['total'];

        //$sql = "SELECT * FROM user LIMIT " . $limit1 . "," . $limit2;
        $sql = "SELECT user_id,user_username,firstname,lastname,role_title,user_email,depa_name,user_notes, user.depa_id, user.role_id 
        FROM user 
        LEFT JOIN role ON user.role_id = role.role_id
        LEFT JOIN department ON user.depa_id = department.depa_id";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
          // output data of each row
          $index = 0;
         
          while($row = mysqli_fetch_assoc($result)) {
            if ($edit_index == $index){
              echo '<td><input id="newuser" style="width: 100%;" class="input" type="text" value="' . $row['user_username']. '"></td>';
              echo '<td><input id="newfirst" style="width: 100%;" class="input" type="text" value="' . $row['firstname']. '"></td>';
              echo '<td><input id="newlast" style="width: 100%;" class="input" type="text" value="' . $row['lastname']. '"></td>';
              echo '<td>';
              echo '<select id="newrole" name="roles">
              <option selected="true" value="'.$row['role_id'].'" disabled="disabled">'.$row['role_title'].'</option>';
                $arrlength=count($roleNames);

                for($i=0;$i<=$arrlength;$i++){
                    echo '<option value="'. $roleIds[$i] . '">'.$roleNames[$i].'</option>';  
                }
              echo '</select></td>';
              echo '<td><input id="newemail" style="width: 100%;" class="input" type="text" value="' . $row['user_email']. '"></td>';
              echo '<td>';
              echo '<select id="newdepar" name="roles">
              <option selected="true" value="'.$row['depa_id'].'" disabled="disabled">'.$row['depa_name'].'</option>';
                $arrlength=count($depaNames);

                for($i=0;$i<=$arrlength;$i++){
                    echo '<option value="'. $depaIds[$i] . '">'.$depaNames[$i].'</option>';  
                }
              echo '</select></td>';
              echo '<td><input id="newnotes" style="width: 100%;" class="input" type="text" value="' . $row['user_notes']. '"></td>';
             
              echo '<td><img class="iconimg" onclick="applyRow('.$row['user_id'].')" src="./icons/pngegg.png" alt="accept"></td>';

            }
            elseif ($index <= $limit2 && $index >= $limit1){
              echo '<tr>
              <td>'.$row['user_username'].'</td>
              <td>'.$row['firstname'].'</td>
              <td>'.$row['lastname'].'</td>
              <td>'.$row['role_title'].'</td>
              <td>'.$row['user_email'].'</td>
              <td>'.$row['depa_name'].'</td>
              <td>'.$row['user_notes'].'</td>
              <td><img class="iconimg" onclick="editRow('.$index.')" src="./icons/pen.png" alt="edit"></td>
              <td><img class="iconimg" src="./icons/delete.png" onclick=\'deleteUser("'.$row['user_username'].'")\' alt="edit"></td>
            
            </tr>'; 
            }else{
              echo '<tr style=display:none;">
                <td>'.$row['user_username'].'</td>
                <td>'.$row['firstname'].'</td>
                <td>'.$row['lastname'].'</td>
                <td>'.$row['role_id'].'</td>
                <td>'.$row['user_email'].'</td>
                <td>'.$row['depa_name'].'</td>
                <td>'.$row['user_notes'].'</td>
                <td><img class="iconimg" onclick="editRow('.$index.')" src="./icons/pen.png" alt="edit"></td>
                <td><img class="iconimg" src="./icons/delete.png" onclick="deleteUser(\"'.$row['user_username'].'\")" alt="edit"></td>
              
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
        <select name="n-entries" id="n-entries" class="n-entries">
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
                echo "<li><button onclick=\"window.location.href='users_listing.php?page=".$x."'\"><span class=\"active\">".$x."</span></button></li>";
           
              }else{
              echo "<li><button onclick=\"window.location.href='users_listing.php?page=".$x."'\">".$x."</button></li>";
              echo "\n";
              }
            }
          ?>
        </ul>
      </div>
    </div>
  </div>
  
  <script>
      function editRow(index){
        location.href = "./users_listing.php?index=" + index;
      }
      function applyRow(index){
         
        var newuser = document.getElementById('newuser').value;
        var newfirst = document.getElementById('newfirst').value;
        var newlast = document.getElementById('newlast').value;
        var newemail = document.getElementById('newemail').value;
        var newnotes = document.getElementById('newnotes').value;
 
        var e = document.getElementById("newrole");
        var newrole = e.value;
        e = document.getElementById("newdepar");
        var newdepar = e.value;
        location.href = "./users_listing.php?newuser=" + newuser 
        + "&newfirst=" + newfirst 
        + "&newlast=" + newlast 
        + "&newemail=" + newemail 
        + "&newnotes=" + newnotes 
        + "&newrole=" + newrole 
        + "&newdepar=" + newdepar 
        + "&indexid=" + index;
      }

    function deleteUser(username){
      console.log(username);
      swal.fire({
        title: '',
        text: "Are you sure you want to remove this user?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: "deleteuser.php ",
            type: "POST",    
            data: {
                delete: username,
            },
            success: function(response) {
              console.log(response);
              alert("User removed");
              location.reload();
            },
            error: function (xhr, ajaxOptions, thrownError) {
              alert("Error deleting user");
            }
          }); 
        }
    })
    }
    

    function searchUser() {
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
          window.location.href = "./users_listing.php?page="+<?php echo $page ?>;
          return;
        }
      }
    }
  </script>


<?php require_once "end_sidebar.php"?>   


    <script type="text/javascript" src="js/sidebar.js"></script>

</body>

</html>
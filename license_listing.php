<?php

  session_start();
  $newURL = 'loginme.php';
  if (!isset($_SESSION["username"]))
  {
    header('Location: '.$newURL);
  }
  require_once './db/db_con.php';

  if (isset($_GET["expiration"]))
  {
    $sql = "UPDATE license SET lice_expiration=?, lice_total=?, lice_available=? WHERE lice_id=?";
    $stmt= $conn->prepare($sql) or die($conn->error);;
    $stmt->bind_param("siii", $_GET["expiration"], $_GET["newlice_total"],$_GET["newlice_availab"], $_GET["indexid"]);
     $stmt->execute();
  }

  if (isset($_GET["index"]))
  {
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
  <title>Licenses</title>

  <style>
  
  body { margin: 0;}
* { box-sizing: border-box; }

Table { border-collapse: collapse; margin: 0;   }
td    { padding: 2px 10px; }
table tr td:nth-child(1) { width: 10vw }
table tr td:nth-child(2) { width: 40vw }
table tr td:nth-child(3) { width: 10vw }
table tr td:nth-child(4) { width: 10vw } 



    </style>

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
      <button style="margin-left: auto;" onclick="exportme('license')">Export</button>
    </div>
  
    <!-- ======= Table ======= -->
    <div class="table-wrapper">
    <table class="datatable" id="myTable">
      <thead>
        <tr>
          <td>Id</td>
          <td>Name</td>
          <td>Expiration Date</td>
          <td>Enabled Date</td>
          <td>Manufacturer</td>
          <td>Total</td>
          <td>Available</td>
          <td>Edit</td>
          <td>Delete</td>
        </tr>
      </thead>
  
      <tbody id="myBody">

      <?php
        $sql = "SELECT count(*) as total FROM license";
        $result = mysqli_query($conn, $sql);
        $data=mysqli_fetch_assoc($result);
        //echo $data['total'];

        $sql = "SELECT * FROM license";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
          // output data of each row
          $index = 0;
          while($row = mysqli_fetch_assoc($result)) {
            if ($edit_index == $index){
              echo '<td>' . $row['lice_id'] . '</td>';
              echo '<td>' . $row['lice_name'] . '</td>';
              echo '<td><input id="expiration" value="'.$row['lice_expiration'].'" name="expiration" type="date"></td>';
              echo  '<td>'.$row['lice_enabled'].'</td>';
              echo  '<td>'.$row['lice_manufacturer'].'</td>';
              echo '<td><input id="newlice_total" style="width: 100%;" class="input" type="text" value="' . $row['lice_total']. '"></td>';
              echo '<td><input id="newlice_availab" style="width: 100%;" class="input" type="text" value="' . $row['lice_available']. '"></td>';
             
              echo '<td><img class="iconimg" onclick="applyRow('.$row['lice_id'].')" src="./icons/pngegg.png" alt="accept"></td>';

            }
            else if ($index <= $limit2 && $index >= $limit1){
              echo '<tr>
              <td>'.$row['lice_id'].'</td>
              <td>'.$row['lice_name'].'</td>
              <td>'.$row['lice_expiration'].'</td>
              <td>'.$row['lice_enabled'].'</td>
              <td>'.$row['lice_manufacturer'].'</td>
              <td>'.$row['lice_total'].'</td>
              <td>'.$row['lice_available'].'</td>
              <td><img class="iconimg" onclick="editRow('.$index.')" src="./icons/pen.png" alt="edit"></td>
              <td><img class="iconimg" src="./icons/delete.png" onclick=\'deleteUser("'.$row['lice_id'].'")\' alt="edit"></td>
            
            </tr>'; 
            }else{
              echo '<tr style=display:none;">
              <td>'.$row['lice_id'].'</td>
              <td>'.$row['lice_name'].'</td>
              <td>'.$row['lice_expiration'].'</td>
              <td>'.$row['lice_enabled'].'</td>
              <td>'.$row['lice_manufacturer'].'</td>
              <td>'.$row['lice_total'].'</td>
              <td>'.$row['lice_available'].'</td>
              <td><img class="iconimg" onclick="editRow('.$index.')" src="./icons/pen.png" alt="edit"></td>
              <td><img class="iconimg"  src="./icons/delete.png" onclick=\'deleteUser("'.$row['lice_id'].'")\' alt="edit"></td>
              </tr>'; 
            }
          
          $index = $index+1;
          }
        } 

        mysqli_close($conn);

      ?>
      </tbody>
    </table>
        <!--  -->
</div>
  
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
                echo "<li><button onclick=\"window.location.href='license_listing.php?page=".$x."'\"><span class=\"active\">".$x."</span></button></li>";
           
              }else{
              echo "<li><button onclick=\"window.location.href='license_listing.php?page=".$x."'\">".$x."</button></li>";
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
        location.href = "./license_listing.php?index=" + index;
    }
    function applyRow(index){
      var expiration = document.getElementById('expiration').value;
      var newlice_total = document.getElementById('newlice_total').value;
      var newlice_availab = document.getElementById('newlice_availab').value;
      location.href = "./license_listing.php?expiration=" + expiration + "&newlice_total=" + newlice_total+ "&newlice_availab=" + newlice_availab + "&indexid=" + index;
        
    }

    function deleteUser(id){
      console.log(id);
      swal.fire({
        title: '',
        text: "Are you sure you want to remove this license?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: "deletelicense.php ",
            type: "POST",    
            data: {
                delete: id,
            },
            success: function(response) {
              console.log(response);
              alert("License removed");
              location.reload();
            },
            error: function (xhr, ajaxOptions, thrownError) {
              alert("Error deleting license");
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
          window.location.href = "./license_listing.php?page="+<?php echo $page ?>;
          return;
        }
      }
    }
  </script>


<?php require_once "end_sidebar.php"?>   


<script type="text/javascript" src="js/sidebar.js"></script>

  
</body>

</html>
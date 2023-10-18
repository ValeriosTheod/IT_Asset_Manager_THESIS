<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
  session_start();
  $newURL = 'loginme.php';

  require_once './db/db_con.php';

  if (isset($_GET["newname"]) && isset($_GET["newcategory"]))
  {
    $sql = "UPDATE component SET comp_name=?, cate_id=? WHERE comp_id=?";
    $stmt= $conn->prepare($sql);
    $stmt->bind_param("sii", $_GET["newname"], $_GET["newcategory"], $_GET["indexid"]);
    $stmt->execute();
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

    $edit_index = $_GET["index"];
  }else{
    $edit_index = -1;
  }

  if (!isset($_SESSION["username"]))
  {
    header('Location: '.$newURL);
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
  <script src="https://cdn.bootcss.com/jquery/3.7.0/jquery.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
  <script type="text/javascript" src="js/exportfile.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@2.2.0/fonts/remixicon.css" />
    <link rel="stylesheet" href="https://unpkg.com/css-pro-layout@1.1.0/dist/css/css-pro-layout.css" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&amp;display=swap" />
    <script type="text/javascript" src="https://unpkg.com/@popperjs/core@2"></script>

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Components</title>
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
      <button style="margin-left: auto;" onclick="exportme('component')">Export</button>
    </div>
  
    <!-- ======= Table ======= -->
    <table class="datatable" id="myTable">
      <thead>
        <tr>
          <th>Id</th>
          <th>Name</th>
          <th>Category</th>
        </tr>
      </thead>
  
      <tbody id="myBody">

      <?php
      //comp_id	comp_name	comp_serial	cate_id	comp_location
        $sql = "SELECT count(*) as total FROM component";
        $result = mysqli_query($conn, $sql);
        $data=mysqli_fetch_assoc($result);
        //echo $data['total'];

        //$sql = "SELECT * FROM user LIMIT " . $limit1 . "," . $limit2;
        $sql = "SELECT comp_id, comp_name, cate_name, category.cate_id  FROM component, category WHERE component.cate_id = category.cate_id";
        $result = mysqli_query($conn, $sql);

        // asse_id	asse_image	asse_model	
        // cate_id	asse_status	asse_assigned_to	
        // asse_depart_owner	asse_user_owner	lice_id 
        if (mysqli_num_rows($result) > 0) {
          // output data of each row
          $index = 0;
          while($row = mysqli_fetch_assoc($result)) {
            if ($edit_index == $index){
              echo '<td>' . $row['comp_id']. '</td>';
              echo '<td><input id="newcomp_name" style="width: 100%;" class="input" type="text" value="' . $row['comp_name']. '"></td>';
              echo '<td>';
              echo '<select id="new_gategory" name="category">
              <option selected="true" value="'.$row['cate_id'].'" disabled="disabled">'.$row['cate_name'].'</option>';
                $arrlength=count($categoryNames);

                for($i=0;$i<=$arrlength;$i++){
                    echo '<option value="'. $categoryIds[$i] . '">'.$categoryNames[$i].'</option>';  
                }
              echo '</select></td>';
              echo '<td><img class="iconimg" onclick="applyRow('.$row['comp_id'].')" src="./icons/pngegg.png" alt="accept"></td>';

            }
            elseif ($index <= $limit2 && $index >= $limit1){
              echo '<tr>
              <td>'.$row['comp_id'].'</td>
              <td>'.$row['comp_name'].'</td>
              <td>'.$row['cate_name'].'</td>
              <td><img class="iconimg" onclick="editRow('.$index.')" id="editbutton" src="./icons/pen.png" alt="edit"></td>
              <td><img class="iconimg" src="./icons/delete.png" onclick=\'deleteUser("'.$row['cate_id'].'")\' alt="edit"></td>
            
            </tr>'; 
            }else{
              echo '<tr style=display:none;">
              
              <td>'.$row['comp_id'].'</td>
              <td>'.$row['comp_name'].'</td>
              <td>'.$row['cate_name'].'</td>
              <td><img class="iconimg" id="editbutton" onclick="editRow('.$index.')" src="./icons/pen.png" alt="edit"></td>
              <td><img class="iconimg" src="./icons/delete.png" onclick=\'deleteUser("'.$row['cate_id'].'")\' alt="edit"></td>
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
                echo "<li><button onclick=\"window.location.href='component_listing.php?page=".$x."'\"><span class=\"active\">".$x."</span></button></li>";
           
              }else{
              echo "<li><button onclick=\"window.location.href='component_listing.php?page=".$x."'\">".$x."</button></li>";
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
        location.href = "./component_listing.php?index=" + index;
      }
      function applyRow(index){
        var newname = document.getElementById('newcomp_name').value;
        var e = document.getElementById("new_gategory");
         var newcat = e.value;
          location.href = "./component_listing.php?newname=" + newname + "&newcategory=" + newcat + "&indexid=" + index;
      
          
      }

    function deleteUser(id){
      console.log(id);
      swal.fire({
        title: '',
        text: "Are you sure you want to remove this category?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: "deletecategory.php ",
            type: "POST",    
            data: {
                delete: id,
            },
            success: function(response) {
              console.log(response);
              alert("Category removed");
              location.reload();
            },
            error: function (xhr, ajaxOptions, thrownError) {
              alert("Error deleting category");
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
          window.location.href = "./component_listing.php?page="+<?php echo $page ?>;
          return;
        }
      }
    }
  </script>


<?php require_once "end_sidebar.php"?>   


<script type="text/javascript" src="js/sidebar.js"></script>

  
</body>

</html>
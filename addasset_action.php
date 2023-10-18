<?php  
ini_set('display_errors','On');
ini_set('error_reporting',E_ALL);
require_once './db/db_con.php';
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
if($_POST && isset($_POST['name'])) {

$name = $_POST['name'];
$category = $_POST['category'];
$assigned = $_POST['assigned'];
$status = $_POST['status'];
$depaowner = $_POST['depaowner'];
$userowner = $_POST['userowner'];
$license = $_POST['license'];

$sql = "SELECT max(asse_id) as maxid FROM asset";
$result = mysqli_query($conn, $sql);
$data=mysqli_fetch_assoc($result);
$id = intval($data['maxid']) + 1;

$stmt = mysqli_prepare($conn, "INSERT INTO asset (asse_id, asse_model, cate_id, asse_status, asse_assigned_to, asse_depart_owner, asse_user_owner, lice_id) VALUES ( ?, ?, ?, ?, ?,?,?,?)");

mysqli_stmt_bind_param($stmt, "isiiiiii", $id, $name, $category, $status, $assigned, $depaowner, $userowner, $license );

// if execute the prepared statement
if(!mysqli_stmt_execute($stmt)){
    header("Location: addasset.php?succ=0");
   
}

$stmt2 = mysqli_prepare($conn, "UPDATE license SET lice_available = lice_available - 1 WHERE lice_id=?");
mysqli_stmt_bind_param($stmt2, "i", $license);
if(mysqli_stmt_execute($stmt2)){
    header("Location: addasset.php?succ=1");
  
}
//header("Location: addasset.php?succ=1");

}
?>
<?php  
require_once './db/db_con.php';
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
if($_POST && isset($_POST['name'])) {

$name = $_POST['name'];
$category = $_POST['category'];

$sql = "SELECT max(comp_id) as maxid FROM component";
$result = mysqli_query($conn, $sql);
$data=mysqli_fetch_assoc($result);
$id = intval($data['maxid']) + 1;

$stmt = mysqli_prepare($conn, "INSERT INTO component (comp_id, comp_name, cate_id) VALUES ( ?, ?, ?)");

mysqli_stmt_bind_param($stmt, "isi", $id, $name, $category);

// if execute the prepared statement
if(mysqli_stmt_execute($stmt)){
    header("Location: addcomponent.php?succ=1");
    die();
}
}
?>
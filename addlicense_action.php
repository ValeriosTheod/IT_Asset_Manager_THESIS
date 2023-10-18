<?php  
require_once './db/db_con.php';
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
if($_POST && isset($_POST['name'])) {

$lice_name = $_POST['name'];
$lice_expiration = $_POST['expir'];
$lice_enabled = $_POST['enabled'];
$lice_manufacturer = $_POST['manufacturer'];
$lice_total = $_POST['total'];
$lice_available = $_POST['available'];
echo $lice_manufacturer.' ';
echo $lice_total.' ';
echo $lice_available;

$sql = "SELECT max(lice_id) as maxid FROM license";
$result = mysqli_query($conn, $sql);
$data=mysqli_fetch_assoc($result);
$id = intval($data['maxid']) + 1;

$stmt = mysqli_prepare($conn, "INSERT INTO license (lice_id, lice_name, lice_expiration, lice_enabled, lice_manufacturer, lice_total, lice_available) VALUES ( ?, ?, ?, ?, ?, ?,?)");

mysqli_stmt_bind_param($stmt, "issssii", $id, $lice_name, $lice_expiration, $lice_enabled, $lice_manufacturer, $lice_total, $lice_available );
//mysqli_stmt_execute($stmt) or trigger_error($stmt->error, E_USER_ERROR);
// if execute the prepared statement
if(mysqli_stmt_execute($stmt)){
    header("Location: addlicense.php?succ=1");
    die();
}
$error = mysqli_stmt_error($stmt);
print("Error : ".$error);
}
?>
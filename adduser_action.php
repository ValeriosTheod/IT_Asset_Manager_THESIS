<?php  
require_once './db/db_con.php';
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
if($_POST && isset($_POST['username'])) {

$username = $_POST['username'];
$first = $_POST['first'];
$last = $_POST['last'];
$role = $_POST['role'];
$email = $_POST['email'];
$department = $_POST['department'];
$notes = $_POST['notes'];


$id = rand(10,1000);

$sql = "SELECT max(user_id) as maxid FROM user";
$result = mysqli_query($conn, $sql);
$data=mysqli_fetch_assoc($result);
$id = intval($data['maxid']) + 1;

$stmt = mysqli_prepare($conn, "INSERT INTO user (user_id, user_username, firstname, lastname, role_id, user_email, depa_id,user_enabled, user_notes) VALUES ( ?,?,?,?,?,?,?,?,?)");
$enabled = 1;
//mysqli_stmt_bind_param($stmt, "isssisiis", $id, $username, $first, $last, $role, $email, $department, $enabled, $notes );
mysqli_stmt_bind_param($stmt, "isssisiis", $id, $username, $first, $last, $role, $email, $department, $enabled, $notes );


//mysqli_stmt_execute($stmt) or trigger_error($stmt->error, E_USER_ERROR);

// if execute the prepared statement
if(mysqli_stmt_execute($stmt)){
    header("Location: adduser.php?succ=1");
    die();
}
$error = mysqli_stmt_error($stmt);
print("Error : ".$error);
}
?>
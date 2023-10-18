<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
header('Content-type: application/json; charset=UTF-8');
$response = array();
 
if ($_POST['delete']) {
    //echo json_encode("hello");
    
    require_once './db/db_con.php';
 
    $asseid = $_POST['delete'];
    
    $sql = $conn->prepare("DELETE FROM asset WHERE asse_id=?");
    $sql->bind_param("i", $asseid);

    $stmt = $sql->execute();

    if ($stmt) {
        $response['status']  = 'success';
        $response['message'] = 'Product Deleted Successfully ...';
    } else {
        $response['status']  = 'error';
        $response['message'] = 'Unable to delete product ...';
    }
    echo json_encode($stmt);
}
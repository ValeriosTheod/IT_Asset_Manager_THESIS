<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
header('Content-type: application/json; charset=UTF-8');
$response = array();
 
if ($_POST['convert']) {
    ob_start();
    require_once './db/db_con.php';
    ob_end_clean();
    $table_name = $_POST['convert'];

    if($table_name == "asset"){
        $sql = "SELECT asse_id, asse_model, cate_id, asse_status, asse_assigned_to, asse_depart_owner, asse_user_owner,lice_id FROM ". $table_name;
    }
    else
        $sql = "SELECT * FROM ". $table_name;
    $result = mysqli_query($conn, $sql);

    $fp = fopen($table_name . '.csv', 'w');

    header('Content-Type: application/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename='.$table_name .'.csv');
    while($row = mysqli_fetch_assoc($result))
    {
        fputcsv($fp, $row);
    }

    fclose($fp);

    echo $table_name .'.csv';
    //writetofile($table_name . '.csv');

    // $file_name = $table_name . '.csv';
    // header('Content-Type: application/csv');
    // header('Content-Disposition: attachment; filename="' . $table_name . '.csv' . '"');
    // readfile($file_name);
   
    // echo $file_name;
}

function writetofile($myFile)
{
    if ( ! file_exists($myFile))
    {
        echo 'file missing';
    }
    else
    {
        $actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]" . dirname($_SERVER['REQUEST_URI']) . "/";
        $url = 
            $actual_link . $myFile;
        
        echo $url . '\n';
        // Use basename() function to return the base name of file
        $file_name = basename($myFile);
        if (file_put_contents($file_name, file_get_contents($url)))
        {
            echo "File downloaded successfully";
        }
        else
        {
            echo "File downloading failed.";
        }
    }
}

?>

       
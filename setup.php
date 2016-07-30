<?php
require_once('config.php');
$link = mysqli_connect(HOST, USER, PASS, DB);

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

$query = file_get_contents("mysql-dump.sql");

/* execute multi query */
if (mysqli_multi_query($link, $query))
     echo "Success";
else 
     echo "Fail";
?>
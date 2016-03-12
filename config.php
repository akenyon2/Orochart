<?php
$DBUSER = 'root';
$DBPASS = '';
$DBNAME = 'akenyon2';
$conn = new mysqli('localhost', $DBUSER, $DBPASS, $DBNAME);
    if ($conn->connect_error){
        die("Unable to connect: " . $conn->connect_error);
    }
?>
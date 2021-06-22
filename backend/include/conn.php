<?php
    // Create connection
    $server = "remotemysql.com";
    $uname = "1CK1nZDjXi";
    $password = "5r6okbJjIq";
    $conn = mysqli_connect($server, $uname, $password,"1CK1nZDjXi");
    // Check connection
    if ($conn->connect_error)  {
        die("Connection failed: " . $conn->connect_error);
    } 
?>
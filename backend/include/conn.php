<?php
    // Create connection
    $server = "remotemysql.com";
    $uname = "wLAXeDdEcy";
    $password = "zlxmJOQSFG";
    $conn = mysqli_connect($server, $uname, $password,"wLAXeDdEcy");
    // Check connection
    if ($conn->connect_error)  {
        die("Connection failed: " . $conn->connect_error);
    } 
?>
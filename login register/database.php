<?php
    $hostName="localhost";
    $dbUser="root";
    $dbPassword="dinithmora2003";
    $dbName="login register";
    $conn=mysqli_connect($hostName,$dbUser,$dbPassword,$dbName);
    if (!$conn) {
        die("Something went wrong");
    }
?>
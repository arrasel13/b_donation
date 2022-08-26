<?php

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "blood_dm";

$conn = mysqli_connect($host, $user, $pass, $dbname);

if ($conn->connect_error){
    die("Database not connected: ".$conn->error());
}else{

}

?>
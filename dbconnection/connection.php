<?php
$server = "localhost";
$user = "root";
$pass = "";
$BD = "hecgal15_db";

$connection = mysqli_connect($server, $user, $pass);
mysqli_select_db($connection, $BD);

?>
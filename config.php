<?php 
define('DB_server', 'localhost');
define('DB_username', 'root');
define('DB_password', '');
define('DB_name', 'akademik');

$con = mysqli_connect(DB_server, DB_username, DB_password, DB_name);

if($con === false){
    die("Error: could not connect," . mysqli_connect_error());
}
?>
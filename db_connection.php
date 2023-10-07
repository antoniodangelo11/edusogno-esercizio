<?php

$server_name = "localhost";
$user_name = "root";
$password = "root";
$db_name = "db_edu";

$connection = mysqli_connect($server_name, $user_name, $password, $db_name);

if (!$connection) {
    echo "Connection failed!";
}

return $connection;
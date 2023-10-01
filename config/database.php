<?php


$host = 'localhost';
$dbname = 'makufoods';
$name = 'root';
$password = 'Greyhat4900';


$mysqli = new mysqli(hostname: $host,
                     name: $name,
                     password: $password,
                     database: $dbname);
 
if (mysqli_errno($connection)) {
   die(mysqli_error($connection));
}                     
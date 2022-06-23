<?php
$server = "localhost";
$user = "root";
$pass = "PiedNez";
$base = "delacroix";

$pdo = new PDO("mysql:host=$server;dbname=$base", $user, $pass);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



class Delacroix {


}

?>

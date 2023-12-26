<?php
// Script zum Verbinden der Datenbank
$host = "localhost";
$name = "hotel";
$user = "root";
$pw = "";
try{
    $mysql = new PDO("mysql:host=$host;dbname=$name", $user, $pw);
} catch (PDOException $e){
    echo "SQL Error: ".$e->getMessage();
}
?>
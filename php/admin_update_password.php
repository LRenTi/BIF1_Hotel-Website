<?php
// Script um passwort zu ändern
session_start();
require("dbaccess.php");

// Daten aus dem Formular holen
$username = $_POST["username"];
$newpw = $_POST["newpw"];
$newpw2 = $_POST["newpw2"];
$id = $_POST["user_id"];

// Wenn die Passwörter nicht übereinstimmen
if($newpw != $newpw2){
    header("Location: ../index.php?include=admin&site=userlist&profile=$id&msg=pwwrong");
    exit(); // Script beenden
}

// Password hashen und updaten
$hash = password_hash($_POST["newpw"], PASSWORD_BCRYPT);        
$stmt = $mysql->prepare("UPDATE ACCOUNTS SET PASSWORD = :password WHERE ID = :id");
$stmt->bindParam(':password', $hash);
$stmt->bindParam(':id', $id);
     
$stmt->execute();
header("Location: ../index.php?include=admin&site=userlist&profile=$id&msg=pwsuccess");
exit();

?>
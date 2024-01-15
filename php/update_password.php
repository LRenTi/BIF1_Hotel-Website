<?php
// Script um passwort zu ändern
session_start();
require("dbaccess.php");

// Daten aus dem Formular holen
$username = $_POST["username"];
$newpw = $_POST["newpw"];
$newpw2 = $_POST["newpw2"];
$oldpw = $_POST["oldpw"];


$stmt = $mysql->prepare("SELECT * FROM ACCOUNTS WHERE USERNAME = :user");
$stmt->bindPARAM(":user", $_SESSION["usernameSession"]);
$stmt->execute();
$count = $stmt->rowCount();

// Wenn ein Account gefunden wurde
if($count >= 1){
    $row = $stmt->fetch();

    // Wenn das alte Passwort nicht stimmt
    if(!password_verify($oldpw, $row["PASSWORD"])){
        header("Location: ../index.php?include=profile&site=change&msg=pwwrong");
        exit();
    }
    // Wenn die Passwörter nicht übereinstimmen
    if($newpw != $newpw2){
        header("Location: ../index.php?include=profile&site=change&msg=pwdiverge");
        exit();
    }
    // Wenn das neue Passwort gleich dem alten ist
    if($newpw == $oldpw){
        header("Location: ../index.php?include=profile&site=change&msg=pwsame");
        exit();
    }
    
    // Password hashen und updaten
    $hash = password_hash($_POST["newpw"], PASSWORD_BCRYPT);        
    $stmt = $mysql->prepare("UPDATE ACCOUNTS SET PASSWORD = :password WHERE username = :session_username");
    $stmt->bindParam(':password', $hash);
    $stmt->bindParam(':session_username', $_SESSION["usernameSession"]);        
    $stmt->execute();
    header("Location: ../index.php?include=profile&site=change&msg=pwsuccess");
    exit();
    }

else {
    header("Location: ../index.php");
    exit();
}

?>
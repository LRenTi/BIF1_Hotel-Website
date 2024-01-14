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
if($count >= 1){
    $row = $stmt->fetch();

    if(!password_verify($oldpw, $row["PASSWORD"])){
        header("Location: ../index.php?include=profile&site=change&msg=pwwrong");
        exit();
    }
    if($newpw != $newpw2){
        header("Location: ../index.php?include=profile&site=change&msg=pwdiverge");
        exit();
    }
    if($newpw == $oldpw){
        header("Location: ../index.php?include=profile&site=change&msg=pwsame");
        exit();
    }
        
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
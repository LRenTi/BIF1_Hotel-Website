<?php
// Script zum Profildaten ändern
session_start();
require("mysql.php");

// Daten aus dem Formular holen
$username = $_POST["username"];
$email = $_POST["email"];
$vorname = $_POST["Vorname"];
$nachname = $_POST["Nachname"];
$telefon = $_POST["telephone"];
$anrede = $_POST["anrede"];
$id = $_POST["user_id"];
// usw. für alle anderen Daten, die Sie aktualisieren möchten

// SQL-Abfrage vorbereiten
$stmt = $mysql->prepare("UPDATE ACCOUNTS SET USERNAME = :username, VORNAME = :vorname, NACHNAME = :nachname, EMAIL = :email, TELEFON = :telefon, ANREDE = :anrede WHERE ID = :id");

// Parameter binden
$stmt->bindParam(':username', $username);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':vorname', $vorname);
$stmt->bindParam(':nachname', $nachname);
$stmt->bindParam(':telefon', $telefon);
$stmt->bindParam(':anrede', $anrede);
$stmt->bindParam(':id', $id);

// Abfrage ausführen
$stmt->execute();

// Weiterleitung wenn Admin
if($_SESSION["roleSession"] == 2){
    header("Location: ../index.php?include=admin&site=userlist&profile=$id&msg=profilesuccess");
    exit();
}
// Aktualisieren der Session-Daten + zurück zum Profil
$_SESSION["usernameSession"] = $username;
header("Location: ../index.php?include=profile&site=change&msg=profilesuccess");
exit();
?>
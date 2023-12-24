<?php
session_start();
require("mysql.php");

// Daten aus dem Formular holen
$username = $_POST["username"];
$email = $_POST["email"];
$vorname = $_POST["Vorname"];
$nachname = $_POST["Nachname"];
$telefon = $_POST["telephone"];
$anrede = $_POST["anrede"];
// usw. für alle anderen Daten, die Sie aktualisieren möchten

// SQL-Abfrage vorbereiten
$stmt = $mysql->prepare("UPDATE ACCOUNTS SET USERNAME = :username, VORNAME = :vorname, NACHNAME = :nachname, EMAIL = :email, TELEFON = :telefon, ANREDE = :anrede WHERE username = :session_username");

// Parameter binden
$stmt->bindParam(':username', $username);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':vorname', $vorname);
$stmt->bindParam(':nachname', $nachname);
$stmt->bindParam(':telefon', $telefon);
$stmt->bindParam(':anrede', $anrede);
$stmt->bindParam(':session_username', $_SESSION["usernameSession"]);

// Abfrage ausführen
$stmt->execute();

// Aktualisieren Sie die Session-Daten
$_SESSION["usernameSession"] = $username;

// Weiterleiten des Benutzers zurück zum Profil
header("Location: ../index.php?include=profile");
exit();
?>
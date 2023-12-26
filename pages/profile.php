<?php
require_once(__DIR__ . "/../php/mysql.php");
$username = $_SESSION["usernameSession"];
$stmt = $mysql->prepare("SELECT * FROM ACCOUNTS WHERE USERNAME = :username");
$stmt->bindParam(':username', $username);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dein Profil</title>
</head>
<body>
    <div class="container-md">
        <h1 class="font-weight-bold mt-3">
            Profil - <?php echo $username; ?>
        </h1>
        <div>
            <a type="button" class="btn btn-gold" href="index.php?include=profile&site=booking">Deine Buchungen</a>
            <a type="button" class="btn btn-gold" href="index.php?include=profile&site=change">Profil ändern</a>
        </div>

        <?php

        if (!isset($_GET["site"]) && isset($_COOKIE["siteCookie"]))
        {
            $_GET["site"] = $_COOKIE["siteCookie"];
        }

			if(isset($_GET["site"]))
			{

                if ($_GET["site"] == "change")
				{
					include("profile/profilechange.php");
				} 
				if ($_GET["site"] == "booking")
				{
					include("profile/profilebooking.php");
				}
            }
            else {
                include("profile/profilebooking.php");
            }

        ?>
    </div>
</body>
</html>
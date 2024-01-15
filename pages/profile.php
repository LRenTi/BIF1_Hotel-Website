<?php
// Wenn nicht eingeloggt dann ...
if(!isset($_SESSION["usernameSession"]))
{
    header("Location: index.php?include=login");
}

// Wenn eingeloggt dann holt er sich die Accounts-Daten aus der Datenbank
require_once(__DIR__ . "/../php/dbaccess.php");
$username = $_SESSION["usernameSession"];
$stmt = $mysql->prepare("SELECT * FROM ACCOUNTS WHERE USERNAME = :username");
$stmt->bindParam(':username', $username);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

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

        // Wenn oben ein link geklickt wird dann wird der GET Parameter "site" gesetzt und die passende seite included
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
            else { // Wenn kein GET Parameter gesetzt ist
                include("profile/profilebooking.php");
            }

        ?>
    </div>
</body>